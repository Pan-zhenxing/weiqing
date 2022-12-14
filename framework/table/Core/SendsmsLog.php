<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Core;

class SendsmsLog extends \We7Table {
	protected $tableName = 'core_sendsms_log';
	protected $primaryKey = 'id';
	protected $field = array(
		'uniacid',
		'mobile',
		'content',
		'result',
		'createtime',
	);
	protected $default = array(
		'uniacid' => 0,
		'mobile' => '',
		'content' => '',
		'result' => '',
		'createtime' => 0,
	);
}