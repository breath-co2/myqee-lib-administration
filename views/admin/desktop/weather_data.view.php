<?php
$cArr = array
(
    'd0.gif' => 'daySun',          //晴
    'd1.gif' => 'cloudy',
    'd2.gif' => 'yin',
    'd3.gif' => 'cloudy',
    'd4.gif' => 'smallrain',
    'd5.gif' => 'middlerain',
    'd6.gif' => 'middlerain',
    'd7.gif' => 'smallrain',
    'd8.gif' => 'middlerain',
    'd9.gif' => 'bigrain',
    'd10.gif' => 'bigrain',
    'd11.gif' => 'bigrain',
    'd12.gif' => 'bigrain',
    'd13.gif' => 'smallStorm',
    'd14.gif' => 'smallStorm',
    'd15.gif' => 'smallStorm',
    'd16.gif' => 'smallStorm',
    'd17.gif' => 'smallStorm',
    'd18.gif' => 'tinywind',
    'd19.gif' => 'bigstorm',
    'd20.gif' => 'fog',
    'd21.gif' => 'smallrain',
    'd22.gif' => 'bigrain',
    'd23.gif' => 'bigrain',
    'd24.gif' => 'bigrain',
    'd25.gif' => 'bigrain',
    'd26.gif' => 'smallStorm',
    'd27.gif' => 'smallStorm',
    'd28.gif' => 'smallStorm',
    'd29.gif' => 'rainstorm',
    'd30.gif' => 'sand',
    'd31.gif' => 'bigwind',
);
if ( date('H')>=19||date('H')<=6 )
{
    $cArr['d00.gif'] = 'nighttime_sun';    //夜间
    $img = str_replace('n','d',$weather['img1']);
}
else
{
    $img = $weather['img1'];
}

$condition = $cArr[$img];
if (!$condition)$condition = 'daySun';
?>
<div class="weather-img weather_<?php echo $condition;?>"></div><div class="weather-city"><?php echo Weather::city($city);?></div><div class="weather-info"><?php echo $weather['weather'];?></div><div class="weather-num"><?php echo $weather['temp2'],'~'.$weather['temp1'];?></div><div id="weather-location" class="weather-location"></div>