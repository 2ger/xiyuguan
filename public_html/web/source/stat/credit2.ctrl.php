<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
uni_user_permission_check('stat_credit2');
$dos = array('index', 'chart');
$do = in_array($do, $dos) ? $do : 'index';
load()->model('mc');
$_W['page']['title'] = "积分统计-会员中心";

$starttime = empty($_GPC['time']['start']) ? mktime(0, 0, 0, date('m') , 1, date('Y')) : strtotime($_GPC['time']['start']);
$endtime = empty($_GPC['time']['end']) ? TIMESTAMP : strtotime($_GPC['time']['end']) + 86399;
$num = ($endtime + 1 - $starttime) / 86400;

if($do == 'index') {
	$clerks = pdo_getall('activity_clerks', array('uniacid' => $_W['uniacid']), array('id', 'name'), 'id');
	$stores = pdo_getall('activity_stores', array('uniacid' => $_W['uniacid']), array('id', 'business_name', 'branch_name'), 'id');

	$condition = ' WHERE uniacid = :uniacid AND credittype = :credittype AND createtime >= :starttime AND createtime <= :endtime';
	$params = array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => $starttime, ':endtime' => $endtime);
	$num = intval($_GPC['num']);
	if($num > 0) {
		if($num == 1) {
			$condition .= ' AND num >= 0';
		} else {
			$condition .= ' AND num <= 0';
		}
	}
	$min = intval($_GPC['min']);
	if($min > 0 ) {
		$condition .= ' AND abs(num) >= :minnum';
		$params[':minnum'] = $min;
	}

	$max = intval($_GPC['max']);
	if($max > 0 ) {
		$condition .= ' AND abs(num) <= :maxnum';
		$params[':maxnum'] = $max;
	}

	$user = trim($_GPC['user']);
	if(!empty($user)) {
		$condition .= ' AND (uid IN (SELECT uid FROM '.tablename('mc_members').' WHERE uniacid = :uniacid AND (realname LIKE :username OR uid = :uid OR mobile LIKE :mobile)))';
		$params[':username'] = "%{$user}%";
		$params[':uid'] = intval($user);
		$params[':mobile'] = "%{$user}%";
	}

	$psize = 30;
	$pindex = max(1, intval($_GPC['page']));
	$limit = " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ", {$psize}";
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('mc_credits_record') . $condition, $params);
	$data = pdo_fetchall('SELECT * FROM ' . tablename('mc_credits_record') . $condition . $limit, $params);

	if(!empty($data)) {
		load()->model('clerk');
		$uids = array();
		foreach($data as &$da) {
			if(!in_array($da['uid'], $uids)) {
				$uids[] = $da['uid'];
			}
			$operator = mc_account_change_operator($da['clerk_type'], $da['store_id'], $da['clerk_id']);
			$da['clerk_cn'] = $operator['clerk_cn'];
			$da['store_cn'] = $operator['store_cn'];
		}
		$uids = implode(',', $uids);
		$users = pdo_fetchall('SELECT mobile,uid,realname FROM ' . tablename('mc_members') . " WHERE uniacid = :uniacid AND uid IN ($uids)", array(':uniacid' => $_W['uniacid']), 'uid');
	}
	$pager = pagination($total, $pindex, $psize);
}

if($do == 'chart') {
	$today_recharge = floatval(pdo_fetchcolumn('SELECT SUM(num) FROM ' . tablename('mc_credits_record') . ' WHERE uniacid = :uniacid AND credittype = :credittype AND num > 0 AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => strtotime(date('Y-m-d')), ':endtime' => TIMESTAMP)));
	$today_consume = floatval(pdo_fetchcolumn('SELECT SUM(num) FROM ' . tablename('mc_credits_record') . ' WHERE uniacid = :uniacid AND credittype = :credittype AND num < 0 AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => strtotime(date('Y-m-d')), ':endtime' => TIMESTAMP)));
	$total_recharge = floatval(pdo_fetchcolumn('SELECT SUM(num) FROM ' . tablename('mc_credits_record') . ' WHERE uniacid = :uniacid AND credittype = :credittype AND num > 0 AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => $starttime, ':endtime' => $endtime)));
	$total_consume = floatval(pdo_fetchcolumn('SELECT SUM(num) FROM ' . tablename('mc_credits_record') . ' WHERE uniacid = :uniacid AND credittype = :credittype AND num < 0 AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => $starttime, ':endtime' => $endtime)));
	if($_W['isajax']) {
		$stat = array();
		for($i = 0; $i < $num; $i++) {
			$time = $i * 86400 + $starttime;
			$key = date('m-d', $time);
			$stat['consume'][$key] = 0;
			$stat['recharge'][$key] = 0;
		}
		$data = pdo_fetchall('SELECT id,num,credittype,createtime,uniacid FROM ' . tablename('mc_credits_record') . ' WHERE uniacid = :uniacid AND credittype = :credittype AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':credittype' => 'credit2', ':starttime' => $starttime, ':endtime' => $endtime));

		if(!empty($data)) {
			foreach($data as $da) {
				$key = date('m-d', $da['createtime']);
				if($da['num'] > 0) {
					$stat['recharge'][$key] += $da['num'];
				} else {
					$stat['consume'][$key] += abs($da['num']);
				}
			}
		}

		$out['label'] = array_keys($stat['consume']);
		$out['datasets'] = array('recharge' => array_values($stat['recharge']), 'consume' => array_values($stat['consume']));
		exit(json_encode($out));
	}
}
template('stat/credit2');