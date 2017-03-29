<?php defined('IN_IA') or exit('Access Denied');?><?php  $newUI = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'set') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/tplnotice')?>"><i class="icon-group"></i> 设置通知模板</a></li>
</ul>
<?php  if($_W['account']['level'] < 3) { ?>
<div class="alert alert-danger">
	<i class="fa fa-info-circle"></i> 由于您的公众号属于非认证帐号，无使用该功能的权限，请在微信公众平台进行“微信认证”
</div>
<?php  } else { ?>
<?php  if($_W['account']['level'] == 3) { ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> 系统将通过“客服消息”接口给会员发送信息.使用客服消息发送通知，要求：粉丝过去的“48小时内”必须有过交互，否则将不能发送通知<br>
	</div>
<?php  } else { ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> 您可以设置一种公共的通知模板来做为消息通知，也可以为各别通知设置个性化通知模板<br>
	</div>
<?php  } ?>
<div class="clearfix">
	<form action="<?php  echo url('mc/tplnotice');?>" method="post" class="form-horizontal">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置通知模板
			</div>
			<div class="panel-body">
				<?php  if($_W['account']['level'] == 4) { ?>
					<div class="page-header"><h4>系统公共通知模板</h4></div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">模板id</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="system" value="<?php  echo $set['public'];?>"/>
							<span class="help-block">设置此通知模板后，如无特殊指定某些通知模板时，系统将采用此通知模板。<br />请在“微信公众平台”选择行业为：“IT科技 - 互联网|电子商务”，添加标题为：”系统通知“，编号为：“OPENTM207042342”的模板</span>
						</div>
					</div>
				<?php  } ?>
				<?php  if(is_array($tpls)) { foreach($tpls as $key => $tpl) { ?>
					<div class="page-header"><h4><?php  echo $tpl['name'];?></h4></div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
						<div class="col-sm-9 col-xs-12">
							<label class="radio-inline">
								<input type="radio" name="<?php  echo $key;?>[switch]" value="1" <?php  if($set[$key]['switch'] == 1) { ?>checked<?php  } ?> onclick="$('.<?php  echo $key;?>').show()"/> 开启
							</label>
							<label class="radio-inline">
								<input type="radio" name="<?php  echo $key;?>[switch]" value="0" <?php  if(!$set[$key]['switch']) { ?>checked<?php  } ?> onclick="$('.<?php  echo $key;?>').hide()"/> 关闭
							</label>
						</div>
					</div>
					<?php  if($_W['account']['level'] == 4) { ?>
						<div class="<?php  echo $key;?>" <?php  if(!$set[$key]['switch']) { ?>style="display:none"<?php  } ?>>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label">通知模板</label>
								<div class="col-sm-9 col-xs-12">
									<label class="radio-inline">
										<input type="radio" name="<?php  echo $key;?>[type]" value="1" <?php  if($set[$key]['type'] == 1 || !$set[$key]['type']) { ?>checked<?php  } ?> onclick="$('.<?php  echo $key;?>-tpl').hide()"/> 系统公共通知模板
									</label>
									<label class="radio-inline">
										<input type="radio" name="<?php  echo $key;?>[type]" value="2" <?php  if($set[$key]['type'] == 2) { ?>checked<?php  } ?> onclick="$('.<?php  echo $key;?>-tpl').show()"/> <?php  echo $tpl['name'];?>模板
									</label>
								</div>
							</div>
							<div class="form-group <?php  echo $key;?>-tpl" <?php  if($set[$key]['type'] == 1 || !$set[$key]['type']) { ?>style="display:none"<?php  } ?>>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $tpl['name'];?>模板</label>
								<div class="col-sm-9 col-xs-12">
									<input type="text" class="form-control" name="<?php  echo $key;?>[tpl]" value="<?php  echo $set[$key]['tpl'];?>"/>
									<span class="help-block"><?php  echo $tpl['help'];?></span>
								</div>
							</div>
						</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
				<input type="submit" name="submit" value="提交" class="btn btn-primary"/>
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
