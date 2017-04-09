<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title> 开始工作</title>
<script type="text/javascript" charset="utf-8" src="../addons/weisrc_dish/template//mobile/style1/assets/diandanbao/mui.min.js"></script>
<link data-turbolinks-track="true" href="../addons/weisrc_dish/template//mobile/style1/assets/diandanbao/mui.min.css" media="all" rel="stylesheet">


</head>
<body>

   <div id="setting" class="mui-page">
			<!--页面标题栏开始-->
			<div class="mui-navbar-inner mui-bar mui-bar-nav">
				<div class="mui-left mui-btn  mui-back mui-btn-nav mui-pull-left"  onclick="window.history.back()">
     返回
				</div>

				<div class="mui-right mui-btn  mui-btn-link mui-btn-nav mui-pull-right">
       <a href="<?php  echo $this->createMobileUrl('logout', array(), true)?>"> 退出</a>
				</div>
				<h1 class="mui-center mui-title"><?php  echo $store;?> 报表</h1>
			</div>
			<!--页面标题栏结束-->
			<!--页面主内容区开始-->
			<div class="mui-page-content">
				<div class="mui-scroll-wrapper">
					<div class="">
						<!-- mui-scroll -->
						<br><br>
 			<div class="mui-content-padded">
                    <p>供货商统计月报表</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                  <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=gongying&logid=<?php  echo $logid;?>&store=<?php  echo $store;?>&m=str_takeout&locationid=<?php  echo $location['id'];?>&year=<?php  echo $year;?>&month=<?php  echo $item['index'];?>&storeid=<?php  echo $id;?>"> <?php  echo $year;?>年<?php  echo $item['index'];?>月 <?php  echo $store;?> 供货商统计报表</a>
                    </li>
                <?php  } } ?>
                </ul>
               <div class="mui-content-padded">
                    <p>收支统计表报</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                  <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=shouzhi&logid=<?php  echo $logid;?>&store=<?php  echo $store;?>&m=str_takeout&locationid=<?php  echo $location['id'];?>&year=<?php  echo $year;?>&month=<?php  echo $item['index'];?>&sid=<?php  echo $id;?>"> <?php  echo $year;?>年<?php  echo $item['index'];?>月 <?php  echo $store;?> 收支统计表报</a>
                    </li>
                <?php  } } ?>
                </ul>
               <div class="mui-content-padded">
                    <p>利润表</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                  <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=lirun&logid=<?php  echo $logid;?>&store=<?php  echo $store;?>&m=str_takeout&locationid=<?php  echo $location['id'];?>&year=<?php  echo $year;?>&sid=<?php  echo $id;?>"> 2017 年 <?php  echo $store;?> 利润明细表</a>
                    </li>
                </ul>

					</div>
				</div>
			</div>
			<!--页面主内容区结束-->
		</div>

    <style>
			html,
			body {
				background-color: #efeff4;
			}
			.mui-views,
			.mui-view,
			.mui-pages,
			.mui-page,
			.mui-page-content {
				position: absolute;
				left: 0;
				right: 0;
				top: 0;
				bottom: 0;
				width: 100%;
				height: 100%;
				background-color: #efeff4;
			}
			.mui-pages {
				top: 46px;
				/*height: auto;*/
			}
			.mui-scroll-wrapper,
			.mui-scroll {
				background-color: #efeff4;
			}
			.mui-page.mui-transitioning {
				-webkit-transition: -webkit-transform 300ms ease;
				transition: transform 300ms ease;
			}
			.mui-page-left {
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
			.mui-ios .mui-page-left {
				-webkit-transform: translate3d(-20%, 0, 0);
				transform: translate3d(-20%, 0, 0);
			}
			.mui-navbar {
				position: fixed;
				right: 0;
				left: 0;
				z-index: 10;
				height: 44px;
				background-color: #f7f7f8;
			}
			.mui-navbar .mui-bar {
				position: absolute;
				background: transparent;
				text-align: center;
			}
			.mui-android .mui-navbar-inner.mui-navbar-left {
				opacity: 0;
			}
			.mui-ios .mui-navbar-left .mui-left,
			.mui-ios .mui-navbar-left .mui-center,
			.mui-ios .mui-navbar-left .mui-right {
				opacity: 0;
			}
			.mui-navbar .mui-btn-nav {
				-webkit-transition: none;
				transition: none;
				-webkit-transition-duration: .0s;
				transition-duration: .0s;
			}
			.mui-navbar .mui-bar .mui-title {
				display: inline-block;
				width: auto;
			}
			.mui-page-shadow {
				position: absolute;
				right: 100%;
				top: 0;
				width: 16px;
				height: 100%;
				z-index: -1;
				content: '';
			}
			.mui-page-shadow {
				background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
				background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
			}
			.mui-navbar-inner.mui-transitioning,
			.mui-navbar-inner .mui-transitioning {
				-webkit-transition: opacity 300ms ease, -webkit-transform 300ms ease;
				transition: opacity 300ms ease, transform 300ms ease;
			}
			.mui-pages .mui-page {
				display: block;
			}
			.mui-page .mui-table-view:first-child {
				margin-top: 60px;
			}
			.mui-page .mui-table-view:last-child {
				margin-bottom: 30px;
			}
			.mui-table-view {
				/*margin-top: 20px;*/
			}
			
			.mui-table-view span.mui-pull-right {
				color: #999;
			}
			.mui-table-view-divider {
				background-color: #efeff4;
				font-size: 14px;
			}
			.mui-table-view-divider:before,
			.mui-table-view-divider:after {
				height: 0;
			}
			.head {
				height: 40px;
			}
			#head {
				line-height: 40px;
			}
			.head-img {
				width: 40px;
				height: 40px;
			}
			#head-img1 {
				position: absolute;
				bottom: 10px;
				right: 40px;
				width: 40px;
				height: 40px;
			}
			.update {
				font-style: normal;
				color: #999999;
				margin-right: -25px;
				font-size: 15px
			}
			.mui-fullscreen {
				position: fixed;
				z-index: 20;
				background-color: #000;
			}
			.mui-ios .mui-navbar .mui-bar .mui-title {
				position: static;
			}
			/*问题反馈在setting页面单独的css*/
			#feedback .mui-popover{
				position: fixed;
			}
			#feedback .mui-table-view:last-child {
			    margin-bottom: 0px;
			}
			#feedback .mui-table-view:first-child {
			    margin-top: 0px;
			}
            .hidden{display:none}
        <?php  echo $operalist;?>{display:block!important} 

        .mui-scroll-wrapper, .mui-scroll {
    overflow-y: scroll;
}
		</style>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
