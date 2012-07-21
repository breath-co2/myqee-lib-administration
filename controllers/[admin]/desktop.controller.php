<?php
namespace Library\MyQEE\Administration;

/**
 * 页面桌面显示控制器
 *
 * @author jonwang
 *
 */
class Controller_Desktop extends \Controller_Admin
{
    public function action_default()
    {
        $view = new \View('admin/desktop');
        $view->render();
    }
}