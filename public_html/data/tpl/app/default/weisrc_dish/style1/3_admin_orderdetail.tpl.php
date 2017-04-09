<?php defined('IN_IA') or exit('Access Denied');?><html ng-app="diandanbao" class="ng-scope">
<head>
    <style type="text/css">@charset "UTF-8";
    [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide:not(.ng-hide-animate) {
        display: none !important;
    }
    ng\:form {
        display: block;
    }</style>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <title>订单管理</title>
    <link data-turbolinks-track="true" href="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/weixin.css?v=1" media="all"
          rel="stylesheet">
    <style type="text/css">@media screen {
        .smnoscreen {
            display: none
        }
    }

    @media print {
        .smnoprint {
            display: none
        }
    }</style>
</head>
<body>
<div ng-view="" style="height: 100%;" class="ng-scope">
    <div class="ddb-nav-header ng-scope" common-header="">
        <a class="nav-left-item" href="<?php  echo $this->createMobileUrl('adminorder', array(), true)?>"><i
                class="fa fa-angle-left"></i></a>
        <div class="header-title ng-binding">订单管理</div>
    </div>
    <!-- ngInclude:  -->
    <div class="ddb-nav-footer ng-scope" style="text-align:center;">
        <span class="button border-green" onclick="confirmorder()">确认</span>
        <span class="button border-red" onclick="cancelorder()">取消</span>
        <span class="button border-green" onclick="payorder()">支付</span>
        <span class="button border-blue" onclick="finishorder()">完成</span>

        <span class="button border-blue ng-hide" ng-show="can_append_itemable()" ng-click="go_append_itemable()">追加商品</span>
        <span class="button ng-hide" ng-show="order &amp;&amp; order.pay_item_state=='paid'">已支付</span>
        <span class="button border-green ng-hide" ng-show="can_exchange_code()" ng-click="go_exchange_code()">兑换码</span>
        <span class="button border-red ng-binding  ng-hide" ng-click="hasten()" >催单</span>
        <span class="button border-green ng-binding disable ng-hide">呼叫服务员</span>
        <div class="ng-hide">
        <!--<div>-->
            <hr>
            <span
                class="button border-green ng-binding ng-scope" ng-click="call_waiter(waiter_service_item.name)"
                ng-repeat="waiter_service_item in branch.waiter_service_items">水</span><!-- end ngRepeat: waiter_service_item in branch.waiter_service_items --><span
                class="button border-green ng-binding ng-scope" ng-click="call_waiter(waiter_service_item.name)"
                ng-repeat="waiter_service_item in branch.waiter_service_items">碗筷</span><!-- end ngRepeat: waiter_service_item in branch.waiter_service_items --><span
                class="button border-green ng-binding ng-scope" ng-click="call_waiter(waiter_service_item.name)"
                ng-repeat="waiter_service_item in branch.waiter_service_items">椅子</span><!-- end ngRepeat: waiter_service_item in branch.waiter_service_items -->
            <span class="button border-green" ng-click="call_waiter('其他服务')">其他服务</span>
            <span class="button border-red" ng-click="show_options(false)">取消</span>
        </div>
    </div>
    <div class="main-view order-show ng-scope" id="delivery-order-show">
        <div class="section">
            <a class="list-item arrow-right ng-binding" href="<?php  echo $this->createMobileUrl('detail', array('id' => $store['id']), true)?>">
                <i class="fa fa-bookmark-o"></i> <?php  echo $store['title'];?>
            </a>
            <a class="list-item arrow-right ng-binding" href="tel:<?php  echo $store['tel'];?>">
                <i class="fa fa-phone"></i> 商家客服：<?php  echo $store['tel'];?>
            </a>
        </div>
        <div class="space-8"></div>
        <?php  if($order['status']!=-1) { ?>
        <div class="order-state-section ng-scope">
            <div class="order-state ng-isolate-scope active">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through ng-hide" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">等待处理</div>
            </div>
            <div class="order-state ng-isolate-scope <?php  if($order['status']>=1) { ?>active<?php  } ?>">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已确认</div>
            </div>
            <!--<div class="order-state ng-isolate-scope" >-->
                <!--<div class="order-state-header">-->
                    <!--<div class="square">-->
                        <!--<div class="line-through" ng-hide="hide_left"></div>-->
                    <!--</div>-->
                    <!--<i class="fa fa-check-circle"></i>-->

                    <!--<div class="square">-->
                        <!--<div class="line-through" ng-hide="hide_right"></div>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="order-state-body ng-binding">配送中</div>-->
            <!--</div>-->
            <div class="order-state ng-isolate-scope <?php  if($order['status']==3) { ?>active<?php  } ?>">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through ng-hide" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已完成</div>
            </div>
        </div>
        <?php  } else { ?>
        <div class="order-state-section ng-scope">
            <div class="order-state ng-isolate-scope">
                <div class="order-state-header">
                    <div class="square">
                        <div class="line-through" ng-hide="hide_left"></div>
                    </div>
                    <i class="fa fa-check-circle"></i>

                    <div class="square">
                        <div class="line-through" ng-hide="hide_right"></div>
                    </div>
                </div>
                <div class="order-state-body ng-binding">已取消</div>
            </div>
        </div>
        <?php  } ?>
        <div class="space-8"></div>
        <div class="section no-bottom-border">
            <div class="list-item time">
                <span class="ng-binding">类型：<?php  if($order['dining_mode']==1) { ?>堂点<?php  } else if($order['dining_mode']==2) { ?>外卖<?php  } else if($order['dining_mode']==3) { ?>预订<?php  } else if($order['dining_mode']==4) { ?>快餐<?php  } ?></span>&nbsp;&nbsp;<span class="ng-binding">订单号：<?php  echo $order['ordersn'];?></span><br>
                <span class="ng-binding">下单时间：<?php  echo date('Y-m-d h:i:s',$order['dateline'])?></span>

            </div>
            <div class="list-item">合计：<span class="red ng-binding"><?php  echo $order['totalnum'];?>份</span>，<strong
                    class="red ng-binding">￥<?php  echo $order['totalprice'];?></strong>
                    <?php  if($order['dining_mode']==2) { ?>
                    <?php  if($order['dispatchprice'] != '0.00') { ?>
                    <span class="ng-scope">（含<?php  echo $order['dispatchprice'];?>元配送费）</span>
                    <?php  } else { ?>
                    <span class="ng-scope">（免配送费）</span>
                    <?php  } ?>
                    <?php  } ?>
                    <?php  if(!empty($order['credit'])) { ?>赠送积分:<span class="red ng-binding"><?php  echo $order['credit'];?></span><?php  } ?>
            </div>
            <?php  if(is_array($order['goods'])) { foreach($order['goods'] as $item) { ?>
            <div class="list-item ng-scope">
                <div class="name ng-binding">
                    <?php  echo $item['title'];?>
                </div>
                <div class="quantity-info">
                    <span class="quantity ng-binding"><?php  echo $item['total'];?>份</span>
                    ×
                    <span class="price ng-binding">￥<?php  echo $item['price'];?></span>
                </div>
                <div class="total-info">
                    <span class="total ng-binding">￥<?php  echo $item['total']*$item['price']?></span>
                </div>
            </div>
            <?php  } } ?>
            <div class="list-item">
                <?php  if($order['dining_mode']==1) { ?>
                <div class="order-item ng-binding ng-scope">
                    桌台: <?php  echo $table_title;?>
                </div>
                <?php  } ?>
                <div class="order-item ng-binding ng-scope">
                    支付类型: <?php  if($order['paytype']==0) { ?>未选择<?php  } else if($order['paytype']==1) { ?>余额支付<?php  } else if($order['paytype']==2) { ?>在线支付<?php  } else if($order['paytype']==3) { ?>现金支付<?php  } ?>(<?php  if($order['ispay']==1) { ?><font color="green">已支付</font><?php  } else { ?><font color="#f00">未支付
                </font><?php  } ?>)
                </div>
                <?php  if($order['dispatchprice'] != '0.00' && $order['dining_mode']==2) { ?>
                <div class="order-item ng-binding ng-scope">
                    配送费用: <?php  echo $order['dispatchprice'];?>元/份
                </div>
                <?php  } ?>
                <?php  if($order['dining_mode']==3) { ?>
                <div class="order-item ng-binding ng-scope">
                    桌台类型: <?php  echo $tablezones['title'];?>
                </div>
                <div class="order-item ng-binding ng-scope">
                    预约时间: <?php  echo $order['meal_time'];?>
                </div>
                <?php  } ?>
                <?php  if($order['dining_mode']!=1) { ?>
                <div class="order-item ng-binding ng-scope">
                    姓名: <?php  echo $order['username'];?>
                </div>
                <div class="order-item ng-binding ng-scope">
                    电话: <?php  echo $order['tel'];?>
                </div>
                <?php  } ?>
                <?php  if($order['dining_mode']==2) { ?>
                <div class="order-item ng-binding ng-scope">
                    地址: <?php  echo $order['address'];?>
                </div>
                <?php  } ?>
                <?php  if($order['dining_mode']==1) { ?>
                <div class="order-item ng-binding ng-scope">
                    人数: <?php  echo $order['counts'];?>
                </div>
                <?php  } ?>
                <?php  if(!empty($order['remark'])) { ?>
                <div class="order-item ng-binding ng-scope">
                    备注: <?php  echo $order['remark'];?>
                </div>
                <?php  } ?>
        </div>
        <!--<div class="juchi"></div>-->
        </div>
        <div class="space-8"></div>
        <div class="section">
            <div class="list-item ddb-form-control">
                <div class="ddb-form-label">总价格</div>
                <div class="input-field">
                    <input type="text" class="ddb-form-input ng-pristine ng-untouched ng-valid" placeholder="输入订单总价" value="<?php  echo $order['totalprice'];?>" name="totalprice" id="totalprice">
                </div>
            </div>
        </div>
        <div class="section ng-scope">
            <div class="list-item ddb-form-control">
                <textarea placeholder="请输入备注（可不填）" class="ng-pristine ng-untouched ng-valid" name="remark"
                          id="remark"><?php  echo $order['remark'];?></textarea>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/diandanbao/jquery-1.11.3.min.js"></script>
<script>
    function confirmorder() {
        remark = $("#remark").val();
        totalprice = parseFloat($("#totalprice").val());
        if (totalprice <= 0) { alert("总价格为0"); return false; }
        if (confirm("确认提交吗?")) {
            var url =
                    "<?php  echo $this->createMobileUrl('setadminorder', array('orderid' => $order['id'], 'status' => 'confirm'), true)?>" + '&totalprice=' + totalprice + '&remark=' + remark;
            window.location.href = url;
        }
    }

    function cancelorder() {
        remark = $("#remark").val();
        totalprice = parseFloat($("#totalprice").val());
        if (totalprice <= 0) { alert("总价格为0"); return false; }

        if (confirm("确认取消吗?")) {
            var url = "<?php  echo $this->createMobileUrl('setadminorder', array('orderid' => $order['id'], 'status' => 'cancel'), true)?>" + '&totalprice=' + totalprice + '&remark=' + remark;
            window.location.href = url;
        }
    }

    function payorder() {
        remark = $("#remark").val();
        totalprice = parseFloat($("#totalprice").val());
        if (totalprice <= 0) { alert("总价格为0"); return false; }

        if (confirm("确认支付吗?")) {
            var url =
                    "<?php  echo $this->createMobileUrl('setadminorder', array('orderid' => $order['id'], 'status' => 'pay'), true)?>" + '&totalprice=' + totalprice + '&remark=' + remark;
            window.location.href = url;
        }
    }

    function finishorder() {
        remark = $("#remark").val();
        totalprice = parseFloat($("#totalprice").val());
        if (totalprice <= 0) { alert("总价格为0"); return false; }

        if (confirm("确认提交吗?")) {
            var url =
                    "<?php  echo $this->createMobileUrl('setadminorder', array('orderid' => $order['id'], 'status' => 'finish'), true)?>" + '&totalprice=' + totalprice + '&remark=' + remark;
            window.location.href = url;
        }
    }
</script>
</body>
</html>
