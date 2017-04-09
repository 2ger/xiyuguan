<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html lang="zh-cn">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>溪雨观消费单</title>

<meta name="format-detection" content="telephone=no, address=no">

<meta name="apple-mobile-web-app-capable" content="yes" />

<meta name="apple-touch-fullscreen" content="yes"/>

<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<link href="./resource/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<style>

          *,input,td,tr,table,h3{padding:0!important;margin:0!important}

ul.list li{width:50%;float:left;margin:0;padding:0;font-weight:700}

</style>

<style media="print">

.Noprint

{

    display: none;

}

.PageNext

{

    page-break-after: always;

}

ul.list li{width:50%;float:left;margin:0;padding:0;font-weight:700}

body{font-size:11px;

font-family:"MicrosoftJhengHei",黑体;

font-weight:700!important;

}

*{padding:0;margin:0} 

.tui{text-decoration: line-through;}

ul.list li{width:50%;float:left;margin:0;padding:0;font-weight:700}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {

    border: 1px solid #000!important;

}

</style>



<center>

<a class="Noprint btn btn-success" onclick="print()">打印</a>

<!-- <img src="/attachment/images/1/2016/08/ELv48l461NA17lOi876LoA6Z8AAV4r.jpg" alt="" class="img-rounded" style="width:30%"> -->

<h4><?php  echo $storeinfo['name'];?> <?php  echo $storeinfo['title'];?> 

   

   <br>

   <?php  echo $tableinfo['zone'];?>-<?php  echo $tableinfo['id'];?>  -

<?php  if($comment !="") { ?>

  <?php  if($type) { ?>

  预打单

  <?php  } else { ?>

  点菜单

  <?php  } ?>

<?php  } else { ?>

结账单

<?php  } ?>

</h4>

</center>

<ul class="list">

<!-- <li><h4>桌号：</h4></li> -->

<li style="width:80%">时间消费： <?php  echo date("Y-m-d H:i",$orderinfo['dateline'])?></li> 

<li style="width:20%;font-size:16px">#<?php  echo $num['num'];?></li> 



<li>订单号：<?php  echo $orderinfo['id'];?>  </li>

<li>收银员： <?php  echo $user['realname'];?></li> 

</ul>

<table class="table table-hover">

    <thead>

        <tr>

            <th>#</th>

            <th>品名</th>

            <th>价格</th>

            <th>数量</th>

            <th>金额</th>

        </tr>

    </thead>

    <tbody>

    <?php  $i=1;?>

    <?php  if(is_array($order_goods)) { foreach($order_goods as $item) { ?>

    <?php  if($item['type']>0) { ?>

    <tr class="tui">

      <?php  } ?> 

        <th scope="row"><?php  echo $i?></th>

        <th><?php  echo $item['title'];?><?php  if($item['flavor']!="") { ?>(<?php  echo $item['flavor'];?>)<?php  } ?>

       <?php  if($item['type']==1) { ?>- 送<?php  } ?> 

       <?php  if($item['type']==2) { ?>- 退<?php  } ?> 

        </th>

        <td><?php  echo round( $item['price'])?></td>

        <td> <?php  echo $item['total'];?></td>

        <td><?php  echo round($item['ttprice'],2);?></td>

    </tr>

    <?php  $i++?>

    <?php  } } ?>

 </tbody>



</table>



<?php  if($comment !="") { ?>

  <?php  if($type) { ?>

  <!-- 预打单 -->

  <h5>消费金额: <?php  echo round($orderinfos['totalprice']) ?>元</h5>

  <?php  } ?>

<?php  } else { ?>

<!-- 结账单 -->

<h5>消费金额: <?php  echo round($orderinfos['totalprice']) ?>元</h5>

<?php  } ?>





<!-- 折扣金额: <?php  echo $orderinfo['zhekou'];?>元 -->

<ul class="list">





