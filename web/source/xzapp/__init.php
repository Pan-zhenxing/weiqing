<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
$account_api = WeAccount::createByUniacid();
if ('post-step' == $action) {
	define('FRAME', '');
} else {
	define('FRAME', $account_api->menuFrame);
}