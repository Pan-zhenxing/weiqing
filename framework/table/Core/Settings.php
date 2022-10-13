<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Core;

class Settings extends \We7Table {
	protected $tableName = 'core_settings';
	protected $primaryKey = 'key';
	protected $field = array(
		'key',
		'value',
	);
	protected $default = array(
		'key' => '',
		'value' => '',
	);
}