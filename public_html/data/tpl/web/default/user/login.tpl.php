<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html lang="zh-cn">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>微信管理系统</title>

	<meta name="keywords" content="微信管理系统" />

	<meta name="description" content="微信管理系统" />

	<link rel="shortcut icon" href="http://shop.daliancms.com/attachment/images/global/wechat.jpg" />

	<link href="./resource/css/bootstrap.min.css" rel="stylesheet">

	<link href="./resource/css/font-awesome.min.css" rel="stylesheet">

	<link href="./resource/css/common.css" rel="stylesheet">

	<script>var require = { urlArgs: 'v=2015120410' };</script>

	<script src="./resource/js/lib/jquery-1.11.1.min.js"></script>

	<script src="./resource/js/app/util.js"></script>

	<script src="./resource/js/require.js"></script>

	<script src="./resource/js/app/config.js"></script>

	<!--[if lt IE 9]>

		<script src="./resource/js/html5shiv.min.js"></script>

		<script src="./resource/js/respond.min.js"></script>

	<![endif]-->

	<script type="text/javascript">

	if(navigator.appName == 'Microsoft Internet Explorer'){

		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {

			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');

		}

	}

	

	window.sysinfo = {

		'siteroot': 'http://shop.daliancms.com/',

		'siteurl': 'http://shop.daliancms.com/web/index.php?c=user&a=login&',

		'attachurl': 'http://shop.daliancms.com/attachment/',

		'attachurl_local': 'http://shop.daliancms.com/attachment/',

		'cookie' : {'pre': '5d9b_'}

	};

	</script>

</head>

<body>

<!-- CMS:cms_homeproxy/home/personal.vm开始:home/personal.vm -->



    <!--[if lte IE 7]>

  <script type="text/javascript">

    window.location.href = 'https://www.alipay.com/x/kill-ie.htm';

  </script>

    <![endif]-->   







<!-- uitpl:/component/trackerTime.vm -->

<link rel="stylesheet" href="http://www.aibeit.com/css/font-awesome.min.css"/>

<link rel="stylesheet" href="http://www.aibeit.com/css/loginMy.css"/>





<script type="text/javascript">

  window._to = { start: new Date() };

</script>





<!-- CMS:cms/监控埋点/前端监控前置脚本开始:tracker/monitor.vm -->

<script type="text/javascript">

(function(e){if(!e.monitor){var a=e.monitor={};a._DATAS=[];var f=a._EVENTS=[];a.on=function(a,d){f.push([a,d])};a.off=function(){};a.log=function(c,d){if(c&&!(3<=arguments.length)){var b;"[object Object]"===Object.prototype.toString.call(c)?(b=c,b.profile=d||b.profile||"log"):b={profile:d||"log",seed:c};a._DATAS.push(b);return b}}}})(this);

(function(h,c){function q(a){return(a=String(a).match(r))?a[0]:"global"}function f(a,m,n,g,f,d,k){if(!k&&arguments.callee.caller){for(var b=arguments.callee.caller,e=[],h=0;b.arguments&&b.arguments.callee&&b.arguments.callee.caller;){b=b.arguments.callee.caller;e.push("at "+q(b));if(b.caller===b)break;if(h++>s)break}k=e.join("\n")}b={profile:t,type:a,msg:m||"",file:n||"",line:g||0,col:f||0,num:d||"",stack:k||"",lang:navigator.language||navigator.browserLanguage||"",lost:l.join(",")};

e=n+":"+g+":"+m;p.hasOwnProperty(e)||(b.uv=1,p[e]=!0);return c.log(b)}if(c){var t="jserror",s=20,r=/^\s*function\b[^\)]+\)/,l=[],d={};c.lost=function(a){if(!d.hasOwnProperty(a))return d[a]=!0,l.push(a),l};var p={};c.error=function(a){if(a instanceof Error)return f("catched",a.message||a.description,a.filename||a.fileName||a.sourceURL,a.lineno||a.lineNumber||a.line,a.colno||a.columnNumber,a.number,a.stack||a.stacktrace)};h.onerror=function(a,c,d,g){f("global",a,c,d,g);return!1}}})(this,this.monitor);

</script><!-- CMS:cms/监控埋点/前端监控前置脚本结束:tracker/monitor.vm -->





<!-- CMS:全站公共 cms/tracker/seajs.vm开始:tracker/seajs.vm -->	



<!-- monitor 防错代码 -->

<script>

(function(win){

  if(!win.monitor){win.monitor = {};}



  var METHODS = ["lost", "log", "error", "on", "off"];



  for(var i=0,method,l=METHODS.length; i<l; i++){

    method = METHODS[i];

    if("function" !== typeof win.monitor[method]){

      win.monitor[method] = function(){};

    }

  }

})(window);

</script>



<!-- seajs以及插件 -->

<script charset="utf-8" crossorigin="anonymous" id="seajsnode" onerror="window.monitor && monitor.lost && monitor.lost(this.src)" src="https://a.alipayobjects.com/??seajs/seajs/2.2.3/sea.js,seajs/seajs-combo/1.0.0/seajs-combo.js,seajs/seajs-style/1.0.2/seajs-style.js,seajs/seajs-log/1.0.0/seajs-log.js,jquery/jquery/1.7.2/jquery.js,gallery/json/1.0.3/json.js,alipay-request/3.0.3/index.js"></script>



<!-- seajs config 配置 -->

<script>

seajs.config({

  alias: {

    '$': 'jquery/jquery/1.7.2/jquery',

    '$-debug': 'jquery/jquery/1.7.2/jquery',

    'jquery': 'jquery/jquery/1.7.2/jquery',

    'jquery-debug': 'jquery/jquery/1.7.2/jquery-debug',

    'seajs-debug': 'seajs/seajs-debug/1.1.1/seajs-debug'

  },

  crossorigin: function(uri){

  

    function typeOf(type){

	  return function(object){

	    return Object.prototype.toString.call(object) === '[object ' + type + ']';

	  }

	}

	var isString = typeOf("String");

	var isRegExp = typeOf("RegExp");

    

	var whitelist = [];

	

                  whitelist.push('https://a.alipayobjects.com/');

          	

	for (var i=0, rule, l=whitelist.length; i<l; i++){

	  rule = whitelist[i];

	  if (

	    (isString(rule) && uri.indexOf(rule) === 0) ||

	    (isRegExp(rule) && rule.test(uri))

		) {

		

	    return "anonymous";

	  }

	}

  },

  vars: {

    locale: 'zh-cn'

  }

});

