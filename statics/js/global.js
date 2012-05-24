if (typeof(MyQEE) != 'object')
{
	var MyQEE = {};
}
MyQEE.userAgent = navigator.userAgent.toLowerCase();

MyQEE.is_firefox = MyQEE.userAgent.indexOf('firefox')>=0?true:false;
MyQEE.is_opera = navigator.appName.indexOf('Opera')>=0?true:false;
MyQEE.is_safari = MyQEE.userAgent.indexOf('safari')>=0?true:false;
MyQEE.is_chrome = MyQEE.userAgent.indexOf('chrome')>=0?true:false;if(MyQEE.is_chrome)MyQEE.is_safari=false;
MyQEE.is_iphone = MyQEE.userAgent.indexOf('iphone')>=0?true:false;
MyQEE.is_ipod = MyQEE.userAgent.indexOf('ipod')>=0?true:false;
MyQEE.is_ipad = MyQEE.userAgent.indexOf('ipad')>=0?true:false;
MyQEE.is_ios = MyQEE.is_iphone||MyQEE.is_ipod||MyQEE.is_ipad;
MyQEE.is_ie =navigator.appName=="Microsoft Internet Explorer"?true:false;
MyQEE.ie = (MyQEE.userAgent.indexOf('msie') != -1 && !MyQEE.is_opera) && MyQEE.userAgent.substr(MyQEE.userAgent.indexOf('msie') + 5, 3);

(function()
{
    if (MyQEE.userAgent.indexOf('webkit')!=-1)
    {
        MyQEE.cssPre = 'Webkit';
    }
    else if (MyQEE.userAgent.indexOf('moz')!=-1)
    {
        MyQEE.cssPre = 'Moz';
    }
    else if (MyQEE.userAgent.indexOf('msie')!=-1)
    {
        MyQEE.cssPre = 'Ms';
    }
    else if (MyQEE.userAgent.indexOf('opera')!=-1)
    {
        MyQEE.cssPre = 'O';
    }
    else
    {
        MyQEE.cssPre = '';
    }
})();

MyQEE.$ = function(id)
{
    return document.getElementById(id);
}

/**
 * 将日期格式化输出，类似php的date方法，本接口默认偏移时区为+8
 * @param str 例如 Y-m-d H:i:s
 * @param utc 偏移时区，默认+8
 */
Date.prototype.format = function(str,utc){
    str = str || 'Y-m-d H:i:s';
    if (!(utc>=-12 && utc<=12)){
        utc = 8;
    }
    utc = utc*60*60*1000;
    var d = new Date(this.getTime());
    d.setUTCMilliseconds(utc); // 服务器时区偏移 毫秒

    var dateStr = {
        Y : d.getUTCFullYear(),
        m : d.getUTCMonth()+1,
        d : d.getUTCDate(),
        H : d.getUTCHours(),
        i : d.getUTCMinutes(),
        s : d.getUTCSeconds()
    }
    for(var key in dateStr){
        if (dateStr[key]<10)dateStr[key] = '0'+dateStr[key];
        var regexp = new RegExp(key,'g');
        str = str.replace(regexp,dateStr[key])
    }
    return str;
}
