<?php
namespace Library\MyQEE\Administration;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class Controller_phpinfo extends \Controller_Admin
{
    /**
     * PHPINFO
     */
    public function action_default()
    {
        $view = new \View('admin/phpinfo');
        $view->render(true);
    }
}