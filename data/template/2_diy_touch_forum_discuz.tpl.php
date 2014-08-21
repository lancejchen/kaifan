<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('discuz');?>
<?php if($_G['setting']['mobile']['mobilehotthread'] && $_GET['forumlist'] != 1) { dheader('Location:forum.php?mod=forumdisplay&fid=2');exit;?><?php } include template('common/header'); ?><link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/discuz.css?<?php echo VERHASH;?>" type="text/css">
<script type="text/javascript">
function getvisitclienthref() {
var visitclienthref = '';
if(ios) {
visitclienthref = 'https://itunes.apple.com/cn/app/zhang-shang-lun-tan/id489399408?mt=8';
} else if(andriod) {
visitclienthref = 'http://www.discuz.net/mobile.php?platform=android';
}
return visitclienthref;
}
</script>

<?php if($_GET['visitclient']) { ?>
<header class="header">
    <div class="nav">
<span>温馨提示</span>
    </div>
</header>
<div class="cl">
<div class="clew_con">
<h2 class="tit">掌上论坛手机客户端</h2>
<p>随时随地上论坛<input class="redirect button" id="visitclientid" type="button" value="点击下载" href="" /></p>
<h2 class="tit">iPhone,Andriod等智能手机</h2>
<p>直接登录手机版，阅读体验更佳<input class="redirect button" type="button" value="访问手机版" href="<?php echo $_GET['visitclient'];?>" /></p>
</div>
</div>
<script type="text/javascript">
var visitclienthref = getvisitclienthref();
if(visitclienthref) {
$('#visitclientid').attr('href', visitclienthref);
} else {
window.location.href = '<?php echo $_GET['visitclient'];?>';
}
</script>

<?php } else { if($showvisitclient) { ?>
<div class="visitclienttip vm" style="display:block;">
<a href="javascript:;" id="visitclientid" class="btn_download">立即下载</a>	
<p>
下载新版掌上论坛客户端，尊享多项看帖特权!
</p>
</div>
<script type="text/javascript">
var visitclienthref = getvisitclienthref();
if(visitclienthref) {
$('#visitclientid').attr('href', visitclienthref);
$('.visitclienttip').css('display', 'block');
}
</script>
<?php } ?>
<!--去原头部-->
<?php if(!empty($_G['setting']['pluginhooks']['index_top_mobile'])) echo $_G['setting']['pluginhooks']['index_top_mobile'];?>

<?php if($forum_favlist) { ?>
<div class="mdiscuz_fav">
    <h2>我收藏的吧</h2>
    <ul class="cl">
    <?php $favorderid = 0;?>    <?php if(is_array($forum_favlist)) foreach($forum_favlist as $key => $favorite) { ?>    <?php if($favforumlist[$favorite['id']]) { ?>
    <?php $forum=$favforumlist[$favorite[id]];?>    <?php $forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];?>    <li><a href="<?php echo $forumurl;?>"><span><?php echo $forum['name'];?> <?php if($forum['todayposts']) { ?><em>(<?php echo $forum['todayposts'];?>)</em><?php } ?></span></a></li>
    <?php } ?>
    <?php } ?>
    </ul>
</div>
<?php } ?>

<div id="m_forum"><?php if(is_array($catlist)) foreach($catlist as $key => $cat) { ?><div class="mforum_list">
<div class="mforum_bh cl" href="#sub_forum_<?php echo $cat['fid'];?>">
<span class="o"><img src="template/webshow_mtb0115/touch/img/collapsed_<?php if(!$_G['setting']['mobile']['mobileforumview']) { ?>yes<?php } else { ?>no<?php } ?>.png"></span>
    <a href="javascript:;"><?php echo $cat['name'];?></a>
</div>
<div id="sub_forum_<?php echo $cat['fid'];?>" class="mforum_main">
<ul><?php if(is_array($cat['forums'])) foreach($cat['forums'] as $forumid) { $forum=$forumlist[$forumid];?><li class="cl">
                    <dl<?php if($forum['todayposts'] > 0) { ?> style="background-image:none;"<?php } ?>>
                        <dt>
                            <?php if($forum['icon']) { ?>
                                <?php echo $forum['icon'];?>
                            <?php } else { ?>
                                <?php $i >= 11 ? $i = 1 : $i++;?>                                <img src="template/webshow_mtb0115/touch/img/ficon/<?php echo $i;?>.png" />
                            <?php } ?>
                        </dt>
                        <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $forum['fid'];?>" class="mforum_main_link">
                        <dd class="dd1"><?php echo $forum['name'];?></dd>
                        <dd class="dd2"><?php echo $forum['description'];?></dd>
                        <?php if($forum['todayposts'] > 0) { ?><span class="s3"><?php echo $forum['todayposts'];?></span><?php } ?>
                        </a>
                    </dl>
                    
                </li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
</div>

<?php if(!empty($_G['setting']['pluginhooks']['index_middle_mobile'])) echo $_G['setting']['pluginhooks']['index_middle_mobile'];?>
<script type="text/javascript">
(function() {
<?php if(!$_G['setting']['mobile']['mobileforumview']) { ?>
$('.mforum_main').css('display', 'block');
<?php } else { ?>
$('.mforum_main').css('display', 'none');
<?php } ?>
$('.mforum_bh').on('click', function() {
var obj = $(this);
var subobj = $(obj.attr('href'));
if(subobj.css('display') == 'none') {
subobj.css('display', 'block');
obj.find('img').attr('src', 'template/webshow_mtb0115/touch/img/collapsed_yes.png');
} else {
subobj.css('display', 'none');
obj.find('img').attr('src', 'template/webshow_mtb0115/touch/img/collapsed_no.png');
}
});
 })();
</script>

<?php } include template('common/footer'); ?>