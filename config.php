<?php

/**
 * 后台首页欢迎标语
*
* @var string
*/
$config['admin']['index_title'] = '欢迎您使用 MyQEE '.Core::VERSION.' 管理平台';

/**
 * 登录后台后是否检查更新
 *
 * @var boolean
 */
$config['admin']['check_update'] = true;


/**
 * 后台首页是否显示支持信息
 *
 * @var boolean
 */
$config['admin']['show_support'] = true;


/**
 * 后台管理模块默认数据表配置
 *
 * @var string
 */
$config['admin']['database'] = 'admin';


/**
 * 登录尝试几次后显示验证码
 */
$config['admin']['login_error_show_captcha_num'] = 5;

/**
 * 24小时最大尝试次数，超过后当前IP将截止登录
 */
$config['admin']['login_max_error_num'] = 50;


/**
 * 管理员登录不活动超时时间，0表示只要浏览器不关闭则不限制
 *
 * @var int
 */
$config['admin']['login_expired_time'] = 3600;


/**
 * 头部菜单
 *
 * @var array
 */
$config['admin']['top_menu'][] = array
(
        'innerHTML' => '修改密码',
        'href'      => 'administrator/change_password/',
);


/**
 * 后台默认菜单
 *
 * @var array
 */
$config['admin']['menu'] = array
(
//     '[name]' => '默认菜单',

    'index' => array
    (
        'innerHTML' => '管理首页',
        'href' => '/',
        'style' => 'font-weight:bold',
        'dev_tools' => array
        (
            'prem' => 'index.phpinfo',
            'innerHTML' => '开发工具',
            'phpinfo' => array(
                'innerHTML' => 'phpinfo()',
                'href' => 'phpinfo/',
                'perm' => 'default.view_phpinfo',
            )
        ),
    ),

    'apps' => array
    (
        'innerHTML' => '应用管理',
        'list' => array(
            'innerHTML' => '应用商店',
            'list' => array(
                'innerHTML' => '精选应用',
                'href' => 'apps/',
            ),
            'paihang' => array
            (
                'innerHTML' => '排行榜',
                'href' => 'apps/paihang',
            ),
            'cat' => array(
                'innerHTML' => '应用分类',
                'href' => 'apps/cat',
            ),
            'buyed' => array(
                'innerHTML' => '已购买的应用',
                'href' => 'apps/buyed',
            ),
            'update' => array(
                'innerHTML' => '更新',
                'href' => 'apps/update',
            )
        )
    ),

    'member' => array
    (
        'innerHTML' => '管理员管理',
        'admin' => array(
            'innerHTML' => '成员管理',
            'list' => array
            (
                'innerHTML' => '管理员列表',
                'href' => 'administrator/',
                'perm' => 'administrator.view_user_info||administrator.is_group_manager',
            ),
            'add' => array
            (
                'innerHTML' => '添加管理员',
                'href' => 'administrator/add',
                'perm' => 'administrator.add_new_user||administrator.is_group_manager',
            )
        ),
        'admin_group' => array
        (
            'innerHTML' => '组管理',
            'list' => array
            (
                'innerHTML' => '权限组列表',
                'href' => 'administrator/group/',
                'perm' => 'administrator.view_group_info||administrator.can_edit_group',
            ),
            'add' => array
            (
                'innerHTML' => '添加权限组',
                'href' => 'administrator/group/add',
                'perm' => 'administrator.add_group',
            )
        )
    )
);