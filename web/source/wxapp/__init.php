<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

load()->model('miniapp');

$version_id = intval($_GPC['version_id']);
if (!empty($version_id)) {
	$account = table('account')->getUniAccountByUniacid($_W['uniacid']);
	$version_info = miniapp_version($version_id);
	if ($version_info['uniacid'] != $_W['uniacid']) {
		itoast('', $_W['siteroot'] . 'web/home.php');
	}
}

if ('version' == $action && 'display' == $do) {
	define('FRAME', '');
}
if (in_array($action, array('manage', 'post'))) {
	define('FRAME', 'account_manage');
}
if (!in_array($action, array('post', 'manage', 'auth'))) {
	$account_api = WeAccount::createByUniacid();
	if (is_error($account_api)) {
		itoast('', $_W['siteroot'] . 'web/home.php');
	}
	$check_manange = $account_api->checkIntoManage();
	if (is_error($check_manange)) {
		itoast('', $account_api->displayUrl);
	}
	$account_type = $account_api->menuFrame;
	define('FRAME', $account_type);
}
$account_all_type = uni_account_type();