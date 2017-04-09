<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>洒水/飞饼对账单</title>
<!-- 按分类统计\时间\ -->
<meta name="format-detection" content="telephone=no, address=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<link href="./resource/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
          body{font-size:12px}
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
body{font-size:12px}
*{padding:0;margin:0}
</style>

<center>
<a class="Noprint btn btn-success" onclick="print()">打印</a>
<br>
<!-- <img src="/attachment/images/1/2016/08/ELv48l461NA17lOi876LoA6Z8AAV4r.jpg" alt="" class="img-rounded" style="width:30%"> -->
<h2><?php  echo $catname['name'];?> - 对账单
</h2>
</center>
<div style="">
交班人： <?php  echo $username;?>  <br>
开始时间： <?php  echo date("Y-m-d H:i",$starts)?><br>
结束时间： <?php  echo date("Y-m-d H:i",$end)?> <br>
<!-- 应收总额： <?php  echo $list[0]['realname'];?>  <br> -->
<!-- 本次应缴： <?php  echo $list[0]['realname'];?>  <br> -->

</div>

<table class="table table-hover ">
    <thead>
        <tr>
            <th>名称</th>
            <th>单价</th>
            <th>数量</th>
            <th>金额</th>
        </tr>
    </thead>
    <tbody>
    <?php  if(is_array($list)) { foreach($list as $item) { ?>
    <?php  if($item['total'] >0 ) { ?>
    <tr>
        <th title=<?php  echo $item['id'];?>>  <?php  echo $item['title'];?>       </th>
        <td> <?php  echo $item['marketprice'];?></td>
        <td><?php  echo $item['total'];?></td>
        <td> <?php  echo $item['totalprice'];?></td>
    </tr>
    <?php  } ?>
    <?php  } } ?>

    <tr class="danger">
        <th>合计</th>
        <td></td>
        <td><?php  echo $totalnum;?></td>
        <td><?php  echo $totalprice;?>
          <!-- <?php  echo round($item['ttprice'],2);?> -->
        </td>
    </tr>
 </tbody>
</table>
<br>
<hr>
<!-- 消费金额: <?php  echo $xiaofei['total'];?>元 -->
<!-- <br> -->
<!-- 折扣金额: <?php  echo $orderinfo['zhekou'];?>元 -->
<script>
window.print();//自动打印:
</script>

</body>
</html>
