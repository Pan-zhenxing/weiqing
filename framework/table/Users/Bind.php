<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Users;

class Bind extends \We7Table {
	protected $tableName = 'users_bind';
	protected $primaryKey = 'id';
	protected $field = array(
		'uid',
		'bind_sign',
		'third_type',
		'third_nickname',
	);
	protected $default = array(
		'uid' => '',
		'bind_sign' => '',
		'third_type' => '0',
		'third_nickname' => '',
	);

	public function getByTypeAndUid($type, $uid) {
		return $this->query->where('third_type', $type)->where('uid', $uid)->get();
	}

	public function getByTypeAndBindsign($type, $bind_sign) {
		return $this->query->where('third_type', $type)->where('bind_sign', $bind_sign)->get();
	}

	public function getAllByUid($uid) {
		return $this->query->where('uid', $uid)->getall('bind_sign');
	}

	public function searchWithUsers() {
		return $this->query->from($this->tableName, 'b')
			->leftjoin('users', 'u')
			->on(array('b.uid' => 'u.uid'));
	}
}