<?php
namespace Library\MyQEE\Administration;

/**
 * 后台管理功能基础控制器
 *
 * @author jonwang
 *
 */
class Controller_Admin extends \Controller
{
    /**
     * 页面标题
     *
     * @var string
     */
    protected $page_title;

    /**
     * 导航目录
     *
     * 数组形式
     *   array(
     *   	'目录1',
     *   	array(
     *   		'innerHTML'=>'目录2',
     *   	),
     *   	array(
     *   		'innerHTML'=>'目录3',
     *   		'href' => 'url2',
     *   	),
     *   	'目录4',
     *   )
     *
     * @var array
     */
    protected $location;

    /**
     * 检查是否登录
     */
    protected function check_login()
    {
        return ;
        $session = $this->session();
        $member = $session->member();

        try
        {
            if ( !$member->id>0 )
            {
                throw new \Exception(\__('Please login'));
            }

            # 超时时间
            if ( ( ($admin_login_expired_time = \Core::config('admin.core.admin_login_expired_time'))>0 && \TIME-$admin_login_expired_time>$session->last_actived_time() ) )
            {
                throw new \Exception(\__('Login timeout, please log in again'));
            }

            if ( $member->password!=$_SESSION['member_password'] )
            {
                throw new \Exception(\__('This account password has been updated, please re-login'));
            }

            if ( $member->setting['only_self_login'] && $session->id()!=$member->last_login_session_id )
            {
                # 如果设置为仅仅可单人登录，若发现最后登录session id和当前登录session不一致，则取消此用户登录，并输出相应信息
                throw new \Exception(\__('This account has been elsewhere login, log the IP: :ip - :iplocal, login time: :time',array(':ip'=>$member->last_login_ip,':iplocal'=>\IpSource::get($member->last_login_ip),':time'=>$member->last_login_time)));
            }

        }
        catch (\Exception $e)
        {
            if (\HttpIO::IS_AJAX)
            {
                # AJAX 请求
                self::message($e->getMessage(),-1);
            }
            else
            {
                # 正常页面请求

                # 记录错误消息
                $session->set_flash('admin_member_login_message',$e->getMessage());

                # 页面跳转
                $this->redirect( \Core::url('login/?forward='.\urlencode($_SERVER['REQUEST_URI'].($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''))) );
            }
            exit;
        }

    }

    public function before()
    {
        # 检查登录
        $this->check_login();

        # 记录访问日志
        if ( \HttpIO::METHOD=='POST' )
        {
            \Database::instance(\Model_Admin::DATABASE)->insert('admin_log',
                array(
                    'uri'      => $_SERVER["REQUEST_URI"],
                	'type'     => 'log',
                    'ip'       => \HttpIO::IP,
                    'referer'  => $_SERVER["HTTP_REFERER"],
                    'post'     => \serialize($_POST),
                    'admin_id' => $this->session()->member()->id,
                )
            );
        }

        # 不允许非超管跨项目访问
        if ( $this->session()->member()->project!=\Bootstrap::$project && !$this->session()->member()->is_super_admin )
        {
            self::message(\__('You do not have the authority to operate in this project, please contact administrator'),-1);
        }

        \ob_start();
    }

    public function after()
    {
        $output = \ob_get_clean();

        if ( !\HttpIO::IS_AJAX )
        {
            $this->run_header();
            echo $output;
            $this->run_bottom();
        }
        elseif (isset($_SERVER["HTTP_X_PJAX"]) && $_SERVER["HTTP_X_PJAX"]=='true')
        {
            # pjax支持

            $admin_menu = \Core::config('admin.menu',array());
            $url = \Core::url(\HttpIO::$uri);
            $page_title = $this->page_title;
            $location = $this->location;

            $this->header_check_perm($admin_menu);
            $menu = $this->header_get_sub_menu($admin_menu, $url);
            if (!$menu)
            {
                // 如果还是没有，则获取首页面
                $tmp_default = \current($admin_menu);
                $menu = $this->header_get_sub_menu($admin_menu, $tmp_default['href']);
                if (!$page_title)$page_title = \__('IndexPage');
            }
            if (!$menu)$menu = array();
            $top_menu = \current($menu);

            if ( !$location || !\is_array($location) )
            {
                $location = array();
            }

            $this_key_len = \count($menu) + \count($location);

            if ( $page_title )
            {
            }
            elseif ( $location )
            {
                \end($location);
                $tmp_menu = \current($location);
                $page_title = \is_array($tmp_menu) ? $tmp_menu['innerHTML'] : (string)$tmp_menu;
            }
            else
            {
                $i = 0;
                $tmp_menu = $admin_menu;
                foreach ( $menu as $key )
                {
                    $i ++;
                    $tmp_menu = $tmp_menu[$key];
                    if ( $i == $this_key_len )
                    {
                        // 获取标题
                        $page_title = \strip_tags($tmp_menu['innerHTML'], '');
                    }
                }
            }

            echo '<title>'.$page_title.'</title>'.\CRLF;
            echo $output;
            echo '<script>myqee_top_menu='.\var_export($top_menu,true).';myqee_menu='.\json_encode($menu).';renew_runtime('.\number_format(\microtime(true)-\START_TIME,4).')</script>';
        }
        else
        {
            echo $output;
        }
    }

