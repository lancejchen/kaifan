<?php exit;?>
<!--{eval $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);$clienturl = ''}-->
<!--{if strpos($useragent, 'iphone') !== false || strpos($useragent, 'ios') !== false}-->
<!--{eval $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=ios' : 'http://www.discuz.net/mobile.php?platform=ios';}-->
<!--{elseif strpos($useragent, 'android') !== false}-->
<!--{eval $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=android' : 'http://www.discuz.net/mobile.php?platform=android';}-->
<!--{elseif strpos($useragent, 'windows phone') !== false}-->
<!--{eval $clienturl = $_G['cache']['mobileoem_data']['iframeUrl'] ? $_G['cache']['mobileoem_data']['iframeUrl'].'&platform=windowsphone' : 'http://www.discuz.net/mobile.php?platform=windowsphone';}-->
<!--{/if}-->

<div id="mask" style="display:none;"></div>
<!--{if !$nofooter}--><!--{/if}-->
</div>

<script>

</script>


<div class="b_blank"></div>
<div data-role="content" data-add-back-btn="true"></div>

<!--{if $_GET['mod'] !== 'viewthread'}-->
<!--底部导航-->
<div data-role="footer" id="btoolbar" data-position="fixed" class="ui-bar" data-id="navBarFooter">
    <div data-role="navbar" id="navgiBar" class="btoolft_update cl" data-iconpos="left">
        <ul>
            <li id="backBtn"><!--<a id="backBtnA" href="javascript: history.go(-1);" class="ui-icon-back" data-icon="back">-->
                <a id="backBtnA" data-rel="back" data-direction="reverse" class="ui-icon-back" data-icon="back">

                <span style="opacity:0;">.</span></a></li>
            <li id='nearby' class="li1{if $_GET['mod'] == 'guide'}_current{/if}"><a class="ui-btn ui-icon-location {if $_GET['mod']=='forumdisplay'}ui-btn-active ui-state-persist{/if}" data-icon="location" data-inline="true" href="forum.php?mod=forumdisplay&fid=2&mobile=2" data-transition="slide" >附近</a></li>
            <li id='createEvent' class="li3"><a  href="forum.php?mod=post&action=newthread&fid=2&special=4" class="ui-icon-plus {if $_GET['mod']=='post' && $_GET['special']=='4' }ui-btn-active ui-state-persist{/if} " data-icon="plus" data-transition="slide">发布</a></li>
            <li id="etc" class="li5{if $_GET['mod'] == 'space'} current{/if} current5">
                <div id="float-open" class="float-open"><a class="open-btn ui-icon-bars" data-icon="bars" href="javascript:void(0);"><span class="ui-li-count">6</span><span style="opacity:0;">.</span></a></div>
            </li>
        </ul>
    </div>
</div>
<!--{/if}-->

<div id="float-news" class="float-news">
    <div class="nv_c cl">
        <a class="float-close" href="javascript:void(0);">X</a>
        <div class="nv_loop nv_loop1">
            <h2>页面导航</h2>
            <ul>
                <li class="cl"><a href="forum.php?mod=guide&view=hot">网站首页</a><a href="forum.php?forumlist=1">版块列表</a></li>
                <!--{if $webshow_group_link ==1}-->
                <li class="cl"><a href="group.php">群组列表</a><a href="group.php?mod=my">我的群组</a></li>
                <!--{/if}-->
                <li class="cl">
                    <a href="misc.php?mod=tag">标签</a>
                    <!--{if helper_access::check_module('doing')}-->
                    <a href="home.php?mod=space&do=doing">说说</a>
                    <!--{/if}-->
                </li>
                <li class="cl"><a href="home.php?mod=medal">勋章</a><a href="search.php?mod=forum">搜索</a></li>
            </ul>
        </div>
        <div class="nv_loop nv_loop1">
            <h2>会员</h2>
            <ul>
                <!--{if !$_G[uid] && !$_G['connectguest']}-->
                <li><a href="member.php?mod=logging&action=login">登录</a><a href="{if $_G['setting']['regstatus']}member.php?mod={$_G[setting][regname]}{else}javascript:;{/if}" class="mu_last">注册</a></li>
                <!--{else}-->
                <li><a href="home.php?mod=space&uid={$_G[uid]}&do=profile&mycenter=1">资料修改</a><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}" class="mu_last">退出</a></li>
                <!--{/if}-->
            </ul>
        </div>
        <!--{if $_G[uid]}-->
        <div class="nv_loop">
            <h2>通知</h2>
            <ul>
                <li><a href="home.php?mod=space&do=pm">我的消息</a>{if $_G[member][newpm]}<em>(new)</em>{/if}</li>
                <li><a href="home.php?mod=space&do=notice">回复提醒</a>{if $_G[member][newprompt]}<em>({$_G[member][newprompt]})</em>{/if}</li>
            </ul>
        </div>
        <div class="nv_loop nv_loop1">
            <h2>其他</h2>
            <ul>
                <li><a href="home.php?mod=space&uid=$_G[uid]&do=thread&view=me">我的主题</a><a href="home.php?mod=space&uid=$_G[uid]&do=favorite&view=me&type=thread">我的收藏</a></li>
            </ul>
        </div>
        <!--{/if}-->
    </div>
</div>

</div>

<script src="template/webshow_mtb0115/touch/img/js/expand.js"></script>
<script type="text/javascript">
<!--{if $_G['basescript'] == 'forum' && CURMODULE == post || $_GET['mod'] == 'viewthread'}-->
window.onload=function(){ 
	setTimeout(function(){
	$('#fastsmilies').html('<table cellspacing="0" cellpadding="0"><tr>' + smilies_fastdata + '</tr></table>');},0);
};
<!--{/if}-->
</script>
</body>
</html>
<!--{eval updatesession();}-->
<!--{if defined('IN_MOBILE')}-->
	<!--{eval output();}-->
<!--{else}-->
	<!--{eval output_preview();}-->
<!--{/if}-->