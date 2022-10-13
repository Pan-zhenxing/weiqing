<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Mc;

class FansTagMapping extends \We7Table {
	protected $tableName = 'mc_fans_tag_mapping';
	protected $primaryKey = 'id';
	protected $field = array(
		'fanid',
		'tagid',
	);
	protected $default = array(
		'fanid' => '',
		'tagid' => '',
	);
}