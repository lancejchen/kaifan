<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); function mobile_codedisp($code) {?><?php
$return = <<<EOF
<div class="blockcode"><span></span><ol><li>{$code}</ol></div>
EOF;
?><?php return $return;?><?php }

function mobile_quote() {?><?php
$return = <<<EOF
<div class="reply_wrap">\\1</div>
EOF;
?><?php return $return;?><?php }

function mobile_free() {?><?php
$return = <<<EOF
<div class="reply_wrap">\\1</div>
EOF;
?><?php return $return;?><?php }

function mobile_image($url, $extra) {?><?php
$return = <<<EOF
<div class="img"><img src="{$url}" {$extra}/></div>
EOF;
?><?php return $return;?><?php }

function mobile_hide_reply() {
global $_G;?><?php
$return = <<<EOF
<div class="showhide"><h4>!post_hide_reply_hidden!</h4>\\1</div>

EOF;
?><?php return $return;?><?php }

function mobile_hide_reply_hidden() {
global $_G;?><?php
$return = <<<EOF
<div class="locked">
EOF;
 if($_G['uid']) { 
$return .= <<<EOF
{$_G['username']}
EOF;
 } else { 
$return .= <<<EOF
游客
EOF;
 } 
$return .= <<<EOF
!post_hide_reply_hidden!</div>
EOF;
?><?php return $return;?><?php }?>