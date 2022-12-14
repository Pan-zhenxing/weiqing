<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

class WebappAccount extends WeAccount {
	protected $tablename = 'account_webapp';
	protected $menuFrame = 'account';
	protected $type = ACCOUNT_TYPE_WEBAPP_NORMAL;
	protected $typeSign = WEBAPP_TYPE_SIGN;
	protected $typeName = 'PC';
	protected $typeTempalte = '-webapp';

	protected function getAccountInfo($uniacid) {
		$account = table('account_webapp')->getAccount($uniacid);

		return $account;
	}
}