<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');
if (in_array($action, array('display', 'edit', 'create'))) {
	define('FRAME', 'user_manage');
}
if (in_array($action, array('group'))) {
	define('FRAME', 'permission');
}
