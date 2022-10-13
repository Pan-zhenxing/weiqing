<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Site;

class Multi extends \We7Table {
	protected $tableName = 'site_multi';
	protected $primaryKey = 'id';
	protected $field = array(
		'uniacid',
		'title',
		'styleid',
		'site_info',
		'status',
		'bindhost',
	);
	protected $default = array(
		'uniacid' => '',
		'title' => '',
		'styleid' => '',
		'site_info' => '',
		'status' => '1',
		'bindhost' => '',
	);

	public function getAllByUniacid($uniacid) {
		return $this->query->where('uniacid', $uniacid)->getall();
	}
}