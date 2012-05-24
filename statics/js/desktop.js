/**
 * 是否视网膜屏
 */
var isRetina,
small_window_mode=false,
is_window_show=false,
iphone_hidden_address=false,
top_scroll_height=0,
is_window_show=false,
is_menu_open_mode = true,
left_width = 0
;

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

    // 高分辨率屏幕
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
    
    $('#main-desktop').removeClass('for-phone for-phone-h');

    if (w<760)
    {
        small_window_mode = true;
        $('#main-body-div').addClass('for-phone');

        if (isRetina && w-$('#logo').width()>=120)
        {
            $('#main-desktop').addClass('for-phone-h');
        }
        else
        {
            $('#main-desktop').addClass('for-phone');
        }
        
        $('#left-menu-div').css({'overflow':'hidden','width':$('#logo').width()});
        $('#main-desktop-left-btn').css('left','0px');
    }
    else
    {
        small_window_mode = false;
        $('#main-body-div').removeClass('for-phone');
        $('#left-menu-div').css({'overflow':'visible','width':'auto'});
        $('#main-desktop-left-btn').css('left',left_width);
    }
    
    reset_desktop();

    resize_window();

};

function reset_desktop()
{
    var w = $(window).width();
    // 调整桌面
    var n = 0;
    $('#main-desktop-div').children().each(function(){$(this).css({'width':w+'px','left':(n*w)+'px'});n++;});
    $('#main-desktop-div').width($('#main-desktop').width()*n);
    
    // 调整滚动位置
    var obj = $('#main-desktop-div')[0];
    if (obj._sc)
    {
    	if (obj._ch)clearTimeout(obj._ch),obj._ch=null;
    	obj._ch = setTimeout(function()
    	{
    		obj._sc.scrollToPage(obj._sc.currPageX);
    		obj._ch = null;
    	},300);
    }
}

function resize_window()
{
    if (small_window_mode && is_window_show)
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

function show_pre_menu()
{
    $('#t1').transition({
        perspective: '500px',
        rotateY: '-90deg',
        width:'0px',
        transformOrigin : '100%'
     },function(){$('#t1').hide()});
     
    $('#t2').transition({
        perspective: '500px',
        rotateY: '0deg',
        width:'160px',
        transformOrigin : '0'
     });
}

function show_next_menu()
{
    $('#t1').show().transition({
        perspective: '500px',
        rotateY: '0deg',
        width:'160px',
        transformOrigin : '100%'
     });
     
    $('#t2').transition({
        perspective: '500px',
        rotateY: '90deg',
        width:'0px',
        transformOrigin : '0'
     });
}

var menu = [
    {'url':'/v3/admin/index/test','name':'首页'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/test/','name':'测试测试测试测试测试测试','sub':[
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页','sub':[
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
            {'url':'/v3/admin/index/test','name':'首11页'},
            {'url':'/v3/admin/index/test','name':'首22页'},
            {'url':'/v3/admin/index/test','name':'首33页'},
        ]},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
        {'url':'/v3/admin/index/test','name':'首11页'},
        {'url':'/v3/admin/index/test','name':'首22页'},
        {'url':'/v3/admin/index/test','name':'首33页'},
    ]},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
    {'url':'/tttt','name':'404错误页面'},
];

function leftmenu_hover(obj,w,h,bc)
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
}

function leftmenu_out()
{
	var o = $('#left-menu-div-hoverbg');
	if (o[0]._stop)return;
	if (o[0].st)clearTimeout(o[0].st),o[0].st=null;
	
	o[0].st = setTimeout(function()
	{
		o.transition({scale:0,opacity:0},function(){o[0].s_over=0;o.css('scale',1);});
	},200);
}

function focus_menu(obj)
{
	$(obj).parent().children().each(function(){$(this).removeClass('hover')});
	if (!small_window_mode)$(obj).addClass('hover');
}

