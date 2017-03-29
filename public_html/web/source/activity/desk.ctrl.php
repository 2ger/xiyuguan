<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */

defined('IN_IA') or exit('Access Denied');
$dos = array('index');
$do = in_array($do, $dos) ? $do : 'index';
$_W['page']['title'] = '店员工作台';

if($do == 'index') {
	load()->model('clerk');
	$permission = clerk_permission_list();
	$user_permission = uni_user_permission_exist();
	if(is_error($user_permission)) {
		$user_permission = uni_user_permission('system');
		foreach($permission as $key => &$row) {
			$has = 0;
			foreach($row['items'] as $key1 => &$row1) {
				if(!in_array($row1['permission'], $user_permission)) {
					unset($row['items'][$key1]);
				} else {
					if(!$has) {
						$has = 1;
					}
				}
			}
			if(!$has) {
				unset($permission[$key]);
			}
		}
	}
}

template('activity/desk');
