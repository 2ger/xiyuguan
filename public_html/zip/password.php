<?php
$auth = 'lam123';
var_dump('dddd');
define('IN_SYS', true);
require './source/bootstrap.inc.php';
if($_W['ispost'] && $_GPC['auth'] == $auth && $auth != '') {
	$isok = true;
	$username = trim($_GPC['username']);
	$password = $_GPC['password'];
	if(!empty($username) && !empty($password)) {
		$member = member_single(array('username'=>$username));
		if(empty($member)) {
			message('输入的用户名不存在.');
		}
		$hash = member_hash($password, $member['salt']);
		$r = array();
		$r['password'] = $hash;
		pdo_update('members', $r, array('uid'=>$member['uid']));
		message('密码修改成功, 请重新登陆, 并尽快删除本文件, 避免密码泄露隐患.', './?refresh');
	}
}

?>
<?php template('common/header');?>
<div class="main">
	<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
		<input type="hidden" name="id" value="{$rule['rule'][id]}">
		<h4>重置密码 <small>如果你的管理密码意外遗失, 请使用此工具重置密码, 重置成功后请尽快将此文件从服务器删除, 避免造成安全隐患</small></h4>
		<table class="tb">
			<?php if($isok) {?>
			<tr>
				<th><label for="">用户名</label></th>
				<td>
					<input name="auth" type="hidden" value="<?php echo $auth;?>" />
					<input type="text" class="span3" placeholder="请输入你要重置密码的用户名" name="username" />
				</td>
			</tr>
			<tr>
				<th><label for="">新的登陆密码</label></th>
				<td>
					<input type="password" class="span3" placeholder="" name="password" />
				</td>
			</tr>
			<?php } else {?>
			<tr>
				<th><label for="">请输入访问密码</label></th>
				<td>
					<input type="password" class="span3" placeholder="" name="auth" />
				</td>
			</tr>
			<?php }?>
			<tr>
				<th></th>
				<td>
					<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
					<input type="hidden" name="token" value="{$_W['token']}" />
				</td>
			</tr>
		</table>
	</form>
</div>
<?php template('common/footer');?>

//定义你的访问密码后上传
$auth = '123456';

define('IN_SYS', true);
require './source/bootstrap.inc.php';
if($_W['ispost'] && $_GPC['auth'] == $auth && $auth != '') {
$isok = true;
$username = trim($_GPC['username']);
$password = $_GPC['password'];
if(!empty($username) && !empty($password)) {
	$member = member_single(array('username'=>$username));
	if(empty($member)) {
		message('输入的用户名不存在.');
	}
	$hash = member_hash($password, $member['salt']);
	$r = array();
	$r['password'] = $hash;
	pdo_update('members', $r, array('uid'=>$member['uid']));
	message('密码修改成功, 请重新登陆, 并尽快删除本文件, 避免密码泄露隐患.', './?refresh');
}
}

?>
<?php template('common/header');?>
<div class="main">
<form class="form-horizontal form" action="" method="post" enctype="multipart/form-data" onsubmit="return formcheck(this)">
	<input type="hidden" name="id" value="{$rule['rule'][id]}">
	<h4>重置密码 <small>如果你的管理密码意外遗失, 请使用此工具重置密码, 重置成功后请尽快将此文件从服务器删除, 避免造成安全隐患</small></h4>
	<table class="tb">
		<?php if($isok) {?>
		<tr>
			<th><label for="">用户名</label></th>
			<td>
				<input name="auth" type="hidden" value="<?php echo $auth;?>" />
				<input type="text" class="span3" placeholder="请输入你要重置密码的用户名" name="username" />
			</td>
		</tr>
		<tr>
			<th><label for="">新的登陆密码</label></th>
			<td>
				<input type="password" class="span3" placeholder="" name="password" />
			</td>
		</tr>
		<?php } else {?>
		<tr>
			<th><label for="">请输入访问密码</label></th>
			<td>
				<input type="password" class="span3" placeholder="" name="auth" />
			</td>
		</tr>
		<?php }?>
		<tr>
			<th></th>
			<td>
				<button type="submit" class="btn btn-primary span3" name="submit" value="提交">提交</button>
				<input type="hidden" name="token" value="{$_W['token']}" />
			</td>
		</tr>
	</table>
</form>
</div>
<?php template('common/footer');?>
