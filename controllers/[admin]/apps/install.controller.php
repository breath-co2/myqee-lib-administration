<?php
namespace Library\MyQEE\Administration;

/**
 * 安装应用控制器
 *
 * @author jonwang
 *
 */
class Controller_Apps__Install extends \Controller_Admin
{
    protected $base_url = 'http://myqee.com/api/apps/';

    /**
     * 管理页面首页控制器
     */
    public function action_default()
    {
        $id = $this->arguments[0];

        if (!$id)
        {
            $this->show_error('缺少参数');
        }

        # APP URL
        $url = $this->base_url .'get_app_info?id='.$id;

        /*
        # 获取APP信息
        $data = \HttpClient::factory()->get($url)->data();

        $data = @\unserialize($data);
        */
        $data = array
        (
            'title' => '测试',
            'url'   => 'http://myqee.com/app_test/Archive.zip',
            'type'  => 'plug-in',
            'hash'  => 'd7646fa39b991f02f99251a477dd3ee2',
        );

        $file_dat = \HttpClient::factory()->get($data['url'])->data();

        # 保存文件
        \file_put_contents(\DIR_TEMP.$data['hash'],$file_dat);

        echo 'ok';
    }

}