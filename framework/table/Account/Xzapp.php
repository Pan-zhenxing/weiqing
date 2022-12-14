<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Account;

class Xzapp extends \We7Table {
	protected $tableName = 'account_xzapp';
	protected $primaryKey = 'acid';
	protected $field = array(
		'acid',
		'uniacid',
		'name',
	);
	protected $default = array(
		'acid' => '',
		'uniacid' => '',
		'name' => '',
	);

	public function getByAcid($acid) {
		return $this->query->where('acid' , $acid)->get();
	}
}