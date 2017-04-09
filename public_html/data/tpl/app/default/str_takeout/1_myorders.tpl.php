<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.nav div{width:80%;}
	.nav a{width:30%;}
	.highlights {
    color: #ff5f32;
    padding-left: 10px;
    font-size: 16px;
    }
    .lights {
    padding-left: 10px;
    font-size: 16px;
    }
</style>
<div class="container">
	<header class="nav menu">
		<div>
			<a href="<?php  echo $this->createMobileUrl('myorders', array('status' => '', 'checked' => ''))?>" <?php  if($checked == '') { ?>class="on"<?php  } ?>>待审核</a>
			<a href="<?php  echo $this->createMobileUrl('myorders', array('status' => '', 'checked' => '1'))?>" <?php  if($checked == '1' && $status == '') { ?>class="on"<?php  } ?>>已审核</a>
			<!-- <a href="<?php  echo $this->createMobileUrl('myorders', array('status' => '2', 'checked' => '1'))?>" <?php  if($checked == '1' && $status == '2') { ?>class="on"<?php  } ?>>已完成</a> -->
		</div>
	</header>
	<section class="pay_wrap">
		<ul class="my_order">
			<?php  if(!empty($data)) { ?>
				<?php  if(is_array($data)) { foreach($data as $row) { ?>
					<li>
						<a href="<?php  echo $this->createMobileUrl('orderdetails', array('id' => $row['id'], 'uid' => $row['uid']))?>">
							<div>
								<?php  if($row['billStatus'] == 0 && $row['checked'] == 0) { ?>
									<div class="ico_status pending"><i></i>待审核</div>
								<?php  } else if($row['billStatus'] == 0 && $row['checked'] == 1) { ?>
									<div class="ico_status inhand"><i></i>已审核</div>
								<?php  } else if($row['billStatus'] == 2 && $row['checked'] == 1) { ?>
									<div class="ico_status complete"><i></i>已完成</div>
								<?php  } ?>
							</div>
							<div>
								<h3 style="font-size: 14px;"><?php  echo $row['billNo'];?></h3>
								<p>数量：<?php  echo $row['totalQty'];?><span <?php  if($row['transType'] == '150602') { ?>class="highlights"<?php  } else { ?>class="lights"<?php  } ?>><?php  echo $row['transTypeName'];?></span></p>
								<div><?php  echo $row['modifyTime'];?></div>
							</div>
						</a>
					</li>
				<?php  } } ?>
			<?php  } else { ?>
				<li class="on-info"><i class="fa fa-info-circle"></i> 暂无订单</li>
			<?php  } ?>
		</ul>
	</section>	
	<div class="page"><?php  echo $pager;?></div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
