<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/order.js"></script>
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.nav a{width:33.333%;}
</style>
<header class="nav menu">
	<center style="color:#fff;font-weight:700">确认订单</center>
</header>
<div class="container">
	<form name="cart_confirm_form" id="cart_confirm_form" action="<?php  echo $this->createMobileUrl('orderconfirms',array('status' => $status),true)?>" method="post">
		<section class="menu_wrap">
			<ul class="menu_list order_list" id="orderList">
			<?php  if(is_array($dish_info)) { foreach($dish_info as $li) { ?>
				<li id="<?php  echo $li['id'];?>">
					<div>
						<h3><?php  echo $li['name'];?></h3>
						<div>
							<div class="fr hidden" max="<?php  echo $li['qty'];?>">
								<a href="javascript:void(0);" class="btn_n add active"></a>
							</div>
							<input autocomplete="off" class="number inputnum" type="number" name="dish[<?php  echo $li['id'];?>]" value="<?php  echo $dishes[$li['id']];?>"> 
							<span class="count"><?php  echo $dishes[$li['id']];?></span>
							<span>库存<?php  echo $li['qty'];?><?php  echo $li['unitName'];?></span>
						</div>
					</div>
				</li>
			<?php  } } ?>
			</ul>
		
			<div style="margin:15px 0 0 15px;">
				<a href="javascript:;" class="comm_btn" style="display: inline-block;background: #51C332;margin-right:15px" id="emptyBtn">重选</a>
			</div>
		</section>
		<style type="text/css">
			.order_fixed .comm_btn {
                width: 100%;
            }		
.hidden{display: none}
		.inputnum{width:50px;border:1px solid #535353;height:30px;float:right;}
		.menu_list .btn_n.del{float:left;}
		</style>
		

		<footer class="order_fixed">
			<div class="fixed">
				<p>
					<span class="fr">总计：<!-- <strong>￥<span id="totalPrice"></span></strong> / --> <span id="cartNum" class="has_num"></span>份</span>
					<!-- 配送费：￥<?php  echo $store['delivery_price'];?> -->		
				</p>
				<!-- <a href="<?php  echo $this->createMobileUrl('list');?>" class="add"><label><span>加菜</span></label></a> -->
				<?php  if($status == 1) { ?>
				<a href="javascript:;" class="comm_btn submit_order" style="display: inline-block;">确认退货</a>
				<?php  } else { ?>
				<a href="javascript:;" class="comm_btn submit_order" style="display: inline-block;">确认订货</a>
				<?php  } ?>
			</div>
		</footer>
	</form>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<div class="confirm_box" style="" id="emptyBox">
	<p>确定清空已选菜品吗？</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancel_empty">取消</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="confirm_empty">确定</a></span>
	</div>
</div>
<!-- <div class="confirm_box" style="" id="addBox">
	<p>或许您对我们的推荐菜品感兴趣！！</p>
	<div>
		<span><a href="javascript:void(0);" class="comm_btn " id="add_back" style="display: inline-block;background: #51C332;" >去看看</a></span>
		<span><a href="javascript:void(0);" class="comm_btn" id="add_go">不需要，提交订单</a></span>
	</div>
</div> -->

<script type="text/javascript">
	$(function(){
		var amountCb = $.amountCb();
		$('.order_list li').each(function(){
			var count = parseInt($(this).find('.count').text()),
				_add = $(this).find('.add'),
				i = 0;

			for(; i < count; i++){
				amountCb.call(_add, '+');
			}
			_add.amount(count, amountCb);
		});
	});

	$('#emptyBtn').click(function(){
		$('#emptyBox').dialog({title: '确定重选菜品'});
	});

	$("#cancel_empty").click(function(){
		$('#emptyBox').dialog('close');
	});
// 确定重选菜品
	$("#confirm_empty").click(function(){
		location.href="<?php  echo $this->createMobileUrl('list', array('f' => 1,'status' => $status))?>";
		return false;
	});

	var is_add = "<?php  echo $is_add;?>";
	$('.submit_order').click(function(){
		var add_flag = parseInt($('#addtip').attr('data-flag'));
		if(!add_flag && is_add == 1) {
			$('#addBox').dialog({title: '亲，看看我们的推荐菜品嘛！'});
			$("#add_back").click(function(){
				$('#addtip').attr('data-flag', 1)
				$('#addBox').dialog('close');
				$('#addList, #addtip').slideDown(500);
				return false;
			});
			$("#add_go").click(function(){
				$('#cart_confirm_form').submit();
				return false;
			});
		} else {
			$('#cart_confirm_form').submit();
			return false;
		}
	});

	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>