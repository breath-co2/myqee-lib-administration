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

    /**
     * 获取天气信息
     */
    public function action_weather_data()
    {
        $city = $_GET['city'];
        if (!$city)
        {
            $city = \PinYIn::get(\IpSource::get());
            if (\in_array($city,array('LAN','Local IP','Invalid IP Address')))
            {
                $city = 'shanghai';
            }
        }
        $view = new \View('admin/desktop/weather_data');
        $view->weather = Weather::get($city);
        $view->city = $city;
        $view->render();
    }
}