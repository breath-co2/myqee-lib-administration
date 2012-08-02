<?php $static_url = Core::url('/statics/skins/default/');?>
<style type="text/css">
#calendar-div{
    position:absolute;
    right:335px;
    top:50px;
    width:160px;
    height: 176px;
    background:url(<?php echo $static_url;?>weather_bg_l.png);
    text-shadow:1px 1px 0 rgba(0,0,0,0.5);
    color:rgba(255,255,255,0.9);
    font-size:1.2em;
    -webkit-background-size:100% 100%;
    background-size:100% 100%;
}
#calendar-date,#calendar-date-chinese{position:absolute;width:154px;height:18px;line-height:16px;overflow:hidden;margin:10px 0 0 6px;text-align:center;white-space:nowrap;}
#calendar-date-chinese{margin:148px 0 0 6px;}
.calender-num{position:absolute;margin:37px 0 0 25px;}
.calender-num span{background-image:url(<?php echo $static_url;?>weather_nums.png);background-repeat:no-repeat;float:left;width:55px;height:107px;-webkit-background-size:550px 107px;background-size:550px 107px;}
.calendar-num-0{background-position:0 0;}
.calendar-num-1{background-position:-55px 0;}
.calendar-num-2{background-position:-110px 0;}
.calendar-num-3{background-position:-165px 0;}
.calendar-num-4{background-position:-220px 0;}
.calendar-num-5{background-position:-275px 0;}
.calendar-num-6{background-position:-330px 0;}
.calendar-num-7{background-position:-385px 0;}
.calendar-num-8{background-position:-440px 0;}
.calendar-num-9{background-position:-495px 0;}


#weather-div{
    position:absolute;
    right:28px;
    background:url(<?php echo $static_url;?>weather_bg_r.png);
    width: 303px;
    height:176px;
    top:50px;
    text-shadow:1px 1px 0 rgba(0,0,0,0.5);
    color:rgba(255,255,255,0.9);
    background-size:100% 100%;
}
.weather-city{font-size:3.3em;position:absolute;margin:6px 0 0 15px;}
.weather-info{position: absolute;margin:70px 0 0 18px;font-size:1.3em;line-height:1.5em;height:3em;}
.weather-num{position: absolute;margin:120px 0 0 16px;font-size:3em;font-family:sans-serif;}
.weather-location{position: absolute;margin:132px 0 0 0;right:12px;background-image:url(<?php echo $static_url;?>weather_location.png);width:27px;height:33px;background-size:100% 100%;cursor:pointer;}
.weather-img{width: 280px;height: 230px;position: absolute;margin:-60px 0 0 0;right:-55px;}
    .weather_daySun{background-image:url(<?php echo $static_url;?>weather_daytime_daySun.png);}
    .weather_bigrain{background-image:url(<?php echo $static_url;?>weather_daytime_bigrain.png);}
    .weather_bigstorm{background-image:url(<?php echo $static_url;?>weather_daytime_bigstorm.png);}
    .weather_bigwind{background-image:url(<?php echo $static_url;?>weather_daytime_bigwind.png);}
    .weather_cloudy{background-image:url(<?php echo $static_url;?>weather_daytime_cloudy.png);}
    .weather_fog{background-image:url(<?php echo $static_url;?>weather_daytime_fog.png);}
    .weather_middlerain{background-image:url(<?php echo $static_url;?>weather_daytime_middlerain.png);}
    .weather_rainstorm{background-image:url(<?php echo $static_url;?>weather_daytime_rainstorm.png);}
    .weather_sand{background-image:url(<?php echo $static_url;?>weather_daytime_sand.png);}
    .weather_smallrain{background-image:url(<?php echo $static_url;?>weather_daytime_smallrain.png);}
    .weather_smallStorm{background-image:url(<?php echo $static_url;?>weather_daytime_smallStorm.png);}
    .weather_tinywind{background-image:url(<?php echo $static_url;?>weather_daytime_tinywind.png);}
    .weather_yin{background-image:url(<?php echo $static_url;?>weather_daytime_yin.png);}
    .weather_nighttime_sun{background-image:url(<?php echo $static_url;?>weather_nighttime_sun.png);}

.for-small-window #calendar-div{top:300px;right:28px;transform:scale(0.5,0.5);}
.for-small-window #weather-div{background-image:url(<?php echo $static_url;?>weather_bg_r2.png);width:160px;height:250px;}
.for-small-window .weather-city{margin-top:90px;text-align:center;width:130px;}
.for-small-window .weather-info{margin-top:145px;text-align:center;width:130px;}
.for-small-window .weather-num{margin-top:200px;text-align:center;width:130px;font-size:2em;}
.for-small-window .weather-location{right:10px;margin-top:108px}
.for-very-small-window #weather-and-calendar-div{
    transform:scale(0.5,0.5);
    -moz-transform:scale(0.5,0.5);
    -webkit-transform:scale(0.5,0.5);
    -ms-transform:scale(0.5,0.5);
    -o-transform:scale(0.5,0.5);
    transform-origin:top right;
    -moz-transform-origin:top right;
    -webkit-transform-origin:top right;
    -ms-transform-origin:top right;
    -o-transform-origin:top right;
}

