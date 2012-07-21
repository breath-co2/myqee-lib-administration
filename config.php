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
$config['admin']['login']['error_show_captcha_num'] = 5;

/**
 * 24小时最大尝试登录次数，超过后当前IP将截止登录
 */
$config['admin']['login']['max_error_num'] = 20;


/**
 * 管理员登录不活动超时时间，0表示只要浏览器不关闭则不限制
 *
 * @var int
 */
$config['admin']['login']['expired_time'] = 3600;


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
 * 后台菜单
 *
 * @var array
 */
$config['admin']['menu'] = array
(
    'index' => array
    (
        'innerHTML' => '管理首页',
        'style' => 'font-weight:bold',
        'href' => '/',
        'dev_tools' => array
        (
            'prem' => 'index.phpinfo',
            'innerHTML' => '开发工具',
            'phpinfo' => array
            (
                'innerHTML' => 'phpinfo()',
                'href' => 'phpinfo/',
                'perm' => 'default.view_phpinfo',
            ),
        ),
    ),

    'apps' => array
    (
        'innerHTML' => '应用管理',
        'list' => array(
            'innerHTML' => '应用商店',
            'list' => array
            (
                'innerHTML' => '精选应用',
                'href' => 'apps/',
            ),
            'paihang' => array
            (
                'innerHTML' => '排行榜',
                'href' => 'apps/a/paihang',
            ),
            'cat' => array
            (
                'innerHTML' => '应用分类',
                'href' => 'apps/a/cat',
            ),
            'installed' => array
            (
                'innerHTML' => '已安装的应用',
                'href' => 'apps/a/installed',
            ),
            'update' => array
            (
                'innerHTML' => '更新',
                'href' => 'apps/a/update',
            ),
        ),
        'apps' => array
        (
            'innerHTML' => '应用程序',
            'test' => array
            (
                'innerHTML' => 'test',
                'href' => 'apps/myqee/test/',
            ),
        ),
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

/**
 * 权限设置
 *
 * @var array
 */
$config['admin']['permission'] = array
(
    'default' => array
    (
        'name' => '常规权限',
        'perm' => array
        (
            'view_serverinfo' => '首页查看服务器信息',
            'use_notepad'     => '使用首页便签',
            'view_phpinfo'    => '查看phpinfo()',
            'view_log'        => '查看操作日志',
            'update'		  => '系统升级',
        ),
    ),
    'administrator' => array
    (
        'name' => '后台用户管理权限',
        'perm' => array
        (
            '普通用户---------------------------------------------',
            'edit_self_password'               => '修改自己的密码',
            'edit_self_info'                   => '修改自己的信息',

            '用户管理权限------------------------------------------',
            'view_user_info'                   => '查看所有用户信息',
            'edit_user_info'                   => '修改所有用户信息',
            'change_user_password'             => '修改所有用户密码',
            'change_user_perm'                 => '修改所有用户权限',
            'add_new_user'                     => '创建新用户',
            'shield_user'                      => '屏蔽用户',
            'liftshield_user'                  => '解除屏蔽用户',
            'delete_user'                      => '删除用户',

            '权限组管理--------------------------------------------',
            'view_group_info'                  => '查看权限组信息',
            'edit_group_info'                  => '修改权限组信息',
            'edit_group_perm'                  => '修改权限组权限',
            'add_group'                        => '添加权限组',
            'delete_group'                     => '删除权限组',
            'edit_menu_config'                 => '修改用户菜单配置',
        ),
    ),
);