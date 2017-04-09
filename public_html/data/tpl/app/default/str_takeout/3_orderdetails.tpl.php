<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.but-post{display:block;height:30px;line-height:30px;border:none;width:640px;border-radius:3px;font-size:16px;font-weight:bold;color:#fff;background-color:#ff5f32;}
	.nav div{width:100%; color: #fff;text-align: center;}
</style>
<div class="container">
	<section>
	<header class="nav menu">
		<div>订单详情</div>
	</header>

		<style type="text/css">
			.my_menu_list th{width:0;}
		</style>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th style="width:30%">原材料</th>
					<th style="width:20%">规格</th>
					<th style="width:20%">数量</th>
					<th style="width:20%">单位</th>
				</tr>
			</thead>
			<tbody>
					<?php  if(is_array($order_info)) { foreach($order_info as $da) { ?>
						<tr>
							<td><?php  echo $da['name'];?></td>
							<td><?php  echo $da['spec'];?></td>
							<td><?php  echo $da['qty'];?></td>
							<td><?php  echo $da['unitName'];?></td>
						</tr>
					<?php  } } ?>
			</tbody>
		</table>
		<ul class="box pay_box">
			<li>订单编号：<?php  echo $order['billNo'];?></li>
			<li>联系人：<?php  echo $order['userName'];?></li>
			<li>下单时间：<?php  echo $order['modifyTime'];?></li>
			<li>总数量：<span class="text-strong"><?php  echo $order['totalQty'];?></span></li>
		</ul>
		<ul class="box pay_box">
			<li>备注</li>
			<li><?php  if($order['description']) { ?><?php  echo $order['description'];?><?php  } else { ?>无<?php  } ?></li>
		</ul>
		<!-- <div class="detail_tools">
				<div><a href="javascript:;" class="comm_btn" id="confirmBtn">退货</a></div>
		</div> -->

	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="confirm_box" id="confirmBox">
	<p>您确定已经收到该餐厅的外卖了吗？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmDelivery">未收到</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirmDelivery">已收到</a></span>
	</div>
</div>
<div class="dialog mask" style="display: none;">
	<div class="dialog_wrap">
		<div class="dialog_tt">确认删除订单</div>
		<div class="dialog_scroller"><div class="confirm_box dialog_content" id="confirmBox2" style="display: block;">
			<p>您确定要删除订单？</p>
		<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmDelete">取消</a></span>
		<span><a href="" class="comm_btn" id="confirmDelete">确认删除</a></span>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#confirmBtn').click(function(){
			$('#confirmBox').dialog({title: '确认送达'});
		});
		$("#cancelConfirmDelivery").click(function(){
			$('#confirmBox').dialog('close');
		});
		$("#confirmDelivery").click(function(){
			$.post("<?php  echo $this->createMobileUrl('ajaxorder', array('id' => $oid, 'op' => 'editstatus'))?>",{},function(e){
				if(e.errno == 0) {
					location.reload();
				}else{
					alert(e.error);
					return false;
				}
			},"json");
		});

		$("#deleteOrder").click(function(){
			$('#confirmBox2').dialog({title: '确认删除订单'});
		});
		$("#cancelConfirmDelete").click(function(){
			$('#confirmBox2').dialog('close');
		});
		$("#confirmDelete").click(function(){
			$.post("<?php  echo $this->createMobileUrl('ajaxorder', array('id' => $oid, 'op' => 'del'))?>",{},function(e){
				if(e.errno == 0) {
					location.href = e.error;
					return false;
				}else{
					alert(e.error);
					return false;
				}
			},"json");
		});
	});
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
