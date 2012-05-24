<?php
namespace Library\MyQEE\Administration;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class Controller_Index extends \Controller_Admin
{
    /**
     * 管理页面首页控制器
     */
    public function action_default()
    {
//             \header( 'Cache-Control: max-age=604800' );
//             \header( 'Last-Modified: ' . \date( 'D, d M Y H:i:s \G\M\T', \TIME-1000 ) );
//             \header( 'Expires: ' . \date( 'D, d M Y H:i:s \G\M\T', \TIME + 86400 * 30 ) );
//             \header( 'Pragma: cache');

        $this->page_title = '欢迎';
        $view = new \View('admin/index');

        $view->render(true);
    }

    public function action_test()
    {
    	sleep(2);
    	echo('aaa<a href="/v3/admin/index/test2/">tttt</a>大大大<div style="height:1500px"></div>aaaaaaaaaaaa<div style="background:red;width:1500px;">sss</div>sdfsdf');
    }

    public function action_test2()
    {
    	echo('bbbbbbbbb'.\TIME);
    }

    /**
     * 输出头尾等视图供其它程序加载显示
     *
     * 需要通过$_POST传过来一些数据
     */
    public function action_view_api()
    {
        $view = new \View('admin/header');
        $view_data = $_POST['data'];
        if ( $view_data['title'] )
        {
            $view->page_title = $view_data['title'];
        }
        if ( $view_data['menu'] )
        {
            $menu = \explode('.', $view_data['menu']);
            $view->menu = $menu;
        }

        $data = array();
        $data['header'] = $view->render(false);

        $data['bottom'] = \View::factory('admin/bottom')->render(false);

        echo \json_encode($data);
        exit();
    }
}