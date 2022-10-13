<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Activity;

class ExchangeTrades extends \We7Table {
	protected $tableName = 'activity_exchange_trades';
	protected $primaryKey = 'tid';
	protected $field = array(
		'uniacid',
		'uid',
		'exid',
		'type',
		'createtime',
	);
	protected $default = array(
		'uniacid' => '',
		'uid' => '',
		'exid' => '',
		'type' => '',
		'createtime' => 0,
	);
}