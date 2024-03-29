<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: profile.php 34314 2014-02-20 01:04:24Z nemohou $
 */
//note 更多more >> profile(个人信息) @ Discuz! X3.x

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'space';
$_GET['do'] = 'profile';
include_once 'home.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
	}

	//note 程序模板输出前运行的代码
	function output() {
		global $_G;
		$data = $GLOBALS['space'];
		$data['groupiconid'] = mobile_core::usergroupIconId($data['groupid']);
		if($data['group']['type'] == 'member' && $data['group']['groupcreditslower'] != 999999999) {
			$data['upgradecredit'] = $data['group']['creditslower'] - $data['credits'];
			$data['upgradeprogress'] = 100 - ceil($data['upgradecredit'] / ($data['group']['creditslower'] - $data['group']['creditshigher']) * 100);
			$data['upgradeprogress'] = max($data['upgradeprogress'], 2);
		}
		unset($data['password'], $data['email'], $data['regip'], $data['lastip'], $data['regip_loc'], $data['lastip_loc']);
		$variable = array(
			'space' => $data,
			'extcredits' => $_G['setting']['extcredits'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>