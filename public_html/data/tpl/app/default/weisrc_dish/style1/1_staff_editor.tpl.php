<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title> 员工管理</title>
<link data-turbolinks-track="true" href="http://dcloudio.github.io/mui/dist/css/mui.min.css" media="all" rel="stylesheet">
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
            <a href="<?php  echo $this->createMobileUrl('staff', array(), true)?>"> 返回</a>
        </button>
        <h1 class="mui-center mui-title">员工管理</h1>
        <button type="button" class="mui-right mui-action-back mui-btn  mui-btn-negative mui-btn-nav mui-pull-right">
            <a href="<?php  echo $this->createMobileUrl('logout', array(), true)?>"> 退出</a>
        </button>
    </div>
    <!--页面标题栏结束-->
    <!--页面主内容区开始-->
    <div class="mui-page-content">
        <div class="">
            <div class="mui-scroll">
                <ul class="mui-table-view mui-table-view-chevron">
                    <li class="mui-table-view-cell mui-media">
                    <a class="" href="#account">
                        <img class="mui-media-object mui-pull-left head-img" id="head-img" src="http://shanghai.xyj0772.com/attachment/images/1/2016/10/tEfohN55cCofH5KnoDZseCMFOrGa83.png">
                        <div class="mui-media-body">
                            溪雨观 惠南店	
                            <p class='mui-ellipsis'><!-- 员工号:<?php  echo $user['useracount'];?> --></p>
                        </div>
                    </a>
                    </li>
                </ul>
                <style>
.bgred{
    background-color: #d64c28;
    color: #fff;
}
                </style>
     
    <form class="mui-input-group" method="POST">
        <div class="mui-input-row mui-radio mui-left">
            <label>离职</label>
            <input name="status" type="radio" value="0" <?php  if($item['status']==0) { ?>checked<?php  } ?>>
        </div>
        <div class="mui-input-row mui-radio mui-left">
            <label>在职</label>
            <input name="status" type="radio" value="1" <?php  if($item['status']==1) { ?>checked<?php  } ?>>
        </div>

        <div class="mui-input-row">
            <label>工号</label>
            <input type="text" name="useracount" value="<?php  echo $item['useracount'];?>" readonly>
        </div>
         <div class="mui-input-row">
            <label>密码</label>
            <input type="text" name="password" value="" placeholder="不填则不修改">
        </div>


  <!--       <div class="mui-input-row">
            <label>所属店面</label>
            <input type="text" placeholder="所属店面" name="storeid" value="<?php  echo $item['storeid'];?>">
        </div> -->
        <div class="mui-input-row">
            <label>姓名</label>
            <input type="text" placeholder="姓名" name="name" value="<?php  echo $item['realname'];?>">
        </div>
        <div class="mui-input-row">
            <label>电话</label>
            <input type="number" placeholder="电话" name="mobile" value="<?php  echo $item['mobile'];?>">
        </div>
        <div class="mui-input-row">
            <label>所属组别</label>
            <select class="" name="pcate">
            <?php  if(is_array($pcate)) { foreach($pcate as $items) { ?>
                <option  value="<?php  echo $item['id'];?>" <?php  if($item['pcate']==$items['id']) { ?>selected<?php  } ?>><?php  echo $items['companyname'];?></option>
            <?php  } } ?>
            </select>
        </div>
        <hr>
            <label>打折权限</label>
              <?php  if(is_array($discount1)) { foreach($discount1 as $items) { ?>
             <label class="radio-inline">
              <input type="checkbox" name="discount[]" checked value="<?php  echo $items['id'];?>">
              <?php  echo $items['title'];?> - <?php  echo $items['discount'];?>折
          </label>
          <?php  } } ?>
          <br>
          <?php  if(is_array($discount0)) { foreach($discount0 as $items) { ?>
             <label class="radio-inline">
              <input type="checkbox" name="discount[]" value="<?php  echo $items['id'];?>">
              <?php  echo $items['title'];?> - <?php  echo $items['discount'];?>折
          </label>
          <?php  } } ?>


            <input type="hidden" name="edit" value="1" >
            <hr>
        <button class="mui-btn mui-btn-primary mui-btn-block" >
            <input type="submit" name="submit" value="提交">
        </button>
        <!-- <a class="mui-btn mui-btn-block" href="<?php  echo $this->createMobileUrl('staff_delete', array(), true)?>&id=<?php  echo $item['id'];?>" onclick="return confirm('确定删除该员工？');return false;">删除</a> -->
    </form>    
            </div>
        </div>
    </div>
    <!--页面主内容区结束-->
</div>

</body>
</html>
