<?php
namespace Library\MyQEE\Administration;

/**
 * 登录，退出控制器
 *
 * @author jonwang
 *
 */
class Controller_Login extends \Controller
{
    protected $message = '';

    protected $error_input;

    public function action_index()
    {
        $member = array
        (
            'message' => '',
            'input'   => '',
        );

        $can_not_login = false;
        $show_captcha = false;
        $db = \Database::instance(\Model_Admin::DATABASE);

        if ( $db->count_records('admin_login_error_log',array('timeline<='=>\TIME-86400)) )
        {
            # 清除24小时前的登录错误信息
            $db->where('timeline<=',\TIME-86400)->delete('admin_login_error_log');
        }

        $error = $db->from('admin_login_error_log')->where('ip',\HttpIO::IP)->limit(1)->get()->current();

        if ($error)
        {
            $error_num = $error['error_num'];
            $config = \Core::config('admin.login');
            if ( $error_num>=$config['error_show_captcha_num']-1 )
            {
                $show_captcha = true;
            }
            if ( $config['max_error_num'] && $error_num>=$config['max_error_num'] )
            {
                $can_not_login = true;
                $this->message = \__('Attempts too much, and temporarily can not login');
            }
        }

        if (\HttpIO::METHOD=='POST')
        {
            //错误次数太多，暂不允许登录
            if ($can_not_login)
            {
                $this->show_error( $this->message , array('show_captcha' => false , 'can_not_login' => true) );
            }

            $member = $this->post($_POST,$error_num);

            if ($member)
            {
                $member->last_login_ip         = \HttpIO::IP;
                $member->last_login_time       = \TIME;
                $member->last_login_session_id = $this->session()->id();
                $member->value_increment('login_num');
                $member->update();

                # 开启session
                $this->session()->start();
                $this->session()->set_member($member);

                $this->show_success(\__('Login success'),array('member_id'=>$member->id,'username'=>$member->username,'gravatar'=>\html::gravatar($member->email?$member->email:'admin@myqee.com',32),'loginNum'=>$member->login_num));
            }
            else
            {
                $this->show_error( $this->message .($config['max_error_num'] && $config['max_error_num']-$error_num<=5?' ('.\__('Have :num chance',array(':num'=>$config['max_error_num']-$error_num)).')':'') , array('error_input' => $this->error_input , 'show_captcha' => $show_captcha) );
            }
        }

        $login_message = $this->session()->get('admin_member_login_message');

        $view = new \View('admin/login');
        $view->can_not_login = $can_not_login;
        $view->show_captcha = $show_captcha;
        $view->message = $login_message?$login_message:$this->message;
        $view->render();
    }

    /**
     * 退出
     */
    public function action_out()
    {
        # 销毁session
        $this->session()->start()->destroy();

        #页面跳转到登录页
        $this->redirect(\Core::url('/'));
    }

    /**
     * 处理提交
     *
     * @param array $data
     * @return \Member 失败则返回false
     */
    protected function post($data,$error_num)
    {
        if (!$data['username'])
        {
            $this->message = \__('Username can not be empty');
            $this->error_input = 'username';

            return false;
        }
        if (!$data['password'])
        {
            $this->message = \__('The password can not be empty');
            $this->error_input = 'password';

            return false;
        }

        $db = \Database::instance(\Model_Admin::DATABASE);

        try
        {
            if ( $error_num )
            {
                # 有登录错误
                $config = \Core::config('admin.login');
                if ( $error_num>=$config['error_show_captcha_num']-1 )
                {
                    if ( \Captcha::valid($data['captcha'])<0 )
                    {
                        $this->error_input = 'captcha';
                        throw new \Exception(\__('Verification code error'));
                    }
                }
            }

            $member_finder = new \ORM_Admin_Member_Finder();
            $member = $member_finder->get_member_by_username($data['username']);

            if ( !$member )
            {
                $this->error_input = 'username';
                throw new \Exception(\__('User does not exist'));
            }

            if ( !$member->check_password($data['password']) )
            {
                $this->error_input = 'password';
                throw new \Exception(\__('Password is incorrect'));
            }

            if ( $error_num )
            {
                # 清除登录记录
                $db->delete('admin_login_error_log', array('ip'=>\HttpIO::IP));
            }

            $id = (int)$member->id;
            $_POST['password'] = '******';    //日志中隐藏密码项

            if ($member->project != \Bootstrap::$project && !$member->perm()->is_super_perm())
            {
                throw new \Exception(\__('Not allowed to login through this page'),-1);
            }

            if ( $member->shielded )
            {
                $this->error_input = 'username';
                throw new \Exception(\__('You have been blocked'), -1 );
            }
        }
        catch (\Exception $e)
        {
            if (0===$e->getCode())
            {
                # 验证失败
                $error_num++;
                if (1===$error_num)
                {
                    $db->insert('admin_login_error_log',array(
                    	'ip'                 => \HttpIO::IP,
                        'timeline'           => \TIME,
                        'error_num'          => 1,
                        'last_error_msg'     => $e->getMessage(),
                        'last_post_username' => $data['username'],
                    ));
                }
                else
                {
                    $db->update('admin_login_error_log',
                        array(
                            'timeline'           => \TIME,
                            'error_num+'         => 1,
                            'last_error_msg'     => $e->getMessage(),
                            'last_post_username' => $data['username'],
                        ),
                        array('ip' => \HttpIO::IP)
                    );
                }
            }

            $this->message = $e->getMessage();
            $id = 0;
            $member = false;

        }

        # 记录登录日志
        $db->insert('admin_log',
            array(
                'uri'      => $_SERVER["REQUEST_URI"],
                'type'     => 'login',
                'ip'       => \HttpIO::IP,
                'referer'  => $_SERVER["HTTP_REFERER"],
                'post'     => \serialize($_POST),
                'admin_id' => $id,
            )
        );

        return $member;
    }
}