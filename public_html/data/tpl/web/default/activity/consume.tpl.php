<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li class="active"><a href="<?php  echo url('activity/consume/display', array('type' => $type));?>"><?php  echo $types[$type]['title'];?>核销</a></li>
</ul>
<div class="main">
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
				<input type="hidden" name="c" value="activity">
				<input type="hidden" name="a" value="consume">
				<input type="hidden" name="do" value="display">
				<input type="hidden" name="type" value="<?php  echo $type;?>">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $types[$type]['title'];?>标题</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<select class="form-control" name="couponid">
							<option value="0">不限</option>
							<?php  if(is_array($coupons)) { foreach($coupons as $coupon) { ?>
							<option value="<?php  echo $coupon['couponid'];?>" <?php  if($_GPC['couponid'] == $coupon['couponid']) { ?>selected<?php  } ?>><?php  echo $coupon['title'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">用户ID</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<input class="form-control" name="uid" id="" type="text" value="<?php  echo $_GPC['uid'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">核销员</label>
					<div class="col-sm-6 col-md-8 col-lg-8 col-xs-12">
						<select class="form-control" name="clerk_id">
							<option value="">不限</option>
							<?php  if(is_array($clerks)) { foreach($clerks as $clerk) { ?>
							<option value="<?php  echo $clerk['id'];?>" <?php  if($_GPC['clerk_id'] == $clerk['id']) { ?>selected<?php  } ?>><?php  echo $clerk['name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $types[$type]['title'];?>状态</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<select class="form-control" name="status">
							<option>不限</option>
							<?php  if(is_array($status)) { foreach($status as $k => $v) { ?>
							<option value="<?php  echo $k;?>" <?php  if($_GPC['status'] == $k) { ?> selected <?php  } ?>><?php  echo $v;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">兑奖日期</label>
					<div class="col-sm-6 col-lg-8 col-xs-12">
						<?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d', $starttime),'endtime'=>date('Y-m-d', $endtime)));?>
					</div>
					<div class="pull-right col-xs-12 col-sm-3 col-lg-2">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="table-responsive panel-body">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th style="width:80px; text-align:center;">用户ID</th>
					<th style="width:80px; text-align:center;">标题</th>
					<th style="width:80px; text-align:center;">图标</th>
					<th style="width:80px; text-align:center;"><?php  if($type == 1) { ?>折扣<?php  } else { ?>面额<?php  } ?></th>
					<th style="width:150px; text-align:center;">兑换时间</th>
					<th style="width:150px; text-align:center;">折扣券状态</th>
					<th style="width:100px;">核销人</th>
					<th style="width:100px;">核销门店</th>
					<th style="width:150px; text-align:center;">使用时间</th>
					<th style="width:80px; text-align:left;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td class="text-center"><?php  echo $item['uid'];?></td>
					<td class="text-center"><?php  echo $item['title'];?></td>
					<td class="text-center"><img src="<?php  echo $item['thumb'];?>" style="max-width:50px; max-height: 30px;"></td>
					<td class="text-center"><?php  echo $item['discount'];?></td>
					<td class="text-center"><?php  echo date('Y-m-d H:i', $item['granttime'])?></td>
					<td class="text-center">
						<?php  if($item['status'] == 1) { ?>
						<span class="label label-success">未使用</span>
						<?php  } else { ?>
						<span class="label label-danger">已使用</span>
						<?php  } ?>
					</td>
					<td><?php  echo $item['clerk_cn'];?></td>
					<td><?php  echo $item['store_cn'];?></td>
					<td class="text-center">
						<?php  if($item['status'] == 1) { ?>
						<?php  } else { ?>
						<?php  echo date('Y-m-d H:i', $item['usetime'])?>
						<?php  } ?>
					</td>
					<td class="text-left">
						<a onclick="if(!confirm('您确定核销吗?')) return false;"  href="<?php  echo url('activity/consume/consume', array('id' => $item['recid'], 'type' => $item['type']))?>" class="btn btn-default btn-sm" title="核销优惠券">核销</a>
						<a onclick="if(!confirm('删除后不可恢复,您确定删除吗?')) return false;"  href="<?php  echo url('activity/consume/del', array('id' => $item['recid'], 'type' => $item['type']))?>" class="btn btn-default btn-sm" title="删除兑换记录">删除</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php  echo $pager;?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
