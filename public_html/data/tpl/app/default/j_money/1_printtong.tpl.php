<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>

<html lang="zh-cn">

<head>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>消费统计表</title>

<meta name="format-detection" content="telephone=no, address=no">

<meta name="apple-mobile-web-app-capable" content="yes" />

<meta name="apple-touch-fullscreen" content="yes"/>

<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<link href="./resource/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<style>

          body{font-size:12px}

          *,input,td,tr,table,h3{text-align: center!important;padding:0!important;margin:0!important}

ul.list li{width:50%;float:left;margin:0;padding:0;font-weight:700}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {

    border: 1px solid #000!important;

}

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

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {

    border: 1px solid #000!important;

}

</style>



<center>

<a class="Noprint btn btn-success" onclick="print()">打印</a>

<br>

<!-- <img src="/attachment/images/1/2016/08/ELv48l461NA17lOi876LoA6Z8AAV4r.jpg" alt="" class="img-rounded" style="width:30%"> -->

<h3>
    <?php  echo $storeinfo['type'];?><?php  echo $storeinfo['title'];?>

       <!-- <?php  echo date(" Y 年 m 月 d 日",$starts)?> -->

       _______ 年 ___ 月 ___ 日
        消费统计表(店ID:<?php  echo $storeid;?>)   <span class="small pull-right">当值签字:__________</span>

</h3>
<div>统计时间:  <?php  echo date("Y-m-d H:i",$starts)?>  至  <?php  echo date("Y-m-d H:i",$end)?></div>
<h4>

  总金额：<?php  echo sprintf('%.2f',($data['all']['total']/100))?> 

  总人数：<?php  echo $data['people']['total'];?> 

  现金：<?php  echo sprintf('%.2f',($data['cash']['total']/100))?> 

  刷卡：<?php  echo sprintf('%.2f',($data['paycard']['total']/100))?> 

  支付宝：<?php  echo sprintf('%.2f',($data['alipay']['total']/100))?> 

  微信：<?php  echo sprintf('%.2f',($data['weixin']['total']/100))?> 

  美团：<?php  echo sprintf('%.2f',($data['meituan']['total']/100))?> 

  美团闪惠：  <span id="shanhui"><?php  echo sprintf('%.2f',($data['shanhui']['total']/100))?></span> 

  美团外卖：<span id="waimai"> </span>

  未收金额：<span><?php  echo sprintf('%.2f',$data['ws']['all'])?></span>



  </h4> 

</center>

<div style="">

<!-- 交班人： <?php  echo $username;?>  <br>

开始时间： <?php  echo date("Y-m-d H:i",$starts)?><br>

结束时间： <?php  echo date("Y-m-d H:i",$end)?> <br> -->

</div>



<table class="table table-bordered">

            <thead>

              <tr>

                <th rowspan=2>#</th>

                <th colspan="3">餐台信息</th>

                <th colspan="1">金额</th>

                <th colspan=7>支付方式</th>

                <!-- <th colspan=3>网购</th> -->

                <th colspan=3>其它</th>

              </tr>

              <tr>

                <th>台号</th>

                <th>菜单号</th>

                <th>人数</th>

                <th>应收</th>

                <th>现金</th>

                <th>刷卡</th>

                <th>支付宝</th>

                <th>微信</th>

                <th>美团</th>

                <th>美团闪惠</th>

                <th>美团外卖</th>

                <th>验证码</th>

                <!-- <th>抹零</th> -->

                <th>免单</th>

                <th>总折扣</th>

                <!-- <th>会员</th> -->

                <!-- <th>时间</th> -->

                <!-- <th>备注</th> -->

              </tr>

            </thead>

            <tbody>

<?php   

$waimai =0;



