<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Site;

class StoreCreateAccount extends \We7Table {
	protected $tableName = 'site_store_create_account';
	protected $primaryKey = 'id';
	protected $field = array(
		'uid',
		'uniacid',
		'type',
		'endtime',
	);
	protected $default = array(
		'uid' => '',
		'uniacid' => '',
		'type' => '',
		'endtime' => '',
	);

	public function getByUniacid($uniacid) {
		return $this->where('uniacid', $uniacid)->get();
	}

	public function getQueryJoinAccountTable($uid = 0, $type = 0) {
		$query = $this->query
			->from($this->tableName, 'a')
			->leftjoin('account', 'b')
			->on('a.uniacid', 'b.uniacid');
		if ($uid > 0) {
			$query->where('a.uid', intval($uid));
		}
		if (!is_array($type) && $type > 0) {
			$type = array(intval($type));
		}
		if (is_array($type)) {
			$query->where('a.type', $type);
		}
		return $query;
	}

	public function getUserCreateNumByType($uid, $type)
	{
		$account_all_type_sign = uni_account_type_sign();
		$contain_type = $account_all_type_sign[$type]['contain_type'];
		return $this->getQueryJoinAccountTable($uid, $contain_type)->getcolumn('count(*)');
	}

	public function getUserDeleteNum($uid, $type) {
		if (!is_array($type)) {
			$type = array(intval($type));
		}
		$sql = "SELECT COUNT(*) FROM "
			. tablename($this->tableName)
			. " as a LEFT JOIN " . tablename('account')
			. " as b ON a.uniacid = b.uniacid WHERE a.uid = :uid AND a.type IN :type AND (b.isdeleted = 1 OR b.uniacid is NULL)";
		return pdo_fetchcolumn($sql, array(':uid' => $uid, ':type' => $type));
	}
}