<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Music;

class Reply extends \We7Table {
	protected $tableName = 'music_reply';
	protected $primaryKey = 'id';
	protected $field = array(
		'rid',
		'title',
		'description',
		'url',
		'hqurl'
	);
	protected $default = array(
		'rid' => '',
		'title' => '',
		'description' => '',
		'url' => '',
		'hqurl' => ''
	);
}