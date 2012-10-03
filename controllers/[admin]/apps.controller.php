<?php
namespace Library\MyQEE\Administration;

/**
 * 应用管理控制器
 *
 * @author jonwang
 *
 */
class Controller_Apps extends \Controller_Admin
{
    protected $base_url = 'http://myqee.com/api/apps/';

    /**
     * 管理页面首页控制器
     */
    public function action_index()
    {
        $this->get_data('');
    }

    public function action_a($type='')
    {
        $this->get_data($type);
    }

    public function action_default()
    {
        if (\count($this->arguments)<2)
        {
            \Core::show_404();
        }

        $uri_arr      = $this->arguments;
        $app = \array_shift($uri_arr) . DS . \array_shift($uri_arr);

        if (!$uri_arr)$uri_arr = array('index');

        # 检查是否已开启
        if ( !is_file(\DIR_APPS . $app . \DS . '.installed') )
        {
            $this->show_error('指定的APP还没有安装，请先安装');
        }

        # 配置文件
        $config_file = \DIR_APPS . $app . \DS . 'config.ini';
        # 读取配置文件
        if (\is_file($config_file))
        {
            $app_config = @\parse_ini_file($config_file,\INI_SCANNER_NORMAL,true);
            if (!$app_config)$app_config = array();
        }

        # 当前控制器
        $controller = \DIR_APPS . $app . \DS .  '[admin]' . \DS . \implode(\DS, $uri_arr) . '.html';
        if (!\is_file($controller))
        {
            $this->show_error('指定的APP控制器不存在');
        }

        # 载入APP类库
        $libraries = \Core::config('core.libraries.app');
        if ($libraries)
        {
            # 逆向排序
            \rsort($libraries);

            foreach ($libraries as $library_name)
            {
                if (!$library_name)continue;

                \Core::import_library($library_name);
            }
        }

        # Smarty缓存目录
        $big_dir = \DIR_CACHE . 'apps' . \DS . $app . \DS . 'smarty' . \DS . 'admin' . \DS;

        $smarty = new \Smarty();

        # 设置缓存目录
        $smarty->setCacheDir( $big_dir . 'cache' . \DS );

        # 设置模板编译目录
        $smarty->setCompileDir( $big_dir . 'templates_c' . \DS );

        # 设置模板目录
        $smarty->setTemplateDir( \DIR_APPS . $app . \DS . '[admin]' . \DS . 'tpl' . \DS );

        foreach (\Core::$include_puth as $path)
        {
            if (\is_dir($path.'smarty_plugins'))
            {
                # 增加Smarty插件目录
                $smarty->addPluginsDir($path.'smarty_plugins');
            }
        }

        # 输出
        $smarty->display($controller);
    }

    protected function get_data($url)
    {
        $rs = \HttpClient::factory()->get($this->base_url.$url.'?v='.\Core::VERSION);

        if ( 200==$rs->code() )
        {
            echo $rs->data();
        }
        else
        {
            echo '<div style="padding:6px;">请求数据失败，请稍后再试</div>';
            if ( \IS_DEBUG )
            {
                echo '<br>code:'.$rs->code();
                echo '<br><br>'.$rs->data();
            }
        }
    }
}