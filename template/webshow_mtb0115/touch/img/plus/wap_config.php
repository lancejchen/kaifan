<?php

if(!defined('IN_DISCUZ')) {exit('Access Denied');}

global $myfollow;
$myfollow=array();
$rs=DB::query("SELECT followuid
FROM  ".DB::table("home_follow")."
WHERE  `uid` ='{$_G['uid']}'");
while ($rw=DB::fetch($rs)) {
    $myfollow[]=$rw['followuid'];
}

$webshow_nav_b=1;
$webshow_group_link=1;


$webshow_forumdisplay_pic=1;
$webshow_forumdisplay_txt=1;

$webshow_sign=1;
$webshow_vtag=1;
$webshow_vrelate=1;

?>

