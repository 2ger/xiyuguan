<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
$_W['page']['title'] = '公众号列表 - 公众号';
$dos = array('rank', 'package', 'display');
$do = in_array($_GPC['do'], $dos)? $do : 'display' ;
if ($do == 'rank' && $_W['isajax']) {
	$rank = intval($_GPC['rank']);
	$id = intval($_GPC['id']);
	$rank = max(0, $rank);
	$rank = min(5, $rank);
	$exist = pdo_get('uni_account', array('uniacid' => $id));
	if (empty($exist)) {
		message(error(1, '公众号不存在'), '', 'ajax');
	}
	pdo_update('uni_account', array('rank' => $rank), array('uniacid' => $id));
	message(error(0), '', 'ajax');
}
if($do == 'package' && $_W['isajax']){
	$uid = intval($_GPC['uid']);
	$groupid = trim($_GPC['groupid']);
	$groupname = array();
	$package = iunserializer(pdo_fetchcolumn('SELECT package FROM '. tablename('users_group') .' WHERE id = :groupid', array(':groupid' => $groupid)));
	if(!empty($package)) {
		$package_str = implode(',', $package);
		$groupname = pdo_fetchall('SELECT name FROM '. tablename('uni_group'). " WHERE id IN ({$package_str})");
	}

	if(!in_array(-1, $package)) {
		$uniacid = pdo_fetchcolumn('SELECT uniacid FROM '.tablename('uni_account_users')." WHERE uid = :uid AND role = 'owner'",array(':uid' => $uid));
		$append = pdo_fetch('SELECT modules, templates  FROM '. tablename('uni_group') .' WHERE uniacid = :uniacid', array(':uniacid' => $uniacid));
		$modules = array();
		$templates = array();
		if(!empty($append)) {
			$modules = iunserializer($append['modules']);
			if(!empty($modules)) {
				$str = "'" . implode("', '", $modules) . "'";
				$modules = pdo_fetchall('SELECT title FROM '. tablename('modules'). " WHERE name IN ($str)");
			}
			$templates = iunserializer($append['templates']);
			if(!empty($templates)) {
				$condition = implode(',',$templates);
				$templates = pdo_fetchall('SELECT title FROM '. tablename('site_templates')." WHERE id IN ($condition)");
			}
		}
	} else {
		$groupname = array(array('name' => '所有服务'));
	}
	$data = array(
		'groupname' => $groupname,
		'modules' => $modules,
		'templates' => $templates
	);
	message(error(0,$data),'','ajax');
}

if ($do == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$start = ($pindex - 1) * $psize;
	$condition = '';
	$pars = array();
	$keyword = trim($_GPC['keyword']);
	$s_uniacid = intval($_GPC['s_uniacid']);
	if(!empty($keyword)) {
		$condition =" AND a.`name` LIKE :name";
		$pars[':name'] = "%{$keyword}%";
	}
	if(!empty($s_uniacid)) {
		$condition =" AND a.`uniacid` = :uniacid";
		$pars[':uniacid'] = $s_uniacid;
	}
	if(empty($_W['isfounder'])) {
		$condition .= " AND a.`uniacid` IN (SELECT `uniacid` FROM " . tablename('uni_account_users') . " WHERE `uid`=:uid)";
		$pars[':uid'] = $_W['uid'];
	}
	if ($_GPC['type'] == '3') {
		$condition .= " AND b.type = 3";
	} elseif($_GPC['type'] == '1') {
		$condition .= " AND b.type <> 3";
	}
	$tsql = "SELECT COUNT(*) FROM " . tablename('uni_account'). " as a LEFT JOIN". tablename('account'). " as b ON a.default_acid = b.acid WHERE a.default_acid <> 0 {$condition}";
	$total = pdo_fetchcolumn($tsql, $pars);
	$pager = pagination($total, $pindex, $psize);
	$sql = "SELECT * FROM ". tablename('uni_account'). " as a LEFT JOIN". tablename('account'). " as b ON a.default_acid = b.acid WHERE a.default_acid <> 0 {$condition} ORDER BY a.`rank` DESC, a.`uniacid` DESC LIMIT {$start}, {$psize}";
	$list = pdo_fetchall($sql, $pars);
	if(!empty($list)) {
		foreach($list as $unia => &$account) {
			$account['details'] = uni_accounts($account['uniacid']);
			$account['role'] = uni_permission($_W['uid'], $account['uniacid']);
			$account['setmeal'] = uni_setmeal($account['uniacid']);
		}
	}
	if(!$_W['isfounder']) {
		$stat = user_account_permission();
	}
	if (!empty($_W['setting']['platform']['authstate'])) {
		load()->classs('weixin.platform');
		$account_platform = new WeiXinPlatform();
		$authurl = $account_platform->getAuthLoginUrl();
	}
}
template('account/display');