/* for ratina */
@media only screen and (-webkit-min-device-pixel-ratio:1.5),only screen and (min--moz-device-pixel-ratio:1.5),only screen and (min-device-pixel-ratio:1.5),only screen and (min-resolution:200dpi)
{
.big-screen #calendar-div{background-image:url(<?php echo $static_url;?>weather_bg_l@2x.png);}
.big-screen #weather-div{background-image:url(<?php echo $static_url;?>weather_bg_r@2x.png);}
.big-screen .weather-location{background-image:url(<?php echo $static_url;?>weather_location@2x.png);}
.big-screen .calender-num span{background-image:url(<?php echo $static_url;?>weather_nums@2x.png);}
}
</style>
<div id="weather-and-calendar-div">
    <div id="weather-div">
        <div id="weather-show-div"></div>
        <div id="weather-setting-div" style="display:none;">
            <div style="padding:16px 25px 0 25px;"><h3 style="padding-bottom:10px">设置我的位置</h3>
            <?php echo Form::select(null,Weather::city_array_for_select(),'',array('id'=>'weather-select','style'=>'width:100%;'));?>
            <input class="btn btn-success" type="button" id="weather-setting-ok" value="确定完成" style="width:100%;margin-bottom:8px;" /> <input style="width:100%;margin-bottom:8px;" class="btn" type="button" id="weather-setting-cancel" value="取消" /></div>
        </div>
    </div>
    <div id="calendar-div"></div>
</div>

