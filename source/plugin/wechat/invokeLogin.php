<?php
/**
 * construct a url consist
 * formhash; refereer(redirect to forumlist);fastloginfield(value=username));
 *cookietime (value=2592000); username (user name); password (pwd); submit;
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

require_once libfile('class/memberwechat');

$ctl_obj = new logging_ctl();
$ctl_obj->setting = $_G['setting'];
$ctl_obj->template = 'member/login';

//other settings.
define('CURMODULE', $mod);
define('NOROBOT', TRUE);
$mod='logging';
$_GET['mod']='logging';
$_GET['action'] = 'login';
$_GET['loginsubmit']='yes';
$_GET['loginhash'] = 'LF22X';//may need to be changed
$_GET['mobile']=2;
$_GET['handlekey']='loginform';
$_GET['inajax'] = 1;
$_GET['formhash'] = '5d85b8df';//may need to be changed later
$_GET['referer']="http://kaifanlou.com/forum.php?mod=forumdisplay&fid=2&mobile=2";
$_GET['fastloginfield']='username';
$_GET['cookietime']=2592000;//may need to be changed later
$_GET['username'] = 'lanceturnbull';//need to be changed later
$_GET['password']= ''; //change
$_GET['questionid'] = 0;
$_GET['answer']='';
$_GET['seccodehash']='';//security hash code
$_GET['seccodeverify']='';//secur
$_GET['loginfield'] = 'username';




//
$_GET['fromWeChatLogin']=true;

$ctl_obj->on_login();

//in default setting, has no $_G['uid'];

