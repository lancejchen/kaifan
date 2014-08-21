<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member.php 34253 2013-11-25 03:36:23Z nemohou $
 */

define('APPTYPEID', 0);
define('CURSCRIPT', 'member');


require_once dir(__FILE__).'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


$_GET['lancelog'] = new Logger('name');
$_GET['lancelog']->pushHandler(new StreamHandler('test2.log',Logger::WARNING));
$_GET['lancelog']->addError('show me');
require './source/class/class_core.php';

$discuz = C::app();

$modarray = array('activate', 'emailverify', 'getpasswd',
	'groupexpiry', 'logging', 'lostpasswd',
	'register', 'regverify', 'switchstatus');





$mod = !in_array($discuz->var['mod'], $modarray) && (!preg_match('/^\w+$/', $discuz->var['mod']) || !file_exists(DISCUZ_ROOT.'./source/module/member/member_'.$discuz->var['mod'].'.php')) ? 'register' : $discuz->var['mod'];

define('CURMODULE', $mod);

$discuz->init();
if($mod == 'register' && $discuz->var['mod'] != $_G['setting']['regname']) {
	showmessage('undefined_action');
}


require libfile('function/member');
require libfile('class/member');
runhooks();


require DISCUZ_ROOT.'./source/module/member/member_'.$mod.'.php';

?>