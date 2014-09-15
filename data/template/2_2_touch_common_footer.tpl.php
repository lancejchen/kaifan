<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''?><?php if(strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';?><?php } elseif(strpos($useragent, 'android') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';?><?php } elseif(strpos($useragent, 'windows phone') !== false) { $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';?><?php } ?>

                <div id="mask" style="display:none;"></div>
                </div>
            </div>
        </div><!--end of content-->
    </div><!--end of ui-panel-wrapper-->

<?php if($_GET['mod'] !== 'viewthread') { ?>
<!--底部导航-->
<div data-role="footer" id="btoolbar" data-position="fixed" class="ui-bar" data-id="navBarFooter" style="overflow:
visible;">
    <div data-role="navbar" id="navgiBar" class="btoolft_update cl" data-iconpos="left">
        <ul>
            <li id="backBtn"><!--<a id="backBtnA" href="javascript: history.go(-1);" class="ui-icon-back" data-icon="back">-->
                <a id="backBtnA" data-rel="back" data-direction="reverse" class="ui-icon-back" data-icon="back">

                <span style="opacity:0;">.</span></a></li>
            <li id='nearby' class="li1<?php if($_GET['mod'] == 'guide') { ?>_current<?php } ?>"><a class="ui-btn ui-icon-location <?php if($_GET['mod']=='forumdisplay') { ?>ui-btn-active ui-state-persist<?php } ?>" data-icon="location" data-inline="true" href="forum.php?mod=forumdisplay&amp;fid=2&amp;mobile=2" data-transition="slide" >附近</a></li>
            <li id='createEvent' class="li3"><a  href="forum.php?mod=post&amp;action=newthread&amp;fid=2&amp;special=4" class="ui-icon-plus <?php if($_GET['mod']=='post' && $_GET['special']=='4' ) { ?>ui-btn-active ui-state-persist<?php } ?> " data-icon="plus" data-transition="slide">发布</a></li>
            <li id="etc" class="li5<?php if($_GET['mod'] == 'space') { ?> current<?php } ?> current5">
                <a href="#nav-panel" class="ui-btn ui-btn-inline ui-icon-bars" data-icon="bars"><span class="ui-li-count">6</span><span style="opacity:0;">.</span></a>
            </li>
        </ul>
    </div>
</div>
<?php } ?>


<div data-role="panel" data-position="right" data-position-fixed="false" data-display="reveal" id="nav-panel" data-theme="a">
    <ul data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search"
        data-inset="true">

        <li class="nav_block" data-icon="delete">
            <a href="#" data-rel="close"></a>
        </li>

        <li class="nav_block">
            <h2>页面导航</h2>
            <ul>
                <li class="nav_line">
                    <div class="sameLine"><a href="forum.php?mod=guide&amp;view=hot">网站首页</a></div>
                    <div class="sameLine"><a href="forum.php?forumlist=1">版块列表</a></div>
                </li>

                <?php if($webshow_group_link ==1) { ?>
                <li class="nav_line">
                    <div class="sameLine"><a href="group.php">群组列表</a></div>
                    <div class="sameLine"><a href="group.php?mod=my">我的群组</a></div>
                </li>
                <?php } ?>
                <li class="nav_line">
                    <div class="sameLine"><a href="misc.php?mod=tag">标签</a></div>
                    <?php if(helper_access::check_module('doing')) { ?>
                    <div class="sameLine"><a href="home.php?mod=space&amp;do=doing">说说</a></div>
                    <?php } ?>
                </li>
                <li class="nav_line">
                    <div class="sameLine"><a href="home.php?mod=medal">勋章</a></div>
                    <div class="sameLine"><a href="search.php?mod=forum">搜索</a></div>
                </li>
            </ul>
        </li>


        <li class="nav_block">
            <h2>会员</h2>
            <ul>
                <?php if(!$_G['uid'] && !$_G['connectguest']) { ?>
                <li class="nav_line">
                    <div class="sameLine"><a href="member.php?mod=logging&amp;action=login">登录</a></div>
                    <div class="sameLine"><a href="<?php if($_G['setting']['regstatus']) { ?>member.php?mod=<?php echo $_G['setting']['regname'];?><?php } else { ?>javascript:;<?php } ?>" class="mu_last">注册</a></div>
                </li>
                <?php } else { ?>
                <li class="nav_line">
                    <div class="sameLine"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=profile&amp;mycenter=1">资料修改</a></div>
                    <div class="sameLine"><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="mu_last">退出</a></div>
                </li>
                <?php } ?>
            </ul>
        </li>

        <?php if($_G['uid']) { ?>
        <li class="nav_block">
            <h2>通知</h2>
            <ul>
                <li class="nav_line"><a href="home.php?mod=space&amp;do=pm">我的消息</a><?php if($_G['member']['newpm']) { ?><em>(new)
                    </em><?php } ?></li>
                <li class="nav_line"><a href="home.php?mod=space&amp;do=notice">回复提醒</a><?php if($_G['member']['newprompt']) { ?><em>(<?php echo $_G['member']['newprompt'];?>)</em><?php } ?></li>
            </ul>
        </li>

        <li class="nav_block">
            <h2>其他</h2>
            <ul>
                <li class="nav_line">
                    <div class="sameLine"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=thread&amp;view=me">我的主题</a></div>
                    <div class="sameLine"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>&amp;do=favorite&amp;view=me&amp;type=thread">我的收藏</a></div>
                </li>
            </ul>
        </li>
        <?php } ?>
    </ul>
</div>





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