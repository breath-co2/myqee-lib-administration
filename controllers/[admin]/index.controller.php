<?php
namespace Library\MyQEE\Administration\Controller;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class Index extends \Controller\Admin
{
    /**
     * 管理页面首页控制器
     */
    public function action_default()
    {
        $this->page_title = '欢迎';
        $view = new \View('admin/index');

        $view->render(true);
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