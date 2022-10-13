<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\System;

class WelcomeBinddomain extends \We7Table {
	protected $tableName = 'system_welcome_binddomain';
	protected $primaryKey = 'id';
	protected $field = array(
		'uid',
		'module_name',
		'domain',
		'createtime',
	);
	protected $default = array(
		'uid' => '',
		'module_name' => '',
		'domain' => '',
		'createtime' => '',
	);
}