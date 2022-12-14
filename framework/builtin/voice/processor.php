<?php
/**
 * [WeEngine System] Copyright (c) 2014 txee.cn
 * WeEngine is NOT a free software, it under the license terms, visited http://www.txee.cn/ for more details.
 */
defined('IN_IA') or exit('Access Denied');

class VoiceModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		$rid = $this->rule;
		$mediaid = table('voice_reply')->where(array('rid' => $rid))->getcolumn('mediaid');
		if (empty($mediaid)) {
			return false;
		}
		return $this->respVoice($mediaid);
	}
}
