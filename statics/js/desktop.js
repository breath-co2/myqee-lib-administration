var desktop = new function()
{
    var menu              = [],     //菜单数组
    small_window_mode     = false,  //窄屏幕窗口
    iphone_hidden_address = false,  //iphone下是否隐藏地址栏状态
    top_scroll_height     = 0,      //页面顶部卷去的高度
    is_window_show        = false,  //是否窗口模式
    is_fullscreen         = false,  //是否全屏模式
    is_menu_open_mode     = true,   //是否目录开启
    menu_status,                    //窗口状态
    left_width            = 0;      //左侧宽度

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
        
        if (is_window_show||small_window_mode)
        {
            if (menu_status===0)desktop.reset.menu();
        }
        else
        {
            if (menu_status===1)desktop.reset.menu();
        }
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
            //重新设定目录
            if (is_window_show||small_window_mode)
            {
                menu_status = 1;
                // 窗口打开
                var i=0;
                $('#left-menu').children().each(function(){
                    if (i>0)$($(this).find('li')[0]).show();
                    i++;
                    $(this).find('.menu_top_bg').hide();
                });
                
                $('#left-menu').transition({x:-161*2},function(){                
                    var len = $('#left-menu').children().length;
                    var i2=0;
                    $('#left-menu').children().each(function(){
                        i2++;
                        if (i2<len)$(this).fadeOut();
                    });
                });
            }
            else
            {
                menu_status = 0;
                // 窗口关闭
                $('#left-menu').children().each(function(){
                    this.style.overflow = '';
                    $(this).show().find('.menu_top_bg').fadeIn();
                    $($(this).find('li')[0]).hide();
                });
                $('#left-menu').transition({x:0});
            }
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
    
    this.leftmenu_hover = function(obj,w,h,bc)
    {
        var o = $('#left-menu-div-hoverbg');
        if (o[0]._stop)return;
        if (o[0].st)clearTimeout(o[0].st),o[0].st=null;
    
        if (o[0].run)clearInterval(o[0].run),o[0].run = null,o[0].n=0;
    
        var offset,offset_o,ch=0;
        if (!o[0].is_tring)
        {
            offset = $(obj).offset();
            if (offset.left!=o[0].s_l || 1!=o[0].s_over || w!=o[0].s_w || h!=o[0].s_h)
            {
                o[0].is_tring = true;
                o[0].s_w = w;
                o[0].s_h = h;
                o[0].s_l = offset.left;
                o[0].s_over = 1;
                o.transition({opacity:1,width:w,height:h,left:offset.left,borderRadius:bc||0},300,function(){o[0].is_tring=null;});
            }
        }

        o[0].n = 0;
        o[0].run = setInterval(function(){
            var tf = 0;
            //var tr = $(obj.parentNode.parentNode.parentNode)[0].style[MyQEE.cssPre+'Transform'].match(/translate(3d)?\([0-9\-]+px, ([0-9\-]+)px/i);
            //if (tr)tf=tr[2]-0;
            if (!offset)offset = $(obj).offset();
            
            if (o[0].n<10)
            {
                o[0].n++;
                if (o[0].n<=4)
                {
                    offset_o = o.offset();
                    var top = offset_o.top + (offset.top+tf-offset_o.top)/2;
                    if (o[0].n==4)ch = (offset.top+tf-offset_o.top)*-1;
                }
                else
                {
                    ch = ch/-2;
                    var top = offset.top + tf + ch;
                }
                o.css({top:top});
            }
            else
            {
                o.css({top:offset.top+tf});
                clearInterval(o[0].run);
                o[0].run = null;
            }
        },50);
    };


    this.leftmenu_out = function()
    {
        var o = $('#left-menu-div-hoverbg');
        if (o[0]._stop)return;
        if (o[0].st)clearTimeout(o[0].st),o[0].st=null;
        
        o[0].st = setTimeout(function()
        {
            o.transition({scale:0,opacity:0},function(){o[0].s_over=0;o.css('scale',1);});
        },200);
    };

    this.focus_menu = function (obj)
    {
        $(obj).parent().children().each(function(){$(this).removeClass('hover')});
        if (!small_window_mode)$(obj).addClass('hover');
    };

    this.leftmenu_back = function(level)
    {
        level = level||'';
        if (''==level)return;
        var obj1 = $('#menu_div_l'+level);
        if(!obj1.length)return;
        if (obj1[0]._running)return;

        var obj2 = obj1.prev();
        if(!obj2.length)return;

        obj1[0]._running = true;
        if (small_window_mode||is_window_show)
        {
            obj2.show(300,function(){
                $('#left-menu').transition({x:'+=161'},function(){
                    $('#left-menu-div-hoverbg')[0]._stop = null;
                    obj2.nextAll().each(function(){
                        if (this._sc)
                        {
                            this._sc.destroy();
                            delete this._sc;
                        }
                    }).remove();
                    delete obj1[0]._running;
                });
            });
        }
        else
        {
            obj2.nextAll().each(function(){
                $(this).transition({x:0,opacity:0},function(){
                    if (this[0]._sc)
                    {
                        this[0]._sc.destroy();
                        this[0]._sc = null;
                    }
                    this.remove();
                });
            });
            setTimeout("$('#left-menu-div-hoverbg')[0]._stop = null;",300);
            delete obj1[0]._running;
        }
        obj2.find('li.hover').removeClass('hover');
    };

    this.create_menu = function(level)
    {
        level = level||'';
        $('#left-menu-div-hoverbg')[0]._stop = true;
        
        if (!document.getElementById('menu_div_l'+level))
        {
            var get_menu_html = function(level)
            {
                level = level||'';
                function h(mm)
                {
                    var hh = $(window).height()-$('#logo').height()-top_scroll_height;
                    var n_num = Math.floor((hh)/26);
                    var l_num = 0;
                    var mm_len = 0;
                    for(var i in mm){mm_len++;}
                    if (level.indexOf('_')!=-1)
                    {
                        var nn = level.split('_');
                        for(var i=0;i<nn.length;i++)
                        {
                            l_num+=(nn[i]-0);
                        }
                        
                        l_num = Math.min(Math.max(0,n_num-mm_len),l_num);
                    }
                    else
                    {
                        l_num = 0;
                    }
                    var html = '<ul class="ul left-menu-ul" style="margin-top:'+(l_num*26)+'px;margin-bottom:'+(hh%26-2)+'px;"><li onclick="desktop.leftmenu_back(\''+level+'\');" class="goto-parent-menu"><div class="text" onmouseover="desktop.leftmenu_hover(this,160,25);" onmouseout="desktop.leftmenu_out();">返回上级菜单</text></li>';

                    for(var i in mm)
                    {
                        var tmp = mm[i];
                        if (typeof mm[i]!='object')continue;
                        i = i.replace(/_/g,'--');
                        var has_submenu = false;
                        for (var j in tmp){if(typeof tmp[j]=='object'){has_submenu=true;break;}}
                        html += '<li id="menu_div_li'+level+'_'+i+'" onclick="desktop.focus_menu(this);'+(has_submenu?'desktop.create_menu(\''+level+'_'+i+'\');':'goto(\''+tmp.href+'\',true);')+'"><div class="text" onmouseover="desktop.leftmenu_hover(this,160,25);" onmouseout="desktop.leftmenu_out();">'+(has_submenu?'<div class="sub_menu_right_bg"></div><div class="sub_menu_right"></div>':'')+tmp.innerHTML+'</div></li>';
                    }
                    
                    html+='</ul>';
                    return html;
                }

                var tmpmenu = menu;

                if (level!='')
                {
                    var l = level.substr(1).split('_');
                    for(var i=0;i<l.length;i++)
                    {
                        var k = l[i].replace(/--/g,'_');
                        if (typeof tmpmenu[k] == 'object' )
                        {
                            tmpmenu = tmpmenu[k];
                        }
                        else
                        {
                            tmpmenu = {};
                            break;
                        }
                    }
                }

                return h(tmpmenu);
            };

            // 创建菜单HTML
            var html = '<div leveldata="'+level+'" id="menu_div_l'+level+'" class="menu-div"><div style="width:161px;height:100%;" id="menu_div_s'+level+'"><div class="scroller" style="min-height:'+($(window).height()-$('#logo').height())+'px">'+get_menu_html(level)+'</div>'+(level?'<div class="menu_top_bg"></div>':'')+'</div></div>';
            
            // 如果非同级菜单打开，则先关闭
            var del_level_length = 0;
            var children = $('#left-menu').children();
            var children_len = children.length;
            level_arr = level.split('_');
            var tmplevelstr = '';
            if (children.length)for(var i=1;i<children_len;i++)
            {
                tmplevelstr += '_' + level_arr[i];
                var nowlevelstr = $(children.get(i)).attr('leveldata');
                if (nowlevelstr!=tmplevelstr)
                {
                    // 菜单层级不一样，移除后面的菜单
                    desktop.leftmenu_back(nowlevelstr);
                    del_level_length = children_len-i;
                    break;
                }
            }

            $(html).appendTo($('#left-menu'));
            
            var children_len = $('#left-menu').children().length - del_level_length;
            
            var create_sc = function()
            {
                $('#left-menu-div-hoverbg')[0]._stop = null;
                $('#menu_div_l'+level)[0]._sc = new iScroll('menu_div_s'+level,{
                    scrollbarClass:'myScrollbar',
                    hideScrollbar:true,
                });
                //,onWheelStart: function (e) {$('#menu_div_l')[0]._sc.enabled=false;},onTouchEnd:function(){$('#menu_div_l')[0]._sc.enabled=true;}
                setTimeout(function(){
                    $('#menu_div_l'+level)[0]._sc.refresh();
                }, 10);
            }

            if (is_window_show||small_window_mode)
            {
                menu_status = 1;
                // 窗口为开启状态
                $('#menu_div_l'+level).css({'overflow':'hidden',x:(children_len-1)*161}).find('ul').css('marginTop',0);
                if(level)$('#menu_div_l'+level).find('li.goto-parent-menu').css({'display':'block'});

                if (children_len>1)
                {
                    $('#left-menu').transition({x:'-=161'},function(){
                        $('#menu_div_l'+level).prev().fadeOut();
                        create_sc();
                    });
                }
                else
                {
                    create_sc();
                }

                // 将此菜单后面的菜单全部移除（如果有）
                $('#menu_div_l'+level).nextAll().each(function(){
                    if (this._sc)
                    {
                        this._sc.destroy();
                        delete this._sc;
                    }
                }).remove();
            }
            else
            {
                $('#menu_div_l'+level).css({x:0,opacity:0}).transition({x:(children_len-1)*161,opacity:1},create_sc);
            }
            
            var len = children_len;
        }
        else
        {
            menu_status = 0;
            //关闭菜单
            desktop.leftmenu_back(level);
            
            var len = $('#menu_div_l'+level).prevAll().length;
        }
        $('#left-menu').width(161*len).children().first().css('overflow','hidden');
    
        $('#main-desktop-bottom-div').transition({'left':small_window_mode?0:(50+161*len)});
    };

    //显示登录框
    this.login_show_div = function()
    {
        is_fullscreen = true;
        this.resize_window();
        
        // 载入Login视图
        $.ajax(MyQEE.Url.Site+'/login').success(function(data)
        {
            $('<div id="login_div">'+data+'</div>').appendTo(document.body);
            $('#login_div').html_paste();
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
        var html = '<div id="main-desktop"></div><div id="left-menu-div"><div id="left-menu-div-hoverbg"></div><div id="left-menu"></div><div id="left-quick-menu-div"></div></div><div id="logo" onclick="document.location.reload();"></div><div id="main-body-div"></div>';
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

        // 监控浏览器前进后退
        $(window).bind('popstate', function(e)
        {
            //window.history.state
        });

        /**
         * 处理页面HTML
         * @param to_next_page 是否进入下一个页面 ，1=进入下一个页面，0=关闭当前所有窗口从头开始
         */
        $.fn.html_paste = function(to_next_page)
        {
            var obj = $(this);
            to_next_page = to_next_page || 0;

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

                    // 采用AJAX提交表单
                    $(this).ajaxSubmit({
                        success:function(html){self._submitting = false},
                        error  :function(){self._submitting = false}
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
                    if ($(this).attr('target')=='_blank')return;

                    // 锚点链接不处理
                    if (this.href.indexOf('#')!=-1 && this.href.split('#')[0]==now_url)
                    {
                        return;
                    }

                    this.to_next_page = to_next_page;
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
                        goto(this.href,false,{complete:function(){self._onloading = false;}});
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
        };

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
                    else if (h==480||h==320||h==1024||h==768)
                    {
                        top_scroll_height = 20;
                        $('#body-main').css('top','20px');
                        $('#logo').css({'marginTop':'-20px','paddingTop':'20px'});
                    }
                }

                // 调整遮罩高度
                $('#page-loading-table').fadeOut(600,function(){$(this).remove();$('#root_css').remove();});

                setTimeout('desktop_init=null;',1);

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
        return false;
    };

    //关闭窗口
    this.close = function(callback)
    {
        is_window_show = false;
        var divs = $('#main-body-div').children();
        var op = null;
        divs.each(function(){
            if ($(this).css('display')!='none'){op=$(this)};
        });
        if (op)
        {
            op.transition({opacity: 0,scale: 0});
        }
        setTimeout(function()
        {
            $('#main-body-div').hide().children().each(function(){
                if (this._sc)
                {
                    // 移除滚动条
                    this._sc.destroy();
                    delete this._sc;
                }
                $(this).remove();
            });
            $('#main-body-div').html('');
            if (callback)callback();
        },600);
    
        this.resize_window();
        desktop.reset.menu();
    };

    // 刷新页面
    this.refresh = function(level,callback)
    {
        var o = $('#'+'window_main_l_'+level);
        if (o[0])
        {
            var r = o.find('.btn-refresh');
            if (r.length)
            {
                r[0].loading();
            }
            //TODO
            goto(o[0].url,level,{success:function(d){
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

    //登录成功后初始化
    var logined_init = function()
    {
        // 调整left-menu高度
        //$('#left-menu').height($(document.body).height()-$('#logo').height());

        create_desktop();

        // 创建目录
        var menu_url = MyQEE.Url.Site + '/menu_data?i=1&n='+MyQEE.Member.LoginNum+'&t='+new Date().getTime();
        $.ajax({url:menu_url}).complete(function(d){
            menu = eval('('+d.responseText+')');
            desktop.create_menu();
        });

        // 创建快速目录
        (function(){
            var html = '<div class="scroller"><ul class="ul">'
            +'<li onmouseover="desktop.leftmenu_hover(this,40,40,3);" onmouseout="desktop.leftmenu_out();"><img src="'+MyQEE.Url.Site+'/statics/skins/default/icon_home'+(isRetina?'@2x':'')+'.png" /></li>'
            +'<li onmouseover="desktop.leftmenu_hover(this,40,40,3);" onmouseout="desktop.leftmenu_out();"><img src="'+MyQEE.Url.Site+'/statics/skins/default/icon_settings'+(isRetina?'@2x':'')+'.png" /></li>'
            +'<li onclick="desktop.login_out();" onmouseover="desktop.leftmenu_hover(this,40,40,3);" onmouseout="desktop.leftmenu_out();"><img src="'+MyQEE.Url.Site+'/statics/skins/default/icon_logout'+(isRetina?'@2x':'')+'.png" /></li>'
            +'</ul></div>';
            $('#left-quick-menu-div').html(html);
            
            var is = new iScroll('left-quick-menu-div',{scrollbarClass:'myScrollbar',hideScrollbar:true});

            setTimeout(function(){is.refresh();is=null;}, 10);
        })();
    }

    /**
     * 创建一个窗体
     */
    var create_body = function(setting)
    {
        is_window_show = true;
        var obj;

        if (!setting.is_first_window)
        {
            var i=0;
            $('#main-body-div').children().each(function(){
                if (this.url==setting.url)
                {
                    obj = $(this);
                    obj.show().transition({x:0});
                    var l_obj = $('#main-body-div').children().last();
                    if (l_obj[0]!==obj[0])
                    {
                        $('#main-body-div').children().last().transition({x:$(window).width()-left_width},function(){
                            obj.nextAll().each(function(){this.remove();});
                        });
                    }
                    return false;
                }
                i++;
            });
            delete i;
        }

        if(!obj)
        {
            var len = $('#main-body-div').children().length;
            var css = {};
            
            if (setting.is_first_window && len>0)
            {
                // 删除已经开启的窗口
                $('#main-body-div').children().each(function(){this.remove();});
                len = 0;
            }

            if (len>0)
            {
                var to_css = {x:0,opacity:1,scale:1};
                css.x = $('#main-body-div').width();
                $('#main-body-div').children().last().transition({x:-$(window).width()+left_width},function(){$(this).hide();});
            }
            else
            {
                var to_css = {opacity: 1,scale: 1};
                css.scale = 0;
                css.opacity = 0;
            }

            var html = '<div class="window-title"><div class="btn-back"'+(len==0?' style="visibility:hidden"':'')+' onclick="desktop.back();">返回</div><div class="btn-close" onclick="desktop.close();" title="关闭"></div><div onclick="desktop.refresh();" class="btn-refresh" title="刷新"></div><div class="title-div">'+(setting.title||'标题')+'</div></div><div class="window-body"><div class="scroller"><div style="display:table;text-align:center;width:100%;height:100%;"><div style="vertical-align:middle;display:table-cell;">加载中…</div></div></div></div>';
            
            obj = $('<div>',{'class':'window-main'}).css(css).html(html).appendTo($('#main-body-div'));

            obj[0].url = setting.url;
            obj[0].setting = setting;
            obj[0].remove = function()
            {
                //销毁滚动条
                if (this._sc)
                {
                    try
                    {
                        this._sc.destroy();
                        delete this._sc;
                    }
                    catch(e){}
                }

                if (this._t)
                {
                    clearInterval(this._t);
                }

                //销毁DOM
                $(this).remove();
            }

            var load_btn = obj.find('.btn-refresh');
            load_btn[0].loaded = function()
            {
                this.onclick = this._oc;
                clearInterval(this._t);
                this._t=null;
                this._rr=0;
                $(this).removeClass('loading').css({transform:'rotate(0deg)'});
            }
            load_btn[0].loading = function()
            {
                this._rr = 0;
                if(this._t)this.loaded();
                var s = this;
                this._t = setInterval(function(){s._rr+=30;load_btn.css({transform:'rotate('+s._rr+'deg)'});},50);
                $(this).addClass('loading');
                this._oc = this.onclick;
                this.onclick = function(){};
            }
            load_btn[0].loading();
            obj.transition(to_css,function(){
                // 调整窗口
                desktop.resize_window();
                // 设置菜单
                desktop.reset.menu();
            });
        }
        else
        {
            // 调整窗口
            desktop.resize_window();
            // 设置菜单
            desktop.reset.menu();
        }

        $('#main-body-div').show();

        return obj;
    };

    //创建桌面内容
    var create_desktop = function()
    {
        $.ajax(MyQEE.Url.Site + '/desktop').success(function(html){
            // 创建初始化HTML
            if (!document.getElementById('main-desktop-div'))
            {
                $('#main-desktop').html('<div id="main-desktop-div"></div><div id="main-desktop-bottom-div"><div id="main-desktop-center-div"></div><div id="main-desktop-right-btn"></div><div id="main-desktop-left-btn"></div></div>');
            }

            $('#main-desktop-div').html(html).html_paste();    //处理HTML

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

        });
    };

    /**
     * 跳转到指定页面
     *
     */
    window.goto = function(url,is_first_window,s)
    {
        s = s||{};
        is_first_window = is_first_window||false;
        $.ajax(
            {
                url:url+'?'+new Date().getTime()
            }
        ).success(
            function(data)
            {
                var obj = create_body({url:url,is_first_window:is_first_window});
                var state = {
                    url: url,
                    title: new Date().getTime(),
                    tttt: 650,
                }
                // 设置浏览器前进后退按钮
                //window.history.pushState(state,'test', url)

                var c = obj.find('.scroller').html('<div class="window-body-text">'+data+'</div>');
                c.html_paste(1);

                if (obj[0]._sc)
                {
                    obj[0]._sc.refresh();
                }
                else
                {
                    if ('ontouchstart' in window)
                    {
                        c.css({position:'absolute',height:'auto'});
                        obj[0]._sc = new iScroll(obj.find('.window-body')[0],{wheelAction:'scroll',onBeforeScrollStart:function(e){},onBeforeScrollMove:function(e){e.preventDefault();}});
                    }
                }

                if (s.success)try
                {
                    s.success(data);
                }
                catch(e){}
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
                if (s.error)try
                {
                    s.error(data);
                }
                catch(e){}
            }
        ).complete(
            function(data)
            {
                $('#main-body-div .btn-refresh').each(function(){
                    if (this.loaded)this.loaded();
                });

                if (s.complete)try
                {
                    s.complete(data);
                }
                catch(e){}
            }
        ).done(
            function(data)
            {
                desktop.hide_loading();
                if (s.done)try
                {
                    s.done(data);
                }
                catch(e){}
            }
        );

        desktop.show_loading();
    };


    return this;
};
