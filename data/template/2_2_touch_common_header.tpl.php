<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-control" content="<?php if($_G['setting']['mobile']['mobilecachetime'] > 0) { ?><?php echo $_G['setting']['mobile']['mobilecachetime'];?><?php } else { ?>no-cache<?php } ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="<?php if(!empty($metakeywords)) { echo dhtmlspecialchars($metakeywords); } ?>" />
<meta name="description" content="<?php if(!empty($metadescription)) { echo dhtmlspecialchars($metadescription); ?> <?php } ?>,<?php echo $_G['setting']['bbname'];?>" />
<meta http-equiv="Page-Exit" content="RevealTrans (Duration=3, Transition=23)">
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php if(!empty($navtitle)) { ?><?php echo $navtitle;?> - <?php } if(empty($nobbname)) { ?> <?php echo $_G['setting']['bbname'];?> - <?php } ?> 手机版</title>
    <link rel="shortcut icon" href="http://kaifan.oss-cn-hangzhou.aliyuncs.com/cdn/k.ico"/>
    <link rel="stylesheet" href="<?php echo STATICURL;?>css/jquery.mobile-1.4.3.min.css" type="text/css" media="all">

    <link rel="stylesheet" href="<?php echo STATICURL;?>css/jQueryUI/jquery-ui.min.css">
<?php if($_GET['mod']=='viewthread') { ?>
    <link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/thread.css" type="text/css">
<?php } ?>

    <link rel="stylesheet" href="<?php echo STATICURL;?>css/icon.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo STATICURL;?>image/mobile/style.css" type="text/css" media="all">

<script src="<?php echo STATICURL;?>js/mobile/jquery-1.8.3.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>

    <script src="<?php echo STATICURL;?>css/jQueryUI/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo STATICURL;?>js/mobile/jquery.mobile-1.4.3.min.js?<?php echo VERHASH;?>" type="text/javascript"></script>
<script type="text/javascript">var STYLEID = '<?php echo STYLEID;?>', STATICURL = '<?php echo STATICURL;?>', IMGDIR = '<?php echo IMGDIR;?>', VERHASH = '<?php echo VERHASH;?>', charset = '<?php echo CHARSET;?>', discuz_uid = '<?php echo $_G['uid'];?>', cookiepre = '<?php echo $_G['config']['cookie']['cookiepre'];?>', cookiedomain = '<?php echo $_G['config']['cookie']['cookiedomain'];?>', cookiepath = '<?php echo $_G['config']['cookie']['cookiepath'];?>', showusercard = '<?php echo $_G['setting']['showusercard'];?>', attackevasive = '<?php echo $_G['config']['security']['attackevasive'];?>', disallowfloat = '<?php echo $_G['setting']['disallowfloat'];?>', creditnotice = '<?php if($_G['setting']['creditnotice']) { ?><?php echo $_G['setting']['creditnames'];?><?php } ?>', defaultstyle = '<?php echo $_G['style']['defaultextstyle'];?>', REPORTURL = '<?php echo $_G['currenturl_encode'];?>', SITEURL = '<?php echo $_G['siteurl'];?>', JSPATH = '<?php echo $_G['setting']['jspath'];?>';</script>

<script src="<?php echo STATICURL;?>js/mobile/common.js?<?php echo VERHASH;?>" type="text/javascript" charset="<?php echo CHARSET;?>"></script>
    <script src="template/webshow_mtb0115/touch/img/js/jqm.customized.js" type="text/javascript"></script>
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/base.css?<?php echo VERHASH;?>" type="text/css">
<?php if($_G['basescript'] == 'group') { ?>
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/group.css?<?php echo VERHASH;?>" type="text/css">
<?php } ?>
    <script src="template/webshow_mtb0115/touch/img/js/jq.customized.js" type="text/javascript"></script>
    <link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/jqm_fixes.css?<?php echo VERHASH;?>">
</head>

<body class="bg"><?php require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/wap_config.php';?><div data-role="page" id="real">
    <div class="ui-panel-wrapper">
        <div data-role="main" class="ui-content" style="padding:0px;">
            <div id="mwp">
                <div id="mcontent">
<!--        <div class="t_blank cl"></div>-->
