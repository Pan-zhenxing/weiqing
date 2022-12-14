<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');


class ToutiaoappAccount extends WeAccount {
	protected $tablename = 'account_toutiaoapp';
	protected $menuFrame = 'wxapp';
	protected $type = ACCOUNT_TYPE_TOUTIAOAPP_NORMAL;
	protected $typeName = '字节跳动小程序';
	protected $typeTempalte = '-toutiaoapp';
	protected $typeSign = TOUTIAOAPP_TYPE_SIGN;
	protected $supportVersion = STATUS_ON;

	protected function getAccountInfo($uniacid) {
		return table('account_toutiaoapp')->getAccount($uniacid);
	}
}