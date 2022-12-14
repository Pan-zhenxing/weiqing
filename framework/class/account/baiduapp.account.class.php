<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

class BaiduappAccount extends WeAccount {
	protected $tablename = 'account_baiduapp';
	protected $menuFrame = 'wxapp';
	protected $type = ACCOUNT_TYPE_BAIDUAPP_NORMAL;
	protected $typeName = '百度小程序';
	protected $typeTempalte = '-baiduapp';
	protected $typeSign = BAIDUAPP_TYPE_SIGN;
	protected $supportVersion = STATUS_ON;

	protected function getAccountInfo($uniacid) {
		return table('account_baiduapp')->getAccount($uniacid);
	}
}