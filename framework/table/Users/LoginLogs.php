<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Users;

class LoginLogs extends \We7Table {
	protected $tableName = 'users_login_logs';
	protected $primaryKey = 'id';
	protected $field = array(
		'ip',
		'uid',
		'city',
		'createtime',
	);
	protected $default = array(
		'ip' => 0,
		'uid' => 0,
		'city' => '',
		'createtime' => 0,
	);
}