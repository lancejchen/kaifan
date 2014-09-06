<?php

//require_once './source/plugin/wechat/wechat.lib.class.php';

//require './source/class/class_core.php';

//$discuz = C::app();
$a = "41";
echo His2Hi($a);

function His2Hi($Hi){
    $tmp=explode(':',$Hi);
    if(sizeof($tmp)>1){
        return $tmp[0].':'.$tmp[1];
    }
    return "wrong format";
}

?>