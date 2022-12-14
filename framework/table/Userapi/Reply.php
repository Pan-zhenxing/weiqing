<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Userapi;

class Reply extends \We7Table {
	protected $tableName = 'userapi_reply';
	protected $primaryKey = 'id';
	protected $field = array(
		'rid',
		'description',
		'apiurl',
		'token',
		'default_text',
		'cachetime',
	);
	protected $default = array(
		'rid' => '',
		'description' => '',
		'apiurl' => '',
		'token' => '',
		'default_text' => '',
		'cachetime' => '0',
	);

	public function getByApiurl($apiurl) {
		return $this->query->where('apiurl', $apiurl)->get();
	}
}