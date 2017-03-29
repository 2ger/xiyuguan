<?php
/**
 * 微外卖模块微站定义
 * @author strday
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
include('model.php');
include 'wprint.class.php';
class Str_takeoutModuleSite extends WeModuleSite {
	public function doWebConfig() {
		global $_W, $_GPC;
		$config = get_config();
		if(checksubmit('submit')) {
			$data = array(
				'uniacid' => $_W['uniacid'],
				'version' => intval($_GPC['version']),
				'area_search' => intval($_GPC['area_search']),
			);
			if(!empty($config)) {
				pdo_update('str_config', $data, array('uniacid' => $_W['uniacid']));
			} else {
				pdo_insert('str_config', $data);
			}
			message('设置参数成功', referer(), 'success');
		}
		include $this->template('config');
	}

	public function doWebStore() {
		global $_W, $_GPC;
		$op = empty($_GPC['op']) ? 'list' : trim($_GPC['op']);
		$config = get_config();
		if($config['num_limit'] > 0) {
			$now_store_num = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_store') . ' WHERE uniacid = :uniacid' , array(':uniacid' => $_W['uniacid']));
		}
		if($op == 'list') {
			$condition = ' uniacid = :aid';
			$params[':aid'] = $_W['uniacid'];
			if(!empty($_GPC['keyword'])) {
				$condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
			}
			$area_id = intval($_GPC['area_id']);
			if($area_id > 0) {
				$condition .= " AND area_id = :area_id";
				$params[':area_id'] = $area_id;
			}
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_store') . ' WHERE ' . $condition, $params);
			$lists = pdo_fetchall('SELECT * FROM ' . tablename('str_store') . ' WHERE ' . $condition . ' ORDER BY displayorder DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
			$pager = pagination($total, $pindex, $psize);
			if(!empty($lists)) {
				foreach($lists as &$li) {
					$li['address'] = str_replace('+', ' ', $li['district']) . ' ' . $li['address'];
				}
			}
			$area = get_area();
		}

		if($op == 'post') {
			load()->func('tpl');
			$id = intval($_GPC['id']);
			$accounts = uni_accounts();
			foreach($accounts as $k => $li) {
				if($li['level'] < 3) {
					unset($li[$k]);
				}
			}
			$area = get_area();
			if($id) {
				$item = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
				if(empty($item)) {
					message('门店信息不存在或已删除', 'referer', 'error');
				} else {
					$item['thumbs'] = iunserializer($item['thumbs']);
					$district_tmp = explode('+', $item['district']);
					if(is_array($district_tmp)) {
						$item['reside'] = array('province' => $district_tmp[0], 'city' => $district_tmp[1], 'district' => $district_tmp[2]);
					}
					$item['map'] = array('lat' => $item['location_x'], 'lng' => $item['location_y']);
					$item['business_hours'] = iunserializer($item['business_hours']);
				}
			} else {
				if($config['num_limit'] > 0 && ($config['num_limit'] - $now_store_num <= 0)) {
					message("您的公众号只能添加{$config['num_limit']}个门店，不能再添加门店，请联系管理员", referer(), 'error');
				}
				$item['notice_type'] = 1;
				$item['comment_set'] = 1;
				$item['comment_status'] = 1;
				$item['is_meal'] = 1;
				$item['is_takeout'] = 1;
				$item['dish_style'] = 1;
				$item['business_hours'] = array(array('s' => '8:00', 'e' => '24:00'));
				$item['area_id'] = intval($_GPC['aid']);
			}
			if(checksubmit('submit')) {
				$data = array(
					'title' => trim($_GPC['title']),
					'logo' => trim($_GPC['logo']),
					'telephone' => trim($_GPC['telephone']),
					'description' => htmlspecialchars_decode($_GPC['description']),
					'send_price' =>intval($_GPC['send_price']),
					'delivery_price' =>intval($_GPC['delivery_price']),
					'delivery_time' =>intval($_GPC['delivery_time']),
					'serve_radius' =>intval($_GPC['serve_radius']),
					'delivery_area' => trim($_GPC['delivery_area']),
					'district' => $_GPC['reside']['province'] . '+' . $_GPC['reside']['city'] . '+' . $_GPC['reside']['district'],
					'address' =>  trim($_GPC['address']),
					'location_x' => $_GPC['map']['lat'],
					'location_y' => $_GPC['map']['lng'],
					'displayorder' => intval($_GPC['displayorder']),
					'status' => intval($_GPC['status']),
					'notice_acid' => intval($_GPC['notice_acid']),
					'notice_type' => intval($_GPC['notice_type']),
					'store_tpl' => trim($_GPC['store_tpl']),
					'member_tpl' => trim($_GPC['member_tpl']),
					'delivery_tpl' => trim($_GPC['delivery_tpl']),
					'dish_style' => intval($_GPC['dish_style']),
					'is_meal' => intval($_GPC['is_meal']),
					'is_takeout' => intval($_GPC['is_takeout']),
					'comment_set' => intval($_GPC['comment_set']),
					'comment_status' => intval($_GPC['comment_status']),
					'print_type' => intval($_GPC['print_type']),
					'notice' => trim($_GPC['notice']),
					'content' => trim($_GPC['content']),
					'area_id' => intval($_GPC['area_id']),
				);
				if(!empty($_GPC['business_start_hours'])) {
					$hour = array();
					foreach($_GPC['business_start_hours'] as $k => $v) {
						$v = str_replace('：', ':', trim($v));
						if(!strexists($v, ':')) {
							$v .= ':00';
						}
						$end = str_replace('：', ':', trim($_GPC['business_end_hours'][$k]));
						if(!strexists($end, ':')) {
							$end.= ':00';
						}
						$hour[] = array('s' => $v, 'e' => $end);
					}
				}

				$data['business_hours'] = iserializer($hour);
				$data['thumbs'] = iserializer($_GPC['thumbs']);
				if($id) {
					pdo_update('str_store', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
				} else {
					$data['uniacid'] = $_W['uniacid'];
					pdo_insert('str_store', $data);
				}
				message('编辑门店信息成功', $this->createWebUrl('store', array('op' => 'list')), 'success');
			}
		}

		if($op == 'del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_dish_category', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_dish', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_order', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_order_print', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_print', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_clerk', array('uniacid' => $_W['uniacid'], 'sid' => $id));
			pdo_delete('str_store', array('uniacid' => $_W['uniacid'], 'id' => $id));
			message('删除门店成功', $this->createWebUrl('store', array('op' => 'list')), 'success');
		}
		include $this->template('store');
	}

	public function doWebAjax() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']);
		if($op == 'status_store') {
			$id = intval($_GPC['id']);
			$value = intval($_GPC['value']);
			$state = pdo_update('str_store', array('status' => $value), array('uniacid' => $_W['uniacid'], 'id' => $id));
			if($state !== false) {
				exit('success');
			}
			exit('error');
		}
		if($op == 'status_dish') {
			$id = intval($_GPC['id']);
			$value = intval($_GPC['value']);
			$state = pdo_update('str_dish', array('is_display' => $value), array('uniacid' => $_W['uniacid'], 'id' => $id));
			if($state !== false) {
				exit('success');
			}
			exit('error');
		}
		if($op == 'recommend_dish') {
			$id = intval($_GPC['id']);
			$value = intval($_GPC['value']);
			$state = pdo_update('str_dish', array('recommend' => $value), array('uniacid' => $_W['uniacid'], 'id' => $id));
			if($state !== false) {
				exit('success');
			}
			exit('error');
		}
	}

	public function doWebSwitch() {
		global $_W, $_GPC;
		$sid = intval($_GPC['sid']);
		isetcookie('__sid', $sid, 86400 * 7);
		header('location: ' . $this->createWebUrl('manage'));
		exit();
	}

	public function doWebManage() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'cate_list';
		$sid = intval($_GPC['__sid']);
		$store = pdo_fetch('SELECT id, title FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		if(empty($store)) {
			message('门店信息不存在或已删除', $this->createWebUrl('store'), 'error');
		}
		$pay_types = array(
			'alipay' => '支付宝支付',
			'wechat' => '微信支付',
			'credit' => '余额支付',
			'delivery' => '餐到付款',
		);

		//订单详细统计
		if($op == 'stat_detail') {
			load()->func('tpl');
			$condition = " WHERE uniacid = :aid AND sid = :sid AND pay_type != ''";
			$params[':aid'] = $_W['uniacid'];
			$params[':sid'] = $sid;
			$is_print = intval($_GPC['is_print']);
			if(!$is_print) {
				if(!empty($_GPC['addtime'])) {
					$starttime = strtotime($_GPC['addtime']['start']);
					$endtime = strtotime($_GPC['addtime']['end']);
				} else {
					$starttime = strtotime(date('Y-m'));
					$endtime = TIMESTAMP;
				}
			} else {
				$starttime = intval($_GPC['starttime']);
				$endtime = intval($_GPC['endtime']);
				$title = date('Y-m-d H:i', $starttime) . ' ~~ ' . date('Y-m-d H:i', $endtime) . ' 订单统计';
			}
			$condition .= " AND addtime > :start AND addtime < :end";
			$params[':start'] = $starttime;
			$params[':end'] = $endtime;
			
			$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order') .  $condition, $params);
			$total_price = pdo_fetchcolumn('SELECT SUM(price+delivery_fee) FROM ' . tablename('str_order') .  $condition, $params);

			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_order') . $condition . ' ORDER BY addtime ', $params);
			$total = array();
			if(!empty($data)) {
				foreach($data as &$da) {
					$total_price = $da['price']+$da['delivery_fee'];
					$key = date('Y-m-d', $da['addtime']);
					$return[$key]['price'] += $total_price;
					$return[$key]['count'] += 1;
					$total['total_price'] += $total_price;
					$total['total_count'] += 1;
					if($da['pay_type'] == 'alipay') {
						$return[$key]['alipay'] += $total_price;
						$total['total_alipay'] += $total_price;
					} elseif($da['pay_type'] == 'wechat') {
						$return[$key]['wechat'] += $total_price;
						$total['total_wechat'] += $total_price;
					} elseif($da['pay_type'] == 'credit') {
						$return[$key]['credit'] += $total_price;
						$total['total_credit'] += $total_price;
					} elseif($da['pay_type'] == 'delivery') {
						$return[$key]['delivery'] += $total_price;
						$total['total_delivery'] += $total_price;
					} else {
						$return[$key]['cash'] += $total_price;
						$total['total_cash'] += $total_price;
					}
				}
			}
			include $this->template('stat_detail');
		}

		if($op == 'stat_day') {
			//今日订单统计
			$orderby = trim($_GPC['orderby']) ? trim($_GPC['orderby']) : 'num';
			if($orderby == 'num') {
				$order_by = ' ORDER BY num DESC';
			} else {
				$order_by = ' ORDER BY price DESC';
			}
			$day = trim($_GPC['day']);
			if(empty($day)) {
				$start = intval($_GPC['start']);
				$end = intval($_GPC['end']);
			} else {
				$start = strtotime($day);
				$end =  strtotime($day) + 86399;
			}
			$data = array();
			$orders = pdo_fetchall('SELECT * FROM ' . tablename('str_order') . " WHERE uniacid = :aid AND sid = :sid AND addtime >= :start AND addtime < :end  AND pay_type != '' ORDER BY id ASC", array(':sid' => $sid, ':aid' => $_W['uniacid'], ':start' => $start, ':end' => $end), 'id');
			$count = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order') . " WHERE uniacid = :aid AND sid = :sid AND addtime >= :start AND addtime < :end  AND pay_type != '' ORDER BY id ASC", array(':sid' => $sid, ':aid' => $_W['uniacid'], ':start' => $start, ':end' => $end));
			if(!empty($orders)) {
				$str = implode(',', array_keys($orders));
				$data = pdo_fetchall('SELECT *,SUM(dish_num) AS num, SUM(dish_price) AS price FROM ' . tablename('str_stat') . " WHERE uniacid = :aid AND sid = :sid AND oid IN ({$str}) GROUP BY dish_id" . $order_by, array(':aid' => $_W['uniacid'], ':sid' => $sid), 'dish_id');
				$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_stat') . " WHERE uniacid = :aid AND sid = :sid AND oid IN ({$str})", array(':aid' => $_W['uniacid'], ':sid' => $sid));
				$price = pdo_fetchcolumn('SELECT SUM(price+delivery_fee) FROM ' . tablename('str_order') . " WHERE uniacid = :aid AND sid = :sid AND id IN ({$str})", array(':aid' => $_W['uniacid'], ':sid' => $sid));
			}
			if(!empty($orders)) {
				foreach($orders as &$da) {
					$total_price = $da['price']+$da['delivery_fee'];
					if($da['pay_type'] == 'alipay') {
						$return['alipay']['price'] += $total_price;
						$return['alipay']['num'] += 1;
					} elseif($da['pay_type'] == 'wechat') {
						$return['wechat']['price'] += $total_price;
						$return['wechat']['num'] += 1;
					} elseif($da['pay_type'] == 'credit') {
						$return['credit']['price'] += $total_price;
						$return['credit']['num'] += 1;
					} elseif($da['pay_type'] == 'delivery') {
						$return['delivery']['price'] += $total_price;
						$return['delivery']['num'] += 1;
					} else {
						$return['cash']['price'] += $total_price;
						$return['cash']['num'] += 1;
					}
				}
			}
			include $this->template('stat_detail');
		}

		//桌号设置
		if($op == 'table_post') {
			if(checksubmit('submit')) {
				if(!empty($_GPC['tables'])) {
					$tables_temp = explode("\n", $_GPC['tables']);
					$tables= array();
					if(!empty($tables_temp)) {
						foreach($tables_temp as $table) {
							if(empty($table)) continue;
							$tables[] = $table;
						}
					}
				}
				if(!empty($_GPC['rooms'])) {
					$rooms_temp = explode("\n", $_GPC['rooms']);
					$rooms= array();
					if(!empty($rooms_temp)) {
						foreach($rooms_temp as $room) {
							if(empty($room)) continue;
							$rooms[] = $room;
						}
					}
				}
				$data = array(
					'uniacid' => $_W['uniacid'],
					'sid' => $sid,
					'tables' => iserializer($tables),
					'rooms' => iserializer($rooms)
				);
				pdo_delete('str_tables', array('uniacid' => $_W['uniacid'], 'sid' => $sid));
				pdo_insert('str_tables', $data);
				message('设置包房/桌号成功', referer(), 'success');
			}

			$data = pdo_fetch('SELECT * FROM ' . tablename('str_tables') . ' WHERE uniacid = :uniacid AND sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
			if(!empty($data)) {
				$data['tables'] = implode("\n", iunserializer($data['tables']));
				$data['rooms'] = implode("\n", iunserializer($data['rooms']));
			}
			include $this->template('table');
		}

		if($op == 'cate_list') {
			$condition = ' uniacid = :aid AND sid = :sid';
			$params[':aid'] = $_W['uniacid'];
			$params[':sid'] = $sid;
			if(!empty($_GPC['keyword'])) {
				$condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
			}
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_dish_category') . ' WHERE ' . $condition, $params);
			$lists = pdo_fetchall('SELECT * FROM ' . tablename('str_dish_category') . ' WHERE ' . $condition . ' ORDER BY displayorder DESC,id ASC LIMIT '.($pindex - 1) * $psize.','.$psize, $params, 'id');
			if(!empty($lists)) {
				$ids = implode(',', array_keys($lists));
				$nums = pdo_fetchall('SELECT count(*) AS num,cid FROM ' . tablename('str_dish') . " WHERE uniacid = :aid AND cid IN ({$ids}) GROUP BY cid", array(':aid' => $_W['uniacid']), 'cid');
			}
			$pager = pagination($total, $pindex, $psize);
			if(checksubmit('submit')) {
				if(!empty($_GPC['ids'])) {
					foreach($_GPC['ids'] as $k => $v) {
						$data = array(
							'title' => trim($_GPC['title'][$k]),
							'displayorder' => intval($_GPC['displayorder'][$k])
						);
						pdo_update('str_dish_category', $data, array('uniacid' => $_W['uniacid'], 'id' => intval($v)));
					}
					message('编辑成功', $this->createWebUrl('manage', array('op' => 'cate_list')), 'success');
				}
			}
			include $this->template('category');
		} elseif($op == 'cate_post') {
			if(checksubmit('submit')) {
				if(!empty($_GPC['title'])) {
					foreach($_GPC['title'] as $k => $v) {
						$v = trim($v);
						if(empty($v)) continue;
						$data['sid'] = $sid;
						$data['uniacid'] = $_W['uniacid'];
						$data['title'] = $v;
						$data['displayorder'] = intval($_GPC['displayorder'][$k]);
						pdo_insert('str_dish_category', $data);
					}
				}
				message('添加菜品分类成功', $this->createWebUrl('manage', array('sid' => $sid, 'op' => 'cate_list')), 'success');
			}
			include $this->template('category');
		} elseif($op == 'cate_del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_dish_category', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
			pdo_delete('str_dish', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'cid' => $id));
			message('删除菜品分类成功', $this->createWebUrl('manage', array('op' => 'cate_list')), 'success');
		} elseif($op == 'dish_del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_dish', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
			message('删除菜品成功', $this->createWebUrl('manage', array('op' => 'dish_list')), 'success');
		} elseif($op == 'dish_list') {
			$condition = ' uniacid = :aid AND sid = :sid';
			$params[':aid'] = $_W['uniacid'];
			$params[':sid'] = $sid;
			if(!empty($_GPC['keyword'])) {
				$condition .= " AND title LIKE '%{$_GPC['keyword']}%'";
			}
			if(!empty($_GPC['cid'])) {
				$condition .= " AND cid = :cid";
				$params[':cid'] = intval($_GPC['cid']);
			}

			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_dish') . ' WHERE ' . $condition, $params);
			$lists = pdo_fetchall('SELECT * FROM ' . tablename('str_dish') . ' WHERE ' . $condition . ' ORDER BY displayorder DESC,id ASC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
			$pager = pagination($total, $pindex, $psize);
			$category = pdo_fetchall('SELECT title, id FROM ' . tablename('str_dish_category') . ' WHERE uniacid = :aid AND sid = :sid', array(':aid' => $_W['uniacid'], ':sid' => $sid), 'id');

			include $this->template('dish');
		} elseif($op == 'dish_post') {
			load()->func('tpl');
			$category = pdo_fetchall('SELECT title, id FROM ' . tablename('str_dish_category') . ' WHERE uniacid = :aid AND sid = :sid ORDER BY displayorder DESC, id ASC', array(':aid' => $_W['uniacid'], ':sid' => $sid));
			$id = intval($_GPC['id']);
			if($id) {
				$item = pdo_fetch('SELECT * FROM ' . tablename('str_dish') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
				if(empty($item)) {
					message('菜品不存在或已删除', $this->createWebUrl('manage', array('dish_list')), 'success');
				}
			} else {
				$item['total'] = -1;
				$item['unitname'] = '份';
			}
			if(checksubmit('submit')) {
				$data = array(
					'sid' => $sid,
					'uniacid' => $_W['uniacid'],
					'title' => trim($_GPC['title']),
					'price' => floatval($_GPC['price']),
					'unitname' => trim($_GPC['unitname']),
					'total' => intval($_GPC['total']),
					'sailed' => intval($_GPC['sailed']),
					'grant_credit' => intval($_GPC['grant_credit']),
					'is_display' => intval($_GPC['is_display']),
					'cid' => intval($_GPC['cid']),
					'thumb' => trim($_GPC['thumb']),
					'recommend' => intval($_GPC['recommend']),
					'displayorder' => intval($_GPC['displayorder']),
					'description' => trim($_GPC['description'])
				);
				if($id) {
					pdo_update('str_dish', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
				} else {
					pdo_insert('str_dish', $data);
				}
				message('编辑菜品成功', $this->createWebUrl('manage', array('op' => 'dish_list')), 'success');
			}
			include $this->template('dish');
		} elseif($op == 'order') {
			load()->func('tpl');
			$condition = ' WHERE uniacid = :aid AND sid = :sid';
			$params[':aid'] = $_W['uniacid'];
			$params[':sid'] = $sid;

			$status = intval($_GPC['status']);
			if($status) {
				$condition .= ' AND status = :stu';
				$params[':stu'] = $status;
			}
			$keyword = trim($_GPC['keyword']);
			if(!empty($keyword)) {
				$condition .= " AND (username LIKE '%{$keyword}%' OR mobile LIKE '%{$keyword}%')";
			}
			if(!empty($_GPC['addtime'])) {
				$starttime = strtotime($_GPC['addtime']['start']);
				$endtime = strtotime($_GPC['addtime']['end']) + 86399;
			} else {
				$starttime = strtotime('-15 day');
				$endtime = TIMESTAMP;
			}
			$condition .= " AND addtime > :start AND addtime < :end";
			$params[':start'] = $starttime;
			$params[':end'] = $endtime;

			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order') .  $condition, $params);
			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_order') . $condition . ' ORDER BY addtime DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
			if(!empty($data)) {
				foreach($data as &$da) {
					$da['is_trash'] = check_trash($da['sid'], $da['uid'], 'fetch');
				}
			}
			$pager = pagination($total, $pindex, $psize);
			include $this->template('order');
		} elseif($op == 'orderdetail') {
			$pay_types = pay_types();
			$id = intval($_GPC['id']);
			$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
			if(empty($order)) {
				message('订单不存在或已经删除', $this->createWebUrl('manage', array('op' => 'order')), 'error');
			} else {
				$order['dish'] = get_dish($order['id']);
				if($order['comment'] == 1) {
					$comment = pdo_fetch('SELECT * FROM ' . tablename('str_order_comment') .' WHERE uniacid = :aid AND oid = :oid', array(':aid' => $_W['uniacid'], ':oid' => $id));
				}
			}
			include $this->template('order');
		} elseif($op == 'status') {
			$id = intval($_GPC['id']);
			$status = intval($_GPC['status']);
			if($status == 5) {
				pdo_update('str_order', array('pay_type' => 'cash'), array('uniacid' => $_W['uniacid'], 'id' => $id));
			} else {
				pdo_update('str_order', array('status' => $status), array('uniacid' => $_W['uniacid'], 'id' => $id));
			}
			//todo
			wechat_notice($sid, $id, $status);
			message('更新订状态成功', referer(), 'success');
		} elseif($op == 'trash_add') {
			$id = intval($_GPC['id']);
			$order = get_order($id);
			if(empty($order)) {
				message('订单不存在或已经删除', referer(), 'error');
			}
			$isexist = pdo_fetchcolumn('SELECT uid FROM ' . tablename('str_user_trash') . ' WHERE uniacid = :uniacid AND sid = :sid AND uid = :uid', array(':uniacid' => $_W['uniacid'], ':sid' => $order['sid'], ':uid' => $order['uid']));
			if(!empty($isexist)) {
				message('该用户已经在黑名单中', referer(), 'error');
			}
			$data = array(
				'uniacid' => $_W['uniacid'],
				'sid' => $order['sid'],
				'uid' => $order['uid'],
				'username' => $order['username'],
				'mobile' => $order['mobile'],
				'addtime' => TIMESTAMP,
			);
			pdo_insert('str_user_trash', $data);
			message('添加到黑名单成功', referer(), 'success');
		} elseif($op == 'trash_list') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$condition = ' WHERE uniacid = :uniacid AND sid = :sid';
			$params = array(
				':uniacid' => $_W['uniacid'],
				':sid' => $sid,
			);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_user_trash') .  $condition, $params);
			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_user_trash') . $condition . ' ORDER BY addtime DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
			$pager = pagination($total, $pindex, $psize);
			include $this->template('trash');
		} elseif($op == 'trash_del') {
			$uid = intval($_GPC['uid']);
			pdo_delete('str_user_trash', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'uid' => $uid));
			message('从黑名单中移除成功', referer(), 'success');
		} elseif($op == 'comment_list') {
			load()->func('tpl');
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$condition = ' WHERE a.uniacid = :uniacid AND a.sid = :sid';
			$params = array(
				':uniacid' => $_W['uniacid'],
				':sid' => $sid,
			);
			$status = intval($_GPC['status']);
			if($status > 0) {
				$condition .= " AND a.status = :status";
				$params[':status'] = $status;
			}
			$oid = intval($_GPC['oid']);
			if($oid > 0) {
				$condition .= " AND a.oid = :oid";
				$params[':oid'] = $oid;
			}

			if(!empty($_GPC['addtime'])) {
				$starttime = strtotime($_GPC['addtime']['start']);
				$endtime = strtotime($_GPC['addtime']['end']) + 86399;
			} else {
				$starttime = strtotime('-15 day');
				$endtime = TIMESTAMP;
			}
			$condition .= " AND a.addtime > :start AND a.addtime < :end";
			$params[':start'] = $starttime;
			$params[':end'] = $endtime;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order_comment') . ' AS a '.  $condition, $params);
			$data = pdo_fetchall('SELECT a.*, b.uid,b.openid,b.addtime FROM ' . tablename('str_order_comment') . ' AS a LEFT JOIN ' . tablename('str_order') . ' AS b ON a.oid = b.id ' . $condition . ' ORDER BY a.addtime DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
			$pager = pagination($total, $pindex, $psize);
			include $this->template('comment');
		} elseif($op == 'comment_status') {
			$id = intval($_GPC['id']);
			pdo_update('str_order_comment', array('status' => intval($_GPC['status'])), array('uniacid' => $_W['uniacid'], 'id' => $id));
			message('设置评论状态成功', $this->createWebUrl('manage', array('op' => 'comment_list')), 'success');
		} elseif($op == 'orderdel') {
			$id = intval($_GPC['id']);
			pdo_delete('str_order', array('uniacid' => $_W['uniacid'], 'id' => $id));
			pdo_delete('str_stat', array('uniacid' => $_W['uniacid'], 'oid' => $id));
			pdo_delete('str_order_comment', array('uniacid' => $_W['uniacid'], 'oid' => $id));
			message('删除订单成功', $this->createWebUrl('manage', array('op' => 'order')), 'success');
		} elseif($op == 'print_post') {
			$id = intval($_GPC['id']);
			if($id > 0) {
				$item = pdo_fetch('SELECT * FROM ' . tablename('str_print') . ' WHERE uniacid = :uniacid AND id = :id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			} 
			if(empty($item)) {
				$item = array('status' => 1, 'print_nums' => 1, 'type' => 1);
			}
			if(checksubmit('submit')) {
				$data['type'] = intval($_GPC['type']); 
				$data['status'] = intval($_GPC['status']); 
				$data['name'] = !empty($_GPC['name']) ? trim($_GPC['name']) : message('打印机名称不能为空', '', 'error');
				$data['print_no'] = !empty($_GPC['print_no']) ? trim($_GPC['print_no']) : message('机器号不能为空', '', 'error');
				$data['key'] = trim($_GPC['key']);
				$data['print_nums'] = intval($_GPC['print_nums']) ? intval($_GPC['print_nums']) : 1;
				if(!empty($_GPC['qrcode_link']) && (strexists($_GPC['qrcode_link'], 'http://') || strexists($_GPC['qrcode_link'], 'https://'))) {
					$data['qrcode_link'] = trim($_GPC['qrcode_link']);
				}
				$data['print_header'] = trim($_GPC['print_header']);
				$data['print_footer'] = trim($_GPC['print_footer']);
				$data['uniacid'] = $_W['uniacid'];
				$data['sid'] = $sid;
				if(!empty($item) && $id) {
					pdo_update('str_print', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
				} else {
					pdo_insert('str_print', $data);
				}
				message('更新打印机设置成功', $this->createWebUrl('manage', array('op' => 'print_list')), 'success');
			}
			include $this->template('print');
		} elseif($op == 'print_list') {
			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_print') . ' WHERE uniacid = :uniacid AND sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
			include $this->template('print');
		} elseif($op == 'print_del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_print', array('uniacid' => $_W['uniacid'], 'id' => $id));
			message('删除打印机成功', referer(), 'success');
		} elseif($op == 'log_del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_order_print', array('uniacid' => $_W['uniacid'], 'id' => $id));
			message('删除打印记录成功', referer(), 'success');
		} elseif($op == 'print_log') {
			$id = intval($_GPC['id']);
			$item = pdo_fetch('SELECT * FROM ' . tablename('str_print') . ' WHERE uniacid = :uniacid AND id = :id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			if(empty($item)) {
				message('打印机不存在或已删除', $this->createWebUrl('manage', array('op' => 'print_list')), 'success');
			}
			if(!empty($item['print_no']) && !empty($item['key'])) {
				$wprint = new wprint();
				$status = $wprint->QueryPrinterStatus($item['print_no'], $item['key']);
				if(is_error($status)) {
					$status = '查询打印机状态失败。请刷新页面重试';
				}
			}
			$condition = ' WHERE a.uniacid = :aid AND a.sid = :sid AND a.pid = :pid';
			$params[':aid'] = $_W['uniacid']; 
			$params[':sid'] = $sid; 
			$params[':pid'] = $id; 
			if(!empty($_GPC['oid'])) {
				$oid = trim($_GPC['oid']);
				$condition .= ' AND a.oid = :oid';
				$params[':oid'] = $oid; 
			}
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order_print') . ' AS a ' . $condition, $params);
			$data = pdo_fetchall('SELECT a.*,b.username,b.mobile FROM ' . tablename('str_order_print') . ' AS a LEFT JOIN' . tablename('str_order') . ' AS b ON a.oid = b.id' . $condition . ' ORDER BY addtime DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, $params);
			$pager = pagination($total, $pindex, $psize);
			include $this->template('print');
		} elseif($op == 'ajaxprint') {
			$id = intval($_GPC['id']);
			$status = print_order($id, true);
			if(is_error($status)) {
				exit($status['message']);
			}
			exit('success');
		}
		if($op == 'clerk_post') {
			$accounts = uni_accounts();
			foreach($accounts as $k => $li) {
				if($li['level'] < 3) {
					unset($li[$k]);
				}
			}
			$notice_acid = pdo_fetchcolumn('SELECT notice_acid FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
			$id = intval($_GPC['id']);
			$clerk = get_clerk($id);
			
			if($_W['ispost']) {
				$insert['uniacid'] = $_W['uniacid'];
				$insert['sid'] = $sid;
				$insert['title'] = trim($_GPC['title']);
				$insert['nickname'] = trim($_GPC['nickname']);
				$insert['openid'] = trim($_GPC['openid']);
				$insert['email'] = trim($_GPC['email']);
				$insert['is_sys'] = intval($_GPC['is_sys']);
				if(empty($insert['openid']) && empty($insert['email'])) {
					exit('粉丝openid和店员邮箱必须填写一项');
				}
				if($id > 0) {
					pdo_update('str_clerk', $insert, array('uniacid' => $_W['uniacid'], 'id' => $id));
				} else {
					$insert['addtime'] = TIMESTAMP;
					pdo_insert('str_clerk', $insert);
				}
				exit('success');
			}
			include $this->template('clerk');
		}

		if($op == 'fetch_openid') {
			$acid = intval($_GPC['acid']);
			$nickname = trim($_GPC['nickname']);
			$openid = trim($_GPC['openid']);
			if(!empty($openid)) {
				$data = pdo_fetch('SELECT openid,nickname FROM ' . tablename('mc_mapping_fans') . ' WHERE uniacid = :uniacid AND acid = :acid AND openid = :openid ', array(':uniacid' => $_W['uniacid'], ':acid' => $acid, ':openid' => $openid));
			}
			if(empty($data)) {
				if(!empty($nickname)) {
					$data = pdo_fetch('SELECT openid,nickname FROM ' . tablename('mc_mapping_fans') . ' WHERE uniacid = :uniacid AND acid = :acid AND nickname = :nickname ', array(':uniacid' => $_W['uniacid'], ':acid' => $acid, ':nickname' => $nickname));
					if(empty($data)) {
						exit('error');
					} else {
						exit(json_encode($data));
					}
				} else {
					exit('error');
				}
			} else {
				exit(json_encode($data));
			}
		}

		if($op == 'clerk_list') {
			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_clerk') . ' WHERE uniacid = :aid AND sid = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
			include $this->template('clerk');
		}

		if($op == 'clerk_del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_clerk', array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'id' => $id));
			message('删除店员成功', referer(), 'success');
		}
	}

	//宏信物联打印机扫描接口
	public function doWebPrint() {
		global $_W, $_GPC;
		if(isset($_GPC['sta'])) {
			$id = intval($_GPC['id']);
			$status = intval($_GPC['sta']);
			if($id > 0) {
				$status = $status == 0 ? 1 : 2;
				pdo_update('str_order_print', array('status' => $status), array('id' => $id));
				return false;
			}
		}
		$usr = !empty($_GPC['usr']) ? trim($_GPC['usr']) : '';
		$ord = !empty($_GPC['ord']) ? trim($_GPC['ord']) : 'no';
		$sgn = !empty($_GPC['sgn']) ? trim($_GPC['sgn']) : 'no';
		hongx_print_echo($usr, $ord, $sgn);
	}
    //绩效排行
    public function doMobileRankList()
    {
        global $_W, $_GPC;
        $storeid = $_GPC['storeid'];
        $groupid = $_GPC['groupid'];
        $type = $_GPC['type'];
        $username = $_GPC['username'];
        $timezone    = "Asia/Shanghai";
        //绩效
        // 上月
        //上一个月第一天的时间戳
        $premonth = strtotime(date('Y-m-1', strtotime("-1 month")));
        //上一个月最后一天的时间戳
        $temptime = date('Y-m-1', strtotime("-1 month"));
        $premonthend = strtotime(date('Y-m-d 23:59:59', strtotime("$temptime +1 month -1 day")));
        // 本月
        $start = strtotime(date('Y-m-1', strtotime("0 month")));
        $temptime = date('Y-m-1 00:00:00', strtotime("0 month"));
        $end = strtotime(date('Y-m-d 23:59:59', strtotime("$temptime +1 month -1 day")));
            $title = '本月';
        if($type == 1){//上月  
            $title = '上月';
            $start = $premonth;
            $end = $premonthend;
        }
        // $start =0;//测试用
        if($groupid == 4){//服务员
        $myinfo= pdo_fetch("SELECT sum(a.price*a.total) as price,sum(a.total) as times,count(*) as usetime,b.title FROM `ims_weisrc_dish_order_goods` a left join ims_weisrc_dish_stores b on a.storeid =b.id WHERE a.step5man  ='".$username."' and a.step1 IS NOT NULL and  a.dateline between ".$start." and ".$end);
        //sum(a.step5-a.step1)/60 as usetime,count(*) as times,
        }else{
        $myinfo= pdo_fetch("SELECT sum(a.price*a.total) as price,sum(a.total) as times,count(*) as usetime,b.title FROM `ims_weisrc_dish_order_goods` a left join ims_weisrc_dish_stores b on a.storeid =b.id WHERE a.step1man  ='".$username."' and a.dateline between ".$start." and ".$end);
        //sum(a.step1-a.dateline)/60 as usetime,count(*) as times,
        }
        $myinfo['rate'] = $myinfo['price']*$myinfo['times']/$myinfo['usetime'];
        //分组 
        $groupUsers = pdo_fetchall('select realname,storeid from ims_j_money_user where pcate = '.$groupid);
        foreach($groupUsers as $key=> $val){
            if($groupid == 4){//服务员
            // $myinfo= pdo_fetch("SELECT sum(a.price*a.total) as price,sum(a.step5-a.step1)/60 as usetime,count(*) as times,b.title FROM `ims_weisrc_dish_order_goods` a left join ims_weisrc_dish_stores b on a.storeid =b.id WHERE a.step5man  ='".$username."' and a.step1 IS NOT NULL and  a.dateline between ".$start." and ".$end);
                $groupUsers[$key]['info']=pdo_fetch("SELECT sum(a.price*a.total) as price,sum(a.total) as times,count(*) as usetime,b.title FROM `ims_weisrc_dish_order_goods` a left join ims_weisrc_dish_stores b on a.storeid = b.id WHERE a.step5man = '".$val['realname']."' and a.step1 IS NOT NULL and  a.dateline between ".$start." and ".$end);
            }else{
                $groupUsers[$key]['info']=pdo_fetch("SELECT sum(a.price*a.total) as price,sum(a.step1-a.dateline)/60 as usetime,count(*) as times,b.title FROM `ims_weisrc_dish_order_goods` a left join ims_weisrc_dish_stores b on a.storeid = b.id WHERE a.step1man = '".$val['realname']."' and a.dateline between ".$start." and ".$end);
            }
            $groupUsers[$key]['rate'] = $groupUsers[$key]['info']['price']*$groupUsers[$key]['info']['times']/$groupUsers[$key]['info']['usetime'];
        }
        $rateCount = array();
        foreach($groupUsers as $user){
            $rateCount[] = $user['rate'];
        }
        array_multisort($rateCount,SORT_DESC, $groupUsers);
        include $this->template($this->cur_tpl . '/ranklist');
    }

//商品列表
	public function doMobileList() {
		global $_W, $_GPC;
		$logid = $_GPC['erpuid'];
		$locationId = $_GPC['location'];
		if(empty($logid)) {
			message('未授权', '', 'error');
		}
		$status = $_GPC['status'];
		if(!empty($_GPC['f'])) {
			$uid = $_GPC['erpuid'];
			del_order_carts($uid);	
		}
		// var_dump($logid);
		// $select = ''
		// //获取购物车的信息
		// $cart = get_order_cart($sid);
		//一级菜单
		// $categorys = pdo_fetchall('SELECT name, id FROM ci_category WHERE status=1 and level=1 and parentId=0 and typeNumber="trade" and id NOT IN (30,31)');//17.2.7隐藏桌椅等类
		//二级菜单
		$categorys = pdo_fetchall('SELECT name, id FROM ci_category WHERE status=1 and level=2 and parentId >0 and typeNumber="trade"');

		$dish = pdo_fetchall('SELECT g.*,sum(i.qty) as qty FROM ci_goods as g join ci_invoice_info as i on g.id=i.invId WHERE status = 1 AND i.locationId = 2 '.$selects.' GROUP BY invId ORDER BY id ASC');
		$cate_dish = array();
		foreach($dish as $di) {
			$cate_dish[$di['categoryId']][] = $di;
			//本店库存17.1.24
			foreach ($cate_dish[$di['categoryId']] as $key => $value) {
			    $cate_dish[$di['categoryId']][$key]['now'] = pdo_fetch('SELECT ifnull(sum(qty),0) as nowqty FROM ci_invoice_info WHERE locationId = '.$locationId.' AND invId='.$value['id']);
		    }
			// $dish['qty'] = round($di['qty'],2);
		}
		include $this->template('list');
	}

//门店自购
	public function doMobileZigou() {
		global $_W, $_GPC;
		$weid = $this->_weid;
		$uid = $_GPC['erpuid'];
		// var_dump($uid);
		$logid = $_GPC['logid'];
		$storeid = $_GPC['storeid'];
		$store = $_GPC['store'];
		$locationId = $_GPC['location'];
		if(empty($logid)){
			$loginurl = "index.php?i=".$weid."&c=entry&do=index&m=j_money";
			message('未授权',$loginurl, 'error');
		}
		$status = $_GPC['status'];
		if(!empty($_GPC['f'])) {
			$uid = $_GPC['erpuid'];
			del_order_carts($uid);	
		}
		$transTypeName = '门店自购';
		if($status==4){
			$transTypeName = '员工餐消耗';
		}
		if($status==5){
			$transTypeName = '门店报损';
		}
				
		// var_dump($selects);
		// $select = ''
		// //获取购物车的信息
		// $cart = get_order_cart($sid);
		//一级菜单
		// $categorys = pdo_fetchall('SELECT name, id FROM ci_category WHERE status=1 and level=1 and parentId=0 and typeNumber="trade" and id NOT IN (30,31)');//17.2.7隐藏桌椅等类
		//二级菜单
		$categorys = pdo_fetchall('SELECT name, id FROM ci_category WHERE status=1 and level=2 and parentId >0 and typeNumber="trade"');

		$dish = pdo_fetchall('SELECT * FROM ci_goods  WHERE status = 1 ORDER BY id ASC');
		$cate_dish = array();
		foreach($dish as $di) {
			$cate_dish[$di['categoryId']][] = $di;
			//本店库存17.1.24
			foreach ($cate_dish[$di['categoryId']] as $key => $value) {
			    $cate_dish[$di['categoryId']][$key]['now'] = pdo_fetch('SELECT ifnull(sum(qty),0) as nowqty FROM ci_invoice_info WHERE locationId = '.$locationId.' AND invId='.$value['id']);
		    }
			// $dish['qty'] = round($di['qty'],2);
		}
		include $this->template('zigou');
	}

//财务报表
	public function doMobileReport() {
		global $_W, $_GPC;
		$weid = $this->_weid;
		$id = $_GPC['id'];//店id
		$logid = $_GPC['logid'];
		$store = $_GPC['store'];
		$location = pdo_fetch('SELECT * FROM  `ci_storage` where name ="'.$store.'"');
		$year = date('Y');
        $month =date('m');
		for($i=1;$i<=$month;$i++){
			if($i<10){
				$list[$i]['index'] ='0'.$i;
			}else{
				$list[$i]['index'] =$i;
			}
			
		}
		include $this->template('report');
	}
	public function doMobileGongying() {
		global $_W, $_GPC;
		$weid = $this->_weid;
		$id = $_GPC['id'];
		$locationid = $_GPC['locationid'];
		$store = $_GPC['store'];
// var_dump($locationid);
		$year =$_GPC['year'];
        $month =$_GPC['month'];
        $num = $this->getMonthLastDay($month, $year);
        $thismonth = date('m');//当月至今天数
        $gongying = pdo_fetchall('SELECT id,name FROM ci_contact  WHERE   `cCategoryName` LIKE  "门店采购"');//buId 供应商
       // date('Y-m-d',time()) 当前时间
        // $num = date('d');//当月至今天数
//todo 加billtype, 
        foreach ($gongying as $key => $value) {
	        for($i=1;$i<=$num;$i++){
	            $day = $year.'-'.$month.'-'.$i;
	            $gongying[$key]['cost'][$i]['cost'] = pdo_fetch('SELECT sum(totalAmount) as total FROM ci_invoice WHERE billType = "PUR" and billDate ="'.$day.'" and buId = '.$value['id'].' and locationId = '.$locationid);
	            $total[$key]['cost'][$i]['day'] =$i;
	        }
	        $gongying[$key]['total'] = pdo_fetch('SELECT sum(totalAmount) as total FROM ci_invoice WHERE  billType = "PUR" and billDate like"%'.$year."-".$month.'%" and  buId = '.$value['id'].' and locationId = '.$locationid);//billDate ="'.$day.'" and
        }
      
		include $this->template('gongying');
	}



	public function doMobileLirun() {
		global $_W, $_GPC;
		$weid = $this->_weid;
		$id = $_GPC['id'];
		$logid = $_GPC['logid'];
		$store = $_GPC['store'];
		$storeid = $_GPC['sid'];
		$locationid = $_GPC['locationid'];
		$year = date('Y');
        $month =date('m');
        // $year =$_GPC['year'];
        // $month =$_GPC['month'];
        // $num = $this->getMonthLastDay($month, $year);
        $yearStart =  strtotime($year.'-1');
        // $num = date('d');	//当月至今天数
        for($i=1;$i<=$month;$i++){
         	$start = strtotime($year.'-'.$i);
         	$start +=10800;
         	$nextmon = $i+1;
         	$end = strtotime($year.'-'.$nextmon);
         	$end +=10800;
			//主营业务收入
			//减：jinhuo成本
			//减：燃气
			//减：酒水饮料成本
	        //营业费用
		 	 $lirun[$i]['shou'] =  pdo_fetch('SELECT sum(total_fee-coupon_fee)/100 as total FROM `ims_j_money_trade` WHERE createtime between '.$start.' and '.$end.'  and storeid ='.$storeid);
		 	 $lirun[$i]['title'] =  pdo_fetchall('SELECT title FROM `ims_weisrc_dish_selfill_text` WHERE 1 group by title');
		 	 $lirun[$i]['feiyong'] =  pdo_fetchall('SELECT sum(price) as price, title FROM `ims_weisrc_dish_selfill_text` WHERE   storeid ='.$storeid.' and dateline between '.$start.' and '.$end.' group by title');
		 	 $lirun[$i]['feiyong']['all'] =  pdo_fetch('SELECT sum(price) as total FROM `ims_weisrc_dish_selfill_text`  WHERE  dateline between '.$start.' and '.$end.' and storeid ='.$storeid);
       	}
        //storeid='.$storeid.' AND createtime>='.$start.' and createtime<'.$end
        // date('Y-m-d',time()) 当前时间
        // 本月
		include $this->template('lirun');
	}

	public function doMobileShouzhi() {
		global $_W, $_GPC;
		$weid = $this->_weid;
		$id = $_GPC['id'];
		$logid = $_GPC['logid'];
		$store = $_GPC['store'];
		$storeid = $_GPC['sid'];

        $year =$_GPC['year'];
        $month =$_GPC['month'];
        $num = $this->getMonthLastDay($month, $year);  
        // 本月
          for($i=1;$i<=$num;$i++){
          	$start = strtotime($year.'-'.$month.'-'.$i);
         	$start +=10800;
         	$end = $start + 86400;
          	$list[$i]['money'] = $this->tongji($storeid,$start,$end);
          	$list[$i]['day'] = $month."-".$i;
          }
		include $this->template('shouzhi');
	}

//获取 某个月的最大天数（最后一天）
function getMonthLastDay($month, $year) {
    switch ($month) {
        case 4 :
        case 6 :
        case 9 :
        case 11 :
            $days = 30;
            break;
        case 2 :
            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    $days = $year % 400 == 0 ? 29 : 28;
                } else {
                    $days = 29;
                }
            } else {
                $days = 28;
            }
            break;
 
        default :
            $days = 31;
            break;
    }
    return $days;
}

 //统计
    public function tongji($storeid,$starttime,$endtime){
        global $_GPC, $_W;
        //条件
        if($storeid ==0){//等于0则查出所有店的
            $store = " storeid >0";
        }else{
            $store = " storeid =".$storeid;
        }
		$where = $store." and createtime between ".$starttime." and ".$endtime;
		//总人数
	    $data['people']= pdo_fetch('SELECT sum(counts) as total from ims_weisrc_dish_order where status =2 and ispay =1  and  storeid ='.$storeid." and dateline between ".$starttime." and ".$endtime);
	    // var_dump($data['people']);

        //微信 weixin
	    $data['weixin']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =0 and '.$where.') b' );
	    $weixin1= pdo_fetch('SELECT sum(weixin) as total from ims_j_money_trade where  '.$where);
	    $data['weixin']['total']+=$weixin1['total'];

        //支付宝 alipay
        $data['alipay']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =1 and '.$where.') b' );
        $alipay1= pdo_fetch('SELECT sum(alipay) as total from ims_j_money_trade where  '.$where);
        $data['alipay']['total']+=$alipay1['total'];

        // //现金 cash
        $data['cash']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =3 and '.$where.') b' );
        $cash1= pdo_fetch('SELECT sum(cash) as total from ims_j_money_trade where  '.$where);
        $data['cash']['total'] += $cash1['total'];

        // //刷卡 paycard
        $data['paycard']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =4 and '.$where.') b' );
        $paycard1= pdo_fetch('SELECT sum(paycard) as total from ims_j_money_trade where  '.$where);
        $data['paycard']['total']+=$paycard1['total'];

        // //闪惠 shanhui
        // $data['shanhui']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from ims_j_money_trade where paytype =5 and  '.$where);

        $data['shanhui']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =5 and '.$where.') b' );

        // //美团 meituan
        $data['meituan']= pdo_fetch('SELECT sum(cash_fee) as total,count(*) as num from (select DISTINCT orderid,cash_fee from ims_j_money_trade where paytype =2 and '.$where.') b' );
        $paycard1= pdo_fetch('SELECT sum(daijinquan)*100 as total from ims_j_money_trade where  '.$where);
        $data['meituan']['total']+=$paycard1['total'];

        //总
        $total= pdo_fetch('SELECT sum(total_fee) as total,count(*) as num from ims_j_money_trade where '.$where);
        $data['all']['total_fee'] = $total['total'];//应收
        $data['all']['total'] = $data['weixin']['total']+$data['alipay']['total']+$data['cash']['total']+$data['paycard']['total']+$data['shanhui']['total']+$data['meituan']['total'];//实收
        $data['all']['num'] = $total['num'];
        return $data;
    }

	//门店库存查询
	public function doMobileStock() {
		global $_W, $_GPC;
		$storeid = $_GPC['storeid'];
		$locationId = $_GPC['location'];
		$logid = $_GPC['logid'];
		
		$store = $_GPC['store'];
		$storeinfo = pdo_fetch('select * from ci_storage where id = '.$locationId);
		// var_dump($storeinfo);
		
		$lId = $storeinfo['id'];
		// var_dump($storeid);
		//关联本店进销存id
		if(!empty($logid)) {
			// $members = pdo_fetch('SELECT u.realname,s.title FROM ' . tablename('j_money_user') . ' as u join ' . tablename('weisrc_dish_stores') . ' as s ON u.storeid = s.id WHERE u.storeid='.$storeid.' AND u.useracount='.$logid);
			// $users = pdo_fetch('SELECT c.id,c.name,d.id AS locationId FROM ci_contact AS c JOIN ci_storage AS d ON c.number=d.locationNo WHERE c.name="'.$members['title'].'"');
   //          // var_dump($users);
			// $_SESSION['linkname'] = $members['realname'];//联系人
		 //    $_SESSION['realname'] = $users['name'];//店名
		 //    $_SESSION['uid'] = $users['id'];
		}
		//end
		$cid = $_GPC['cid'];//分类搜索id
		if (!empty($cid)){
			$wheres = 'AND g.categoryId ='.$cid;
		}
		
		//类别(二级) and level=2 and parentId >0 
		$category = pdo_fetchall('SELECT name, id FROM ci_category WHERE status=1 and typeNumber="trade"');
        // var_dump($category);

		$goods = pdo_fetchall('SELECT g.id,g.name,g.number,g.spec,g.costUnitId,g.costName,g.unitName,g.categoryId,sum(i.qty) as qty FROM ci_goods as g join ci_invoice_info as i on g.id=i.invId WHERE i.locationId = '.$locationId.' '.$wheres.' GROUP BY invId ORDER BY id ASC');
		// var_dump($goods);
		$cate_goods = array();
		foreach($goods as $gd) {
			$cate_goods[$gd['categoryId']][] = $gd;
			// $dish['qty'] = round($di['qty'],2);
		}

		include $this->template('stock');
	}

//购物车
	public function doMobileOrderlist() {
		global $_W, $_GPC;
		$uid = $_GPC['erpuid'];
		// var_dump($uid);
		$locationId = $_GPC['location'];
		$status = $_GPC['status'];

		//购物车
		$cart = set_order_carts($uid);
		if(is_error($cart)) {
			message($cart.message, '', 'error');
		}
		$dishes = $cart['data'];//商品id与数量
		// $dishes2 = $_GPC['dishes'];//商品id与数量
		$prices = $_GPC['price'];//商品id与价格
		 // var_dump($prices);
		$is_add = 0;
		// $recommend = pdo_fetchall('SELECT id FROM ci_goods WHERE uniacid = :uniacid AND sid = :sid AND recommend = 1 AND is_display = 1', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), id);
		// $add = array_keys($recommend);
		$add_arr = array_diff($add, array_keys($dishes));
		// if(!empty($add_arr)) {
		// 	$is_add = 1;
		// 	$add_str = implode(',', $add_arr);
		// 	$dish_add = pdo_fetchall('SELECT * FROM ci_goods WHERE id IN ($add_str)', 'id');
		// }
		if(!empty($dishes)) {
			$ids_str = implode(',', array_keys($dishes));
			// $dish_info = pdo_fetchall('SELECT g.*,sum(i.qty) as qty FROM ci_goods as g join ci_invoice_info as i on g.id=i.invId WHERE g.id IN ('.$ids_str.') AND i.locationId =2 GROUP BY invId');
		$dish_info = pdo_fetchall('SELECT * FROM ci_goods  WHERE id IN ('.$ids_str.') ORDER BY id ASC');
		// var_dump($dish_info);
		}
		include $this->template('orderlist');
	}

//门店申请
	public function doMobileOrderConfirms() {
		global $_W, $_GPC;
		$status = $_GPC['status'];
		// checkauth();
		if(!$_W['isajax']) {
			$uid = $_GPC['erpuid'];
			$realname = $_GPC['realname'];
			$storeTitle = $_GPC['storeTitle'];
			// $return = intval($_GPC['r']);
			// if(empty($return)) {
			// 	$cart = set_order_carts($uid);
			// } else {
				$cart = get_order_carts($uid);
				$dishes = $_GPC['dish'];//商品id与价格
				$prices = $_GPC['prices'];//商品id与价格
				$total = 0;
				foreach ($prices as $key => $value) {
					$total += $value*$dishes[$key];
				}
				 // var_dump($total);
			// }
			if(empty($cart['data'])) {
				message('订单信息出错'.$uid, '', 'error');
			}
		} else {
			$uid = intval($_GPC['erpuid']);
			$storeid = $_GPC['storeid'];
			$lId = $_GPC['location'];
			$status = $_GPC['status'];
			$out['errno'] = 1;
			$out['error'] = '';
			if(empty($dish)) {
				$out['errno'] = 1;
				$out['error'] = '订单信息不存在或已失效';
			}
			$orderSn = 'XSDD'.date('YmdHis'). sprintf('%d', rand(0, 9));//订单号
			if($status>=3){
				$cart = get_order_carts($uid);
				if($cart['num'] == 0) {
					$out['errno'] = 1;
					$out['error'] = '菜品为空';
					exit(json_encode($out));
				}
				
				$transTypeName = '门店自购';
				$orderSn = 'PUR'.date('YmdHis'). sprintf('%d', rand(0, 9));//订单号
				if($status==4){
					$orderSn = 'XS'.date('YmdHis'). sprintf('%d', rand(0, 9));//订单号
					$transTypeName = '员工餐消耗';
				}
				if($status==5){
					$orderSn = 'XS'.date('YmdHis'). sprintf('%d', rand(0, 9));//订单号
					$transTypeName = '门店报损';
				}
				if($status==3){
					$billType = 'PUR';
					$totalAmount =  $_GPC['total'];
				}else{
					$billType = 'SALE';
					$totalAmount = $cart['price'];
				}

				//自购货单表
				$invo = array(
					'buId' => $uid,//供货商
					'billNo' => $orderSn,//单据编号
					'uid' => $uid,
					'username' => $_GPC['person_num'],
					'transType' => '150501',//购货
					'description' => trim($_GPC['note']),//备注
					'transTypeName' => $transTypeName,
					'description' => $transTypeName,
					'locationId' => $lId,
					// 'billStatus' => 2,
					'checked' => 1,
							'totalAmount' => $totalAmount,
							'billType' => $billType,
					'modifyTime' => date('Y-m-d H:i:s'),
					'createtime' => date('Y-m-d H:i:s'),
					'postData' => iserializer($invo),
					'billDate' => date('Y-m-d'),
					);
				
				pdo_inserts('ci_invoice', $invo);
				$id = pdo_insertid();
				if(!empty($cart['data'])) {
					$ids_str = implode(',', array_keys($cart['data']));
					$dish_info = pdo_fetchall('SELECT id,name,salePrice FROM ci_goods WHERE 1 = :sid AND id IN ('.$ids_str.')', array(':sid' => 1), 'id');
				}
				//自购货商品表
				foreach($cart['data'] as $k => $v) {
					$k = intval($k);
					$v = intval($v);
					$stats = array();
					if($k && $v) {
						$stats['iid'] = $id;
						$stats['invId'] = $dish_info[$k]['id'];
						$stats['buId'] = $uid;
						$stats['billNo'] = $orderSn;
						$stats['transType'] = '150501';
						$stats['amount'] = ($dish_info[$k]['salePrice']*$v);
						$stats['billDate'] = date('Y-m-d');
						// $stats['description'] = trim($_GPC['note']);
						if($status==3){
							$stats['qty'] = $v;
							$stats['price'] = $_GPC['prices'][$dish_info[$k]['id']];
							$stats['billType'] = 'PUR';
						}else{
							$stats['qty'] = -$v;
							$stats['price'] = $dish_info[$k]['salePrice'];
							$stats['billType'] = 'SALE';
						}
						$stats['locationId'] = $lId;
						$stats['uid'] = $uid;
						$stats['srcOrderEntryId'] = 0;
						$stats['skuId'] = -1;
						$stats['transTypeName'] = $transTypeName;
						// $stat['addtime'] = TIMESTAMP;
						pdo_inserts('ci_invoice_info', $stats);
					}
				}
			}else{
				$data['buId'] = $uid;
				$data['billNo'] = $orderSn;//单据编号
				$data['uid'] = $uid;
				$data['username'] = $_GPC['person_num'];
				$data['transType'] = $status == 1 ? '150602' : '150601';//购货
				$data['description'] = trim($_GPC['note']);
				$data['transTypeName'] = $status == 1 ? '退货' : '订货';
				$cart = get_order_carts($uid);
				if($cart['num'] == 0) {
					$out['errno'] = 1;
					$out['error'] = '菜品为空';
					exit(json_encode($out));
				}
				$data['totalQty'] = $cart['num'];
				$data['totalAmount'] = $status == 1 ? -$cart['price'] : $cart['price'];
				$data['modifyTime'] = date('Y-m-d H:i:s');
				$data['deliveryDate'] = date('Y-m-d');
				$data['billType'] = 'SALE';
				$data['postData'] = iserializer($data);
				$data['billDate'] = date('Y-m-d');
				pdo_inserts('ci_order', $data);
				$id = pdo_insertid();
				if(!empty($cart['data'])) {
					$ids_str = implode(',', array_keys($cart['data']));
					$dish_info = pdo_fetchall('SELECT id,name,salePrice,locationId FROM ci_goods WHERE 1 = :sid AND id IN ('.$ids_str.')', array(':sid' => 1), 'id');
				}
				foreach($cart['data'] as $k => $v) {
					$k = intval($k);
					$v = intval($v);
					// pdo_query('UPDATE ' . tablename('str_dish') . " set sailed = sailed + {$v} WHERE uniacid = :aid AND id = :id", array(':aid' => $_W['uniacid'], ':id' => $k));
					$stat = array();
					if($k && $v) {
						$stat['iid'] = $id;
						$stat['invId'] = $dish_info[$k]['id'];
						$stat['buId'] = $uid;
						$stat['billNo'] = $orderSn;
						$stat['transType'] = $status == 1 ? '150602' : '150601';
						$stat['amount'] = $status == 1 ? -($dish_info[$k]['salePrice']*$v) : ($dish_info[$k]['salePrice']*$v);
						$stat['billDate'] = date('Y-m-d');
						// $stat['description'] = trim($_GPC['note']);
						$stat['price'] = $dish_info[$k]['salePrice'];
						$stat['qty'] = $status == 1 ? $v : -$v;
						$stat['locationId'] = $dish_info[$k]['locationId'];
						$stat['uid'] = $uid;
						$stat['skuId'] = -1;
						$stat['transTypeName'] = $status == 1 ? '退货' : '订货';
						$stat['billType'] = 'SALE';
						// $stat['addtime'] = TIMESTAMP;
						pdo_inserts('ci_order_info', $stat);
					}
				}
			}
            
			//是否打印订单
			// init_print_order($sid, $id, 'order');
			//微信邮件通知
			//init_notice_order($sid, $id, 'order');
			del_order_carts($uid);
			if($id) {
				$out['errno'] = 0;
				$out['url'] = $this->createMobileUrl('orderdetails', array('id' => $id,'uid' => $uid,'storeid' => $storeid,'lId' => $lId,'state' => $status ));
			} else {
				$out['errno'] = 1;
				$out['error'] = '保存订单失败';
			}
			exit(json_encode($out));
		}
		include $this->template('orderconfirms');
	}
//我的订单
	public function doMobileMyorders() {
		global $_W, $_GPC;
		$uid = $_SESSION['uid'];

		$where = ' WHERE uid = :uid ';
		$params = array(
			':uid' => $uid,
		);
		$status = intval($_GPC['status']);
		$checked = intval($_GPC['checked']);

		if($status >= 0 && $checked >= 0 ) {
			$where .= ' AND billStatus = :status AND checked = :checked';
			$params[':status'] = $status;
			$params[':checked'] = $checked;
		} 

		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;

		$limit = ' ORDER BY modifyTime DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ci_order' . $where, $params);
		$data = pdo_fetchall('SELECT * FROM ci_order' . $where . $limit, $params);
		// var_dump($uid);
		$pager = pagination($total, $pindex, $psize, '', array('before' => 0, 'after' => 0));
		include $this->template('myorders');
	}
//订单详情
	public function doMobileOrderDetails() {
		global $_W, $_GPC;
		$oid = $_GPC['id'];
		$uid = $_SESSION['uid'];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$orderid = $_GPC['orderid'];
			$imageurl = $_GPC['imageurl'];
			if(!empty($imageurl)){
				pdo_fetch('UPDATE ci_order SET photo="'.$imageurl.'" WHERE id='.$orderid);
			}else{
				message("请选择图片");
			}
			
		}
		$order = pdo_fetch('SELECT * FROM ci_order WHERE uid = :uid AND id = :id', array(':uid' => $uid, ':id' => $oid));
		if(empty($order)) {
$url ='index.php?i=1&c=entry&do=operalist&storeid=&m=weisrc_dish';
message('操作成功！', $url, 'success');
		//	message('订单信息不存在', '', 'error');//销货单
		}
		$order_info = pdo_fetchall('SELECT ABS(i.qty) as qty,g.name,g.unitName,g.spec FROM ci_order_info as i join ci_goods as g on i.invId=g.id WHERE i.iid='.$order['id']);
		$pay_types = pay_types();
		$order['dish'] = get_dish($order['id']);
		//上传图片
		
		include $this->template('orderdetails');
	}

	public function doMobileIndex() {
		global $_W, $_GPC;
		$config = get_config();
		if($config['version'] == 2) {
			$sid = pdo_fetchcolumn('SELECT id FROM ' . tablename('str_store') . ' WHERE uniacid = :uniacid AND status = 1 ORDER BY displayorder DESC', array(':uniacid' => $_W['uniacid']));
			if(!$sid) {
				message('没有有效的门店');
			} else {
				header('location: ' . $this->createMobileUrl('dish', array('sid' => $sid)));
				exit();
			}
		}
		if($config['area_search'] == 1) {
			$area = get_area();
		}
		$pindex = max(1, intval($_GPC['page']));
		$psize = 100;
		$key = trim($_GPC['key']);
		$condition = ' WHERE uniacid = :aid AND status = 1';
		$params[':aid'] = $_W['uniacid'];
		if(!empty($key)) {
			$condition .= " AND title LIKE '%{$key}%'";
		}
		$area_id = intval($_GPC['aid']);
		if(!empty($area_id) && $config['area_search'] == 1) {
			$condition .= " AND area_id = :area_id";
			$params[':area_id'] = $area_id;
		}
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_store') . $condition, $params);
		$data = pdo_fetchall('SELECT * FROM ' . tablename('str_store') . $condition . ' ORDER BY displayorder DESC LIMIT ' . (($pindex - 1) * $psize) . ', ' . $psize, $params);
		$str = '';
		if(!empty($data)) {
			foreach($data as &$dca) {
				$dca['business_hours_flag'] = 0;
				$dca['business_hours'] = iunserializer($dca['business_hours']);
				if(is_array($dca['business_hours'])) {
					foreach($dca['business_hours'] as $li) {
						$li_s_tmp = explode(':', $li['s']); //开始时间
						$li_e_tmp = explode(':', $li['e']); //结束时间
						$s_timepas = mktime($li_s_tmp[0], $li_s_tmp[1]);
						$e_timepas = mktime($li_e_tmp[0], $li_e_tmp[1]);
						$now = TIMESTAMP;
						if($now >= $s_timepas && $now <= $e_timepas) {
							$dca['business_hours_flag'] = 1;
							break;
						}
					}
				}
			}
		}			
		$pager = pagination($total, $pindex, $psize, '', array('before' => 0, 'after' => 0));
		include $this->template('index');
	}

	public function doMobileDish() {
		global $_W, $_GPC;
		$sid = intval($_GPC['sid']);
		// checkauth();
		// checkclerk($sid);
		// check_trash($sid);
		$store = pdo_fetch('SELECT title,logo,id,content,delivery_price,business_hours,send_price,dish_style,is_meal,is_takeout,comment_status,notice FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		$title = $store['title'];
		$_share = get_share($store);
		if($store['comment_status'] == 1) {
			$comment_stat = comment_stat($sid);
		}
		$store['business_hours_flag'] = 0;
		$store['business_hours'] = iunserializer($store['business_hours']);
		if(is_array($store['business_hours'])) {
			$hour_str = '';
			foreach($store['business_hours'] as $li) {
				$hour_str .= $li['s'] . '~' . $li['e'] . '、';
				$li_s_tmp = explode(':', $li['s']); //开始时间
				$li_e_tmp = explode(':', $li['e']); //结束时间
				$s_timepas = mktime($li_s_tmp[0], $li_s_tmp[1]);
				$e_timepas = mktime($li_e_tmp[0], $li_e_tmp[1]);
				$now = TIMESTAMP;
				if(!$store['business_hours_flag']) {
					if($now >= $s_timepas && $now <= $e_timepas) {
						$store['business_hours_flag'] = 1;
					}
				}
			}
			$hour_str = trim($hour_str, '、');
		}

		if(empty($store)) {
			message('门店信息不存在', $this->createMobileUrl('index'), 'error');
		}
		if(!empty($_GPC['f'])) {
			del_order_cart($sid);
		}
		//获取购物车的信息
		$cart = get_order_cart($sid);
		$category = pdo_fetchall('SELECT title, id FROM ' . tablename('str_dish_category') . ' WHERE uniacid = :aid AND sid = :sid ORDER BY displayorder DESC, id ASC', array(':aid' => $_W['uniacid'], ':sid' => $sid));
		$dish = pdo_fetchall('SELECT * FROM ' . tablename('str_dish') . ' WHERE uniacid = :aid AND sid = :sid AND is_display = 1 ORDER BY displayorder DESC, id ASC', array(':aid' => $_W['uniacid'], ':sid' => $sid));
		$cate_dish = array();
		foreach($dish as $di) {
			$cate_dish[$di['cid']][] = $di;
		}
		include $this->template('dish');
	}

	public function doMobileAjaxDish() {
		global $_W, $_GPC;
		$sid = intval($_GPC['sid']);
		$cid = intval($_GPC['cid']);
		$store = pdo_fetch('SELECT delivery_price,business_hours,send_price FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		$store['business_hours_flag'] = 0;
		$store['business_hours'] = iunserializer($store['business_hours']);
		if(is_array($store['business_hours'])) {
			$hour_str = '';
			foreach($store['business_hours'] as $li) {
				$hour_str .= $li['s'] . '~' . $li['e'] . '、';
				$li_s_tmp = explode(':', $li['s']); //开始时间
				$li_e_tmp = explode(':', $li['e']); //结束时间
				$s_timepas = mktime($li_s_tmp[0], $li_s_tmp[1]);
				$e_timepas = mktime($li_e_tmp[0], $li_e_tmp[1]);
				$now = TIMESTAMP;
				if(!$store['business_hours_flag']) {
					if($now >= $s_timepas && $now <= $e_timepas) {
						$store['business_hours_flag'] = 1;
					}
				}
			}
			$hour_str = trim($hour_str, '、');
		}
		//获取购物车的信息
		$cart = get_order_cart($sid);
		$category = pdo_fetch('SELECT title, id FROM ' . tablename('str_dish_category') . ' WHERE uniacid = :aid AND sid = :sid AND id = :id', array(':aid' => $_W['uniacid'], ':sid' => $sid, ':id' => $cid));
		$dish = pdo_fetchall('SELECT * FROM ' . tablename('str_dish') . ' WHERE uniacid = :aid AND sid = :sid AND cid = :cid AND is_display = 1 ORDER BY displayorder DESC, id ASC', array(':aid' => $_W['uniacid'], ':sid' => $sid, ':cid' => $cid));
		include $this->template('dish_model');
		exit();
	}
	public function doMobileStore() {
		global $_W, $_GPC;
		$sid = intval($_GPC['sid']);
		checkclerk($sid);
		check_trash($sid);
		$store = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		$title = $store['title'];
		$_share = get_share($store);
		$store['thumbs'] = iunserializer($store['thumbs']);
		$store['business_hours_flag'] = 0;
		$store['business_hours'] = iunserializer($store['business_hours']);
		if(is_array($store['business_hours'])) {
			$hour_str = '';
			foreach($store['business_hours'] as $li) {
				$hour_str .= $li['s'] . '~' . $li['e'] . '、';
				$li_s_tmp = explode(':', $li['s']); //开始时间
				$li_e_tmp = explode(':', $li['e']); //结束时间
				$s_timepas = mktime($li_s_tmp[0], $li_s_tmp[1]);
				$e_timepas = mktime($li_e_tmp[0], $li_e_tmp[1]);
				$now = TIMESTAMP;
				if(!$store['business_hours_flag']) {
					if($now >= $s_timepas && $now <= $e_timepas) {
						$store['business_hours_flag'] = 1;
					}
				}
			}
			$hour_str = trim($hour_str, '、');
		}
		$store['address'] = str_replace('+', '', $store['distirct']) . $store['address'];
		include $this->template('store');
	}

	public function doMobileOrder() {
		global $_W, $_GPC;
		checkauth();
		$sid = intval($_GPC['sid']);
		checkclerk($sid);
		check_trash($sid);
		$store = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		$title = $store['title'];
		$_share = get_share($store);
		if(empty($store)) {
			message('门店不存在', '', 'error');
		}
		//购物车
		$cart = set_order_cart($sid);
		if(is_error($cart)) {
			message($cart.message, '', 'error');
		}
		$dishes = $cart['data'];
		//提醒客户需要点的菜品（比如：米饭）
		$is_add = 0;
		$recommend = pdo_fetchall('SELECT id FROM ' . tablename('str_dish') . ' WHERE uniacid = :uniacid AND sid = :sid AND recommend = 1 AND is_display = 1', array(':uniacid' => $_W['uniacid'], ':sid' => $sid), id);
		$add = array_keys($recommend);
		$add_arr = array_diff($add, array_keys($dishes));
		if(!empty($add_arr)) {
			$is_add = 1;
			$add_str = implode(',', $add_arr);
			$dish_add = pdo_fetchall('SELECT * FROM ' . tablename('str_dish') ." WHERE uniacid = :aid AND sid = :sid AND id IN ($add_str)", array(':aid' => $_W['uniacid'], ':sid' => $sid), 'id');
		}
		if(!empty($dishes)) {
			$ids_str = implode(',', array_keys($dishes));
			$dish_info = pdo_fetchall('SELECT * FROM ' . tablename('str_dish') ." WHERE uniacid = :aid AND sid = :sid AND id IN ($ids_str)", array(':aid' => $_W['uniacid'], ':sid' => $sid), 'id');
		}
		include $this->template('order');
	}
	public function doMobileOrderConfirm() {
		global $_W, $_GPC;
		checkauth();
		if(!$_W['isajax']) {
			$sid = intval($_GPC['sid']);
			$return = intval($_GPC['r']);
			checkclerk($sid);
			$store = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
			$title = $store['title'];
			if(empty($store)) {
				message('门店不存在', '', 'error');
			}
			if(!$return) {
				$cart = set_order_cart($sid);
			} else {
				$cart = get_order_cart($sid);
			}
			if(empty($cart['data'])) {
				message('订单信息出错', '', 'error');
			}
			//送餐时间
			$minut = date('i', TIMESTAMP);
			if($minut <= 15) {
				$minut = 15;
			} elseif($minut >15 && $minut <= 30) {
				$minut = 30;
			} elseif($minut >30 && $minut <= 45) {
				$minut = 45;
			} elseif($minut >45 && $minut <= 60) {
				$minut = 60;
			}
			$now = mktime(date('H'), $minut);
			$now_limit = $now + 180*60;
			for($now; $now <= $now_limit; $now += 15 * 60) {
				$str .= '<a href="javascript:void(0);">'.date('H:i', $now).'</a>';
			}
			//桌号
			$tables = pdo_fetch('SELECT * FROM ' . tablename('str_tables') . ' WHERE uniacid = :uniacid AND sid = :sid', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
			if(!empty($tables)) {
				$tables['tables'] = iunserializer($tables['tables']);
				$tables['rooms'] = iunserializer($tables['rooms']);
			}

			//获取送餐地址(外卖用)
			$address_id = intval($_GPC['address_id']);
			$address = get_address($address_id);
			if(empty($address)) {
				$address = get_default_address();
			}

			//点餐人信息(点餐用)
			$member = mc_fetch($_W['member']['uid'], array('realname', 'mobile', 'address', 'nickname'));
			$order_member = pdo_fetch('SELECT id,mobile,username, address FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND uid = :uid ORDER BY id DESC LIMIT 1', array(':aid' => $_W['uniacid'], ':uid' => $_W['member']['uid']));
			$member['realname'] = !empty($order_member['username']) ? $order_member['username'] : $member['realname'];
			$member['mobile'] = !empty($order_member['mobile']) ? $order_member['mobile'] : $member['mobile'];
			$member['address'] = !empty($order_member['address']) ? $order_member['address'] : $member['address'];
		} else {
			$sid = intval($_GPC['sid']);
			$store = pdo_fetch('SELECT notice_acid,title,store_tpl,member_tpl,delivery_tpl,delivery_price FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
			$out['errno'] = 1;
			$out['error'] = '';
			if(!$sid || empty($dish)) {
				$out['errno'] = 1;
				$out['error'] = '订单信息不存在或已失效';
			}
			$data['uniacid'] = $_W['uniacid'];
			$data['sid'] = $sid;
			$data['uid'] = $_W['member']['uid'];
			$data['openid'] = $_W['openid'];
			$data['order_type'] = intval($_GPC['order_type']);
			if($data['order_type'] == 1) {
				$data['mobile'] = trim($_GPC['mobile']);
				$data['username'] = trim($_GPC['username']);
				$data['person_num'] = intval($_GPC['person_num']);
				$data['table_num'] = trim($_GPC['table_num']);
			} elseif($data['order_type'] == 2) {
				$address = get_address($_GPC['address_id']);
				$data['mobile'] = trim($address['mobile']);
				$data['username'] = trim($address['realname']);
				$data['address'] = trim($address['address']);
				$data['delivery_time'] = trim($_GPC['delivery_time']) ? trim($_GPC['delivery_time']) : '尽快送出';
				$data['delivery_fee'] = $store['delivery_price'];
			}
			$data['note'] = trim($_GPC['note']);
			$data['pay_type'] = '';
			$cart = get_order_cart($sid);
			if($cart['num'] == 0) {
				$out['errno'] = 1;
				$out['error'] = '菜品为空';
				exit(json_encode($out));
			}
			$data['num'] = $cart['num'];
			$data['price'] = $cart['price'];
			$data['addtime'] = TIMESTAMP;
			$data['status'] = 1;
			$data['is_notice'] = 0;
			$data['grant_credit'] = $cart['grant_credit'];;
			$data['is_grant'] = 0;
			pdo_insert('str_order', $data);
			$id = pdo_insertid();

			if(!empty($cart['data'])) {
				$ids_str = implode(',', array_keys($cart['data']));
				$dish_info = pdo_fetchall('SELECT id,title,price,grant_credit FROM ' . tablename('str_dish') ." WHERE uniacid = :aid AND sid = :sid AND id IN ($ids_str)", array(':aid' => $_W['uniacid'], ':sid' => $sid), 'id');
			}
			foreach($cart['data'] as $k => $v) {
				$k = intval($k);
				$v = intval($v);
				pdo_query('UPDATE ' . tablename('str_dish') . " set sailed = sailed + {$v} WHERE uniacid = :aid AND id = :id", array(':aid' => $_W['uniacid'], ':id' => $k));
				$stat = array();
				if($k && $v) {
					$stat['oid'] = $id;
					$stat['uniacid'] = $_W['uniacid'];
					$stat['sid'] = $sid;
					$stat['dish_id'] = $k;
					$stat['dish_num'] = $v;
					$stat['dish_title'] = $dish_info[$k]['title'];
					$stat['dish_price'] = ($v * $dish_info[$k]['price']);
					$stat['addtime'] = TIMESTAMP;
					pdo_insert('str_stat', $stat);
				}
			}
			//是否打印订单
			init_print_order($sid, $id, 'order');
			//微信邮件通知
			//init_notice_order($sid, $id, 'order');
			del_order_cart($sid);
			if($id) {
				$out['errno'] = 0;
				$out['url'] = $this->createMobileUrl('pay', array('id' => $id));
			} else {
				$out['errno'] = 1;
				$out['error'] = '保存订单失败';
			}
			exit(json_encode($out));
		}
		include $this->template('orderconfirm');
	}
	public function doMobileOrderDetail() {
		global $_W, $_GPC;
		checkauth();
		$sid = intval($_GPC['sid']);
		$oid = intval($_GPC['id']);
		$store = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		if(empty($store)) {
			message('门店不存在', '', 'error');
		}
		$_share = get_share($store);
		$title = $store['title'];
		$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $oid));
		if(empty($order)) {
			message('订单信息不存在', '', 'error');
		}
		$pay_types = pay_types();
		$order['dish'] = get_dish($order['id']);
		include $this->template('orderdetail');
	}
	public function doMobileAjaxOrder() {
		global $_W, $_GPC;
		checkauth();
		$id = intval($_GPC['id']);
		$op = trim($_GPC['op']);
		$order = pdo_fetch('SELECT id FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
		$out['errno'] = 0;
		$out['error'] = 0;
		if(empty($order)) {
			$out['errno'] = 1;
			$out['error'] = '订单不存在';
			exit(json_encode($out));
		}
		if($op == 'editstatus') {
			pdo_update('str_order', array('status' => 3), array('uniacid' => $_W['uniacid'], 'id' => $id));
		} elseif($op == 'del') {
			pdo_update('str_order', array('status' => 7), array('uniacid' => $_W['uniacid'], 'id' => $id));
			$out['error'] = $this->createMobileUrl('myorder');
		}
		exit(json_encode($out));
	}
	public function doMobilePay() {
		global $_W, $_GPC;
		checkauth();
		$id = intval($_GPC['id']);
		$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
		if(empty($order)) {
			message('订单不存在或已删除', $this->createMobileUrl('myorder'), 'error');
		}
		if(!empty($order['pay_type'])) {
			message('该订单已付款或已关闭,正在跳转到我的订单...',$this->createMobileUrl('myorder', array('sid' => $order['sid'])), 'info');
		}
		$params['module'] = "str_takeout";
		$params['tid'] = $order['id'];
		$params['ordersn'] = $order['id'];
		$params['user'] = $_W['member']['uid'];
		$params['fee'] = $order['price'] + $order['delivery_fee'] ;
		$params['title'] = $_W['account']['name'] . "外卖订单{$order['ordersn']}";
		include $this->template('pay');
	}
	public function payResult($params) {
		global $_W, $_GPC;
		$data['pay_type'] = $params['type'];
		pdo_update('str_order', $data, array('id' => $params['tid'], 'uniacid' => $_W['uniacid']));
		$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $params['tid']));
		if($params['from'] == 'return') {
			init_print_order($order['sid'], $order['id'], 'pay');
			init_notice_order($order['sid'], $order['id'], 'order');
			//wechat_notice($order['sid'], $order['id'], 5);
			if($params['type'] == 'credit' || $params['type'] == 'delivery') {
				message('支付成功！', $this->createMobileUrl('orderdetail', array('id' => $order['id'], 'sid' => $order['sid'])), 'success');
			} else {
				message('支付成功！', '../../app/' .$this->createMobileUrl('orderdetail', array('id' => $order['id'], 'sid' => $order['sid'])), 'success');
			}
		}
	}
	public function doMobileMyorder() {
		global $_W, $_GPC;
		checkauth();
		$sid = intval($_GPC['sid']);
		check_trash($sid);

		$store = get_store($sid);
		$_share = get_share($store);
		if(empty($store)) {
			message('门店不存在', referer(), 'error');
		}
		$title = $store['title'];
		$where = ' WHERE uniacid = :aid AND sid = :sid AND uid = :uid';
		$params = array(
			':aid' => $_W['uniacid'],
			':uid' => $_W['member']['uid'],
			':sid' => $sid,
		);
		$status = intval($_GPC['status']);

		if($status > 0 && $status != 5) {
			$where .= ' AND status = :status';
			$params[':status'] = $status;
		} 
		if($status == 5) {
			$where .= " AND pay_type = ''";
		}

		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;

		$limit = ' ORDER BY addtime DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order') . $where, $params);
		$data = pdo_fetchall('SELECT * FROM ' . tablename('str_order') . $where . $limit, $params);
		$pager = pagination($total, $pindex, $psize, '', array('before' => 0, 'after' => 0));
		include $this->template('myorder');
	}

	public function doMobileComment() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $id));
		check_trash($order['sid']);
		if(!$_W['isajax']) {
			if(empty($order)) {
				message('订单不存在或已经删除', $this->createMobileUrl('myorder'), 'error');
			}
			if($order['comment'] == 1) {
				$comment = pdo_fetch('SELECT * FROM ' . tablename('str_order_comment') .' WHERE uniacid = :aid AND oid = :oid', array(':aid' => $_W['uniacid'], ':oid' => $id));
			}
		} else {
			$out['errno'] = 0;
			$out['error'] = 0;
			if(empty($order)) {
				$out['errno'] = 1;
				$out['error'] = '订单不存在或已经删除';
				exit(json_encode($out));
			}
			$store = pdo_fetch('SELECT id,comment_set FROM ' . tablename('str_store') .' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $order['sid']));

			if($order['comment'] == 1) {
				$out['errno'] = 1;
				$out['error'] = '该订单已经评价过';
				exit(json_encode($out));
			}
			if(!empty($_GPC['score_data'])) {
				$insert = array(
					'uniacid' => $_W['uniacid'],
					'sid' => $order['sid'],
					'oid' => $order['id'],
					'uid' => $order['uid'],
					'addtime' => TIMESTAMP,
					'status' => ($store['comment_set']) == 1 ? 1 : 3,
					'note' => trim($_GPC['note']),
				);
				foreach($_GPC['score_data'] as $row) {
					if($row['id'] && in_array($row['id'], array('taste', 'speed', 'serve'))) {
						$score = intval($row['score']);
						$insert[$row['id']] = $score;
					}
				}
				pdo_insert('str_order_comment', $insert);
			}
			pdo_update('str_order', array('comment' => 1), array('uniacid' => $_W['uniacid'], 'id' => $id));
			exit(json_encode($out));
		}
		include $this->template('comment');
	}
	public function doWebCron() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'print';
		//飞蛾打印机订单打印状态查询。1:打印成功，2：未打印
		if($op == 'print') {
			$sid = intval($_GPC['__sid']);
			$data = pdo_fetchall('SELECT a.foid, b.print_no, b.key FROM ' . tablename('str_order_print') . ' AS a LEFT JOIN '.tablename('str_print').' AS b ON a.pid = b.id WHERE a.uniacid = :aid AND a.sid = :sid AND a.status = 2 AND a.print_type = 1 ORDER BY addtime ASC LIMIT 5', array(':aid' => $_W['uniacid'], ':sid' => $sid));
			if(!empty($data)) {
				foreach($data as $da) {
					if(!empty($da['foid']) && !empty($da['print_no']) && !empty($da['key'])) {
						$print = new wprint();
						$status = $print->QueryOrderState($da['print_no'], $da['key'], $da['foid']);
						if(!is_error($status)) {
							pdo_update('str_order_print', array('status' => $status), array('uniacid' => $_W['uniacid'], 'sid' => $sid, 'foid' => $da['foid']));
						}
					}
				}
			}
		} elseif($op == 'order') {
			$sid = intval($_GPC['__sid']);
			$order = pdo_fetch('SELECT id FROM ' . tablename('str_order') . ' WHERE uniacid = :uniacid AND sid = :sid AND is_notice = 0 ORDER BY addtime DESC', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
			if(!empty($order)) {
				pdo_update('str_order', array('is_notice' => 1), array('uniacid' => $_W['uniacid'], 'id' => $order['id']));
				exit('success');
			}
			exit('error');
		}
	}
	public function doWebSystem() {
		global $_W, $_GPC;
		include $this->template('system');
	}

	public function doMobileManage() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
		$sid = $_GPC['sid'];
		$store = pdo_fetch('SELECT * FROM ' . tablename('str_store') . ' WHERE uniacid = :aid AND id = :id', array(':aid' => $_W['uniacid'], ':id' => $sid));
		if(empty($store)) {
			message('门店不存在', referer(), 'error');
		}
		$_share = get_share($store);
		$title = $store['title'];
		$clerk = checkclerk($sid);
		if(is_error($clerk)) {
			message($clerk['message'], referer(), 'error');
		}
		if($op == 'list') {
			$where = ' WHERE uniacid = :aid AND sid = :sid';
			$params = array(
				':aid' => $_W['uniacid'],
				':sid' => $sid
			);
			if($status > 0 && $status != 5) {
				$where .= ' AND status = :status';
				$params['status'] = $status;
			} 
			if($status == 5) {
				$where .= " AND pay_type = ''";
			}
			$pindex = max(1, intval($_GPC['page']));
			$psize = 10;

			$limit = ' ORDER BY id DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order') . $where, $params);
			$data = pdo_fetchall('SELECT * FROM ' . tablename('str_order') . $where . $limit, $params);
			$pager = pagination($total, $pindex, $psize, '', array('before' => 0, 'after' => 0));
			include $this->template('manage');
		} elseif($op == 'detail') {
			$id = intval($_GPC['id']);
			$order = pdo_fetch('SELECT * FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND sid = :sid AND id = :id', array(':aid' => $_W['uniacid'], ':sid' => $store['id'], ':id' => $id));
			if(empty($order)) {
				message('订单不存在或已经删除', referer(), 'error');
			}
			$order['dish'] = get_dish($order['id']);
			include $this->template('manage-detail');
		} 
	}

	public function doMobileStatus() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$sid = intval($_GPC['sid']);
		$status = intval($_GPC['status']);
		$order = pdo_fetch('SELECT id FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND sid = :sid AND id = :id', array(':aid' => $_W['uniacid'], ':sid' => $sid, ':id' => $id));
		if(empty($order)) {
			exit('订单不存在');
		}
		if($status == 5) {
			pdo_update('str_order', array('pay_type' => 'cash'), array('uniacid' => $_W['uniacid'], 'id' => $id));
		} else {
			pdo_update('str_order', array('status' => $status), array('uniacid' => $_W['uniacid'], 'id' => $id));
		}
		wechat_notice($sid, $id, $status);
		exit('success');
	}

	public function doMobilePrint() {
		global $_W, $_GPC;
		$id = intval($_GPC['id']);
		$sid = intval($_GPC['sid']);
		$order = pdo_fetch('SELECT id FROM ' . tablename('str_order') . ' WHERE uniacid = :aid AND sid = :sid AND id = :id', array(':aid' => $_W['uniacid'], ':sid' => $sid, ':id' => $id));
		if(empty($order)) {
			exit('订单不存在');
		}
		$status = print_order($id);
		if(is_error($status)) {
			exit($status['message']);
		}
		exit('success');
	}

	public function doMobileAddress() {
		global $_W, $_GPC;
		checkauth();
		$sid = intval($_GPC['sid']);
		$store = get_store($sid);
		$_share = get_share($store);
		if(empty($store)) {
			message('商家不存在', '', 'error');
		}
		$title = $store['title'];
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
		$return_url = '';
		if(!empty($_GPC['return_url'])) {
			$return_url = urldecode($_GPC['return_url']);
		}
		if($op == 'list') {
			$addresses = get_addresses();
		}

		if($op == 'post') {
			$id = intval($_GPC['id']);
			$address = get_address($id);
			if($_W['ispost']) {
				$data = array(
					'uniacid' => $_W['uniacid'],
					'uid' => $_W['member']['uid'],
					'realname' => trim($_GPC['realname']),
					'mobile' => trim($_GPC['mobile']),
					'address' => trim($_GPC['address']),
				);
				if(!empty($address)) {
					pdo_update('str_address', $data, array('uniacid' => $_W['uniacid'], 'id' => $id));
				} else {
					pdo_insert('str_address', $data);
					$id = pdo_insertid();
				}
				exit(json_encode(array('errorno' => 0, 'message' => $id)));
			}
		}

		if($op == 'del') {
			$id = intval($_GPC['id']);
			pdo_delete('str_address', array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid'], 'id' => $id));
			exit(json_encode(array('errorno' => 0, 'message' => '')));
		}

		if($op == 'default') {
			$id = intval($_GPC['id']);
			pdo_update('str_address', array('is_default' => 0), array('uniacid' => $_W['uniacid'], 'uid' => $_W['member']['uid']));
			pdo_update('str_address', array('is_default' => 1), array('uniacid' => $_W['uniacid'], 'id' => $id));
			exit(json_encode(array('errorno' => 0, 'message' => '')));
		}

		include $this->template('address');
	}
	public function doMobileComment_list() {
		global $_W, $_GPC;
		checkauth();
		$sid = intval($_GPC['sid']);
		check_trash($sid);
		$store = get_store($sid);
		$_share = get_share($store);
		if(empty($store)) {
			message('商家不存在', '', 'error');
		}
		$title = $store['title'];
		$comment_stat = comment_stat($sid);
		$avg = ($comment_stat['avg_taste'] + $comment_stat['avg_serve'] + $comment_stat['avg_speed'])/3;
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$condition = ' WHERE a.uniacid = :uniacid AND a.sid = :sid AND a.status = 1';
		$params = array(
			':uniacid' => $_W['uniacid'],
			':sid' => $sid,
		);

		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('str_order_comment') . ' AS a '.  $condition, $params);
		$data = pdo_fetchall('SELECT a.*, b.nickname,b.avatar,b.realname FROM ' . tablename('str_order_comment') . ' AS a LEFT JOIN ' . tablename('mc_members') . ' AS b ON a.uid = b.uid ' . $condition . ' ORDER BY a.addtime DESC LIMIT '.($pindex - 1) * $psize.','.$psize, $params);
		$pager = pagination($total, $pindex, $psize, '', array('before' => 0, 'after' => 0));
		include $this->template('comment_list');
	}

	public function doWebLimit() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
		if($op == 'list') {
			if(!$_W['isfounder']) {
				message('此项操作只有超级管理员有权限', referer(), 'error');
			}
			$title = intval($_GPC['title']);
			$condition = '';
			if($title > 0) {
				$condition .= " WHERE uniacid = {$title}";
			} else {
				$title = trim($_GPC['title']);
				if(!empty($title)) {
					$condition .= " WHERE name LIKE '%{$title}%'";
				}
			}
			$pindex = max(1, intval($_GPC['page']));
			$psize = 15;
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('uni_account') . $condition);
			$accounts = pdo_fetchall('SELECT * FROM ' . tablename('uni_account') . $condition .' ORDER BY uniacid DESC LIMIT '.($pindex - 1) * $psize.','.$psize, array(), 'uniacid');
			if(!empty($accounts)) {
				$ids = implode(',', array_keys($accounts));
				$limits = pdo_fetchall('SELECT uniacid, num_limit FROM ' . tablename('str_config') . " WHERE uniacid IN ({$ids})", array(), 'uniacid');
			}
			$pager = pagination($total, $pindex, $psize);
		}

		if($op == 'num') {
			if(!$_W['isfounder']) {
				exit('您没有权限进行该操作');
			}
			$uniacid = intval($_GPC['uniacid']);
			if(!$uniacid) exit('公众号信息错误');
			$num = intval($_GPC['num']);
			$config = get_config($uniacid);
			if(!empty($config)) {
				pdo_update('str_config', array('num_limit' => $num), array('uniacid' => $uniacid));
			} else {
				$data = array(
					'uniacid' => $uniacid,
					'version' => 1,
					'area_search' => 1,
					'num_limit' => $num
				);
				pdo_insert('str_config', $data);
			}
			exit('success');
		}

		include $this->template('limit');
	}

	public function doWebArea() {
		global $_W, $_GPC;
		$op = trim($_GPC['op']) ? trim($_GPC['op']) : 'list';
		if($op == 'list') {
			$condition = ' uniacid = :aid';
			$params[':aid'] = $_W['uniacid'];
			$lists = get_area();
			if(!empty($lists)) {
				$ids = implode(',', array_keys($lists));
				$nums = pdo_fetchall('SELECT count(*) AS num,area_id FROM ' . tablename('str_store') . " WHERE uniacid = :aid AND area_id IN ({$ids}) GROUP BY area_id", array(':aid' => $_W['uniacid']), 'area_id');
			}
			if(checksubmit('submit')) {
				if(!empty($_GPC['ids'])) {
					foreach($_GPC['ids'] as $k => $v) {
						$data = array(
							'title' => trim($_GPC['title'][$k]),
							'displayorder' => intval($_GPC['displayorder'][$k])
						);
						pdo_update('str_area', $data, array('uniacid' => $_W['uniacid'], 'id' => intval($v)));
					}
					message('编辑成功', $this->createWebUrl('area'), 'success');
				}
			}
		}

		if($op == 'post') {
			if(checksubmit('submit')) {
				if(!empty($_GPC['title'])) {
					foreach($_GPC['title'] as $k => $v) {
						$v = trim($v);
						if(empty($v)) continue;
						$data['uniacid'] = $_W['uniacid'];
						$data['title'] = $v;
						$data['displayorder'] = intval($_GPC['displayorder'][$k]);
						pdo_insert('str_area', $data);
					}
				}
				message('添加区域成功', $this->createWebUrl('area'), 'success');
			}
		}

		include $this->template('area');
	}
}
