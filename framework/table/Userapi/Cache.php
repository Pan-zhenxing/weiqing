<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Userapi;

class Cache extends \We7Table {
	protected $tableName = 'userapi_cache';
	protected $primaryKey = 'id';
	protected $field = array(
		'key',
		'content',
		'lastupdate',

	);
	protected $default = array(
		'key' => '',
		'content' => '',
		'lastupdate' => '',

	);
}