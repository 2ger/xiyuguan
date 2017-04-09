<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title> 利润查询</title>
<link data-turbolinks-track="true" href="../addons/weisrc_dish/template//mobile/style1/assets/diandanbao/mui.min.css" media="all" rel="stylesheet">
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
    height: auto;
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
    margin-top: 20px;
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
</style>

</head>
<body>
<div id="setting" class="mui-page">
    <!--页面标题栏开始-->
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-btn-positive mui-btn  mui-btn-nav mui-pull-left">
            <a href="<?php  echo $this->createMobileUrl('operalist', array(), true)?>"> 返回</a>
        </button>
        <h1 class="mui-center mui-title">利润表</h1>
        <button type="button" class="mui-right mui-action-back mui-btn  mui-btn-negative mui-btn-nav mui-pull-right">
            <a href="<?php  echo $this->createMobileUrl('logout', array(), true)?>"> 退出</a>
        </button>
    </div>
    <!--页面标题栏结束-->
    <!--页面主内容区开始-->
    <div class="mui-page-content">
        <div class="">
            <div class="mui-scroll">
                <div class="mui-table-view mui-table-view-chevron"></div>
                <style>
                    .bgred{
                        background-color: #d64c28;
                        color: #fff;
                    }
                    
                </style>
                <ul class="mui-table-view">
                <li class="mui-table-view-cell" style="background-color: yellow"><?php  echo $year;?>年<?php  echo $month;?>月 总利润：<?php  echo $sumprice;?></li>
                    <?php  if(is_array($days)) { foreach($days as $item) { ?>
                    <li class="mui-table-view-cell">
                    <?php  echo $item['num'];?> 
                    <a class="mui-btn"><?php  echo $item['profit'];?></a>
                    </li>
                    <li  class="mui-table-view-cell" style="background-color: #eee">实收：<?php  echo $item['cash'];?> 材料成本：<?php echo $item['cost']['cost']?$item['cost']['cost']:0?>
                    店铺成本：<?php echo $item['selfill']['selfill']?$item['selfill']['selfill']:0?>
                    </li>
                    <?php  } } ?>
                <li class="mui-table-view-cell" style="background-color: yellow"><?php  echo $years;?>年<?php  echo $months;?>月 总利润：<?php  echo $profit;?></li>
                <li class="mui-table-view-cell" style="background-color: yellow"><?php  echo $lyear;?>年<?php  echo $lmonth;?>月 总利润：<?php  echo $lprofit;?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--页面主内容区结束-->
</div>

</body>
</html>
