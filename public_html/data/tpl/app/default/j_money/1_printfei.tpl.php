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
ul.list li{width:100%;margin:0;padding:0;font-weight:700}
body{font-size:14px}
*{padding:0;margin:0}
</style>

<center>
<a class="Noprint btn btn-success" onclick="print()">打印</a>
<!-- <img src="/attachment/images/1/2016/08/ELv48l461NA17lOi876LoA6Z8AAV4r.jpg" alt="" class="img-rounded" style="width:30%"> -->
<h3><?php  echo $storeinfo['name'];?>
    <br><?php  echo $storeinfo['title'];?>
</h3>
</center>
<ul class="list">
<li><b>桌号：<?php  echo $tableinfo['zone'];?>-<?php  echo $tableinfo['id'];?></b></li>
<li>时间： <?php  echo date("y/m/d H:i",time())?></li> 
</ul>
<table class="table table-hover">
    <thead>
        <tr>
            <th>品名</th>
            <th>价格</th>
            <th>数量</th>
            <th>金额</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php  echo $good['title'];?> <?php  echo $good['taste'];?></th>
            <th><?php  echo $good['price'];?> </th>
            <th><?php  echo $total;?></th>
            <th><?php  echo $totalprice;?></th>
        </tr>

<!--     <?php  $i=1;?>
    <?php  if(is_array($order_goods)) { foreach($order_goods as $item) { ?>
    <tr>
        <th scope="row"><?php  echo $i?></th>
        <th><?php  echo $item['title'];?><?php  if($item['flavor']!="") { ?>(<?php  echo $item['flavor'];?>)<?php  } ?>
       <?php  if($item['type']==1) { ?>- 送<?php  } ?> 
       <?php  if($item['type']==2) { ?>- 退<?php  } ?> 
        </th>
        <td><?php  echo $item['price'];?></td>
        <td> <?php  echo $item['total'];?></td>
        <td><?php  echo round($item['ttprice'],2);?></td>
    </tr>
    <?php  $i++?>
    <?php  } } ?> -->
 </tbody>

</table>
<!-- <h3>应收金额: <?php  echo $orderinfo['ys'];?>元</h3> -->
<!-- <table class="table"> -->
    <!-- <tr> -->
        <!-- <td>人民币</td> -->
        <!-- <td>付款: -->
<!-- </td> -->
    <!-- </tr> -->
    <!-- <tr> -->
        <!-- <td>找零：0.00</td> -->
        <!-- <td>实付: -->
<!-- </td> -->
    <!-- </tr> -->
    <!-- <tr> -->
        <!-- <td colspan="2"> 凭证号： </td> -->
    <!-- </tr> -->
    <!-- <tr> -->
        <!-- <td colspan="2">  -->

       
 <!-- </td> -->
    <!-- </tr> -->
<!-- </table> -->

<hr>
<center>
公司名称：上海蒂昶实业有限公司 
</center>
<script>
window.print();//自动打印:
 // window.close();
</script>

</body>
</html>
