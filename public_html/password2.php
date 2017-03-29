<?php

	$isok = true;
	$username = trim('admin');
	$password = 'admin888';
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


?>