</script>



<!-- 兼容原有的 plugin-i18n 写法 -->

<!-- https://github.com/seajs/seajs/blob/1.3.1/src/plugins/plugin-i18n.js -->

<script>

seajs.pluginSDK = seajs.pluginSDK || {

  Module: {

    _resolve: function() {}

  },

  config: {

    locale: ''

  }

};

// 干掉载入 plugin-i18n.js，避免 404

seajs.config({

  map: [

	[/^.*\/seajs\/plugin-i18n\.js$/, ''],

	[/^.*\i18n!lang\.js$/, '']

  ] 

});

</script>



<!-- 路由旧 ID，解决 seajs.use('select/x.x.x/select') 的历史遗留问题 -->

<script>

(function(){



var JQ = '/jquery/1.7.2/jquery.js';

seajs.cache['https://a.alipayobjects.com/gallery' + JQ] = seajs.cache['https://a.alipayobjects.com/jquery' + JQ];



var GALLERY_MODULES = [

  'async','backbone','coffee','cookie','es5-safe','handlebars','iscroll',

  'jasmine','jasmine-jquery','jquery','jquery-color','json','keymaster',

  'labjs','less','marked','moment','mustache','querystring','raphael',

  'socketio','store','swfobject','underscore','zepto','ztree'

];



var ARALE_MODULES = [

  'autocomplete','base','calendar','class','cookie','dialog','easing',

  'events','iframe-uploader','iframe-shim','messenger','overlay','popup',

  'position','select','switchable','tip','validator','widget'

];



var util = {};

util.indexOf = Array.prototype.indexOf ?

  function(arr, item) {

    return arr.indexOf(item);

  } :

  function(arr, item) {

    for (var i = 0; i < arr.length; i++) {

      if (arr[i] === item) {

        return i;

      }

    }

    return -1;

  };

util.map = Array.prototype.map ?

  function(arr, fn) {

    return arr.map(fn);

  } :

  function(arr, fn) {

    var ret = [];

	for (var i = 0; i < arr.length; i++) {

        ret.push(fn(arr[i], i, arr));

    }

    return ret;

  };



function contains(arr, item) {

  return util.indexOf(arr, item) > -1

}



function map(id) {

  id = id.replace('#', '');



  var parts = id.split('/');

  var len = parts.length;

  var root, name;



  // id = root/name/x.y.z/name

  if (len === 4) {

    root = parts[0];

    name = parts[1];



    // gallery 或 alipay 开头的没有问题

    if (root === 'alipay' || root === 'gallery') {

      return id;

    }



    // arale 开头的

    if (root === 'arale') {

      // 处理 arale/handlebars 的情况

      if (contains(GALLERY_MODULES, name)) {

        return id.replace('arale/', 'gallery/');

      } else {

        return id;

      }

    }

  }

  // id = name/x.y.z/name

  else if (len === 3) {

    name = parts[0]



    // 开头在 GALLERY_MODULES 或 ARALE_MODULES

    if (contains(GALLERY_MODULES, name)) {

      return 'gallery/' + id;

    } else if (contains(ARALE_MODULES, name)) {

      return 'arale/' + id;

    }

  }



  return id;

}



var _use = seajs.use;



seajs.use = function(ids, callback) {

  if (typeof ids === 'string') {

    ids = [ids];

  }



  ids = util.map(ids, function(id) {

    return map(id);

  });



  return _use(ids, callback);

}



})();

</script><!-- CMS:全站公共 cms/tracker/seajs.vm结束:tracker/seajs.vm -->



<!-- CMS:全站公共 cms/tracker/tracker_time.vm开始:tracker/tracker_time.vm --><meta name="ABTest" content="" />



<script type="text/javascript">

if (!window._to) {

  window._to = { start: new Date() };

}

</script>

  <script charset="utf-8" crossorigin="crossorigin" src="https://a.alipayobjects.com/??static/ar/alipay.light.base-1.8.js,tracker-all/2.1.2/index.js,alipay/smartracker/2.0.0/smartracker.js"></script>
<script>

  window.Tracker && Tracker.start && Tracker.start();
</script>

