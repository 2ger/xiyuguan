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
<link href="./resource/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<style>
*{font-size:10px;}
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
</style>
<OBJECT classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" height="0" id="WebBrowser3" width="0" VIEWASTEXT>
</OBJECT>
<center>
<a class="Noprint btn btn-success" onclick="print()">打印</a>
<img src="/attachment/images/1/2016/08/ELv48l461NA17lOi876LoA6Z8AAV4r.jpg" alt="" class="img-rounded" style="width:30%">
<h2>桌号：<?php  echo $tableinfo['zone'];?>-<?php  echo $tableinfo['id'];?></h2>
</center>
<div style="padding:10px 20%">
订单号：xxxxxxxxx  <br>
收银员：莫深辰<br>
消费时间：2015-5-5 12:00:22 
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>名称</th>
            <th>数量</th>
            <!-- <th>单价</th> -->
            <th>总价</th>
        </tr>
    </thead>
    <tbody>
    <?php  $i=1;?>
    <?php  if(is_array($order_goods)) { foreach($order_goods as $item) { ?>
    <tr>
        <th scope="row"><?php  echo $i?></th>
        <th><?php  echo $item['title'];?><?php  if($item['flavor']!="") { ?>(<?php  echo $item['flavor'];?>)<?php  } ?></th>
        <td> <?php  echo $item['total'];?></td>
        <!-- <td><?php  echo $item['price'];?></td> -->
        <td><?php  echo round($item['ttprice'],2);?></td>
    </tr>
    <?php  $i++?>
    <?php  } } ?>
    <tr>
        <td></td>
        <td></td>
        <td>总金额</td>
        <td><?php  echo $xiaofei['total1'];?> 元</td>
    </tr>  </tbody>

</table>
<center>
    微信扫描加入会员，积分免费换购商品！ <br>
<img src="http://qr.topscan.com/api.php?text=溪雨观公众号" alt="" style="width:30%;">
<br>
欢迎您再次光临！
</center>
<script>
window.print();//自动打印:
</script>

</body>
</html>
