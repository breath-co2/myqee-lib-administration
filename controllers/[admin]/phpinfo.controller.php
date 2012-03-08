<?php
namespace Library\MyQEE\Administration\Controller;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class phpinfo extends \Controller\Admin
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