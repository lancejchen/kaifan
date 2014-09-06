<?php
/**
 * Created by PhpStorm.
 * User: peterwhyle
 * Date: 8/24/14
 * Time: 12:32 PM
 */

//if already has cookies
/*
         * setlogin status and send cookies back
         * 1) if cookie exists & valid, redirect to kaifanlou.com
         * 2) if not redirect to open.weixin.qq.con to get users openid
*/

define('IN_WECHAT', strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false);

if(!IN_WECHAT){
    echo "请在微信中登陆！";
    exit;
}


define('DISABLEXSSCHECK', true);

require './source/class/class_core.php';

$discuz = C::app();

$cachelist = array('plugin');

$discuz->cachelist = $cachelist;
$discuz->init();


if(!empty($_G['uid'])){
    header('Location:http://kaifanlou.com/');
}else{
    $urlEncode='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxd951eb6b813b25ae&redirect_uri=http%3A%2F%2Fkaifanlou.com%2Fplugin.php%3Fid%3Dwechat%3Aaccess%26start_debug%3D1%26debug_host%3D202.189.99.44%26debug_port%3D10137&response_type=code&scope=snsapi_base&state=123#wechat_redirect';

    //echo urlencode($urlEncode);
    header('Location:'.$urlEncode);
}
exit;

?>