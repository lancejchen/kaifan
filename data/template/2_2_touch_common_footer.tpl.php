<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

<div id="mask" style="display:none;"></div>
</div>

</div>
<div class="b_blank"></div>
</div>


<div id="float-news" class="float-news">
    <div class="nv_c cl">
        <a class="float-close" href="javascript:void(0);">X</a>
        <div class="nv_loop nv_loop1">
            <h2>页面导航</h2>
            <ul>
                <li class="cl"><a href="forum.php?mod=guide&amp;view=hot">网站首页</a><a href="forum.php?forumlist=1">版块列表</a></li>
                <?php if($webshow_group_link ==1) { ?>
                <li class="cl"><a href="group.php">群组列表</a><a href="group.php?mod=my">我的群组</a></li>
                <?php } ?>
                <li class="cl">
                    <a href="misc.php?mod=tag">标签</a>
                    <?php if(helper_access::check_module('doing')) { ?>
                    <a href="home.php?mod=space&amp;do=doing">说说</a>
                    <?php } ?>
                </li>
                <li class="cl"><a href="home.php?mod=medal">勋章</a><a href="search.php?mod=forum">搜索</a></li>
            </ul>
        </div>
        <div class="nv_loop nv_loop1">
            <h2>会员</h2>
            <ul>
                <?php if(!$_G['uid'] && !$_G['connectguest']) { ?>
                <li><a href="member.php?mod=logging&amp;action=login">登录</a><a href="<?php if($_G['setting']['regstatus']) { ?>member.php?mod=<?php echo $_G['setting']['regname'];?><?php } else { ?>javascript:;<?php } ?>" class="mu_last">注册</a></li>
                <?php } else { ?>
                <li><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1">资料修改</a><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="mu_last">退出</a></li>
                <?php } ?>
            </ul>
        </div>
        <?php if($_G['uid']) { ?>
        <div class="nv_loop">
            <h2>通知</h2>
            <ul>
                <li><a href="home.php?mod=space&amp;do=pm">我的消息</a><?php if($_G['member']['newpm']) { ?><em>(new)</em><?php } ?></li>
                <li><a href="home.php?mod=space&amp;do=notice">回复提醒</a><?php if($_G['member']['newprompt']) { ?><em>(<?php echo $_G['member']['newprompt'];?>)</em><?php } ?></li>
            </ul>
        </div>
        <div class="nv_loop nv_loop1">
            <h2>其他</h2>
            <ul>
                <li><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me">我的主题</a><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread">我的收藏</a></li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>



<?php if($_GET['mod'] !== 'viewthread') { ?>
<!--底部导航-->
<div data-role="footer" id="btoolbar" data-position="fixed" class="ui-bar" data-id="navBarFooter">
    <div data-role="navbar" id="navgiBar" class="btoolft_update cl" data-iconpos="left">
        <ul>
            <li id="backBtn"><!--<a id="backBtnA" href="javascript: history.go(-1);" class="ui-icon-back" data-icon="back">-->
                <a id="backBtnA" data-rel="back" data-direction="reverse" class="ui-icon-back" data-icon="back">

                <span style="opacity:0;">.</span></a></li>
            <li id='nearby' class="li1<?php if($_GET['mod'] == 'guide') { ?>_current<?php } ?>"><a class="ui-btn ui-icon-location <?php if($_GET['mod']=='forumdisplay') { ?>ui-btn-active ui-state-persist<?php } ?>" data-icon="location" data-inline="true" href="forum.php?mod=forumdisplay&amp;fid=2&amp;mobile=2" data-transition="slide" >附近</a></li>
            <li id='createEvent' class="li3"><a  href="forum.php?mod=post&amp;action=newthread&amp;fid=2&amp;special=4" class="ui-icon-plus <?php if($_GET['mod']=='post' && $_GET['special']=='4' ) { ?>ui-btn-active ui-state-persist<?php } ?> " data-icon="plus" data-transition="slide">发布</a></li>
            <li id="etc" class="li5<?php if($_GET['mod'] == 'space') { ?> current<?php } ?> current5">
                <div id="float-open" class="float-open"><a class="open-btn ui-icon-bars" data-icon="bars" href="javascript:void(0);"><span class="ui-li-count">6</span><span style="opacity:0;">.</span></a></div>
            </li>
        </ul>
    </div>
</div>
<?php } ?>







<script src="template/webshow_mtb0115/touch/img/js/expand.js" type="text/javascript"></script>
<script type="text/javascript">
<?php if($_G['basescript'] == 'forum' && CURMODULE == post || $_GET['mod'] == 'viewthread') { ?>
window.onload=function(){ 
setTimeout(function(){
$('#fastsmilies').html('<table cellspacing="0" cellpadding="0"><tr>' + smilies_fastdata + '</tr></table>');},0);
};
<?php } ?>

</script>
</div>
</body>
</html><?php updatesession();?><?php if(defined('IN_MOBILE')) { output();?><?php } else { output_preview();?><?php } ?>