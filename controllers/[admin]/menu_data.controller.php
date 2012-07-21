<?php
namespace Library\MyQEE\Administration;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class Controller_Menu_Data extends \Controller_Admin
{

    /**
     * 管理页面首页控制器
     */
    public function action_default()
    {
        $admin_menu = \Core::config('admin.menu');
        $this->header_check_perm($admin_menu);

        # 输出json头信息
        \header( 'Content-Type: application/json; charset=utf-8' );

        # 输出缓存信息
        self::header_cache(86400);

        echo json_encode($admin_menu);
        exit;
    }

}