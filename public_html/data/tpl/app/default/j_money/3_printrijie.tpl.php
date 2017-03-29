<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>交班/日结 对账单</title>
<meta name="format-detection" content="telephone=no, address=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-touch-fullscreen" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<link href="./resource/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="./resource/css/font-awesome.min.css" rel="stylesheet"> -->
</head>
<body>
<script>
window.print();//自动打印:
</script>
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
<h2>交班对账单
</h2>
</center>
<div style="">
交班人： <?php  echo $username;?>  <br>
开始时间： <?php  echo date("Y-m-d H:i",$starts)?><br>
结束时间： <?php  echo date("Y-m-d H:i",$end)?> <br>
应收总额： <?php  echo sprintf('%.2f',($data['all']['total_fee']/100))?> <br>
实收总额： <?php  echo sprintf('%.2f',($data['all']['total']/100))?> <br>
<hr>
应缴现金： <?php  echo sprintf('%.2f',($data['cash']['total']/100))?>  <br>
</div>
<table class="table table-hover">
            <thead>
              <tr>
                <th>收款类型</th>
                <th>次数</th>
                <th>总金额</th>
                <th>实收金额</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                    <td>微信</td>
                    <td><?php  echo $data['weixin']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['weixin']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['weixin']['total']/100))?></td>
                </tr>
                <tr>
                    <td>支付宝</td>
                    <td><?php  echo $data['alipay']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['alipay']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['alipay']['total']/100))?></td>
                </tr>
                <tr>
                    <td>美团闪惠</td>
                    <td><?php  echo $data['shanhui']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['shanhui']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['shanhui']['total']/100))?></td>
                </tr>
                <tr>
                    <td>美团</td>
                    <td><?php  echo $data['meituan']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['meituan']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['meituan']['total']/100))?></td>
                </tr>
                <tr>
                    <td>现金</td>
                    <td><?php  echo $data['cash']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['cash']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['cash']['total']/100))?></td>
                </tr>
                <tr>
                    <td>刷卡</td>
                    <td><?php  echo $data['paycard']['num']?></td>
                    <td><?php  echo sprintf('%.2f',($data['paycard']['total_fee']/100))?></td>
                    <td><?php  echo sprintf('%.2f',($data['paycard']['total']/100))?></td>
                </tr>
                <tr>
                    <td><strong>合计</strong></td>
                    <td style="color:#F00"><?php  echo $data['all']['num'];?>笔</td>
                    <td style="color:#F00">￥<?php  echo sprintf('%.2f',($data['all']['total_fee']/100))?>元</td>
                    <td style="color:#F00">￥<?php  echo sprintf('%.2f',($data['all']['total']/100))?>元</td>
                </tr>
            </tbody>
          </table>
</body>
</html>
