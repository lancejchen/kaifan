<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: wechat.php 34480 2014-05-07 01:18:15Z nemohou $
 */
if (!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

define('DISABLEXSSCHECK', true);

require './source/class/class_core.php';

$discuz = C::app();

$cachelist = array('plugin');

$discuz->cachelist = $cachelist;
$discuz->init();

$_G['siteurl'] = str_replace('api/mobile/', '', $_G['siteurl']);
$_G['wechat']['setting'] = unserialize($_G['setting']['mobilewechat']);

$_GET['log']->addError('before require_once \n');
require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';

$_GET['log']->addError('after require_once wechat.lib.class \n');


$_GET['log']->addError('get response  \n');
//update array
/*
$data = array(
    'receiveEvent::view' => array(
        'plugin' => 'wechat',
        'include' => 'response.class.php',
        'class' => 'WSQResponse',
        'method' => 'view'
    ),
    'receiveEvent::location' => array(
        'plugin' => 'wechat',
        'include' => 'response.class.php',
        'class' => 'WSQResponse',
        'method' => 'location'
    )
);
//dsetcookie('api response','yes it is me');
//dheader('location:http://www.kaifanlou.com/test2.php');

WeChatHook::updateResponse($data,$_GET['id']);

$response = WeChatHook::getResponse($_GET['id']);
*/
//hello

$_GET['log']->addError('The response is \n');
foreach($response as $num=>$content){
    $_GET['log']->addError($num . ' content ' .$content);
}


$svr = new WeChatServer($_G['wechat']['setting']['wechat_token'], WeChatHook::getResponse($_GET['id']));