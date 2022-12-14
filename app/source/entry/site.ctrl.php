<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */

defined('IN_IA') or exit('Access Denied');

if (!empty($_W['uniacid'])) {
	$link_uniacid = table('uni_link_uniacid')->getMainUniacid($_W['uniacid'], $entry['module']);
	if (!empty($link_uniacid)) {
		$_W['uniacid'] = $link_uniacid;
		$_W['account']['link_uniacid'] = $link_uniacid;
	}
}

$site = WeUtility::createModuleSite($entry['module']);
if(!is_error($site)) {
	$do_function = $site instanceof WeModuleSite ? 'doMobile' : 'doPage';
	$method = $do_function . ucfirst($entry['do']);
	exit($site->$method());
}
exit();