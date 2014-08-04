<?php exit;?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="{if $_G['setting']['mobile'][mobilecachetime] > 0}{$_G['setting']['mobile'][mobilecachetime]}{else}no-cache{/if}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="{if !empty($metakeywords)}{echo dhtmlspecialchars($metakeywords)}{/if}" />
<meta name="description" content="{if !empty($metadescription)}{echo dhtmlspecialchars($metadescription)} {/if},$_G['setting']['bbname']" />
<meta http-equiv="Page-Exit" content="RevealTrans (Duration=3, Transition=23)">
<meta name="apple-mobile-web-app-capable" content="yes">
<title><!--{if !empty($navtitle)}-->$navtitle - <!--{/if}--><!--{if empty($nobbname)}--> $_G['setting']['bbname'] - <!--{/if}--> {lang waptitle}</title>
    <link rel="stylesheet" href="{STATICURL}css/jquery.mobile-1.4.3.min.css" type="text/css" media="all">

    <link rel="stylesheet" href="{STATICURL}css/jQueryUI/jquery-ui.min.css">



    <link rel="stylesheet" href="{STATICURL}css/icon.css" type="text/css" media="all">
    <link rel="stylesheet" href="{STATICURL}image/mobile/style.css" type="text/css" media="all">

<script src="{STATICURL}js/mobile/jquery-1.8.3.min.js?{VERHASH}"></script>

    <script src="{STATICURL}css/jQueryUI/jquery-ui.js"></script>
<script src="{STATICURL}js/mobile/jquery.mobile-1.4.3.min.js?{VERHASH}"></script>
<script type="text/javascript">var STYLEID = '{STYLEID}', STATICURL = '{STATICURL}', IMGDIR = '{IMGDIR}', VERHASH = '{VERHASH}', charset = '{CHARSET}', discuz_uid = '$_G[uid]', cookiepre = '{$_G[config][cookie][cookiepre]}', cookiedomain = '{$_G[config][cookie][cookiedomain]}', cookiepath = '{$_G[config][cookie][cookiepath]}', showusercard = '{$_G[setting][showusercard]}', attackevasive = '{$_G[config][security][attackevasive]}', disallowfloat = '{$_G[setting][disallowfloat]}', creditnotice = '<!--{if $_G['setting']['creditnotice']}-->$_G['setting']['creditnames']<!--{/if}-->', defaultstyle = '$_G[style][defaultextstyle]', REPORTURL = '$_G[currenturl_encode]', SITEURL = '$_G[siteurl]', JSPATH = '$_G[setting][jspath]';</script>

<script src="{STATICURL}js/mobile/common.js?{VERHASH}" charset="{CHARSET}"></script>
    <script src="template/webshow_mtb0115/touch/img/js/jqm.customized.js"></script>
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/base.css?{VERHASH}" type="text/css">
<!--{if $_G['basescript'] == 'group'}-->
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/group.css?{VERHASH}" type="text/css">
<!--{/if}-->
    <script src="template/webshow_mtb0115/touch/img/js/jq.customized.js"></script>
    <link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/jqm_fixes.css?{VERHASH}">
</head>

<body class="bg">
<!--{eval require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/wap_config.php';}-->
<div data-role="page">
<div role="main" class="ui-content" style="padding:0px;">
<div id="mwp">
    <div id="mcontent">
        <div class="t_blank cl"></div>
