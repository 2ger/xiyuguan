<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('home/welcome/' . $do);?>">账号概况 - <?php  echo $title;?></a></li>
</ul>
<div class="clearfix welcome-container">
	<?php  if($do != 'ext') { ?>
	<div class="page-header">
		<h4><i class="fa fa-plane"></i> 快捷操作</h4>
	</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th style="width:150px;">功能类别</th>
			<th>管理入口</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>大模块</td>
			<td>
                <div class="shortcut clearfix">
                    <?php  if(is_array($shortcuts)) { foreach($shortcuts as $shortcut) { ?>
                    <a href="<?php  echo $shortcut['link'];?>" title="<?php  echo $shortcut['title'];?>">
                        <img src="<?php  echo $shortcut['image'];?>" alt="<?php  echo $shortcut['title'];?>" class="img-rounded" />
                        <span><?php  echo $shortcut['title'];?></span>
                    </a>
                    <?php  } } ?>
                </div>
			</td>
		</tr>
		<tr>
			<td>门店管理</td>
			<td>
                <div class="shortcut clearfix">
                    <a href="index.php?c=site&a=entry&id=1&storeid=1&do=order&m=weisrc_dish">
                        <i class="fa fa-home"></i>
                        <span>惠南店</span>
                    </a>
                </div>
			</td>
		</tr>
		<tr>
			<td>收银及员工管理</td>
			<td>
                <div class="shortcut clearfix">
                    <a href="index.php?c=home&a=welcome&do=ext&m=j_money">
                        <i class="fa fa-user-plus"></i>
                        <span>收银及员工管理</span>
                    </a>
                </div>
            </td>
		</tr>
		<tr>
			<td>分销商城</td>
			<td>
                <div class="shortcut clearfix">
                    <a href="index.php?c=home&a=welcome&do=ext&m=ewei_shop">
                        <i class="fa fa-shopping-cart"></i>
                        <span>分销商城</span>
                    </a>
                </div>
			</td>
		</tr>
		<tr>
			<td>聊天系统</td>
			<td>
                开发中...
                <!-- <div class="shortcut clearfix"> -->
                    <!-- <a href="index.php?c=home&a=welcome&do=ext&m=ewei_shop"> -->
                        <!-- <i class="fa fa-wechat"></i> -->
                        <!-- <span>聊天系统</span> -->
                    <!-- </a> -->
                <!-- </div> -->
			</td>
		</tr>
		</tbody>
	</table>
	</div>
</div>
	<!-- <div class="shortcut clearfix"> -->
		<!-- <a href="<?php  echo url('platform/reply', array('m' => 'userapi'))?>"> -->
			<!-- <i class="fa fa-sitemap"></i> -->
			<!-- <span>自定义接口</span> -->
		<!-- </a> -->
	<!-- </div> -->
	<?php  } ?>
	<?php  if($do == 'platform') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-platform', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-platform', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'site') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-site', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-site', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'mc') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-mc', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-mc', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'setting') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-setting', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-setting', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'ext') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-ext', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-ext', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
	<?php  if($do == 'solution') { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('home/welcome-solution', TEMPLATE_INCLUDEPATH)) : (include template('home/welcome-solution', TEMPLATE_INCLUDEPATH));?>
	<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
