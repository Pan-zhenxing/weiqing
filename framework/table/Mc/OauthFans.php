<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
namespace We7\Table\Mc;

class OauthFans extends \We7Table {
	protected $tableName = 'mc_oauth_fans';
	protected $primaryKey = 'id';
	protected $field = array(
		'oauth_openid',
		'uniacid',
		'uid',
		'openid',
	);
	protected $default = array(
		'oauth_openid' => '',
		'uniacid' => '',
		'uid' => '',
		'openid' => '',
	);

	public function searchWithoAuthopenid($oauth_openid) {
		return $this->query->where('oauth_openid', $oauth_openid);
	}

	public function searchWithUniacid($uniacid) {
		return $this->query->where('uniacid', $uniacid);
	}
}