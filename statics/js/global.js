if (typeof(MyQEE) != 'object')
{
	var MyQEE = {};
}

(function(MyQEE)
{
    MyQEE.userAgent = navigator.userAgent.toLowerCase();
    MyQEE.isFirefox = MyQEE.userAgent.indexOf('firefox')>=0?true:false;
    MyQEE.isOpera   = navigator.appName.indexOf('Opera')>=0?true:false;
    MyQEE.isSafari  = MyQEE.userAgent.indexOf('safari')>=0?true:false;
    MyQEE.isChrome  = MyQEE.userAgent.indexOf('chrome')>=0?true:false;if(MyQEE.isChrome)MyQEE.isSafari=false;
    MyQEE.isIphone  = MyQEE.userAgent.indexOf('iphone')>=0?true:false;
    MyQEE.isIpod    = MyQEE.userAgent.indexOf('ipod')>=0?true:false;
    MyQEE.isIpad    = MyQEE.userAgent.indexOf('ipad')>=0?true:false;
    MyQEE.isIos     = MyQEE.isIphone||MyQEE.isIpod||MyQEE.isIpad;
    MyQEE.isIE      = navigator.appName=="Microsoft Internet Explorer"?true:false;
    MyQEE.IE        = (MyQEE.userAgent.indexOf('msie') != -1 && !MyQEE.isOpera) && MyQEE.userAgent.substr(MyQEE.userAgent.indexOf('msie') + 5, 3);

    MyQEE.$ = function(id)
    {
        return document.getElementById(id);
    }

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

    MyQEE.cookie = {
        get : function (name)
        {
            var nameEQ = name + '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0)
                    return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
            return null;
        },
        set : function (name, value, days, path)
        {
            var expires = '';
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toGMTString();
            };
            path = path || '/';
            document.cookie = name + "=" + encodeURIComponent(value) + expires + ";path=" + path;
        },
        del : function (name,path)
        {
            var exp = new Date();
            exp.setTime (exp.getTime() - 99999);
            path = path || '/';
            document.cookie = name + "=''; expires=" + exp.toGMTString()+';path='+path;
        }
    };

    var resetFrame = function()
    {
        try
        {
            if( typeof(window.parent.MyQEE)=='object' )
            {
                window.MyQEE.parentFrame = window.parent;
            }
        }
        catch(e){}
        window.MyQEE.parentFrame.MyQEE.frameFrame = window.self;
    };

    MyQEE.alert = function(alertset,w,h,title,handler)
    {
        resetFrame();
        if (typeof (alertset) != 'object')
        {
            alertset = {'message':(alertset||'')};
        }
        //alertset.message = alertset.message.replace(/\n/g,'<br />');
        alertset.width = alertset.width || w;
        alertset.height = alertset.height || h;
        alertset.title = alertset.title || title || '信息提示';
        alertset.handler = alertset.handler || handler;

        if (!window.MyQEE.parentFrame.ymPrompt)
        {
            window.alert(alertset.message);
            if (alertset.handler){
                try{alertset.handler('ok')}catch(e){}
            }
        }
        else
        {
            //try{MyQEE.parentFrame.ymPrompt.close();}catch(e){}
            if (alertset._type=='errorInfo')
            {
                window.MyQEE.parentFrame.ymPrompt.errorInfo(alertset);
            }
            else if(alertset._type=='succeedInfo')
            {
                window.MyQEE.parentFrame.ymPrompt.succeedInfo(alertset);
            }
            else if(alertset._type=='win')
            {
                alertset.allowSelect = alertset.allowSelect || true;        //默认允许
                alertset.allowRightMenu = alertset.allowRightMenu || true;  //默认允许
                window.MyQEE.parentFrame.ymPrompt.win(alertset);
            }
            else
            {
                window.MyQEE.parentFrame.ymPrompt.alert(alertset);
            }
            if (window.MyQEE.parentFrame)window.MyQEE.parentFrame.MyQEE.iniHtml(MyQEE.$('ym-window'));
        }
    };

    MyQEE.succeed = function(alertset,w,h,title,handler)
    {
        if (typeof (alertset) != 'object')
        {
            alertset = {'message':(alertset||'')};
        }
        alertset.title = alertset.title || '操作成功';
        alertset._type = 'succeedInfo';
        MyQEE.alert(alertset,w,h,title,handler);
    };

    MyQEE.error = function(alertset,w,h,title,handler)
    {
        if (typeof (alertset) != 'object')
        {
            alertset = {'message':(alertset||'')};
        }
        alertset.title = alertset.title || '错误提示';
        alertset._type = 'errorInfo';
        MyQEE.alert(alertset,w,h,title,handler);
    };

    MyQEE.win = function(alertset,w,h,title,handler)
    {
        if (typeof (alertset) != 'object')
        {
            alertset = {'message':(alertset||'')};
        }
        alertset._type = 'win';
        alertset.middlevalign = false;
        MyQEE.alert(alertset,w,h,title,handler);
    };

    MyQEE.confirm = function (alertset,w,h,title,handler)
    {
        resetFrame();
        if (typeof (alertset) != 'object')
        {
            alertset = {'message':(alertset||'是否继续此操作？')};
        }
        //alertset.message = alertset.message.replace(/\n/g,'<br />');
        alertset.width = alertset.width || w;
        alertset.height = alertset.height || h;
        alertset.title = alertset.title || '请确认';
        alertset.handler = alertset.handler || handler;

        if (!MyQEE.parentFrame.ymPrompt)
        {
            var myconform = window.confirm(alertset['message']);
            if (!alertset.handler)
            {
                return myconform;
            }
            else
            {
                var r = false;
                try{r = alertset.handler(myconform?'ok':'cancel');}catch(e){}
                return r;
            }
        }
        else
        {
            try{MyQEE.parentFrame.ymPrompt.close();}catch(e){}
            MyQEE.parentFrame.ymPrompt.confirmInfo(alertset,w,h,title,handler);
            $('ym-body-div').html_paste();
        }
    };

    MyQEE.closeWin = function(type,autoclose)
    {
        resetFrame();
        try{MyQEE.parentFrame.ymPrompt.doHandler(type,autoclose);}catch(e){}
    };

    MyQEE.showLoading = function()
    {
        var obj = MyQEE.$('_the_loading_div');
        if (!obj)
        {
            obj = document.createElement('DIV');
            obj.id = '_the_loading_div';
            obj.style.cssText = 'z-index:20000;position:fixed;_position:absolute;top:0;left:0;text-align:center;width:100%;color:#111;font-size:14px;';
            obj.innerHTML = '<span class="loading_div">正在加载，请稍等...</span>';
            document.body.appendChild(obj);
        }
        var top = $(document.body).height()/2-30;
        obj.style.top = top+'px';
        obj.style.display = '';
    };

    MyQEE.hiddenLoading = function()
    {
        $('_the_loading_div').hide();
    };

    var msg_run_hidden;
    /**
     * 显示提示信息
     *
     * @param string msg 信息提示内容
     * @param string 跳转到下一页url，留空则在本页直接提示，否则跳转到下一页后提示
     * @param int showtime 显示时间，单位秒，默认3
     */
    MyQEE.Msg = function(msg,href,showtime)
    {
        showtime = showtime||3;
        if (href)
        {
            MyQEE.cookie.set('flash_message_',msg);
            document.location.href = href;
            return true;
        }
        if (typeof msg != 'string')
        {
            msg = MyQEE.cookie.get('flash_message_');
            if (msg)
                MyQEE.cookie.del('flash_message_');
        }
        if (msg)
        {
            var runTime = 0;
            var tmpleft = 0;
            var width;
            var obj = MyQEE.$('MyQEE_show_msg_div_');

            if (MyQEE.isIE && MyQEE.IE<7)
            {
                //解决IE浮动问题
                var runtime = setInterval(function()
                {
                    var rand = Math.ceil(Math.random()*10);
                    obj.style.bottom = rand+'px';
                    obj.style.bottom = '0px';
                },20);
            }

            var hidden = function (_run)
            {
                runTime++;
                tmpleft = width * runTime/20;
                var tmpopacity = 80 - 80 * runTime/20;
                if (runTime<=20)
                {
                    obj.style.left = '-'+tmpleft+'px';
                    obj.style.opacity = tmpopacity/100;
                    obj.style.filter = 'alpha(opacity='+tmpopacity+')';
                    setTimeout(function(){hidden(_run);},10);
                }
                else
                {
                    runTime = 0;
                    if (MyQEE.isIE && MyQEE.IE<7)
                    {
                        clearInterval(runtime);
                    }
                    msg_run_hidden = null;
                    if (typeof _run =='function')
                    {
                        try{
                            _run();
                        }catch(e){}
                    }
                }
            };
            if (msg_run_hidden)
            {
                clearTimeout(msg_run_hidden);
                width = obj.offsetWidth * 0.2;
                hidden(function()
                {
                    MyQEE.Msg(msg,href,showtime);
                });
                return true;
            }
            if (!obj)
            {
                obj = document.createElement('div');
                obj.style.cssText = 'z-index:111111;position:fixed;opacity:0.01;filter:alpha(opacity=1);_position:absolute;left:0;bottom:0px;padding:3px 12px;border:1px solid #ccc;overflow:hidden;background:#FF6600;width:27%;color:#fff;text-align:left;';
                obj.id = 'MyQEE_show_msg_div_';
                document.body.appendChild(obj);
            }
            obj.innerHTML = msg;
            width = obj.offsetWidth * 0.2;

            var tmpleft2 = width;
            var show = function (){
                runTime++;
                tmpleft2 = tmpleft2 * 7/10;
                var tmpopacity = 80 * runTime/20;
                if (runTime<=20)
                {
                    obj.style.left = '-'+tmpleft2+'px';
                    obj.style.opacity = tmpopacity/100;
                    obj.style.filter = 'alpha(opacity='+tmpopacity+')';
                    setTimeout(show,10);
                }
                else
                {
                    obj.style.left = '0px';
                    runTime = 0;
                    msg_run_hidden = setTimeout(hidden,showtime*1000);
                }
            }
            setTimeout(show,500);
        }
    }

    /**
     * 确认执行
     *
     * @parem url 待执行的URL
     * @parem ask 内容
     */
    MyQEE.askTodo = function(url,ask)
    {
        MyQEE.confirm(
            {
                'message':ask||'请确认',
                'title':'请确认',
                'handler':function(el){
                    if (el!='ok')return true;

                    runAjax(url);
                }
            }
        );
    };

    var ajaxRunning = {};
    var runAjax = function(url)
    {
        if (ajaxRunning[url])
        {
            MyQEE.Msg('页面正在执行，请稍等...');
            return;
        }
        ajaxRunning[url] = 1;
        MyQEE.showLoading();

        var ajax = $.ajax({url:url,method:'POST',dataType:'json'}).error(function(data)
        {
            if (data.status == 404)
            {
                MyQEE.error('指定的页面不存在');
            }
            else
            {
                MyQEE.error('页面执行失败，请重试。');
            }
            return false;
        }).success(function(data)
        {
            if (!data)
            {
                MyQEE.error('数据异常，请重试或联系管理员。');
                return false;
            }

            if (data.code==1)
            {
                MyQEE.Msg(data.msg,document.location);
            }
            else if (data.code<0)
            {
                MyQEE.error(data.msg);
            }
            else
            {
                MyQEE.alert(data.msg);
            }
        }).done(
            function(data)
            {
                MyQEE.hidden_loading();
                delete ajaxRunning[url];
            }
        );
    };








})(MyQEE);


if (typeof console =='undefined' )
{
    var console = {
        log : function(){},
        info : function(){},
        error : function(){}
    };
}

/**
 * 将日期格式化输出，类似php的date方法，本接口默认偏移时区为+8
 * @param str 例如 Y-m-d H:i:s
 * @param utc 偏移时区，默认+8
 */
Date.prototype.format = function(str,utc)
{
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
    for(var key in dateStr)
    {
        if (dateStr[key]<10)dateStr[key] = '0'+dateStr[key];
        var regexp = new RegExp(key,'g');
        str = str.replace(regexp,dateStr[key])
    }
    return str;
}

if (typeof Date.now == 'undefined')
{
    // IE8下兼容支持Date.now()方法
    Date.now = function()
    {
        return new Date().getTime();
    }
}
