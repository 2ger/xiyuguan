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
        <button type="button" class="mui-right  mui-btn  mui-btn-link mui-btn-nav mui-pull-right">
            <a href="<?php  echo $this->createMobileUrl('logout', array(), true)?>"> 退出</a>
        </button>
        <h1 class="mui-center mui-title">个人中心</h1>
    </div>
    <!--页面标题栏结束-->
    <!--页面主内容区开始-->
    <div class="mui-page-content">
        <div class="mui-scroll-wrapper">
            <div class="mui-scroll">
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell mui-media">
                    <a class="" href="#account">
                        <img class="mui-media-object mui-pull-left head-img" id="head-img" src="http://shanghai.xyj0772.com/attachment/images/1/2016/10/tEfohN55cCofH5KnoDZseCMFOrGa83.png">
                        <div class="mui-media-body">      
                            <?php  echo $store['title'];?>
                            <p class='mui-ellipsis'>员工号:<?php  echo $user['useracount'];?></p>
                        </div>
                    </a>
                    </li>
                </ul>

<?php  if($user['pcate'] ==18) { ?>
<!-- 财务可见 -->
 <div class="  mui-content-padded">
                    <p>门店报表</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                    <?php  if(is_array($storelist)) { foreach($storelist as $item) { ?>
                        <li class="mui-table-view-cell" >
                        <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=report&logid=<?php  echo $logid;?>&store=<?php  echo $item['title'];?>&m=str_takeout&id=<?php  echo $item['id'];?>"> <?php  echo $item['title'];?></a>
                        </li>
                    <?php  } } ?>
                </ul>

<?php  } else { ?>
<!-- 店员可见 -->
                <div class="  mui-content-padded">
                    <p>个人信息</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                    <!-- <a class=" mui-btn mui-btn-positive mui-btn-block"> 扫一扫</a> -->
                    <li class="mui-table-view-cell">
                    <a href="#account" class="">姓名：<?php  echo $user['realname'];?></a>
                    </li>
                    <li class="mui-table-view-cell">
                    <a href="#notifications" class="">电话：<?php  echo $user['mobile'];?></a>
                    </li>
                    <li class="mui-table-view-cell">
                    <a href="#privacy" class="">级别：<?php  echo $user['companyname'];?></a>
                    </li>
                </ul>
                <div class="  mui-content-padded">
                    <p>贡献值排行</p>
                </div>
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell">
                    <a href="index.php?i=1&c=entry&groupid=<?php  echo $user['pcate'];?>&type=0&username=<?php  echo $user['realname'];?>&storeid=<?php  echo $user['storeid'];?>&do=ranklist&m=str_takeout" class="">本月排行榜</a>
                    </li>
                    <li class="mui-table-view-cell">
                    <a href="index.php?i=1&c=entry&groupid=<?php  echo $user['pcate'];?>&type=1&username=<?php  echo $user['realname'];?>&storeid=<?php  echo $user['storeid'];?>&do=ranklist&m=str_takeout" class="">上月排行榜</a>
                    </li>
                </ul>
                <div class="all mui-content-padded hidden">
                    <p>店面情况</p>
                </div>
                <ul class="all mui-table-view mui-table-view-chevron hidden ">
                    <li class="mui-table-view-cell">
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=orderall&m=weisrc_dish"> 查看所有上菜情况</a>
                    </li>
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=look_tables&m=weisrc_dish"> 按桌号查看菜单</a>
                    </li>
                </ul>
                <div class=" all mui-content-padded hidden ">
                    <p>管理</p>
                </div>
                <ul class="all mui-table-view mui-table-view-chevron hidden">

                    <li class="mui-table-view-cell">
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=caipin&m=weisrc_dish"> 菜品管理</a>
                    </li>
                    <li class="mui-table-view-cell">
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=jixiao&m=weisrc_dish"> 员工绩效</a>
                    <!-- 对员工工作情况进行归纳 -->
                    </li>
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=staff&m=weisrc_dish"> 员工管理</a>
                    <!-- [> 可添加，编辑员工 <] -->
                    </li>
                      <!-- 店长自填表 17.2.7-->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=selfill&m=weisrc_dish"> 成本自填表</a>
                    </li>
                    <!-- 店长收入自填表 17.2.27-->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=inselfill&m=weisrc_dish"> 收入自填表</a>
                    </li>
                    <!-- 店长查询利润 17.2.8-->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=profits&m=weisrc_dish"> 利润查询</a>
                    </li>

                </ul>
                <div class=" all mui-content-padded hidden ">
                    <p>进销存</p>
                </div>
                <ul class="all mui-table-view mui-table-view-chevron hidden">
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=list&logid=<?php  echo $logid;?>&storeid=<?php  echo $storeid;?>&m=str_takeout&store=<?php  echo $store['title'];?>"> 门店进货</a>
                    <!-- [> 可添加，原材料进货 <] -->
                    </li>
                        <!-- 门店自购 -->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=zigou&logid=<?php  echo $logid;?>&status=3&storeid=<?php  echo $storeid;?>&m=str_takeout"> 门店自购</a>
                    </li>
                        <!-- 员工餐 -->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=zigou&logid=<?php  echo $logid;?>&status=4&storeid=<?php  echo $storeid;?>&m=str_takeout"> 员工餐消耗表</a>
                    </li>
                        <!-- 门店报损表 -->
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=zigou&logid=<?php  echo $logid;?>&status=5&storeid=<?php  echo $storeid;?>&m=str_takeout"> 门店报损表</a>
                    </li>
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=stock&logid=<?php  echo $logid;?>&storeid=<?php  echo $storeid;?>&m=str_takeout"> 库存查询</a>
                    <!-- [> 可添加，原材料进货 <] -->
                    </li>
                  
                </ul>

                <div class="  mui-content-padded ">
                    <p>操作</p>
                </div>
                <!-- 员工 17.3.10-->
                <ul class=" mui-table-view mui-table-view-chevron ">
                    <li class="mui-table-view-cell hidden zhu" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=list&logid=<?php  echo $logid;?>&storeid=<?php  echo $storeid;?>&m=str_takeout"> 门店进货</a>
                    </li>
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=material&pcate=<?php  echo $user['pcate'];?>&m=weisrc_dish"> 原材料库存</a>
                    </li>
                    <li class="mui-table-view-cell" >
                    <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=sales&pcate=<?php  echo $user['pcate'];?>&m=weisrc_dish"> 菜品销量</a>
                    </li>
                </ul>
                <?php  if($opera !="") { ?>
                <div class="zhu  mui-content-padded">
                    <p>开始工作</p>
                </div>
                <a class=" mui-btn mui-btn-positive mui-btn-block" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=<?php  echo $opera;?>&m=weisrc_dish"> 开始工作</a>
                <?php  } ?>

            </div>
        </div>
    </div>

<?php  } ?>
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
.mui-scroll-wrapper,.mui-scroll{
    overflow-y: scroll;
}
</style>

</body>
</html>
