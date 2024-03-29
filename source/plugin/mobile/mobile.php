<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: mobile.php 34692 2014-07-09 01:17:48Z qingrongfu $
 */

define('IN_MOBILE_API', 1);
define('IN_MOBILE', 1);

chdir('../../../');

require_once 'source/plugin/mobile/mobile.class.php';

$modules = array('extends', 'buyattachment', 'buythread', 'checkpost', 'connect',
	'favforum', 'favthread', 'forumdisplay', 'forumindex',
	'forumnav', 'forumupload', 'friend', 'hotforum', 'hotthread',
	'login', 'myfavforum', 'myfavthread', 'mypm', 'mythread',
	'newthread', 'profile', 'publicpm', 'register', 'seccode',
	'secure', 'sendpm', 'sendreply', 'sub_checkpost', 'sublist',
	'toplist', 'viewthread', 'uploadavatar', 'pollvote', 'mynotelist',
	'modcp', 'topicadmin', 'forumimage', 'newthreads', 'signin', 'smiley', 'threadrecommend', 'check', 'mobilesign',
	'wsqindex', 'wsqsiteinfo', 'recommend',
	'wechat', 'wechat_clearlogin', 'checkinfo', 'seccodehtml',
	'showactivity');

$defaultversions = array(
	'wechat' => 4,
);

if(!in_array($_GET['module'], $modules)) {
	mobile_core::result(array('error' => 'module_not_exists'));
}
$_GET['version'] = !empty($_GET['version']) ? intval($_GET['version']) : (!$defaultversions[$_GET['module']] ? 1 : $defaultversions[$_GET['module']]);
$_GET['version'] = $_GET['version'] > MOBILE_PLUGIN_VERSION ? MOBILE_PLUGIN_VERSION : $_GET['version'];

if($_GET['version'] != 4) {
	$_GET['mobile'] = 'no';
}

if(empty($_GET['module']) || empty($_GET['version']) || !preg_match('/^[\w\.]+$/', $_GET['module']) || !preg_match('/^[\d\.]+$/', $_GET['version'])) {
	mobile_core::result(array('error' => 'param_error'));
}

if($_GET['module'] == 'extends') {
	require_once 'source/plugin/mobile/mobile_extends.php';
	return;
}

$apifile = 'source/plugin/mobile/api/'.$_GET['version'].'/'.$_GET['module'].'.php';

if(file_exists($apifile)) {
	require_once $apifile;
} else {
	if($_GET['version'] > 1) {
		for($i = $_GET['version']; $i >= 1; $i--) {
			$apifile = 'source/plugin/mobile/api/'.$i.'/'.$_GET['module'].'.php';
			if(file_exists($apifile)) {
				$_GET['version'] = $i;
				require_once $apifile;
				break;
			} elseif($i==1 && !file_exists($apifile)) {
				mobile_core::result(array('error' => 'module_not_exists'));
			}
		}
	} else {
		mobile_core::result(array('error' => 'module_not_exists'));
	}
}

?>