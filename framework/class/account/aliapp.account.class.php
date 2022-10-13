<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');


class AliappAccount extends WeAccount {
	protected $tablename = 'account_aliapp';
	protected $menuFrame = 'wxapp';
	protected $type = ACCOUNT_TYPE_ALIAPP_NORMAL;
	protected $typeName = '支付宝小程序';
	protected $typeTempalte = '-aliapp';
	protected $typeSign = ALIAPP_TYPE_SIGN;
	protected $supportVersion = STATUS_ON;

	protected function getAccountInfo($uniacid) {
		return table('account_aliapp')->getAccount($uniacid);
	}
}