<!-- CMS:全站公共 cms/tracker/tracker_time.vm结束:tracker/tracker_time.vm -->



    <!-- animate.css -->

    <link rel="stylesheet" href="./resource/weidongli/logormsweb/T1GPFhXmldXXXXXXXX.css" type="css/text" />

    <style>

      @font-face {

        font-family: 'alipayhome';

        src: url('//at.alicdn.com/t/font_1431504418_7238076.eot'); /* IE9*/

        src: url('//at.alicdn.com/t/font_1431504418_7238076.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */

        url('//at.alicdn.com/t/font_1431504418_7238076.woff') format('woff'), /* chrome、firefox */

        url('//at.alicdn.com/t/font_1431504418_7238076.ttf') format('truetype'), /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/

        url('//at.alicdn.com/t/font_1431504418_7238076.svg#iconfont') format('svg'); /* iOS 4.1- */

      }

    </style>

    <style>

      body, ol, ul, h1, h2, h3, h4, h5, h6, p, th, td, dl, dd, form, fieldset, legend, input, textarea, select, img {margin: 0;padding: 0;}

      body { font:12px/1.5 "Microsoft YaHei",tahoma,arial,Hiragino Sans GB,\5b8b\4f53; overflow: hidden;position: relative;}

      html,body,.am-page,.am-body,.am-bg{height:100%; width:100%;}

      html,body,.am-page{ overflow:hidden; }

      ul,li {list-style:none;}

      .am-body { position: absolute; top: 0; left: 0; }

      .iconfont {font-family: "alipayhome";-webkit-font-smoothing: antialiased;font-style: normal; display:block;}

      .clearfix {zoom:1;}

      .clearfix:after {content:"";display:block;height:0;clear:both;visibility:hidden;}

      .fl{float:left !important;}

      .fr{float:right !important;}

      .w320 { width: 320px;}

      .fn-hide { display: none !important; }

      .arrow-down { display: inline-block; width:0px; height:0px; border-width: 5px 5px 0 5px; border-color:#eeeeee transparent transparent transparent; border-style: solid dashed dashed dashed;}

      .am-page,.am-bg { background-size:cover;background-repeat:no-repeat;background-position:center center;}

      .am-page { overflow:hidden; position: relative; z-index: 1;}

      .am-bg {position:absolute;z-index: 9;top: 0;left: 0;}

      .main-content,.ft-content {width:1200px;margin:0 auto;height:100%;}

      .main-content { position:relative;z-index:99;}

      .ftbar { height:60px; overflow:hidden;z-index: 101; position:absolute;left:0;bottom:0; width:100%; background: rgba(0,0,0,.3); }

      .ft-content { }



      .products {padding-top: 12px;}

      .product {float:left;}

      .product .icon {font-family: "alipayhome"; color: #fff; font-size: 32px; float:left; font-style: normal; display:block;height: 32px;width: 32px;line-height: 32px; text-align: center;-webkit-font-smoothing: antialiased; }

      .product .tips { padding-left:12px; margin-left:42px; position:relative;}

      .product .tips:before { content:"";display:block; background-color:#b5b5b5; position:absolute; height:90%;width:1px;top:1px; left:-1px; }

      .product .tips p,.product .tips span {line-height: 1;}

      .product .tips p,.product .tips span  { color: #fff;}

      .product .tips p { font-size:16px;}

      .product .tips span { font-size:12px;margin-top: 5px;display: inline-block;}

      .products .zzfk,.products .gh,.products .ewmfk,.products .wjsy,.products .gjys { margin-left: 40px;}

      .products .gjhk,.products .ssqx,.products .ckbg,.products .sbfk,.products .rmbfk {float: right; margin-right: 40px;}

      /*.products .ewmfk,.products .fkmfk,.products .gjys,.products .ppzp { width: 320px;}*/

      .products .fkmfk {margin-left:150px;}

      .products .ppzp {margin-left: 130px;}

      .products .ewmfk {}

      .products .gh {}

      .products .yhf,.products .zndz {margin-left:80px;}

      /*.products .wjsy {margin-left: 80px;}*/

      .products .aqbz{margin-left: 80px;}

      .header {position:fixed;width:100%;top:0;left:0; z-index:999;}

      .header .am-header-inner { position: relative; z-index: 2;}

      .header .topNav .laymid,.topNav {background:#1e1b29;}

      .header .laymid {width:1200px; margin:0 auto;}

      .topNav {font-size:12px; height:28px; line-height:28px; }

      .topNav li {float:left;margin:0 15px; text-align:center;}

      .topNav li.first { margin-left: 0 !important;}

      .topNav,.topNav a,.topNav span {color:#fff;font-size:12px;}

      .topNav a {text-decoration:none; }

      .topNav a:hover,.topNav li.on a {color:#00bbee;}

      .topNav .rlink li {margin:0 5px;}

      .am-bannarAd-box {position:relative;z-index:1;display:none;}



      .mainNav {background-color:#ffffff;border-bottom: 1px #eeeeee solid;background-color:rgba(255,255,255,.9); }

      .mainMenu { margin-left:360px; }

      .alipay-logo {display:block;width:114px;position: relative;left:0;top:20px;float:left;height:40px;background-position:0 0;background-repeat:no-repeat;background-image: url(./resource/weidongli/logoT1HHFgXXVeXXXXXXXX.png);}

      .mainNav,.mainMenu,.channel .downlist .close {height:80px;}



      .channel {float:left; height:80px; line-height:80px;position:relative;}

      .channel .channel-a,.channel .downlist a {text-decoration:none; color:#333; font-size:16px; display:block;}

      .channel .downlist { display: none; box-shadow:0 0 2px rgba(128,128,128,0.5);  position:absolute; top:0; left:-5px; width:100%; padding:0 5px 0;text-align:center; background:#ffffff;}

      .channel .downlist a {line-height:28px;padding: 0 5px; margin: 0 -5px;}

      .channel .downlist .together { padding-bottom: 15px; }

      .channel .downlist .tp a { font-size:14px; }

      .channel .downlist .ft { border-top:1px #eeeeee solid;}

      .channel .downlist .ft span { font-size:16px; color: #999; display: block; height: 80px; line-height: 80px;}

      .channel .downlist a:hover {background:#00bbee;color:#fff;}

      .channel .downlist .close {display:block;cursor:pointer;line-height:80px;text-align:center;font-size:24px;color:#999; font-family: "alipayhome"; -webkit-font-smoothing: antialiased;}

      .mainMenu .hover .downlist {display:block;}



      .channel-a { padding:0 30px;}

      .channel-a:hover,.mainMenu .on .channel-a,.am-service .downlist a:hover {color:#00bbee;}

      .hasleftline {padding-left:20px;margin-left:20px;}

      .hasleftline:before { content:"";display:block;position:absolute;top:32px;left:0;width:1px;height:16px;background:#444;}



      .buttons { margin-top: 25px; float: right; }

      .buttons .am-button-innerNav { text-decoration: none; text-align: center; display: block; height: 28px; line-height: 28px; margin-left: 15px; }

      .buttons .button-myalipay,.buttons .button-login,.video-area .button-login {background: #00bbee; color: #ffffff;}

      .buttons .button-myalipay,.buttons .button-login { border-radius: 2px;}

      .buttons .button-login { font-size: 14px; width: 84px;}

      .buttons .button-register { color: #00bbee; font-size: 12px;}

      .buttons .button-myalipay { padding: 0 15px; margin-right: 8px; margin-left: 0; }

      .buttons dd {float: left; }



      .am-service {position: relative; }

      .am-service .arrow-down {*position: relative; *top:-3px; *left:3px; margin-left: 3px; -webkit-transition: .5s 0s all; -o-transition: .5s 0s all;-moz-transition: .5s 0s all; -ms-transition: .5s 0s all; transition: .5s 0s all; }

      .am-service:hover .arrow-down { -webkit-transform:rotate(180deg);-o-transform:rotate(180deg);-moz-transform:rotate(180deg);-ms-transform:rotate(180deg); transform:rotate(180deg);}

      .am-service .downlist { padding: 5px 0; top: 28px; left: -10px; width: 80px; text-align:center; display: none; border: 1px #f1f1f1 solid; border-width: 0 1px 1px 1px; background: #fff; position: absolute; }

      .am-service .downlist a { color: #333;display:block; }

      .am-service:hover .downlist { display: block;}



      /*第一页*/

      .video-loading { display: block; visibility: hidden; position: absolute; bottom: 130px; right: -40px; width: 50px; height: 50px; background: url(./resource/weidongli/logoT11pNfXnRnXXXXXXXX.gif) center center no-repeat;}

      .play { display: block; visibility: hidden; height:36px;width:36px; line-height: 36px; font-size: 34px; text-decoration: none;color: #ffffff; bottom: 130px;right: -40px;position: absolute; z-index: 99;}

      .haslogin {bottom:130px !important;}

      .video-player {background-color: transparent;min-width: 100%; min-height: 100%; display: block; position: absolute; z-index: 1; visibility: hidden;}

      .video-area { background-color: #666666;}

      .video-area .logo { margin-bottom:10px;/* width:520px;height:109px;*/ width: 420px; height: 88px; background-repeat: no-repeat; background-position: -10px 0; background-size:100% 100%;background-image: url(./resource/weidongli/logo/4JdljnmTmX.png);}

      .video-area .laymid { position:absolute;top:50%;left:50%;width:420px;height:200px;margin-left:-195px;margin-top: -40px; }

      .video-area .am-bg { overflow: hidden;}

      .video-area .click-me a {display:block; text-decoration:none; float: left; }

      .video-area .am-button { text-align: center; cursor:pointer; display:block;border-radius:3px;outline:none; border:none;font-size: 14px; line-height: 30px; height: 30px; width: 186px; color:#fff; border-width: 1px; border-style: solid;margin-right: 20px;}

      .video-area .button-login { letter-spacing:5px; border-color: #00bbee; }

      .video-area .button-register { border-color: #ffffff; }



      .video-area .button-login:hover,.buttons .button-login:hover,.buttons .button-myalipay:hover {background: #00a3d2;}

      .video-area .button-login:hover {border-color: #00a3d2;}

      .video-mask,.poster {visibility: hidden; position: absolute; z-index: 9; top: 0; left: 0; width: 100%; height: 100%; opacity: 0;}

      .poster { -webkit-transition: 2s 0s opacity;-o-transition: 2s 0s opacity;-moz-transition: 2s 0s opacity;-ms-transition: 2s 0s opacity; transition: 2s 0s opacity; background-repeat:no-repeat; background-position: center center; background-size: cover; }



      .video-mask { visibility: hidden; z-index: 99; background: #000; opacity: 0.35; filter:alpha(opacity=40);}

      .stat-novideo .video-player,.stat-ready .video-mask { visibility: hidden; }

      .stat-playing .video-mask,.stat-end .video-mask,.stat-novideo .video-mask,.stat-pause .video-mask,.stat-pause .video-player,.stat-playing .video-player { visibility: visible;}

      .stat-playing .play { visibility: hidden; }

      .stat-pause .play { visibility: visible; }

      .stat-end .poster,.stat-novideo .poster { opacity: 1; visibility: visible;}

      .stat-end .play { visibility: visible; }

      .stat-end .video-player { visibility: hidden; }

      .stat-ready .video-loading { visibility: visible;}



      .popbox { display: none; height: 0;}

      .popbox .popmask { visibility: hidden; display: block; position: fixed; z-index: 997; top: 0; left: 0;background: rgba(0,0,0,0.6);}

      .popbox .loginbox .iframe,.popbox .loginbox iframe,.popbox .popmask { width: 100%; height: 100%;}

      .popbox .loginbox .iframe { position: relative;}

      .popbox .loginbox iframe { visibility: hidden; width:286px;overflow:hidden;}

      .popbox .loginbox .loading { width: 100%; height: 100%; position: absolute;top: 0; left: 0; background: url(./resource/weidongli/logo/T1fONeXlBpXXXXXXXX.gif) #000000 no-repeat center center;}

      .popbox .loginbox { width: 286px; height: 380px; border-radius: 5px; overflow: hidden; visibility: hidden; position: absolute; z-index: 1001; top: 50%; left: 50%; margin-left: -143px; margin-top: -120px;}

      .popbox .popbox-close { position: absolute; z-index: 9; top: 5px; left: 10px; font-size: 16px; color: #ccc; text-decoration: none;}

      .popbox .popbox-close:hover {color:#f1f1f1;}

      .stat-login { display: block !important; }

      .stat-login .loginbox,.popbox .popmask {visibility: visible;}



      /*第二页*/

      .am-cloud {position: absolute; z-index: 9; background-position: 0 0; background-repeat: no-repeat;}

      .am-boy {width: 120px; left: 30%; top: 55%;}

      .am-kind {width: 600px; right: 10%; top: 10%;}

      .am-smart {width: 227px;left: -20%; top: 10px;}

      .am-flying {width: 340px; left: 0%; top: 150px;}

      .am-stupid {width: 224px; left: 5%; top: 150px;}

      .am-seeyou {width: 343px; right: -5%; top: 10px;}

      .am-here {width: 400px; right: -5%; top: 5%;}

      .songbao { -webkit-transition:.2s 0s width linear; position: absolute; z-index: 10; width: 900px; /*height: 748px;*/ bottom: 0; right: -15%;}



      /*最后一页*/

      .am-five .am-bg .am-part-white,.am-five .am-bg .am-part-black {width:100%;display:block;position:absolute;z-index:0;}

      .am-five .am-bg .am-part-white {top:0;left:0;background:#f5f5f5;}

      .am-five .am-bg .am-part-black {bottom:0;left:0;background:#1e1b29;}

      .am-five .am-bg .am-part-white,.am-five .white-area {height:70%;min-height: 430px;z-index: 2;}

      .am-five .am-bg .am-part-black,.am-five .black-area {height:30%;z-index: 1;}

      .am-five .white-area .layout {width:98%; margin: 0 auto;}



      .happy-life { padding-top:110px; }

      .youcans { padding-top:40px; padding-bottom: 40px;}

      .youcan {float:left; width: 25%; *width: 24.8%; }

      .youcan .icon {color: #aaaaaa; font-family: "alipayhome"; text-align: center; line-height: 36px; font-size: 36px; font-style: normal; float:left; display:block; height:36px; width:36px;-webkit-font-smoothing: antialiased; }

      .youcan .tips { margin-top: 4px;}

      .youcan .tips p { font-size:14px;}

      .youcan .tips span { font-size:14px; color:#999;}

      .youcan .tips a { text-decoration: none; color: #999;}

      .youcan .tips a:hover,.newslist li a:hover,.tlink a:hover {text-decoration: underline;}

      .youcan .icon-pay {color:#ffb400;}

      .youcan .icon-member {color:#47a8ef;}

      .youcan .icon-oversea  {color:#ff6600;}

      .youcan .icon-play {color:#47a8ef;}

      .youcan .title { height: 36px; line-height: 36px; font-size: 14px; margin-left: 45px;}



      .filed { border-top: 1px #eeeeee solid;}

      .filed a {text-decoration:none;color:#333;}

      .filed .block { padding-top: 40px; width: 25%; *width:24.8%; float: left; }

      .notice span {float:left;color:#666;}

      .newslist {margin-left: 32px;}

      .newslist li {line-height:20px; width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: pre; }

      .newslist li a,.follow-us .weibo,.follow-us,.tlink a {color:#999;}

      .tlink { margin-bottom: 10px; margin-top:2px;}

      .tlink a {line-height:1; float:left;margin-bottom:5px; margin-left:8px; padding-left:8px; border-left: 1px #999 solid;}

      .tlink a.first {margin-left: 0 !important; padding-left: 0 !important; border-left: 0 !important;}

      .follow-us {line-height: 14px;}

      .follow-us .weibo { text-decoration: underline; margin-left:5px;}



      .alipay-app {}

      .alipay-app p { color: #999999;}

      .qrcode { display:block; width: 80px; height: 80px; padding: 1px; border: 1px #e9e9e9 solid;}



      .footer,.footer a {color:#999999;}

      .footer {padding-top:30px;}

      .footer .links {line-height:1; padding:0 0 5px;}

      .footer .links a {float:left;text-decoration:none;margin-bottom:5px;border-left:1px #999999 solid; margin-right:5px; padding-left:5px;}

      .footer .links a:first-child {border-left:0;padding-left: 0 !important;}

      .footer .certs { margin-top:5px; height: 38px; }

      .footer .certs a { display: block; float: left; height: 38px; background: url(./resource/weidongli/logo/4JdkuzOiwP.png) no-repeat 0 0; margin-right: 20px;}

      .footer .certs .pic1 {background-position: -4px -20px; width: 32px; }

      .footer .certs .pic1:hover {background-position: -2px -64px; }

      .footer .certs .pic2 {background-position: -64px -15px; width: 70px; }

      .footer .certs .pic2:hover { background-position: -62px -60px; }

      .footer .certs .pic3 {background-position: -140px -15px; width: 65px;}

      .footer .certs .pic3:hover {background-position: -138px -60px; }

      .footer .certs .pic4 {background-position: -225px -15px; width: 30px;}

      .footer .certs .pic4:hover {background-position: -223px -60px; }

      .footer .certs .pic5 {background-position: -260px -15px; width: 60px;}

      .footer .certs .pic5:hover {background-position: -258px -59px; }

      .footer .certs .pic6 {background-position: -390px -18px; width: 30px;}

      .footer .certs .pic6:hover {background-position: -390px -58px; }

      .footer .certs .pic7 {background-position: -335px -18px; width: 40px;}

      .footer .certs .pic7:hover {background-position: -334px -58px; }

      .footer .certs .pic8 {background-position: -428px -18px; width: 40px;}

      .footer .certs .pic8:hover {background-position: -428px -58px; }



      /*元素初始状态*/

      .am-page .words { visibility:hidden; opacity:0; position:absolute; z-index: 11; background-position:0 0; background-repeat:no-repeat;}

      .am-page .words img { width: 100%; height: 100%;}

      .view2 .words {-webkit-transition:1s .2s opacity;  -o-transition:1s .2s opacity;  -moz-transition:1s .2s opacity; -ms-transition:1s .2s opacity; transition:1s .2s opacity; top:30%; left:25%; width: 315px;}

      .view3 .words {-webkit-transition:1s 1.2s opacity;-o-transition:1s 1.2s opacity;-moz-transition:1s 1.2s opacity; -ms-transition:1s 1.2s opacity; transition:1s 1.2s opacity; top:29%;left: 50%; width:345px;}

      .view4 .words {-webkit-transition:1s 1.5s opacity;-o-transition:1s 1.5s opacity;-moz-transition:1s 1.5s opacity; -ms-transition:1s 1.5s opacity; transition:1s 1.5s opacity; top:30%;left: 100px; width: 300px;}

      .view5 .words {-webkit-transition:1s .5s opacity;-o-transition:1s .5s opacity;-moz-transition:1s .5s opacity; -ms-transition:1s .5s opacity; transition:1s .5s opacity; top:30%;right:18%; width: 300px;}

      .view3 .up { position:absolute; -webkit-transition: .8s .5s all;-o-transition: .8s .5s all;-moz-transition: .8s .5s all;-ms-transition: .8s .5s all; transition: .8s .5s all; }

      .view3 .down { position:absolute; -webkit-transition: .5s .2s all;-o-transition: .5s .2s all;-moz-transition: .5s .2s all;-ms-transition: .5s .2s all; transition: .5s .2s all; }

      .view3 .up { z-index: 2; top:-500px; left:-530px; width:480px; }

      .view3 .down { z-index: 1; top:102%; left:55%; width:1600px; }

      .am-six .words {-webkit-transition:1s 1.5s opacity;-o-transition:1s 1.5s opacity;-moz-transition:1s 1.5s opacity; -ms-transition:1s 1.5s opacity; transition:1s 1.5s opacity; top:30%;left: 13%; width: 355px;}

      /* 进入动画*/

      .animateIn-one .words,.animateIn-two .words,.animateIn-three .words,.animateIn-four .words,.animateIn-six .words { visibility: visible; opacity:1;}

      .am-three .am-bg,.am-one .am-bg {-webkit-transform-origin: 50% 50%; -moz-transform-origin: 50% 50%; -o-transform-origin: 50% 50%; -ms-transform-origin: 50% 50%; transform-origin: 50% 50%; }

      /*海外购物*/

      .am-six .am-bg {-webkit-transition: 16s 0s all ease;-o-transition: 16s 0s all ease;-moz-transition: 16s 0s all ease; transition: 16s 0s all ease; -webkit-transform:scale(1,1);-o-transform:scale(1,1);-moz-transform:scale(1,1);transform:scale(1,1);}

      .animateIn-six .am-bg { -webkit-transform:scale(1.1,1.1); -o-transform:scale(1.1,1.1); -moz-transform:scale(1.1,1.1);transform:scale(1.1,1.1); }

      /*智慧医疗*/

      .am-three .am-bg {-webkit-transition: 16s 0s all ease;-o-transition: 16s 0s all ease;-moz-transition: 16s 0s all ease; transition: 16s 0s all ease; -webkit-transform:scale(1.1,1.1); -o-transform:scale(1.1,1.1); -moz-transform:scale(1.1,1.1);transform:scale(1.1,1.1); }

      .animateIn-three .am-bg {-webkit-transform:scale(1,1);-o-transform:scale(1,1);-moz-transform:scale(1,1);transform:scale(1,1);}

      /*松宝*/

      .am-one .am-bg { -webkit-transition: 3s 0s all;-o-transition: 3s 0s all;-moz-transition: 3s 0s all; transition: 3s 0s all ease; -webkit-transform:scale(1.02,1.02); -o-transform:scale(1.02,1.02); -moz-transform:scale(1.02,1.02);transform:scale(1.02,1.02);}

      .animateIn-one .am-bg {-webkit-transform:scale(1,1);-o-transform:scale(1,1);-moz-transform:scale(1,1);transform:scale(1,1);}



      .animateIn-two .up {top: -100px; left:2%;}

      .animateIn-two .down {top:400px; left:12%;}



      .am-four .am-bg .mask { visibility:hidden; -webkit-transition: 2s 2s opacity; -o-transition: 2s 2s opacity; -moz-transition: 2s 2s opacity; -ms-transition: 2s 2s opacity; transition: 2s 2s opacity; opacity:0; content: ""; background: #2D0E0E; display: block; width: 100%; height: 100%; position: absolute; top: 0; left: 0; }

      .animateIn-four .am-bg .mask { opacity: 0.6; filter:alpha(opacity=60); visibility: visible; }



      .alipay-ads { position: relative; }

      .alipay-ads h4 { color: #000; font-weight: 800; font-size: 14px;}

      .alipay-ads p {width:160px; padding: 5px 0 10px; color: #999;}

      .alipay-ads .ads-img { border: 0; position: absolute; right: -10px; top: -10px; z-index: 1; display: block; width: 150px;}

      .alipay-ads .ads-text { position: relative; z-index: 2;}

      .alipay-ads .ads-text .link-detail {text-decoration: none; float: left; display: block; line-height: 1.5; padding: 2px 15px; background: #959595; color: #fff;}



      /*当设备宽小与1200px时的适配*/

      .belowW1200 .header .laymid,.belowW1200 .ft-content,.belowW1200 .main-content { width: 990px;}

      .belowW1200 .mainMenu { margin-left: 260px;}

      .belowW1200 .products .gjhk,.belowW1200 .products .sbfk { }

      .belowW1200 .products .yhf,.belowW1200 .products .zndz { margin-left: 28px;}

      .belowW1200 .products .aqbz { margin-left: 0px;}

      .belowW1200 .products .fkmfk { margin-left: 50px;}

      .belowW1200 .products .ppzp {margin-left: 20px;}

      .belowW1200 .products .wjsy {margin-left: 0;}

      .belowW1200 .products .ewmfk {}

      .belowW1200 .products .zzfk,.belowW1200 .products .ewmfk,.belowW1200 .products .wjsy { margin-left: 40px;}

      .belowW1200 .products .gh {margin-left:10px;}

      .belowW1200 .products .ckbg {margin-right:10px;}

      .belowW1200 .songbao { right: -30%;}

      .belowW1200 .am-two .words { left: 54%;}

      .belowW1200 .am-three .words { left: 50px; }

      .belowW1200 .animateIn-two .up {top: -100px; left:0%;}

      .belowW1200 .animateIn-two .down {top:400px; left:10%;}

      .belowW1200 .channel-a { padding: 0 25px;}

      .belowW1200 .alipay-ads .ads-img {right: -30px; width: 120px;}



      .w3 {width: 385px; margin-left: 15px;}

    .w4 {width: 285px; margin-left: 15px;}

    .belowW1200 .w3 {width: 320px; margin-left: 10px;}

    .belowW1200 .w4 {width: 235px; margin-left: 12px;}



      /*当设备高小与650px时的适配*/

      .maxH650 .songbao { width: 800px; bottom: -50px;}

      .maxH650 .up { width: 420px; top: -380px; }

      .maxH650 .down { width: 1300px; }

      .maxH650 .animateIn-two .up { width: 420px; top: -100px; }

      .maxH650 .animateIn-two .down { width: 1300px; top: 300px; }



      .maxH800 .songbao { width: 820px; bottom: 0px;}

      .maxH800 .am-two .words { top: 35%;}

      .maxH800 .animateIn-two .up { width: 440px; top: -80px; left: 5%; }

      .maxH800 .animateIn-two .down { width: 1340px; top: 380px; left: 15%; }



      .big800 .am-one .words { top: 35%; left: 18%;}



      .big800 .am-two .words { top: 300px;}

      .big800 .animateIn-two .up { width: 500px; top: -100px; }

      .big800 .animateIn-two .down { width: 1600px; top: 460px; }



      /*当设备高与800px时的适配*/

      .bigscreen .am-five .am-bg .am-part-white,.bigscreen .am-five .white-area { height: 50%; min-width: 400px; }

      .bigscreen .am-five .am-bg .am-part-black,.bigscreen .am-five .black-area { height: 50%;}

      /*

      .go-next {text-align: center; color: #fff; font-size: 36px; position: fixed; bottom: 80px; left: 50%; margin-left: -15px; display: block; width: 40px; height: 40px; line-height: 40px; z-index: 99; cursor: pointer; }

      .upanddown {

        -webkit-animation: pulse 1.5s 0 linear infinite;

        animation: pulse 1.5s 0 linear infinite;

      }*/



      .laynext { position: relative; z-index: 99; line-height: 0; height: 0;top: 100%; left: 0; }

      .go-next {text-decoration: none; text-align: center; color: #ffffff; font-size: 36px; position: absolute; bottom: 80px; left: 50%; margin-left: -15px; display: block; width: 40px; height: 40px; line-height: 40px; z-index: 99; cursor: pointer;}



      @-webkit-keyframes upanddown {

        0%, 100% {

          bottom: 80px

        }

        50% {

          bottom: 70px

        }

      }



      @-webkit-keyframes aw-pulse {

        0%, 100% {

          -webkit-transform: translate3d(0,0,0);

          transform: translate3d(0,0,0);

        }

        50% {

          -webkit-transform: translate3d(0,10px,0);

          transform: translate3d(0,10px,0);

        }

      }





      .upanddown {

        -webkit-animation: pulse 2s 0 linear infinite;

        /*

        -webkit-backface-visibility: hidden;

        -webkit-transform: translate3d(0,0,0);

        transform: translate3d(0,0,0);*/

      }



      /* when device-pixel-ratio == 2 */

      @media only screen and (-webkit-min-device-pixel-ratio: 2), not all, not all, not all, only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {

        .video-area .logo {background-image: url(./resource/weidongli/logo/4JdkvPYoOr.png);}

        .alipay-logo {background-image:url(./resource/weidongli/logo/T11rdgXbFkXXXXXXXX.png);}



        .am-page .words,.alipay-logo,.youcan .icon,.am-three .up,.am-three .down {background-size:100% 100%;}



        .am-two .words {}

        .am-three .words {}

        .am-four .words {right: 15%;}

        .footer .certs a { background-image: url(./resource/weidongli/logo/4JdloFhW69.png); background-size: 500px 100px;}

      }

      .am-page,.am-bg,.am-page .main-content,.video-mask,.ftbar {-webkit-transform:translate3d(0,0,0);transform:translate3d(0,0,0);}

      .fuck-ie { display: none;}



    .alipay-flash-logo { width: 260px; height: 45px; overflow: hidden;}

      .alipay-noflash {text-indent:-500px;overflow:hidden;}

      .white-nav .mainNav { background-color: #ffffff !important; filter: alpha(opacity=100);}

      .white-nav .header {border-bottom:0;}

      #ServerNum,#ServerNum p {line-height:1;text-align:center;color:#1e1b29;}

    </style>

    <!--[if lte IE 8]>

    <style type="text/css">

        .channel .downlist { border:1px #f1f1f1 solid; }

        .ftbar .ft-content { position: relative; z-index: 2; top:0; left:0;}

        .ftbar .fuck-ie { zoom:1; background:#000; filter:alpha(opacity=30); display:block; width:100%; height:100%; position: absolute; top:0; left:0; z-index: 1;}

        .popmask {background: #000; filter:alpha(opacity=60);}

		

		

    </style>

    <![endif]-->

  <!--[if gte IE 9]>

    <style type="text/css">

    .channel .downlist { border:1px #f1f1f1 solid; border-top:0; box-shadow: none; }

    </style>

  <![endif]-->

  <!--[if IE 9]>

    <script type="text/javascript">

  var loginboxHack = true;

  </script>

    <![endif]-->

	  <script type="text/javascript" charset="utf-8">

  	if (typeof console === 'undefined') { console = { log: function() {} }; }

    try{

      var oldDomain=document.domain;

      var num=oldDomain.indexOf('alipay');

      var newDomain=oldDomain.substring(num,oldDomain.length)

      document.domain=newDomain;

    } catch(msg) {

      document.domain = 'alipay.com';

    }

  </script>



  

      <script type="text/javascript">

      var autoPlay = true;

    </script>

  

  

  

  </head>

<body>

      <div id="J_bannar_box" class="am-bannarAd-box"></div>

    </div>

    <div id="J_onepage" class="am-body">

                <div id="J_videoContainer" class="am-page video-area">

            <div class="main-content">

                <div class="laymid">

                 <div class="logo"></div>

                    <div class="main">



	<div class="center" style="width:300px; height:150px;">

		<form action="" method="post" role="form" onsubmit="return formcheck();">

					<div class="form-group input-group">

						<div class="input-group-addon"><i class="fa fa-user"></i></div>

						<input name="username" type="text" class="form-control input-lg" placeholder="请输入用户名登录">

					</div>

					<div class="form-group input-group">

						<div class="input-group-addon"><i class="fa fa-unlock-alt"></i></div>

						<input name="password" type="password" class="form-control input-lg" placeholder="请输入登录密码">

					</div>

					

						<div class="pull-right">

							<?php  if(!$_W['siteclose']) { ?><a href="<?php  echo url('user/register');?>" class="btn btn-link btn-lg">注册</a><?php  } ?>

							<input type="submit" name="submit" value="登录" class="btn btn-primary btn-lg" />

							<input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />

						

						</div>

				</form>

	</div>

	

</div>





<script type="text/javascript" src="http://www.aibeit.com/css/js/loginMy.js"></script>

                    <a id="J_play" href="javascript:;" class="iconfont play">&#xe615;</a>

                    <div class="video-loading"></div>

                </div>

            </div>

        </div>    

               

    <a id="J_gonext" href="javascript:;" class="iconfont go-next upanddown">&#xe612;</a>

    <div id="J_popbox" class="popbox">

        <div id="J_popmask" class="popmask"></div>

        <div id="J_loginbox" class="loginbox">

            <a href="javascript:;" class="popbox-close">&times;</a>

           

    </div>

    <script type="text/javascript">

    //判断是否有flash

    function hadFlash(){

        var result = false;

        var obj = null;

        var activeXEnabled = function(){

            if(!window.ActiveXObject) return false;

            var external = window.external;

            try{

                if(external && typeof external.msActiveXFilteringEnabled != "undefined" && external.msActiveXFilteringEnabled()){

                    return false;

                }

            }catch(e){}

            return true;

        };



        if (activeXEnabled()) {

            try {

                obj =  new ActiveXObject("ShockwaveFlash.ShockwaveFlash");

                result = !!obj;

            }

            catch (e) {} finally {obj = null;}

        }

        else {

            if(navigator.plugins) result = navigator.plugins['Shockwave Flash'];

        }

        return !!result;

    }

    </script>

	<!-- modules -->

		

	

	<script type="text/javascript" src="https://a.alipayobjects.com/alipayhome-static/1.0.5/index.js"></script>

	    <script type="text/javascript">

		var jq = jQuery;

		//hack mac safari没有falsh的情况

		if(!hadFlash()) {

			var flash = jq('#J_alipay_flash_logo');

			var noflash = jq('#J_alipay_noflash');

			if(flash.length > 0) {

				flash.css({"display":"none"});

				flash.addClass("fn-hide");

				noflash.removeClass("fn-hide");

			}

		}

    </script>

<!-- uitpl:/component/tracker.vm -->

<!-- CMS:全站公共 cms/tracker/tracker.vm开始:tracker/tracker.vm --><script type="text/javascript">

window.Smartracker && Smartracker.sow&&Smartracker.sow();

</script>
<script type="text/javascript">

function _use_monitor(){
  if(!window.seajs){return;}



  // 命中率：[0,1]: 实际对应采样率：[0%,100%]

  // 注意：sens_rate 跟 sens_rate 是有关联的。

  //      实际设置的内容时，应该参考以下算法：

  //      敏感信息监控实际采样率 = sens_rate * jserr_rate;

  var jserr_rate = 1;

  var sens_rate = 0.01;

  var performance_rate = 1;



  // 随机采样命中算法。

  // @param {Nuber} rate, 采样率，[0,1] 区间的数值。

  // @return {Boolean}

  function hit(rate){

    return 0 === Math.floor(Math.random() / rate);

  }

  

  // 引入性能打点文件	

  if(hit(performance_rate)){ 

	window.PAGE_TIMING = {

	  pageId: new String(new Date().getTime()),

	  parentPageId: "",

      pageType: "",

      site: "AlipayCN",

      receiverUrl: "https://kcart.alipay.com/p.gif"

    };

		

    if(window._to && _to.start){

      window.PAGE_TIMING.startRender = _to.start.getTime();

	};

		

	seajs.use("aliexpress.page-timing/0.3.2/index");

  }





  if(!hit(jserr_rate)){return;}



  seajs.use(["$", "alipay/monitor/2.3.1/monitor",

    "alipay/sensinfo/1.2.0/sensinfo"], function($, monitor, sensinfo){



    if(!monitor){return;}



    $(function(){

      var sysName = "homeproxy-90-8";



      monitor.on("*", function(meta){

        meta.sys = sysName;

      });





      if(!hit(sens_rate) || !sensinfo){return;}

      try{

        var html = (document.documentElement || document.body).innerHTML;

        window.setTimeout(function(){

          sensinfo.scan(html, {

            "*": function(cardType, privacy_card, context) {

              monitor.log(cardType+"="+privacy_card+"```"+context, "sens");

            }

          });

        }, 1200);

      }catch(ex){}



    });

  });



}



if(window._monitor_autoload !== false){

  _use_monitor();

}

</script>





<!-- CMS:全站公共 cms/cmsbuffer/main.vm开始:cmsbuffer/main.vm -->			
<script>

function formcheck() {

	if($('#remember:checked').length == 1) {

		cookie.set('remember-username', $(':text[name="username"]').val());

	} else {

		cookie.del('remember-username');

	}

	return true;

}

var h = document.documentElement.clientHeight;

$(".login").css('min-height',h);

</script>

<!-- CMS:全站公共 cms/foot/console_security_msg.vm开始:alipay/foot/console_security_msg.vm -->

<script src="https://as.alipayobjects.com/component/console-security-message/0.0.2/index.js"></script>

<!-- CMS:全站公共 cms/foot/console_security_msg.vm结束:alipay/foot/console_security_msg.vm --><!-- CMS:全站公共 cms/cmsbuffer/main.vm结束:cmsbuffer/main.vm --><!-- CMS:全站公共 cms/tracker/tracker.vm结束:tracker/tracker.vm -->



</body>

</html>

<!-- CMS:cms_homeproxy/home/personal.vm结束:home/personal.vm -->



