<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum.php 33828 2013-08-20 02:29:32Z nemohou $
 */

define('APPTYPEID', 2);
define('CURSCRIPT', 'forum');


require_once dir(__FILE__).'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

global $log;
$log = new Logger('name');
$log->pushHandler(new StreamHandler('test2.log',Logger::WARNING));

//$log->addWarning('location');
//$log->addError('bar');
//$postdata = file_get_contents("php://input");
//$log->addError('from forum.php '. $postdata);
$cookieLog = '';
foreach ($_COOKIE as $key=>$val)
{
    $cookieLog.= $key.' is '.$val."<br>\n";
}
$log->addError('from forum the cookies are\n'.$cookieLog);

require './source/class/class_core.php';


require './source/function/function_forum.php';


$modarray = array('ajax','announcement','attachment','forumdisplay',
	'group','image','index','medal','misc','modcp','notice','post','redirect',
	'relatekw','relatethread','rss','topicadmin','trade','viewthread','tag','collection','guide'
);

$modcachelist = array(
	'index'		=> array('announcements', 'onlinelist', 'forumlinks',
			'heats', 'historyposts', 'onlinerecord', 'userstats', 'diytemplatenameforum'),
	'forumdisplay'	=> array('smilies', 'announcements_forum', 'globalstick', 'forums',
			'onlinelist', 'forumstick', 'threadtable_info', 'threadtableids', 'stamps', 'diytemplatenameforum'),
	'viewthread'	=> array('smilies', 'smileytypes', 'forums', 'usergroups',
			'stamps', 'bbcodes', 'smilies',	'custominfo', 'groupicon', 'stamps',
			'threadtableids', 'threadtable_info', 'posttable_info', 'diytemplatenameforum'),
	'redirect'	=> array('threadtableids', 'threadtable_info', 'posttable_info'),
	'post'		=> array('bbcodes_display', 'bbcodes', 'smileycodes', 'smilies', 'smileytypes',
			'domainwhitelist', 'albumcategory'),
	'space'		=> array('fields_required', 'fields_optional', 'custominfo'),
	'group'		=> array('grouptype', 'diytemplatenamegroup'),
);

$mod = !in_array(C::app()->var['mod'], $modarray) ? 'index' : C::app()->var['mod'];

define('CURMODULE', $mod);
$cachelist = array();
if(isset($modcachelist[CURMODULE])) {
	$cachelist = $modcachelist[CURMODULE];

	$cachelist[] = 'plugin';
	$cachelist[] = 'pluginlanguage_system';
}
if(C::app()->var['mod'] == 'group') {
	$_G['basescript'] = 'group';
}

C::app()->cachelist = $cachelist;
//lance created discuz_application instance, it adds new variables like modcache etc into the application.
C::app()->init();

loadforum();

set_rssauth();

runhooks();

$navtitle = str_replace('{bbname}', $_G['setting']['bbname'], $_G['setting']['seotitle']['forum']);
$_G['setting']['threadhidethreshold'] = 1;

/*set login status


$member = getuserbyuid(61, 1);
if($member) {
    require_once libfile('function/member');
    setloginstatus($member, 1296000);
}

*/

require DISCUZ_ROOT.'./source/module/forum/forum_'.$mod.'.php';

?>