<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>按桌号查看</title>
</head>
<body>
    <?php  include $this->template($this->cur_tpl.'/_menu2');?>
    <div class="page grid ">
     <a  href="<?php  echo $this->createMobileUrl('opera', array(), true)?>" class="weui-btn weui-btn_plain-primary">返回上菜列表</a>
 </div>

  <!-- <p class='page__hd'><a href="javascript:window.history.back();" class="weui-btn weui-btn_plain-primary" id="p1" >关闭</a></p> -->

<div class="weui-cells__title">订单号：<?php  echo $orderid;?></div>
<div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p><?php  echo $zone;?>-<?php  echo $title;?> 点菜单</p>
                </div>
                <div class="weui-cell__ft">
                  <?php  if($newOrder['id']>0) { ?>
            <a  class="weui-btn  weui-btn_warn"  href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=look_list&tables=<?php  echo $newOrder['tables'];?>&title=<?php  echo $newOrder['title'];?>&m=weisrc_dish">
            有新订单请确认
            </a> <?php  } else if($order['status'] ==1) { ?>
    <center><i class="weui-icon-success-no-circle"></i>已确认</center>
            <?php  } ?>
        </div>
            </div>
        </div>

<span style="color:#f00">
<?php  echo $tips;?>
</span>

<!-- <?php  if($tips =="") { ?> -->
    <?php  if($orders!="") { ?>
    <div class="weui-flex">
            <div class="weui-flex__item"><a class="weui-btn weui-btn_warn" onclick="cancelorder()">  取消订单</a> </div>
            <div class="weui-flex__item"> <a class="weui-btn  weui-btn_primary " onclick="confirmorder()"> 确认订单</a></div>
        </div>
    <?php  } ?>
<!-- <?php  } ?> -->
  <table class="table" width="100%">
            <tr>
                <th>#</th>
                <th>菜名</th>
                <th >数量</th>
                <!-- <th >单价</th> -->
                <th >总价</th>
                <th >操作</th>
             </tr>

             <?php  if($orders!="") { ?>
             <h2>新增点菜单</h2>
<?php  $i=1;?>
        <?php  if(is_array($lists)) { foreach($lists as $item) { ?>
             <tr class="danger" >
                <td><?php  echo $i?></td>
                <td><?php  echo $item['title'];?>  <?php  echo $item['taste'];?></td>
                <td><?php  echo $item['total'];?></td>
                <td><?php  echo $item['price'];?></td>
                <td><?php  echo $item['addprice'];?>元</td>
                <td></td>
             </tr>
            <?php  $i++?>
        <?php  } } ?>
            <tr class="danger">
                <td></td>
                <td></td>
                <td colspan="2">总金额</td>
                <td><?php  echo $addprice;?>元</td>
                <td></td>
             </tr>
<?php  } ?>

             <?php  $i=1;?>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <?php  if($item['type']==1) { ?>
             <tr style="text-decoration:line-through" class="success">
            <?php  } else if($item['type']==2) { ?>
             <tr style="text-decoration:line-through" class="danger">
            <?php  } else { ?>
             <tr class="<?php  if($item['stepnow']==5) { ?>success<?php  } else if($item['stepnow']==1) { ?>warming<?php  } ?>" >
            <?php  } ?>
                <td><?php  echo $i?></td>
                <td><?php  echo $item['title'];?>  <?php  echo $item['taste'];?>  

                    <?php  if($item['stepnow']==1) { ?>(正在配送)<?php  } ?>

                    <?php  if($item['type']==1) { ?>(<i class="weui-icon-info-circle"></i>送)<?php  } ?>
                    <?php  if($item['type']==2) { ?>(<i class="weui-icon-cancel"></i>退)<?php  } ?>
                </td>
                <td><?php  echo $item['total'];?></td>
                <!-- <td><?php  echo $item['price'];?></td> -->
                <td><?php  echo $item['oneprice'];?>元</td>
                <td>

                    <?php  if($item['stepnow']==5) { ?>
                    <i class="weui-icon-success-no-circle"></i>
                    <!-- 已上桌 -->
                    <?php  } ?>
    <?php  if($order['status'] ==1) { ?>
    <!-- 此订单已确认 -->
                    <?php  if($item['stepnow']==1 or (($item['pcate']==7 or $item['pcate']==8 or $item['pcate']==10  or $item['pcate']==11) and $item['stepnow'] ==0) ) { ?>

                   <a class="weui-btn weui-btn_mini weui-btn_primary" onclick="go_detail(<?php  echo $item['id'];?>,<?php  echo $item['storeid'];?>,<?php  echo $item['tablesid'];?>,4)">上桌</a>
                    <?php  } ?>
    <?php  } ?>
</td>
             </tr>
            <?php  $i++?>
        <?php  } } ?>

<tr>
                <td></td>
                <!-- <td></td> -->
                <!-- <td></td> -->
                <td colspan="2">总金额</td>
                <td><?php  echo $totalprice;?>元</td>
                <td></td> 
             </tr>

        </table>
      
<script>
function go_detail(id,storeid,tablesid,stepnow) {
    if(confirm('确认已上桌?')){
    window.location.href = "<?php  echo $this->createMobileUrl('operadetail', array(), true)?>" + "&ids=" + id+"&storeid=" + storeid+"&tablesid=" + tablesid+"&stepnow=" + stepnow;
    }
}
function cancelorder() {
    if(confirm('取消订单?')){
    window.location.href = "<?php  echo $this->createMobileUrl('Cancelorder2', array('orderid' => $orders['id'],'tables'=>$tables))?>";
    }
}
function confirmorder() {
    if(confirm('确认订单?')){
    window.location.href = "<?php  echo $this->createMobileUrl('confirmorder', array('orderid' => $orders['id'],'tables'=>$tables))?>";
    }
}
</script>
</body>
</html>