?>

                    <?php  if(is_array($list)) { foreach($list as $key => $item) { ?>

    <tr>

    <td><?php  echo $item['num'];?></td>

      <th><?php  echo $item['tablename'];?></th>

                <th><?php  echo $item['ordersn']['id'];?></th>

                <th><?php  echo $item['ordersn']['counts'];?><!-- 人数 --></th>

                <th><?php  echo sprintf('%.2f',($item['total_fee']/100))?></th>

                <th>

                <!-- 现金 -->

                    <?php  if($item['paytype'] == 3) { ?>

                        <?php  echo sprintf('%.2f',(($item['cash_fee']+$item['cash'])/100))?>

                        <?php  } else { ?>

                       <?php echo $item['cash']==0?'':sprintf('%.2f',($item['cash']/100))?>

                    <?php  } ?>



                </th>

                <th>

                    <?php  if($item['paytype'] == 4) { ?>

                        <?php  echo sprintf('%.2f',(($item['cash_fee']+$item['paycard'])/100))?>

                        <?php  } else { ?>

                       <?php echo $item['paycard']==0?'':sprintf('%.2f',($item['paycard']/100))?>

                    <?php  } ?>



                </th>

                <th>

                    <?php  if($item['paytype'] == 1) { ?>

                        <?php  echo sprintf('%.2f',(($item['cash_fee']+$item['alipay'])/100))?>

                        <?php  } else { ?>

                       <?php echo $item['alipay']==0?'':sprintf('%.2f',($item['alipay']/100))?>

                    <?php  } ?>



                </th>

                <th>

                    <?php  if($item['paytype'] == 0) { ?>

                        <?php  echo sprintf('%.2f',(($item['cash_fee']+$item['weixin'])/100))?>

                        <?php  } else { ?>

                       <?php echo $item['weixin']==0?'':sprintf('%.2f',($item['weixin']/100))?>

                    <?php  } ?>



                </th>

                <th>

                    <?php  if($item['paytype'] == 2) { ?>

                        <?php  echo sprintf('%.2f',($item['cash_fee']/100))?>

                    <?php  } ?>

                    <?php  if($item['addcount'] == 4) { ?>

                       <?php  echo sprintf('%.2f',($item['countmoney']/100))?>

                    <?php  } ?>



                    <?php  if($item['daijinquan'] >0) { ?>

                      <?php  echo sprintf('%.2f',($item['daijinquan']))?>

                    <?php  } ?>



                </th>

                <th>

                    <?php  if($item['paytype'] == 5) { ?>



                <?php    if(substr($item['old_trade_no'],0,3) =="800" ){ ?>  

                        <?php  echo sprintf('%.2f',($item['cash_fee']/100))?>



                        <?php  } ?>

                    <?php  } ?>

                       <?php echo $item['quick']==0?'':sprintf('%.2f',($item['quick']/100))?>

                </th>

                <th>

                     <?php  if($item['paytype'] == 5) { ?>



                <?php    if(substr($item['old_trade_no'],0,3) !="800" ){ 

                    $waimai = $waimai+sprintf('%.2f',($item['cash_fee']/100));

                    ?>  

                        <?php  echo sprintf('%.2f',($item['cash_fee']/100))?>



                        <?php  } ?>

                    <?php  } ?>

                </th>

                <th><?php  echo $item['old_trade_no'];?></th>

                <!-- <th>抹零</th> -->

                <th>

                    <?php  if($item['mian'] >0) { ?>

                        <?php  echo $item['mian'];?>

                    <?php  } ?>
                 </th>

                <th>
                      <?php  if($item['coupon_fee'] >0) { ?>

                       
                    <?php  echo sprintf('%.2f',(($item['coupon_fee']/100)-$item['daijinquan']))?>
                

                    <?php  } ?></th>

                <!-- <th>会员</th> -->

        <!-- <td><?php  echo date("H:i",$item['createdate'])?></td> -->

                <!-- <th>备注</th> -->



</tr>



    <?php  } } ?>





            </tbody>

            </table>

            <hr>

<!-- 未结账 17.2.28-->

<h4>未结账</h4>

            <table class="table table-bordered" style="margin-top: 20px;">

            <thead>

     

              <tr>

                <th>#</th>

                <th>台号</th>

                <th>状态</th>

                <th>菜单号</th>

                <th>人数</th>

                <th>应收金额</th>

                <th>实收金额</th>

                <th>未收金额</th>

              <!--   <th>抹零</th>

                <th>免单</th>

                <th>折扣</th>

                <th>会员</th>

                <th>时间</th> -->

                <th>备注</th>

              </tr>

            </thead>

            <tbody>



        <?php  if(is_array($list2)) { foreach($list2 as $key => $item) { ?>

    <tr>

    <td><?php  echo $key+1 ?></td>

                <th><?php  echo $item['tablename'];?></th>

                <th><?php  if($item['status']==-1) { ?>已取消<?php  } else if($item['status']==0) { ?>未确定<?php  } else if($item['status']==1) { ?>未完成<?php  } ?></th>

                <th><?php  echo $item['id'];?></th>

                <th><?php  echo $item['counts'];?></th>

                <th><?php  echo sprintf('%.2f',$item['totalprice'])?></th>

                <th><?php  if($item['status']==2) { ?><?php  echo sprintf('%.2f',$item['paymoney'])?><?php  } else { ?>0<?php  } ?></th><!-- 实收 -->

                <th><?php  if($item['status']==2) { ?>0.00<?php  } else { ?><?php  echo sprintf('%.2f',$item['totalprice'])?><?php  } ?></th><!-- 未收 -->

           

                <th><!-- 备注 --></th>

    </tr>

    <?php  } } ?>

            </tbody>

            </table>

           

<script>

    var shanhui =parseInt(<?php  echo sprintf('%.2f',($data['shanhui']['total']/100))?>);

    var waimai =parseInt(<?php  echo $waimai ?>);

     //alert(shanhui);

    shanhui = shanhui-waimai;

    document.getElementById('shanhui').innerText=shanhui;

    document.getElementById('waimai').innerText=waimai;



</script>

 



<hr>

<!-- 消费金额: <?php  echo $xiaofei['total'];?>元 -->

<!-- <br> -->

<!-- 折扣金额: <?php  echo $orderinfo['zhekou'];?>元 -->

<script>

// window.print();//自动打印:

</script>



</body>

</html>

