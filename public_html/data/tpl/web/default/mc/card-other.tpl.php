<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'other') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/card/other');?>">会员卡其他功能</a></li>
</ul>
<div class="clearfix">
	<div class="clearfix menu">
		<h5 class="page-header">其他设置</h5>
		<div class="clearfix">
			<a href="<?php  echo url('mc/card/notice');?>" class="tile img-rounded">
				<i class="fa fa-volume-up"></i>
				<span>通知管理</span>
			</a>
			<a href="<?php  echo url('mc/card/credit');?>" class="tile img-rounded">
				<i class="fa fa-cny"></i>
				<span>积分策略</span>
			</a>
			<a href="<?php  echo url('mc/card/recommend');?>" class="tile img-rounded">
				<i class="fa fa-share-alt"></i>
				<span>每日推荐</span>
			</a>
			<a href="<?php  echo url('mc/card/sign');?>" class="tile img-rounded">
				<i class="fa fa-hand-o-up"></i>
				<span>签到管理</span>
			</a>
		</div>
	</div>
</div>
<script>
	require(['trade', 'bootstrap'], function(trade){
		trade.init();
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>