    /**
     * 输出头部视图
     */
    protected function run_header()
    {
        $admin_menu = \Core::config('admin.menu',array());
        $url = \Core::url(\HttpIO::$uri);
        $page_title = $this->page_title;
        $location = $this->location;

        $this->header_check_perm($admin_menu);
        $menu = $this->header_get_sub_menu($admin_menu,$url);

        if (!$menu)
        {
            # 如果还是没有，则获取首页面
            $tmp_default = \current($admin_menu);
            $menu = $this->header_get_sub_menu($admin_menu,$tmp_default['href']);
            if (!$page_title)$page_title = \__('IndexPage');
        }
        if ( !$menu ) $menu = array();
        $top_menu = \current($menu);

        if (!$location || !\is_array($location))
        {
            $location = array();
        }

        $this_key_len = \count($menu) + \count($location);

        if ( $page_title )
        {
            $location[] = $page_title;
            $this_key_len += 1;
        }
        elseif( $location )
        {
            \end($location);
            $tmp_menu = \current($location);
            $page_title = \is_array($tmp_menu)?$tmp_menu['innerHTML']:(string)$tmp_menu;
        }
        else
        {
            $i=0;
            $tmp_menu = $admin_menu;
            foreach ($menu as $key){
                $i++;
                $tmp_menu = $tmp_menu[$key];
                if ($i==$this_key_len)
                {
                    # 获取标题
                    $page_title = \strip_tags($tmp_menu['innerHTML'],'');
                }
            }
        }

        $view = new \View('admin/header');
        $view->menu       = $menu;
        $view->top_menu   = $top_menu;
        $view->page_title = $page_title;
        $view->location   = $location;
        $view->admin_menu = $admin_menu;
        $view->url        = $url;

        $view->render(true);
    }

    /**
     * 输出尾部视图
     */
    protected function run_bottom()
    {
        $view = new \View('admin/bottom');
        $view->render(true);
    }

    /**
     * 获取子目录
     *
     * @param array $admin_menu
     * @param string $url
     * @param int $found
     */
    protected function header_get_sub_menu( array $admin_menu , $url , & $found=-1 )
    {
        $menu = array();
        $sub_menu = false;
        foreach ($admin_menu as $k=>$v)
        {
            if ( \is_array($v) )
            {
                if ( isset($v['href']) && $v['href']==$url )
                {
                    # 如果当前URL和$v['href']的设置完全相同，则返回
                    $menu = array($k);
                    $found = true;
                    break;
                }
                else
                {
                    $url_len = $v['href']?\strlen($v['href']):0;
                    if( (!isset($v['href']) && null===$url) || (isset($v['href']) && \substr($url,0,$url_len)==$v['href']) )
                    {
                        # 如果当前URL和$v['href']的前部分相同，则记录下来
                        if ( $url_len>$found )
                        {
                            $found = $url_len;
                            $sub_menu = array($k);
                        }
                    }

                    $submenu = $this->header_get_sub_menu($v,$url,$found);
                    if ( $submenu )
                    {
                        if ( true===$found )
                        {
                            $menu = array($k);
                            $menu = \array_merge($menu,$submenu);
                            break;
                        }
                        else
                        {
                            $sub_menu = \array_merge(array($k),$submenu);
                        }
                    }
                }
            }
        }
        if ( $menu )
        {
            return $menu;
        }
        elseif( $sub_menu )
        {
            return $sub_menu;
        }
        else
        {
            return false;
        }
    }

    /**
     * 检查权限，将没有权限的菜单移出
     *
     * @param array $admin_menu
     */
    protected function header_check_perm( & $admin_menu)
    {
        if (!is_array($admin_menu))$admin_menu = array();
        $perm = $this->session()->member()->perm();
        $havearr = false;
        foreach ( $admin_menu as $k=>&$v )
        {
            if ( \is_array($v) )
            {
                if (isset($v['perm']))
                {
                    $perm_key = $v['perm'];
                    unset($v['perm']);
                    if ( false!==\strpos($perm_key,'||') )
                    {
                        $perm_key = \explode('||', $perm_key);
                        $have_perm = false;
                        foreach ($perm_key as $p)
                        {
                            if ( $perm->is_own($p) )
                            {
                                $have_perm = true;
                                continue;
                            }
                        }
                        if (!$have_perm)
                        {
                            unset($admin_menu[$k]);
                            continue;
                        }
                    }
                    elseif ( false!==\strpos($perm_key,'&&') )
                    {
                        $perm_key = \explode('&&', $perm_key);
                        foreach ($perm_key as $p)
                        {
                            if ( !$perm->is_own($p) )
                            {
                                unset($admin_menu[$k]);
                                continue 2;
                            }
                        }
                    }
                    else
                    {
                        # 检查权限
                        if ( !$perm->is_own($perm_key) )
                        {
                            unset($admin_menu[$k]);
                            continue;
                        }
                    }
                }
                if ( false===$this->header_check_perm( $v ) )
                {
                    unset($admin_menu[$k]);
                }
                else
                {
                    $havearr = true;
                }
            }
            elseif ( $k=='href' )
            {
                if ( $v !='#' && !\preg_match('#^[a-z0-9]+://.*$#', $v) )
                {
                    $v = (string)\Core::url($v);
                }
            }

        }
        if ( false==$havearr && (!isset($admin_menu['href']) || $admin_menu['href']=='#' ) )
        {
            return false;
        }
    }
}