<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

if (in_array($action, array('sms', 'sms-sign', 'sms-package', 'sms-statistics', 'sms-template', 'sms-share'))) {
	define('FRAME', 'system');
}
if ('process' == $action) {
	define('FRAME', '');
} else {
	define('FRAME', 'site');
}

if (in_array($action, array('device', 'callback', 'appstore'))) {
	$do = $action;
	$action = 'redirect';
}

if ('touch' == $action) {
	exit('success');
}
/*
if (in_array($action, array('profile', 'diagnose', 'sms-sign', 'sms-package', 'sms-statistics', 'sms-template', 'sms-share'))) {
	check_w7_request();
}
*/