<?php  if($comment !="") { ?>

  <?php  if($type) { ?>

<?php  echo $comment;?>

  <?php  } ?>

</ul>

<?php  } else { ?>

<li>不可打折金额：<?php  echo $orderinfo['bkdz'];?></li>

<!-- <li>可打折金额：<?php  echo $orderinfo['kdz'];?></li> -->

<li>总打折金额：<?php  echo $orderinfo['zhekou'];?></li>

<li>代金劵：<?php  echo $orderinfo['daijinquan'];?></li>

<li>免单金额：<?php  echo $orderinfo['mian'];?></li>

<li>打折金额：<?php  echo $orderinfo['dz'];?></li>

<li>满减金额：<?php  echo $orderinfo['mj'];?></li>

<!-- <li></li> -->

</ul>

<h5>应收金额： <?php  echo round($orderinfo['ys']) ?></h5> 



<!--  收银方式：    <style>input[type=radio], input[type=checkbox]{margin:10px}</style> 

          现金<input type="checkbox">| 

          银行卡<input type="checkbox">| 

          网购券<input type="checkbox">| 

          微信<input type="checkbox">| 

          支付宝<input type="checkbox">| 

          抵用券<input type="checkbox">  -->

<br>



收银方式：

<?php  if($trade['paytype']==0) { ?>微信:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==2) { ?>+支付宝:<?php  echo $addmoney;?><?php  } else if($addtp==3) { ?>+现金:<?php  echo $addmoney;?><?php  } else if($addtp==4) { ?>+美团:<?php  echo $addmoney;?><?php  } else if($addtp==5) { ?>+刷卡:<?php  echo $addmoney;?><?php  } ?>

  <?php  } else if($trade['paytype']==1) { ?>支付宝:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==1) { ?>+微信:<?php  echo $addmoney;?><?php  } else if($addtp==3) { ?>+现金:<?php  echo $addmoney;?><?php  } else if($addtp==4) { ?>+美团:<?php  echo $addmoney;?><?php  } else if($addtp==5) { ?>+刷卡:<?php  echo $addmoney;?><?php  } ?>

  <?php  } else if($trade['paytype']==5) { ?> 美团闪惠:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==2) { ?>+支付宝:<?php  echo $addmoney;?><?php  } else if($addtp==3) { ?>+现金:<?php  echo $addmoney;?><?php  } else if($addtp==4) { ?>+美团:<?php  echo $addmoney;?><?php  } else if($addtp==5) { ?>+刷卡:<?php  echo $addmoney;?><?php  } else if($addtp==1) { ?>+微信:<?php  echo $addmoney;?><?php  } ?>

  <?php  } else if($trade['paytype']==2) { ?> 美团:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==2) { ?>+支付宝:<?php  echo $addmoney;?><?php  } else if($addtp==3) { ?>+现金:<?php  echo $addmoney;?><?php  } else if($addtp==5) { ?>+刷卡:<?php  echo $addmoney;?><?php  } else if($addtp==1) { ?>+微信:<?php  echo $addmoney;?><?php  } ?>

  <?php  } else if($trade['paytype']==3) { ?> 现金:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==2) { ?>+支付宝:<?php  echo $addmoney;?><?php  } else if($addtp==4) { ?>+美团:<?php  echo $addmoney;?><?php  } else if($addtp==5) { ?>+刷卡:<?php  echo $addmoney;?><?php  } else if($addtp==1) { ?>+微信:<?php  echo $addmoney;?><?php  } ?>

  <?php  } else if($trade['paytype']==4) { ?> 刷卡:<?php  echo round($trade['cash_fee']/100)?><?php  if($addtp==2) { ?>+支付宝:<?php  echo $addmoney;?><?php  } else if($addtp==3) { ?>+现金:<?php  echo $addmoney;?><?php  } else if($addtp==4) { ?>+美团:<?php  echo $addmoney;?><?php  } else if($addtp==1) { ?>+微信:<?php  echo $addmoney;?><?php  } ?><?php  } ?>

  <br>

  凭证单号：<?php  echo $trade['old_trade_no'];?>

<hr>

服务员签名：

<hr>

<?php  } ?>


<?php  if($comment =="") { ?>

<br style="clear:both">

上海蒂昶实业有限公司  <br>

官网：www.dichangshiye.com  <br>

地址:上海市浦东新区航三公路<br>

战略合作热线：400-921-0779   

<center>

    <!-- 微信扫描加入会员，积分免费换购商品！ <br> -->

<img src="<?php echo MODULE_URL;?>template/img/qrcode.png" alt="" style="width:150px;height:150px">

<br>关注我们

</center>
  <?php  } ?>
<script>

window.print();//自动打印:

 // window.close();

</script>



</body>

</html>