function leftmenu_back(level)
{
    level = level||'';
    if (''==level)return;
    var obj1 = $('#menu_div_l'+level);
    var obj2 = obj1.prev();
    if (small_window_mode||is_window_show)
    {
    	obj2.show(300,function(){
    		$('#left-menu').transition({x:'+=161'},function(){
				$('#left-menu-div-hoverbg')[0]._stop = null;
				obj2.nextAll().each(function(){
					if (this._sc)
					{
						this._sc.destroy();
						this._sc = null;
					}
				}).remove();
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
    }
	obj2.find('li.hover').removeClass('hover');
}

function get_menu_html(level)
{
    level = level||'';
    function h(mm)
    {
    	//var h = $(window).height();
    	var l_num = 0;
        if (level.indexOf('_')!=-1)
        {
        	var nn = level.split('_');//level.substr(level.lastIndexOf('_')+1)-0;
        	for(var i=0;i<nn.length;i++)
        	{
        		l_num+=(nn[i]-0);
        	}
        }
        else
        {
        	l_num = 0;
        }
        var html = '<ul class="ul left-menu-ul" style="margin-top:'+(l_num*26)+'px" mtop="'+(l_num*26)+'"><li onclick="leftmenu_back(\''+level+'\');" class="goto-parent-menu"><div class="text" onmouseover="leftmenu_hover(this,160,25);" onmouseout="leftmenu_out();">返回上级菜单</text></li>';
        for(var i=0;i<mm.length;i++)
        {
            var tmp = mm[i];
            html += '<li id="menu_div_li'+level+'_'+i+'" onclick="focus_menu(this);'+(tmp.sub?'create_menu(\''+level+'_'+i+'\');':'goto(\''+tmp.url+'\',\''+level+'\');')+'"><div class="text" onmouseover="leftmenu_hover(this,160,25);" onmouseout="leftmenu_out();">'+(tmp.sub?'<div class="sub_menu_right_bg"></div><div class="sub_menu_right"></div>':'')+tmp.name+'</div></li>';
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
            tmpmenu = tmpmenu[l[i]].sub;
        }
    }
    return h(tmpmenu);
}

function create_menu(level)
{
    level = level||'';
	$('#left-menu-div-hoverbg')[0]._stop = true;
    
    if (!document.getElementById('menu_div_l'+level))
    {
        // 创建菜单HTML
        var html = '<div id="menu_div_l'+level+'" class="menu-div"><div style="width:161px;height:100%;" id="menu_div_s'+level+'"><div class="scroller" style="min-height:'+($(window).height()-$('#logo').height())+'px">'+get_menu_html(level)+'</div><div class="menu_top_bg"></div></div></div>';

        $(html).appendTo($('#left-menu'));
        
        var sc = function(e){
        	var rt;
        	if (this._scing)
        	{
        		this._scing = null;
        		return false;
        	}
			var tf = false;//$('#menu_div_l'+level+' .scroller')[0].style[MyQEE.cssPre+'Transform'].match(/translate(3d)?\([0-9\-]+px, ([0-9\-]+)px/i);
			$('#menu_div_l'+level)[0]._sc_top = tf?tf[2]:0;
    		$('#menu_div_l'+level).nextAll().each(function(){
    			if (!this._sc)return;
				var tr = $('#menu_div_l'+level+' .scroller')[0].style[MyQEE.cssPre+'Transform'].match(/translate(3d)?\([0-9\-]+px, ([0-9\-]+)px/i);
				if (tr)
				{
					var msy = tr[2]-0+(this._sc_top-0||0);
					if (this._sc.maxScrollY>msy)msy=this._sc.maxScrollY,rt = false;
					this._sc._scing = true;
					this._sc.scrollTo(0,msy);
				}
				this._sc._scing = null;
				
				
				return rt;
    		});
    	};
        
        /*
        if (level)$('#menu_div_l'+level).css({
            perspective: '600px',
            rotateY:'90deg',
            width:160,
            transformOrigin:'0',
        });
        */
        
        var create_sc = function()
        {
			$('#left-menu-div-hoverbg')[0]._stop = null;
	        $('#menu_div_l'+level)[0]._sc = new iScroll('menu_div_s'+level,{
	        	scrollbarClass:'myScrollbar',
	        	hideScrollbar:true,
	        	onScrollEnd:sc,
	        });
	        //,onWheelStart: function (e) {$('#menu_div_l')[0]._sc.enabled=false;},onTouchEnd:function(){$('#menu_div_l')[0]._sc.enabled=true;}
	        setTimeout(function(){
	        	$('#menu_div_l'+level)[0]._sc.refresh();
	        }, 10);
        }
        
        if (is_window_show||small_window_mode)
        {
        	// 窗口为开启状态
        	$('#menu_div_l'+level).css({'overflow':'hidden',x:($('#left-menu').children().length-1)*161}).find('ul').css('marginTop',0);
        	$('#menu_div_l'+level).find('li.goto-parent-menu').css({'display':'block'});
        	
        	$('#left-menu').transition({x:'-=161'},function(){
        		$('#menu_div_l'+level).prev().fadeOut();
        		create_sc();
    		});
        	
        	// 将此菜单后面的菜单全部移除（如果有）
        	$('#menu_div_l'+level).nextAll().each(function(){
        		if (this._sc)
        		{
        			this._sc.destroy();
        			this._sc = null;
        		}
        	}).remove();
        }
        else
        {
        	$('#menu_div_l'+level).css({x:0,opacity:0}).transition({x:($('#left-menu').children().length-1)*161,opacity:1},create_sc);
        }
    }
    else
    {
    	//关闭菜单
    	return leftmenu_back(level);
    }

    //$('#left-menu').children().css('overflow','');
    
    $('#left-menu').width(161*($('#left-menu').children().length)).children().first().css('overflow','hidden');

}


function create_quick_menu()
{
    var html = '<div class="scroller"><ul class="ul">'
    +'<li onmouseover="leftmenu_hover(this,40,40,3);" onmouseout="leftmenu_out();"><img src="'+MyQEE.Url.Site+'/statics/skins/default/icon_home'+(isRetina?'@2x':'')+'.png" /></li>'
    +'<li onmouseover="leftmenu_hover(this,40,40,3);" onmouseout="leftmenu_out();"><img src="'+MyQEE.Url.Site+'/statics/skins/default/icon_settings'+(isRetina?'@2x':'')+'.png" /></li>'
    +'</ul></div>';
    $('#left-quick-menu-div').html(html);
    
    var is = new iScroll('left-quick-menu-div',{scrollbarClass:'myScrollbar',hideScrollbar:true});
    
    setTimeout(function(){is.refresh();is=null;}, 10);
}

function goto(url,level,s)
{
    s = s||{};
    level = level||0;
    $.ajax(
        {
            url:url+'?'+new Date().getTime()
        }
    ).success(
        function(data)
        {
            var state = {
                url: url,
                title: new Date().getTime(),
                tttt: 650,
            }
            // 设置浏览器前进后退按钮
            //window.history.pushState(state,'test', url)
            
            var obj = $('#window_main_l_'+level);
	    	var c = obj.find('.scroller').html('<div class="window-body-text">'+data+'</div>');

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

		    obj.find('a').each(
		        function()
		        {
		            this.level = level;
		            this.onclick = function()
		            {
		                if (true==this._onloading)return false;
		                this._onloading = true;
		                var self = this;
		                goto(this.href,this.level+1,{complete:function(){self._onloading = false;self=null;}});
		                return false;
		            }
		        }
		    );
		    
            if (s.success)try
            {
                s.success(data);
            }
            catch(e){}
        }
    ).error(
        function(data)
        {
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
            
            if (level>0)
            {
            	back_win(level);
            }
            else
            {
            	close_win();
            }
        }
    ).complete(
        function(data)
        {
		    var r = $('#window_main_l_'+level+' .btn-refresh');
		    if (r.length)
			{
				r[0].loaded();
			}
            if (s.complete)try
            {
                s.complete(data);
            }
            catch(e){}
        }
    ).done(
        function(data)
        {
            if (s.done)try
            {
                s.done(data);
            }
            catch(e){}
        }
    );

    create_body({url:url},level);
}

function back_win(level)
{
	if(level<1)return false;
	var o1 = $('#'+'window_main_l_'+(level-1));
	if (o1)
	{
		var o2 = $('#'+'window_main_l_'+level);
		
		o1.show().transition({x:0},function(){if (o1[0]._sc)o1[0]._sc.refresh();});
		if (o2)
		{
			o2.transition({x:$(window).width()-left_width},function(){o2[0].remove();});
		}
	}
	else
	{
		close_win();
	}
}

function close_win()
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
        $('#main-body-div').hide().children().each(function(){this.remove();});
        $('#main-body-div').html('');
    },600);

    resize_window();
}

function refresh_win(level)
{
	var o = $('#'+'window_main_l_'+level);
	if (o[0])
	{
		var r = o.find('.btn-refresh');
		if (r.length)
		{
			r[0].loading();
		}
	    goto(o[0].url,level,{success:function(d){
	    	$('<div>').html('页面已刷新').hide().addClass('loaded').appendTo($(document.body)).css({left:($(window).width()-100)/2,top:($(window).height()-50)/2,width:'100px',height:'40px',lineHeight:'38px',scale:0,y:-200}).show().transition({scale:1,opacity:1,y:0},function(){$(this).transition({scale:[3,0],opacity:0,delay:600},function(){$(this).remove();})});
	    	if (r.length)
			{
				r[0].loaded();
			}
	    }});
	}
}

function create_body(setting,level)
{
    is_window_show = true;
    level = level || 0;
    
    var id = 'window_main_l_'+level;
    var css = {};
    if (level>0)
    {
        var to_css = {x:0,opacity:1,scale:1};
        css.x = $('#main-body-div').width();
        var oo = $('#'+'window_main_l_'+(level-1));
        if(oo)oo.transition({x:-$(window).width()+left_width},function(){$(this).hide();});
    }
    else
    {
        var to_css = {opacity: 1,scale: 1};
        css.scale = 0;
        css.opacity = 0;
    }

    var obj = $('#'+id);
    if (0==obj.length)
    {
        var html = '<div class="window-title"><div class="back-btn"'+(level==0?' style="visibility:hidden"':'')+' onclick="back_win(\''+level+'\');"><div class="btn-r">返回</div></div><div class="btn-close" onclick="close_win();" title="关闭"></div><div onclick="refresh_win(\''+level+'\');" class="btn-refresh" title="刷新"></div><div class="title-div">'+(setting.title||'标题')+'</div></div><div class="window-body"><div class="scroller"><div style="display:table;text-align:center;width:100%;height:100%;"><div style="vertical-align:middle;display:table-cell;">加载中…</div></div></div></div>';
        
        obj = $('<div>',{'class':'window-main','id':id}).css(css).html(html).appendTo($('#main-body-div'));

	    obj[0].url = setting.url;
	    obj[0].setting = setting;
	    obj[0].level = level;
	    obj[0].remove = function()
	    {
	    	//销毁滚动条
	    	if (this._sc)
	    	{
	    		try
	    		{
			    	this._sc.destroy();
			    	this._sc = null;
	    		}
	    		catch(e){}
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
    }

	$('#main-body-div').show();
	obj.transition(to_css,function(){
		//处理菜单
		$('#menu_div_l').nextAll().each(function(){
			if(this._sc)this._sc.destroy(),this._sc=null;
			$(this).remove();
		});
		resize_window();
	});
}


function create_desktop()
{
	$('#main-desktop').html('<div id="main-desktop-div"></div><div id="main-desktop-center-div"></div><div id="main-desktop-right-btn"></div><div id="main-desktop-left-btn"></div>');
	
    var d = new Date();
    var day = d.getDate();
    var dd=[];
    if (day<10){dd[0]=0;dd[1]=day;}
    else{dd[0]=(day-day%10)/10;dd[1]=day%10;}
    
    $('<div class="desktop-div"><div id="weather-div"><div class="weather-img weather_sun"></div><div class="weather-city">上海</div><div class="weather-info">晴转多云 微风</div><div class="weather-num">19~28℃</div></div><div id="calendar-div"><div id="calendar-date">'+d.format('Y/m')+' 星期'+'天一二三四五六'.charAt(d.getDay())+'</div><div id="calendar-date-chinese">'+chinese_calendar(d)+'</div><div class="calender-num"><span class="calendar-num-'+dd[0]+'"></span><span class="calendar-num-'+dd[1]+'"></span></div></div></div>').appendTo($('#main-desktop-div'));
    
    $('<div class="desktop-div">2</div>').appendTo($('#main-desktop-div'));
    $('<div class="desktop-div">3</div>').appendTo($('#main-desktop-div'));
    $('<div class="desktop-div">4</div>').appendTo($('#main-desktop-div'));
    $('<div class="desktop-div">5</div>').appendTo($('#main-desktop-div'));
    $('<div class="desktop-div">6</div>').appendTo($('#main-desktop-div'));
    
    var len = $('#main-desktop-div').children().length;
    
    var html = '';
    for(var i=0;i<len;i++)
    {
    	html += '<div'+(i==0?' class="focus"':'')+'></div>';
    }
    $('#main-desktop-center-div').html(html);
    
    reset_desktop();
    
    $('#main-desktop-div')[0]._sc = new iScroll('main-desktop',{vScroll:false,hScrollbar:false,vScrollbar:false,snap:true,wheelAction:'none',onScrollEnd:function(){
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
}

//初始化
function desktop_init()
{

    var html = '<div id="main-desktop"></div><div id="left-menu-div"><div id="left-menu-div-hoverbg"></div><div id="left-menu"></div><div id="left-quick-menu-div"></div></div><div id="logo" onclick="document.location.reload();"></div><div id="main-body-div"></div>';
    var st = {'id':'body-main'};
    // 创建背景
    $('<div>',st).html(html).appendTo(document.body);
    
    if (isRetina)
    {
        if ($(window).width()>760)
        {
            // 窗口和屏幕分辨率宽度>1500,切换到高清背景图
            $(document.body).addClass('big-screen');
        }
    }
    
    // 调整left-menu高度
    //$('#left-menu').height($(document.body).height()-$('#logo').height());
    
    // 创建目录
    create_menu();
    
    create_quick_menu();
    
    create_desktop();
    
    // 监控浏览器前进后退
    $(window).bind('popstate', function(e)
    {
        //window.history.state
    });

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
            $('#page-loading-table').fadeOut(600,function(){$(this).remove();});
            
            setTimeout('desktop_init=null;',1);
            
            // 重新整理size
            setTimeout('window.onresize();',20);
        },10);
    });
}










function chinese_calendar(today)
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
}
