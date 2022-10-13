<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');



function visit_update_today($type, $module_name = '') {
	global $_W;
	$module_name = trim($module_name);
	$type = trim($type);
	if (empty($type) || !in_array($type, array('app', 'web', 'api'))) {
		return false;
	}
	if ($type == 'app' && empty($module_name)) {
		return false;
	}

	$today = date('Ymd');
	$stat_visit_teble = table('stat_visit');
	$stat_visit_teble->searchWithDate($today);
	$stat_visit_teble->searchWithModule($module_name);
	$stat_visit_teble->searchWithUnacid($_W['uniacid']);
	$stat_visit_teble->searchWithType($type);
	$today_exist = $stat_visit_teble->get();

	if (empty($today_exist)) {
		$insert_data = array(
			'uniacid' => $_W['uniacid'],
			'module' => $module_name,
			'type' => $type,
			'date' => $today,
			'count' => 1,
			'ip_count' => 0
		);
		pdo_insert('stat_visit', $insert_data);
		$today_exist = $insert_data;
		$today_exist['id'] = pdo_insertid();
	} else {
		$data = array('count' => $today_exist['count'] + 1);
		pdo_update('stat_visit' , $data, array('id' => $today_exist['id']));
	}

	if (!empty($today_exist['id'])) {
		$ip = ip2long(getip());
		$stat_ip_visit_table = table('stat_visit_ip');
		$stat_ip_visit_table->searchWithIp($ip);
		$stat_ip_visit_table->searchWithDate($today);
		$ip_today_exist = $stat_ip_visit_table->get();
		if (empty($ip_today_exist)) {
			$ip_insert_data = array(
				'ip' => $ip,
				'uniacid' => $_W['uniacid'],
				'module' => $module_name,
				'type' => $type,
				'date' => $today,
			);
			pdo_insert('stat_visit_ip', $ip_insert_data);
			pdo_update('stat_visit', array('ip_count' => $today_exist['ip_count'] + 1), array('id' => $today_exist['id']));
		}
	}
	return true;
}


function visit_app_update_today_visit($module_name) {
	global $_W;
	$module_name = trim($module_name);
	if (empty($module_name) || !in_array($_W['account']['type'], array(ACCOUNT_TYPE_OFFCIAL_NORMAL, ACCOUNT_TYPE_OFFCIAL_AUTH, ACCOUNT_TYPE_WEBAPP_NORMAL))) {
		return false;
	}

	$today = date('Ymd');
	$stat_visit_teble = table('stat_visit');
	$stat_visit_teble->searchWithDate($today);
	$stat_visit_teble->searchWithModule($module_name);
	$stat_visit_teble->searchWithType('app');
	$stat_visit_teble->searchWithUnacid($_W['uniacid']);
	$today_exist = $stat_visit_teble->get();
	if (empty($today_exist)) {
		$insert_data = array(
			'uniacid' => $_W['uniacid'],
			'module' => $module_name,
			'type' => 'app',
			'date' => $today,
			'count' => 1,
			'ip_count' => 0
		);
		pdo_insert('stat_visit', $insert_data);
		$today_exist = $insert_data;
		$today_exist['id'] = pdo_insertid();
	} else {
		$data = array('count' => $today_exist['count'] + 1);
		pdo_update('stat_visit' , $data, array('id' => $today_exist['id']));
	}

	$yestoday = date('Ymd', strtotime('-1 day'));
	$cache_key = cache_system_key('delete_visit_ip', array('date' => $yestoday));
	$is_delete_visit_ip = cache_load($cache_key);
	if (empty($is_delete_visit_ip)) {
		pdo_delete('stat_visit_ip', $yestoday);
		cache_write($cache_key, true);
	}

	if (!empty($today_exist['id'])) {
		$ip = ip2long(getip());
		$stat_ip_visit_table = table('stat_visit_ip');
		$stat_ip_visit_table->searchWithIp($ip);
		$stat_ip_visit_table->searchWithDate($today);
		$ip_today_exist = $stat_ip_visit_table->get();
		if (empty($ip_today_exist)) {
			$ip_insert_data = array(
				'ip' => $ip,
				'uniacid' => $_W['uniacid'],
				'module' => $module_name,
				'type' => 'app',
				'date' => $today,
			);
			pdo_insert('stat_visit_ip', $ip_insert_data);
			pdo_update('stat_visit', array('ip_count' => $today_exist['ip_count'] + 1), array('id' => $today_exist['id']));
		}
	}
	return true;
}


