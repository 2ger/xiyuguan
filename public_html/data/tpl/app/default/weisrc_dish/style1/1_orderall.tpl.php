<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta content="telephone=no" name="format-detection">
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
<meta content="production" name="env">
<title>所有订单管理</title>
<link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css?v=1" media="all" rel="stylesheet">
<style type="text/css">@media screen{.smnoscreen {display:none}} @media print{.smnoprint{display:none}}</style></head>
<body>

<div ng-view="" style="height: 100%;" class="ng-scope">
    <div class="ddb-nav-header ng-scope" common-header="">
         <div class="nav-left-item"  onclick="javascript :history.back(-1);"><i class="fa fa-angle-left"></i></div> 
        <!-- <a class="nav-left-item" href="<?php  echo $this->createMobileUrl('orderall', array(), true)?>"><div class="operation-button red">查看所有</div></a> -->
        <div class="header-title ng-binding">今日上菜情况</div>
       <a class="nav-right-item" href="<?php  echo $this->createMobileUrl('logout', array(), true)?>">
            <div class="operation-button red">退出</div>
        </a>
     <!--    <a class="nav-right-item" href="<?php  echo $this->createMobileUrl('adminorder', array(), true)?>">
            <div class="operation-button red"><i class="fa fa-qrcode"></i>扫一扫</div>
        </a> -->
       
    </div>

    <!-- 底部菜单 -->
    <?php  include $this->template($this->cur_tpl.'/_menu2');?>
<style type="text/css">
    td{text-align: center; float: left; height: 30px;}
</style>
     
    <div class="orders-index-page main-view ng-scope" id="delivery-orders-index">
    <!-- <div style="height:40px; text-align:center; background-color: #fff; line-height: 40px;"> -->
      <!-- <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=look_tables&m=weisrc_dish">按桌号查看</a> -->
    <!-- </div> -->
        <?php  if(is_array($list)) { foreach($list as $items) { ?>
        <div class="space-12"></div>
        <div class="order-item section <?php  echo $items['status'];?> ng-scope">
            <a class="list-item">
                <div class="time ng-binding">
                   <h3>
                    <?php  echo $items['sortname'];?> - <?php  echo $items['tablesname'];?> 桌位
                   </h3>
                </div>
            </a>
            <a class="list-item">
                <div class="branch-image" style="width:70px;float:left;margin-right:10px;height:50px;overflow:hidden">
                    <img src="../attachment/<?php  echo $items['thumb'];?>" width="100%">
                </div>
                <div class="name ng-binding"><?php  echo $items['title'];?> * <?php  echo $items['total'];?> <?php  echo $items['unitname'];?></div>
                <div class="variants overflow-ellipsis ng-binding">
                    下单时间：<?php  echo date('Y-m-d H:i:s',$items['dateline'])?>                   </div>
            </a>
            <div class="list-item">
                <div class="total-amount ng-binding"><span class="amount-label">金额：</span>￥<?php  echo $items['totalprice'];?>  <?php  echo $items['tips'];?>
</div>
                <div class="operation">
                    <span class="button  ng-binding ng-scope" style="color:#28a267;"><?php  if($items['stepnow']==0) { ?>正在制作<?php  } else if($items['stepnow']==1) { ?>正在配送<?php  } else if($items['stepnow']==5) { ?>已上桌<?php  } ?></span>
                </div>
                <div class="space"></div>
            </div>
        </div>
        <?php  } } ?>
    </div>
</div>
<script>
//function jump(status) {
//    window.location.href = "<?php  echo $this->createMobileUrl('order', array(), true)?>" + "&status=" + status;
//}
//function go_detail(id,storeid,tablesid,stepnow) {
//    window.location.href = "<?php  echo $this->createMobileUrl('operadetail', array(), true)?>" + "&orderid=" + id+"&storeid=" + storeid+"&tablesid=" + tablesid+"&stepnow=" + stepnow;
//}
</script>
</body>
</html>
