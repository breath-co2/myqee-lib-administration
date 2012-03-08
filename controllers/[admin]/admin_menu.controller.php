<?php
namespace Library\MyQEE\Administration\Controller;

/**
 * 首页控制器
 *
 * @author jonwang
 *
 */
class admin_menu extends \Controller\Admin
{

    /**
     * 管理页面首页控制器
     */
    public function action_default()
    {
        $admin_menu = \Core::config('admin.menu');
        $this->header_check_perm($admin_menu);

        # 输出js头信息
        \header( 'Content-Type: application/x-javascript' );
        # 输出缓存信息
        \header( 'Cache-Control: max-age=604800' );
        \header( 'Last-Modified: ' . \date( 'D, d M Y H:i:s \G\M\T' ) );
        \header( 'Expires: ' . \date('D, d M Y H:i:s \G\M\T', \TIME + 86400) );
        \header( 'Pragma: cache');
        echo 'var _myqee_admin_menu = ',\json_encode($admin_menu).';';
        echo 'change_menu(myqee_top_menu,null,myqee_menu);';
        exit;
    }

}