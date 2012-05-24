<!DOCTYPE html>
<html>
<?php
/*
<html manifest="<?php echo Core::url('statics/').'appcache/tetris.manifest';?>">
*/
?>
<head>
<meta http-equiv="Content-Language" content="zh-cn" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta content="black-translucent" name="apple-mobile-web-app-status-bar-style" />
<link rel="apple-touch-icon-precomposed" href="http://app.3g.cn/App_icon_114.png" />
<title>后台管理</title>
<style type="text/css">
html,body{margin:0;padding:0;widht:100%;height:100;background:#d8edf0;}
#page-loading-table{position:absolute;left:0;top:0;background:#d8edf0;width:100%;height:100%;z-index:999999;font-size:12px;font:12px/1.5 Verdana,Helvetica,Arial,sans-serif;}
#page-loading{width:400px;height:8px;overflow:hidden;margin:auto;border:1px solid #398491;text-align:left;background:#b6d9e4;border-radius:6px;padding:1px;}
#page-loading-bar
{
float:left;
width:0px;
height:8px;
background-size: 30px 30px;
background-color: #45a6bd;
border-radius:6px;
-webkit-transition: width .4s ease-in-out;
-moz-transition: width .4s ease-in-out;
-ms-transition: width .4s ease-in-out;
-o-transition: width .4s ease-in-out;
transition: width .4s ease-in-out;
background-image: -webkit-gradient(linear, left top, right bottom,color-stop(.25, rgba(255, 255, 255, .15)), color-stop(.25, transparent),color-stop(.5, transparent), color-stop(.5, rgba(255, 255, 255, .15)),color-stop(.75, rgba(255, 255, 255, .15)), color-stop(.75, transparent),to(transparent));
background-image: -webkit-linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);
background-image: -moz-linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);
background-image: -ms-linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);
background-image: -o-linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);background-image: linear-gradient(135deg, rgba(255, 255, 255, .15) 25%, transparent 25%,transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%,transparent 75%, transparent);            
-webkit-animation: animate-stripes 3s linear infinite;
-moz-animation: animate-stripes 3s linear infinite;
}

@-webkit-keyframes animate-stripes { 
	0% {background-position: 0 0;} 100% {background-position: 60px 0;}
}
@-moz-keyframes animate-stripes {
	0% {background-position: 0 0;} 100% {background-position: 60px 0;}
}

#is-retina-div{overflow:hidden;width:1px;position:absolute;visibility:hidden;height:1px;}
@media only screen and (-webkit-min-device-pixel-ratio: 1.5),only screen and (min--moz-device-pixel-ratio: 1.5),only screen and (min-resolution: 200dpi)
{
#is-retina-div{width:10px;}
}
</style>
<script type="text/javascript">
var MyQEE = {};
MyQEE.Url = {
    Site    : '<?php echo rtrim(Core::url('/'),'/');?>',
    Statics : '<?php echo rtrim(Core::url('statics/'),'/');?>'
};
</script>
</head>
<body>
<div id="bg-div"></div>
<div id="is-retina-div"></div>
<table id="page-loading-table" border="0">
<tr>
<td align="center">
<div id="page-loading-div">
<div id="page-loading"><div id="page-loading-bar"></div></div>
<div style="padding:5px;" onclick="document.location.reload();">加载中...</div>
</div>
</td>
</tr>
</table>
<script type="text/javascript">
(function()
{
	var tmp = document.getElementById('is-retina-div');
	if (tmp.clientWidth==10)
	{
		window.isRetina = window.MyQEE.isRetina = true;
    	var m = document.createElement('meta');m.name = 'viewport';m.content = 'width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no';document.getElementsByTagName('head')[0].appendChild(m);m=null;
	}
	else
	{
		window.isRetina = window.MyQEE.isRetina = false;
	}

	var m = document.createElement('link');m.href=MyQEE.Url.Statics+'/skins/default/startup.png?ddddd1';m.rel='apple-touch-startup-image';document.getElementsByTagName('head')[0].appendChild(m);m=null;

	document.body.removeChild(tmp);
	tmp = null;

	(function(){
//	setTimeout(function(){
	    var p = 0;
		var urls = ['/skins/default/style.css',['/jquery/js/jquery-1.6.2.min.js','/jquery/js/jquery.transit.min.js'],'/js/iscroll.js','/js/global.js','/js/desktop.js'];
		var c = urls.length;
		var w = 400;
		if (document.body.clientWidth<600)
		{
			document.getElementById('page-loading').style.width = '160px';
			w = 160;
		}

		var lf = function(urls)
		{
			var url;
			if (typeof urls == 'object')
			{
				url = urls[0];
			}
			else
			{
				url = urls;
			}

		    var s = url.split('?')[0].substr(url.length-4);
			var type,tag;
			if (s=='.css')
			{
        		var t = document.createElement('link');
        		t.setAttribute('rel' ,'stylesheet');
        		t.setAttribute('type' , 'text/css');
        		t.setAttribute('id' , url);
        		t.setAttribute('href' , MyQEE.Url.Statics + url);//+'?t='+new Date().getTime());
			}
			else
			{
        		var t = document.createElement('script');
        		t.type = 'text/javascript';
        		t.src = MyQEE.Url.Statics + url;//+'?t='+new Date().getTime();
			}
			t.onload = function()
			{
				if (this._onloaded)return;
				this._onloaded = true;
				p++;
				document.getElementById('page-loading-bar').style.width = (w*p/c) + 'px';

				if (typeof urls=='object')
				{
					for (var i=1;i<urls.length;i++)
					{
						c++;
						lf(urls[i]);
					}
				}

				if (p==c)
				{
					setTimeout('desktop_init();',10);
				}
			}
			t.onreadystatechange = function()
			{
				if(this.readyState=='complete'||this.readyState=='loaded')
				{
	                this.onload();
	            }
			}
			t.onerror = function()
			{
				// 失败
				alert(url)
			}
    		document.getElementsByTagName('head')[0].appendChild(t);
		}

		for (var i=0;i<urls.length;i++)
		{
			lf(urls[i]);
		}

		//chrome,safari等浏览器不支持css的onload的事件
		var ck = setInterval(function()
		{
			if (p==c)
			{
				//all success
				clearInterval(ck);
				ck = null;
				return;
			}
			for (var i=1;i<document.styleSheets.length;i++)
			{
				var f = document.styleSheets[i].ownerNode;
				if (f && f.onload && !f._onloaded)
				{
					f.onload();
				}
			}
		},50);
//	},10);
	})();
})();
</script>
</body>
</html>