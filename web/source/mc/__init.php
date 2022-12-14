<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */

$version_id = intval($_GPC['version_id']);
if (!empty($version_id)) {
	load()->model('miniapp');
	$version_info = miniapp_version($version_id);
}
$account_api = WeAccount::createByUniacid();
if (is_error($account_api)) {
	message($account_api['message'], $_W['siteroot'] . 'web/home.php');
}
$check_manange = $account_api->checkIntoManage();

if (is_error($check_manange)) {
	itoast('', $account_api->displayUrl);
} else {
	$account_type = $account_api->menuFrame;
	define('FRAME', $account_type);
}