function visit_app_pass_visit_limit($uniacid = 0) {
	global $_W;
		if (strpos($_W['siteurl'], 'api.php?') === false && ($_W['isajax'] || $_W['ispost'] || strpos($_W['siteurl'], 'c=utility&a=visit') !== false)) {
		return false;
	}
	$uniacid = intval($uniacid) > 0 ? intval($uniacid) : $_W['uniacid'];

	$limit = uni_setting_load('statistics', $uniacid);
	$limit = $limit['statistics'];

	if (empty($limit)) {
		return false;
	}
	$cachekey = cache_system_key('statistics', array('uniacid' => $uniacid));
	$cache = cache_load($cachekey);
	if (!empty($cache) && ($cache['time'] + $limit['interval'] > TIMESTAMP)) {
		return $cache['limit'];
	}
	$data = array('time'=> TIMESTAMP, 'limit' => false);

	$today_num = visit_app_today_visit($uniacid);
	if (!empty($limit['founder'])) {
		$order_num = 0;
		$orders = table('site_store_order')->getApiOrderByUniacid($uniacid);
		if (!empty($orders)) {
			foreach ($orders as $order) {
				$order_num += $order['duration'] * $order['api_num'] * 10000;
			}
		}
				$before_num = visit_app_month_visit_till_today($uniacid);
		$sum_num = intval($limit['founder']) + $order_num - intval($limit['use']);
		if($sum_num <= 0 || $limit['founder'] + $order_num <= $before_num + $today_num) {
			$data['limit'] = true;
			cache_write($cachekey, $data);
			return true;
		}
	}
		if (!empty($limit['owner']) && $today_num > $limit['owner']) {
		$data['limit'] = true;
		cache_write($cachekey, $data);
		return true;
	}

	if (!empty($limit['founder']) && ($before_num + $today_num) > $limit['founder']) {
		$limit['use'] = !empty($limit['use']) ? (intval($limit['use']) + 1) : 1;
		uni_setting_save('statistics', $limit);
	}
	cache_write($cachekey, $data);
	return false;
}


function visit_app_month_visit_till_today($uniacid = 0) {
	global $_W;
	$result = 0;
	$uniacid = intval($uniacid) > 0 ? intval($uniacid) : $_W['uniacid'];
	$today = date('Ymd');
	$cachekey = cache_system_key('uniacid_visit', array('uniacid' => $uniacid, 'today' => $today));
	$cache = cache_load($cachekey);
	if (!empty($cache)) {
		return $cache;
	}
	$start = date('Ym01', strtotime(date("Ymd")));
	$end = date('Ymd', strtotime('-1 day'));
	$stat_visit_teble = table('stat_visit');
	$stat_visit_teble->searchWithGreaterThenDate($start);
	$stat_visit_teble->searchWithLessThenDate($end);
	$stat_visit_teble->searchWithType('app');
	$stat_visit_teble->searchWithUnacid($uniacid);
	$visit = $stat_visit_teble->getall();

	if (!empty($visit)) {
		foreach ($visit as $val) {
			$result += $val['count'];
		}
	}
	cache_write($cachekey, $result);
	return $result;
}


function visit_app_today_visit($uniacid = 0) {
	global $_W;
	$result = 0;
	$uniacid = intval($uniacid) > 0 ? intval($uniacid) : $_W['uniacid'];

	$stat_visit_teble = table('stat_visit');
	$stat_visit_teble->searchWithDate(date('Ymd'));
	$stat_visit_teble->searchWithType('app');
	$stat_visit_teble->searchWithUnacid($uniacid);
	$today = $stat_visit_teble->getall();
	if (!empty($today)) {
		foreach ($today as $val) {
			$result += $val['count'];
		}
	}
	return $result;
}