<script type="text/javascript">
(function(){
var chinese_calendar = function(today)
{
    function DaysNumberofDate(DateGL)
    {
        return parseInt((Date.parse(DateGL)-Date.parse(DateGL.getFullYear()+"/1/1"))/86400000)+1;
    }
    function CnDateofDate(DateGL)
    {
        var CnData=new Array(
            0x16,0x2a,0xda,0x00,0x83,0x49,0xb6,0x05,0x0e,0x64,0xbb,0x00,0x19,0xb2,0x5b,0x00,
            0x87,0x6a,0x57,0x04,0x12,0x75,0x2b,0x00,0x1d,0xb6,0x95,0x00,0x8a,0xad,0x55,0x02,
            0x15,0x55,0xaa,0x00,0x82,0x55,0x6c,0x07,0x0d,0xc9,0x76,0x00,0x17,0x64,0xb7,0x00,
            0x86,0xe4,0xae,0x05,0x11,0xea,0x56,0x00,0x1b,0x6d,0x2a,0x00,0x88,0x5a,0xaa,0x04,
            0x14,0xad,0x55,0x00,0x81,0xaa,0xd5,0x09,0x0b,0x52,0xea,0x00,0x16,0xa9,0x6d,0x00,
            0x84,0xa9,0x5d,0x06,0x0f,0xd4,0xae,0x00,0x1a,0xea,0x4d,0x00,0x87,0xba,0x55,0x04
        );
        var CnMonth=new Array();
        var CnMonthDays=new Array();
        var CnBeginDay;
        var LeapMonth;
        var Bytes=new Array();
        var I;
        var CnMonthData;
        var DaysCount;
        var CnDaysCount;
        var ResultMonth;
        var ResultDay;
        var yyyy=DateGL.getFullYear();
        var mm=DateGL.getMonth()+1;
        var dd=DateGL.getDate();
        if(yyyy<100) yyyy+=1900;
        if ((yyyy < 1997) || (yyyy > 2020)){
            return 0;
        }
        Bytes[0] = CnData[(yyyy - 1997) * 4];
        Bytes[1] = CnData[(yyyy - 1997) * 4 + 1];
        Bytes[2] = CnData[(yyyy - 1997) * 4 + 2];
        Bytes[3] = CnData[(yyyy - 1997) * 4 + 3];
        if ((Bytes[0] & 0x80) != 0) {CnMonth[0] = 12;}
        else {CnMonth[0] = 11;}
        CnBeginDay = (Bytes[0] & 0x7f);
        CnMonthData = Bytes[1];
        CnMonthData = CnMonthData << 8;
        CnMonthData = CnMonthData | Bytes[2];
        LeapMonth = Bytes[3];
        for (I=15;I>=0;I--)
        {
            CnMonthDays[15 - I] = 29;
            if (((1 << I) & CnMonthData) != 0 ){
                CnMonthDays[15 - I]++;}
            if (CnMonth[15 - I] == LeapMonth ){
                CnMonth[15 - I + 1] = - LeapMonth;}
            else{
                if (CnMonth[15 - I] < 0 ){CnMonth[15 - I + 1] = - CnMonth[15 - I] + 1;}
            else {CnMonth[15 - I + 1] = CnMonth[15 - I] + 1;}
                if (CnMonth[15 - I + 1] > 12 ){ CnMonth[15 - I + 1] = 1;}
            }
        }
        DaysCount = DaysNumberofDate(DateGL) - 1;
        if (DaysCount <= (CnMonthDays[0] - CnBeginDay))
        {
            if ((yyyy > 1901) && (CnDateofDate(new Date((yyyy - 1)+"/12/31")) < 0))
            {
                ResultMonth = - CnMonth[0];
            }
            else {
                ResultMonth = CnMonth[0];
            }
            ResultDay = CnBeginDay + DaysCount;
        }
        else
        {
            CnDaysCount = CnMonthDays[0] - CnBeginDay;
            I = 1;
            while ((CnDaysCount < DaysCount) && (CnDaysCount + CnMonthDays[I] < DaysCount))
            {
              CnDaysCount+= CnMonthDays[I];
              I++;
            }
            ResultMonth = CnMonth[I];
            ResultDay = DaysCount - CnDaysCount;
        }
        if (ResultMonth > 0)
        {
            return ResultMonth * 100 + ResultDay;
        }
        else
        {
            return ResultMonth * 100 - ResultDay;
        }
    }

    function CnMonthofDate(DateGL)
    {
        var CnMonthStr=new Array("零","正","二","三","四","五","六","七","八","九","十","冬","腊");
        var Month;
        Month = parseInt(CnDateofDate(DateGL)/100);
        if (Month < 0){return "闰" + CnMonthStr[-Month] + "月";}
          else{return CnMonthStr[Month] + "月";}
    }

    function CnDayofDate(DateGL)
    {
        var CnDayStr=new Array("零",
        "初一", "初二", "初三", "初四", "初五",
        "初六", "初七", "初八", "初九", "初十",
        "十一", "十二", "十三", "十四", "十五",
        "十六", "十七", "十八", "十九", "二十",
        "廿一", "廿二", "廿三", "廿四", "廿五",
        "廿六", "廿七", "廿八", "廿九", "三十");
        var Day;
        Day = (Math.abs(CnDateofDate(DateGL)))%100;
        return CnDayStr[Day];
    }

    function DaysNumberofMonth(DateGL)
    {
        var MM1=DateGL.getFullYear();
        MM1<100 ? MM1+=1900:MM1;
        var MM2=MM1;
        MM1+="/"+(DateGL.getMonth()+1);
        MM2+="/"+(DateGL.getMonth()+2);
        MM1+="/1";
        MM2+="/1";
        return parseInt((Date.parse(MM2)-Date.parse(MM1))/86400000);
    }

    if(CnMonthofDate(today)=="零月") return '';

    else return "农历 " + CnMonthofDate(today) + CnDayofDate(today);
};

(function(){
    var d = new Date();
    var day = d.getDate();
    var dd=[];
    if (day<10){dd[0]=0;dd[1]=day;}
    else{dd[0]=(day-day%10)/10;dd[1]=day%10;}
    
    $('#calendar-div').html('<div id="calendar-date">'+d.format('Y年m月')+' 星期'+'天一二三四五六'.charAt(d.getDay())+'</div><div id="calendar-date-chinese">'+chinese_calendar(d)+'</div><div class="calender-num"><span class="calendar-num-'+dd[0]+'"></span><span class="calendar-num-'+dd[1]+'"></span></div>');

    delete chinese_calendar;
    delete d;
    delete day;
    delete dd;
})();

(function(){
    var city = localStorage.getItem('weather_city')||'shanghai';
    var get_weather = function()
    {
        $.ajax(MyQEE.Url.Site + '/desktop/weather_data?city='+city).success(function(html){
            $('#weather-show-div').html(html);
        }).error(function(){
            $('#weather-show-div').html('<div style="padding:40px 0 0 0;text-align:center;">加载失败</div>');
        });
    }

    // 获取天气
    get_weather();

    // 添加weather div的onclick绑定事件
    var fun = function()
    {
        var obj = $('#weather-div');
        obj.transition({rotateY:'90deg'},function(){
            if (MyQEE.$('weather-show-div').style.display=='none')
            {
                MyQEE.$('weather-show-div').style.display = '';
                MyQEE.$('weather-setting-div').style.display = 'none';
            }
            else
            {
                MyQEE.$('weather-show-div').style.display = 'none';
                MyQEE.$('weather-setting-div').style.display = '';
                MyQEE.$('weather-select').value = city;
            }
            obj.transition({rotateY:'0deg'});
            delete obj;
        });
    }

    MyQEE.$('weather-show-div').onclick = fun;
    MyQEE.$('weather-setting-cancel').onclick = fun;
    MyQEE.$('weather-setting-ok').onclick = function()
    {
        city = MyQEE.$('weather-select').value||'shanghai';
        localStorage.setItem('weather_city',city);
        get_weather();
        fun();
    };

})();

})();
</script>