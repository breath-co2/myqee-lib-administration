var desktop = new function()
{
    var menu              = [],     //菜单数组
    small_window_mode     = false,  //窄屏幕窗口
    iphone_hidden_address = false,  //iphone下是否隐藏地址栏状态
    top_scroll_height     = 0,      //页面顶部卷去的高度
    is_window_show        = false,  //是否窗口模式
    is_fullscreen         = false,  //是否全屏模式
    is_menu_open_mode     = true,   //是否目录开启
    menu_width            = 160,    //菜单宽带
    left_width            = 0,      //左侧宽度
    site_full_url         = '',     //站点完整URL前缀
    history_index         = 0,      //前进后退索引
    is_support_pajx       = window.history.pushState?true:false;    //是否支持动态切换地址栏功能

    var _history_reload_page  = false;
    var _history_state        = {};
    var _history_old_hash;


    //窗口调整大小
    window.onresize = function()
    {
        if(iphone_hidden_address)
        {
            // 调高
            $(document.body).css('height',($(window).height()+60)+'px');

            // iphone中隐藏地址栏
            window.scrollTo(0,0);
        }

        // 高分辨率
        if (!isRetina && $(document.body).width()>1500)
        {
            $('#bg-div').addClass('big-screen');
        }

        var w = $(window).width();
        var h = $(window).height();
        if (iphone_hidden_address)h+=60;

        //$('#bg-div').width(w-2).height(h-2);
        if (w<760)
        {
            left_width = 0;
        }
        else
        {
            left_width = $('#logo').width()+1;
        }
        var hh = h - $('#logo').height();

        $('#left-menu').children().each(function(){$(this).find('.scroller').css({minHeight:hh+'px'});if(this._sc)this._sc.refresh();});

        if (w<1000)
        {
            small_window_mode = true;
            $('#main-body-div').addClass('for-small-window');

            if (w<720)
            {
                if ( w<=480 )
                {
                    // 超小屏幕
                    $('#main-desktop').addClass('for-very-small-window');
                }

                if ( w-$('#logo').width()<500-(isRetina?250:0) )
                {
                    $('#main-desktop').addClass('for-small-window');
                }
                else
                {
                    $('#main-desktop').removeClass('for-small-window');
                }
            }
            else
            {
                $('#main-desktop').removeClass('for-small-window');
            }

            $('#left-menu-div').css({'overflow':'hidden','width':$('#logo').width()});

            $('#main-desktop-bottom-div').transition({'left':0});
        }
        else
        {
            small_window_mode = false;
            $('#main-desktop').removeClass('for-small-window for-very-small-window');
            $('#main-body-div').removeClass('for-small-window');
            $('#left-menu-div').css({'overflow':'visible','width':'auto'});

            $('#main-desktop-bottom-div').css({'left':50+161*$('#left-menu').children().length});
        }

        desktop.reset.desktop();

        desktop.resize_window();
    };

    this.reset = {
        desktop : function()
        {
            var w = $(window).width();
            // 调整桌面
            var n = 0;
            $('#main-desktop-div').children().each(function(){$(this).css({'width':w+'px','left':(n*w)+'px'});n++;});
            $('#main-desktop-div').width($('#main-desktop').width()*n);

            // 调整滚动位置
            var obj = $('#main-desktop-div')[0];
            if (obj && obj._sc)
            {
                if (obj._ch)clearTimeout(obj._ch),obj._ch=null;
                obj._ch = setTimeout(function()
                {
                    obj._sc.scrollToPage(obj._sc.currPageX);
                    obj._ch = null;
                },300);
            }
        },
        menu : function()
        {

        }
    };

    this.resize_window = function()
    {
        if ( is_fullscreen || (small_window_mode && is_window_show) )
        {
            $('#main-desktop').hide();
            $('#left-menu-div').hide();
            $('#logo').fadeOut();
        }
        else
        {
            $('#logo').fadeIn();
            $('#main-desktop').show();
            $('#left-menu-div').show();
        }
    }

    //显示登录框
    this.login_show_div = function()
    {
        is_fullscreen = true;
        this.resize_window();

        // 载入Login视图
        $.ajax(MyQEE.Url.Site+'/login').success(function(data)
        {
            $('<div id="login_div">'+data+'</div>').appendTo(document.body);
            $('#login_div').html_paste(true);
        }).error(function(){alert('页面加载失败，请刷新')});
    }

    this.login_out = function()
    {
        document.location.href = MyQEE.Url.Site+'/login/out';
        return false;
    }

    //登录成功
    this.login_success = function(data)
    {
        if (typeof destroy=='function')
        {
            destroy();
            delete destroy;
        }

        $('#login_div').remove();

        is_fullscreen = false;
        this.resize_window();

        if (data.member_id)
        {
            //更新数据
            MyQEE.Member.Id = data.member_id;
            MyQEE.Member.Username = data.username;
            MyQEE.Member.LoginNum = data.login_num;
        }

        //加入登录用户
        localStorage.setItem('logined_member',JSON.stringify([MyQEE.Member.Username,data.gravatar]));

        logined_init();
    }

    //初始化
    this.init = function()
    {
        /**
         * 处理页面HTML
         *
         */
        $.fn.html_paste = function()
        {
            var obj = this;

            //处理表单
            obj.find('form').each(function()
            {
                if (this._pasted)return;

                this._onsubmit = this.onsubmit;
                this.onsubmit = function()
                {
                    if (this._submitting == true)return false;
                    if (this._onsubmit)
                    {
                        if (false===this._onsubmit())
                        {
                            //如果表单自带的onsubmit()返回的是false，则无需再处理
                            this._submitting == false;
                            return false;
                        }
                    }
                    this._submitting = true;
                    var self = this;

                    // 采用 ajaxSubmit 提交表单
                    $(this).ajaxSubmit({
                        success : function(rs)
                        {
                            self._submitting = false;

                            if (rs.code==1)
                            {
                                MyQEE.Msg(rs.msg);
                            }
                            else if (rs.code<0)
                            {
                                MyQEE.error(rs.msg);
                            }
                            else
                            {
                                MyQEE.alert(rs.msg);
                            }
                        },
                        error : function()
                        {
                            self._submitting = false;

                            MyQEE.error('页面加载失败，请重试');
                        }
                    });

                    return false;
                }

                this._pasted = true;
            });

            var now_url = document.location.href.split('#')[0];

            //处理超链接
            obj.find('a').each(
                function()
                {
                    if (this._pasted)return;

                    this._pasted = true;
                    if ($(this).attr('rel')=='nofollow')return;
                    if ($(this).attr('target') && $(this).attr('target')!='_self')return;

                    // 锚点链接不处理
                    if (this.href.indexOf('#')!=-1 && this.href.split('#')[0]==now_url)
                    {
                        return;
                    }

                    this._onclick = this.onclick;
                    this.onclick = function()
                    {
                        if (this._onclick)
                        {
                            if (false===this._onclick())return false;
                        }
                        if (true==this._onloading)return false;
                        this._onloading = true;
                        var self = this;
                        goto(this.href,{complete:function(){self._onloading = false;}});
                        return false;
                    }
                }
            );

            obj.find('[data-spy="scroll"]').each(function(){
                var $this = $(this);
                $this.scrollspy($this.data());
            });

            obj.find('[rel="tooltip"]').each(function(){
                var $this = $(this);
                $this.tooltip($this.data());
            });

            obj.find('.dropdown-toggle').dropdown();
            obj.find('.carousel').carousel();
            obj.find('.collapse').collapse();
            obj.find('.typeahead').typeahead();

            if (MyQEE.is_iphone)
            {
                $('form.form-horizontal').removeClass('form-horizontal').addClass('form-inline');
            }

            return this;
        };


        // 监控浏览器前进后退
        var popstate = function(e)
        {
            if (!e.state)return;

            document.title = e.state.title;

            var uri = e.state.url.substr(site_full_url.length);

            if (uri=='/')
            {
                desktop.close();
                return;
            }

            $('#main-body-div').show();

            var show_index;
            // 隐藏其它DIV
            $('#main-body-div div.window-main').each(function()
            {
                if (this.style.display!='none')
                {
                    show_index = $(this).attr('data-index');
                    if (show_index==e.state.index)
                    {
                        return;
                    }
                    if (show_index>e.state.index)
                    {
                        var n = 1;
                    }
                    else
                    {
                        var n = -1;
                    }
                    $(this).transition({x:n*($(window).width()-left_width)},function(){$(this).hide();});
                }
            });

            var obj = $('#main-body-div div.window-main[data-index='+e.state.index+']');

            if (obj.length>0)
            {
                obj[0].show();
            }


            /*

            var c = $('#main-body-div').children();
            if (c.length==0)return false;
            if (c.length==1)
            {
                this.close(callback);
            }
            var o2 = c.last();
            var o1 = o2.prev();

            o1.show().transition({x:0},function(){if (o1[0]._sc)o1[0]._sc.refresh();if (callback)callback();});
            o2.transition({x:$(window).width()-left_width},function(){o2[0].remove();});

            */
        };

        if ( MyQEE.Url.Site.substr(0,7)!='http://' && MyQEE.Url.Site.substr(0,8)!='https://' )
        {
            site_full_url = document.location.protocol+'//'+document.location.host+(document.location.port?':'+document.location.host:'') + MyQEE.Url.Site;
        }
        else
        {
            site_full_url = MyQEE.Url.Site;
        }

        if( is_support_pajx )
        {
            window.history.replaceState({title:document.title,url:document.location.href,index:0},document.title);

            window.onpopstate = popstate;
        }
        else
        {
            var hash = document.location.hash;
            if ( hash=='' || hash.substr(0,5)!='#url=' )
            {
                hash = '#url=/';
            }
            _history_old_hash = hash;

            _history_state[hash.substr(5)] = {
                title : document.title,
                url   : document.location.href,
                index : 0
            };

            window.onhashchange = function()
            {
                var hash = document.location.hash;
                if ( hash=='' || hash.substr(0,5)!='#url=' )
                {
                    hash = '#url=/';
                }
                if ( _history_old_hash!=hash )
                {
                    _history_old_hash = hash;

                    var state = _history_state[hash.substr(5)];

                    //调用 popstate
                    popstate({state:state});
                }
            };
        }


        var html = '<div id="main-desktop"></div><div id="left-menu-div"><div id="left-menu-div-hoverbg"></div><div id="left-menu"></div><div id="left-menu-icon-div"><div id="left-first-menu-div"></div><div id="left-bottom-menu-div"></div></div></div><div id="logo" onclick="document.location.reload();"><img src="'+MyQEE.Url.Statics+'/skins/default/'+(isRetina?'logo@2x.png':'logo.png')+'" /></div><div id="main-body-div"></div>';
        var st = {'id':'body-main'};
        // 创建背景
        $('<div>',st).html(html).appendTo($(document.body));

        if (isRetina)
        {
            if ($(window).width()>760)
            {
                // 窗口和屏幕分辨率宽度>1500,切换到高清背景图
                $(document.body).addClass('big-screen');
            }
        }

        if (MyQEE.Member.Id)
        {
            logined_init();
        }
        else
        {
            // 显示登录窗口
            desktop.login_show_div();
        }

        // 移除loading
        $('#page-loading-div').fadeOut(300,function(){
            setTimeout(function()
            {
                if (MyQEE.is_ios)
                {
                    var h = document.body.offsetHeight;
                    if (h<480 && h!=320)
                    {
                        // 调高
                        $(document.body).css('height',$(window).height()+'px');
                        $('#page-loading-table').height($(window).height()+60);

                        // iphone中隐藏地址栏
                        window.scrollTo(0,0);

                        iphone_hidden_address = true;

                        // 阻止页面滚动
                        document.addEventListener('touchmove',function(e){e.preventDefault();},false);
                    }
                    else if (h==480||h==320||h==1024||h==768||h==568)
                    {
                        top_scroll_height = 20;
                        $('#body-main').css('top','20px');
                        $('#logo').css({'marginTop':'-20px','paddingTop':'20px'});
                    }
                }

                // 调整遮罩高度
                $('#page-loading-table').fadeOut(600,function(){$(this).remove();$('#root_css').remove();});

                // 重新整理size
                setTimeout('window.onresize();',20);
            },10);
        });

        //销毁方法
        delete desktop.init;
    };

    //返回上一个窗口
    this.back = function(callback)
    {
        history.go(-1);
    };

    //关闭窗口
    this.close = function(callback)
    {
        is_window_show = false;
        var divs = $('#main-body-div').children();
        var op;
        divs.each(function()
        {
            if (this.style.display!='none')op=$(this);
        });
        if (op)
        {
            op.transition({opacity:0,scale:0},function(){op[0].close();});
        }

        this.resize_window();

        setTimeout(function()
        {
            $('#main-body-div').hide();
            if (callback)callback();
        },400);
    };

    // 刷新页面
    this.refresh = function(callback)
    {
        var o = $('#'+'window_main_l_');
        if (o[0])
        {
            var r = o.find('.btn-refresh');
            if (r.length)
            {
                r[0].loading();
            }

            //TODO
            goto(o[0].url,{success:function(d){
                $('<div>').html('页面已刷新').hide().addClass('loaded').appendTo($(document.body)).css({left:($(window).width()-100)/2,top:($(window).height()-50)/2,width:'100px',height:'40px',lineHeight:'38px',scale:0,y:-200}).show().transition({scale:1,opacity:1,y:0},function(){$(this).transition({scale:[3,0],opacity:0,delay:600},function(){$(this).remove();})});
                if (r.length)
                {
                    r[0].loaded();
                }
            }});
        }
    };

    var _login_rt;
    /**
     * 显示Loading框
     */
    this.show_loading = function()
    {
        _login_rt = setTimeout(function()
        {
            desktop.hide_loading();
            if (!document.getElementById('page_loading_div'))
            {
                $('<div id="page_loading_div"><div id="page_loading_image"></div></div>').appendTo($(document.body));
            }

            var obj = document.getElementById('page_loading_div');
            obj.style.display = '';
            obj.style.left = (($(window).width()-60)/2)+'px';
            obj.style.top = (($(window).height()-60)/2)+'px';
            var loaddiv = $('#page_loading_image');
            obj._rr = 0;
            obj._t = setInterval(function(){obj._rr+=30;if (obj._rr==360)obj._rr=0;loaddiv.css({transform:'rotate('+obj._rr+'deg)'});},60);
        },50);
    };

    /**
     * 隐藏Loading框
     */
    this.hide_loading = function()
    {
        if (_login_rt)
        {
            clearTimeout(_login_rt);
            _login_rt = null;
        }
        var obj = document.getElementById('page_loading_div');
        if (obj)
        {
            if (obj._t)
            {
                clearInterval(obj._t);
                delete obj._t;
            }
            obj.style.display='none';
        }
    }

    this.change_big_menu = function(key)
    {
        $('#left-first-menu-div li').removeClass('hover');
        $('#left-first-menu-div #left-menu-'+key).addClass('hover');

        var obj = $('#menu-ul-'+key+'-div');
        if (!obj.length)return;

        var prev_menu_num = obj.prevAll('ul').length;

        $('#left-menu-show-div').transition({x:-menu_width*prev_menu_num});
    }

    //登录成功后初始化
    var logined_init = function()
    {
        create_desktop();

        create_menu();
    }

    // 设置菜单高亮
    var menu_set_hover = function(url)
    {
        var uri = url.substr(site_full_url.length);

        if (uri=='/')
        {
            $($('#left-first-menu-div li').removeClass('hover')[0]).addClass('hover');
        }
    }

    // 创建菜单
    var create_menu = function()
    {
        // 创建目录
        var menu_url = MyQEE.Url.Site + '/menu_data?n='+MyQEE.Member.LoginNum;
        $.ajax({url:menu_url,dataType:'json'}).error(function(){alert('菜单加载失败，请刷新页面')}).success(function(m)
        {
            menu = m;
            var html_bottom = '<ul class="ul">';

            var html_first = '<div class="scroller"><ul class="ul">';

            // 递归的创建右侧菜单HTML
            var create_right_menu = function(arr,n,kstr)
            {
                n=n||0;
                kstr=kstr||'';
                var subhtml = '';
                for (var k in arr)
                {
                    if (typeof arr[k] == 'object')
                    {
                        subhtml += create_right_menu(arr[k],n+1,kstr+'_'+k);
                    }
                }

                var html = '<li>'+(subhtml?'<span class="fav-arrow" onclick="var obj=$(\'#menu-li-key-'+kstr+'\');if (obj.css(\'display\')==\'none\'){obj.show();}else{obj.hide();}"></span>':'')+'<a'+(arr.href?' href="'+MyQEE.Url.Site+'/'+arr.href+'"':subhtml?' href="#" onclick="$(this).prev()[0].onclick();this.blur();return false;"':'')+'><span style="padding-left:'+n+'em;"><i class="icon-cog"></i>'+arr.html+'</a></span></li>'+(subhtml?'<div id="menu-li-key-'+kstr+'">'+subhtml+'</div>':'');
                return html;
            };

            var html_right = '<div class="scroller"><div id="left-menu-show-div">';
            var n = 0;
            for (var key in menu)
            {
                var m = menu[key];
                var tmp_html = '<li id="left-menu-'+key+'" onclick="'+(m.click?m.click:'desktop.change_big_menu(\''+key+'\');')+'"><img'+(m.html?' data-placement="right" rel="tooltip" data-original-title="'+m.html+'"':'')+' src="'+MyQEE.Url.Site+'/statics/skins/default/'+(m.icon||'default')+(isRetina?'@2x':'')+'.png" /></li>';
                if (m.bottom)
                {
                    html_bottom += tmp_html;
                    continue;
                }
                else
                {
                    html_first += tmp_html;

                    html_right += '<ul style="margin-left:'+(menu_width*n)+'px;width:'+menu_width+'px;" id="menu-ul-'+key+'-div" class="ul left-menu-ul">';
                    for (var k2 in m)
                    {
                        if (typeof m[k2] =='object')
                        {
                            html_right += create_right_menu(m[k2],0,k2);
                        }
                    }
                    html_right += '</ul>';
                    n++;
                }
            }
            html_first  += '</ul></div>';
            html_bottom += '</ul>';
            html_right += '</div></div>';

            // 设置左侧底部菜单
            $('#left-bottom-menu-div').html(html_bottom).html_paste();

            // 设置左侧菜单
            $('#left-first-menu-div').css('bottom',$('#left-bottom-menu-div').height()).html(html_first).html_paste();
            var is = new iScroll('left-first-menu-div',{scrollbarClass:'myScrollbar',hideScrollbar:true});
            setTimeout(function(){is.refresh();is=null;},200);

            // 设置右侧菜单
            $('#left-menu').html(html_right).html_paste();

            menu_set_hover(document.location.href);
        });
    };

    /**
     * 创建一个窗体
     */
    var create_body = function(setting)
    {
        var obj;
        var css = {};

        if (is_window_show)
        {
            var to_css = {x:0,opacity:1,scale:1};
            css.x = $('#main-body-div').width();
            $('#main-body-div .window-main').each(function(){
                if (this.style.display!='none')$(this).transition({x:-$(window).width()+left_width},function(){$(this).hide();});
            });
        }
        else
        {
            var to_css = {opacity:1,scale:1};
            css.scale = 0;
            css.opacity = 0;
        }

        is_window_show = true;

        var html = '<div class="window-title"><div class="btn-back" onclick="desktop.back();">返回</div><div class="btn-close" onclick="desktop.close();" title="关闭"></div><div onclick="desktop.refresh();" class="btn-refresh" title="刷新"></div><div class="title-div">'+(setting.title||'')+'</div></div><div class="window-body" ontouchmove="event.stopPropagation();"></div>';

        obj = $('<div>',{'class':'window-main','data-index':setting.index,'data-url':setting.url}).css(css).html(html).appendTo($('#main-body-div'));

        // 设置HTML内容
        if (setting.html.length>0)obj.find('.window-body').html(setting.html).html_paste(false);

        obj[0].setting = setting;
        obj[0].close = function()
        {
            if (this._t)
            {
                clearInterval(this._t);
            }
            //销毁DOM
            $(this).hide().find('.window-body').html('');
        }
        //显示页面
        obj[0].show = function()
        {
            is_window_show = true;
            $(this).show().transition({x:0,opacity:1,scale:1}).find('.window-body').html('1111111111');
        };

        var load_btn = obj.find('.btn-refresh');
        load_btn[0].loaded = function()
        {
            this.onclick = this._oc;
            if(this._t)clearInterval(this._t);
            this._t=null;
            this._rr=0;
            $(this).removeClass('loading').css({transform:'rotate(0deg)'});
        };
        load_btn[0].loading = function()
        {
            this._rr = 0;
            if(this._t)this.loaded();
            var s = this;
            this._t = setInterval(function(){s._rr+=30;if (s._rr==360)s._rr=0;load_btn.css({transform:'rotate('+s._rr+'deg)'});},50);
            $(this).addClass('loading');
            this._oc = this.onclick;
            this.onclick = function(){};
        };
        load_btn[0].loading();

        obj.transition(to_css,function(){
            // 调整窗口
            desktop.resize_window();
            // 设置菜单
            desktop.reset.menu();
        });

        $('#main-body-div').show();

        return obj;
    };

    //创建桌面内容
    var create_desktop = function()
    {
        $.ajax(MyQEE.Url.Site + '/desktop').success(function(html)
        {
            // 创建初始化HTML
            if (!document.getElementById('main-desktop-div'))
            {
                $('#main-desktop').html('<div id="main-desktop-div"></div><div id="main-desktop-bottom-div"><div id="main-desktop-center-div"></div><div id="main-desktop-right-btn"></div><div id="main-desktop-left-btn"></div></div>');
            }

            $('#main-desktop-div').html(html).html_paste(true);    //处理HTML

            // 桌面个数
            var len = $('#main-desktop-div').children().addClass('desktop-div').length;

            var c_html = '';
            for(var i=0;i<len;i++)
            {
                c_html += '<div'+(i==0?' class="focus"':'')+'></div>';
            }
            $('#main-desktop-center-div').html(c_html);

            desktop.reset.desktop();

            if (!$('#main-desktop-div')[0]._sc)$('#main-desktop-div')[0]._sc = new iScroll('main-desktop',{vScroll:false,hScrollbar:false,vScrollbar:false,snap:true,wheelAction:'none',onBeforeScrollStart:function(){},onScrollEnd:function(){
                if (small_window_mode)
                {
                    if ( this.currPageX>0 )
                    {
                        $('#left-menu-div').transition({x:-210});
                        $('#logo').transition({x:-210});
                    }
                    else
                    {
                        $('#left-menu-div').transition({x:0});
                        $('#logo').transition({x:0});
                    }
                }
                if ( this.currPageX>0 )
                {
                    $('#main-desktop-left-btn').fadeIn();
                }
                else
                {
                    $('#main-desktop-left-btn').hide();
                }

                if (this.currPageX==len-1)
                {
                    $('#main-desktop-right-btn').fadeOut();
                }
                else if (len>1)
                {
                    $('#main-desktop-right-btn').fadeIn();
                }

                if (len>1)
                {
                    $('#main-desktop-center-div').find('.focus').removeClass('focus');
                    $('#main-desktop-center-div').children().get(this.currPageX).className='focus';
                }
            }});

            if (len==1)$('#main-desktop-right-btn').hide(),$('#main-desktop-center-div').hide();

            $('#main-desktop-right-btn').bind('click',function(){$('#main-desktop-div')[0]._sc.scrollToPage($('#main-desktop-div')[0]._sc.currPageX+1);});
            $('#main-desktop-left-btn').bind('click',function(){$('#main-desktop-div')[0]._sc.scrollToPage($('#main-desktop-div')[0]._sc.currPageX-1);}).css({ transform: 'rotate(180deg)'}).hide();

        }).complete(function()
        {
            // 桌面代码载入完毕
            var url = document.location.href.split('#')[0].substr(site_full_url.length);

            if ( url && url!='/' )
            {
                _history_reload_page = true;
                goto(MyQEE.Url.Site+url);
            }
            else
            {
                var hash = decodeURIComponent(document.location.hash);
                if (hash && hash.substr(0,5)=='#url=')
                {
                    url = hash.substr(5);
                    if (url)
                    {
                        _history_reload_page = true;
                        goto(MyQEE.Url.Site+url);
                    }
                }
            }
        });
    };

    /**
     * 跳转到指定页面
     *
     */
    window.goto = function(url,setting)
    {
        setting = setting||{};
        $.ajax(
            {
                url:url+'?time='+new Date().getTime(),
                headers : {'X-PJAX':'true'}
            }
        )
        .success(
            function(html)
            {
                var title = '';
                var reg = html.match(/\<title\>(.*)\<\/title\>/);
                if (reg)title = reg[1] || '';
                var obj = create_body({url:url,title:title,html:html,index:_history_reload_page?history_index:history_index+1});

                document.title = title;

                var state = {
                    url: url,
                    title: title
                }

                if (is_support_pajx)
                {
                    // 设置浏览器前进后退按钮
                    if (_history_reload_page)
                    {
                        _history_reload_page = false;
                        state.index = history_index;
                        window.history.replaceState(state,document.title);
                    }
                    else
                    {
                        history_index += 1;
                        state.index = history_index;
                        window.history.pushState(state,document.title,url);
                    }
                }
                else
                {
                    if (!_history_reload_page)
                    {
                        var hash = url.substr(MyQEE.Url.Site.length);
                        _history_state[hash] = state;

                        _history_old_hash = document.location.hash = '#url=' + encodeURIComponent(hash);
                    }
                }

                if (setting.success)try
                {
                    setting.success(data);
                }
                catch(e){}

                if (window._gaq)
                {
                    _gaq.push(['_trackPageview']);
                }
            }
        ).error(
            function(data)
            {
                desktop.hide_loading();
                if (data.status==404)
                {
                    setTimeout("alert('页面不存在')",200);
                }
                else
                {
                    setTimeout("alert('页面加载失败')",200);
                }
                if (setting.error)try
                {
                    setting.error(data);
                }
                catch(e){}
            }
        ).complete(
            function(data)
            {
                $('#main-body-div .btn-refresh').each(function(){
                    if (this.loaded)this.loaded();
                });

                if (setting.complete)try
                {
                    setting.complete(data);
                }
                catch(e){}
            }
        ).done(
            function(data)
            {
                desktop.hide_loading();
                if (setting.done)try
                {
                    setting.done(data);
                }
                catch(e){}
            }
        );

        desktop.show_loading();
    };

    return this;
};
