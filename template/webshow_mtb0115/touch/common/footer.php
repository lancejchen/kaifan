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
<div class="b_blank"></div>

<!--顶部导航-->
<div id="ttoolbar">
    <!--{if $_G['setting']['domain']['app']['mobile']}-->
			{eval $nav = 'http://'.$_G['setting']['domain']['app']['mobile'];}
		<!--{else}-->
			{eval $nav = "forum.php";}
    <!--{/if}-->
    <div class="ttool cl">
        <!--中间文字-->
        <div class="m_txt{if $_GET['mod'] == 'guide'} m_txt_logo{/if}">
            {if $_GET['mod'] == 'guide'}
            {elseif $_GET['mod'] == 'forumdisplay'}
                <span>{$_G['forum']['name']}</span>
            {elseif $_GET['mod'] == 'viewthread'}
                主题帖
            {elseif $_GET['mod'] == 'logging'}   
                登录 
            {elseif $_GET['mod'] == 'tag'}   
                标签  
            {elseif $_GET['mod'] == 'post'}
                发表帖子
            {elseif $_G['basescript'] == 'search'}
                搜索
            {elseif $_GET['do'] == 'pm'}
                短消息
            {elseif $_GET['do'] == 'profile'}
                个人中心
            {elseif $_G['basescript'] == 'forum'}
                版块导航
            {else}
                <a href="forum.php?mod=guide&view=hot">{$_G[setting][bbname]}</a>
            {/if}
        </div>
        
        <!--左侧-->
        <div class="ttool_l">
            {if $_GET['mod'] == 'guide'}
            <a class="m_1" href="forum.php?forumlist=1"></a>
            {else}
            <a {if $_GET['mod'] == 'forumdisplay'}href="forum.php?forumlist=1"{elseif $_GET['mod'] == 'viewthread'}href="forum.php?mod=forumdisplay&fid=$_G[fid]"{else}onclick="javascript:history.back(-1);"{/if} class="m_2"></a>
            {/if}
        </div>

        <!--右侧-->
        <div class="ttool_r">
            {if !$_G[uid] && !$_G['connectguest']}
            <a href="javascript:void(0);" class="a_1 a_menu"></a>
                <div id="signin_menu" class="{if $_GET['mod'] == 'forumdisplay' || $_GET['do'] == 'pm'}signin_menuv{/if}">
                    <ul>
                        <li><a href="member.php?mod=logging&action=login">普通登录</a></li>
                        {if $_G['setting']['connect']['allow'] && !$_G['setting']['bbclosed']}
                        <li><a href="$_G[connect][login_url]&statfrom=login_simple">QQ登录</a></li>
                        {/if}
                        {if $_G['setting']['regstatus']}
                        <li><a href="member.php?mod={$_G[setting][regname]}">立即注册</a></li>
                        {/if}
                    </ul>
                </div>
            {elseif $_GET['mod'] !== 'viewthread'}
            <a href="javascript:void(0);" class="a_1 a_menu"></a>
                <div id="signin_menu" class="{if $_GET['mod'] == 'forumdisplay' || $_GET['do'] == 'pm'}signin_menuv{/if}">
                    <ul>
                        <li><a href="home.php?mod=space&do=pm">消息{if $_G[member][newpm]}<i>(new)</i>{/if}</a></li>
                        <li><a href="home.php?mod=space&do=notice">提醒{if $_G[member][newprompt]}<i>({$_G[member][newprompt]})</i>{/if}</a></li>
                        <!--{if helper_access::check_module('doing')}-->
                        <li><a href="home.php?mod=space&do=doing">说说</a></li>
                        <!--{/if}-->
                        <li><a href="home.php?mod=medal">勋章</a></li>
                        <li><a href="misc.php?mod=tag">标签</a></li>
                        <!--{if $_G[uid]}-->
                        <!--{if $webshow_group_link ==1}-->
                        <li><a href="group.php?mod=my">我的群组</a></li>
                        <li><a href="forum.php?mod=group&action=create">创建群组</a>
                        <!--{/if}--> 
                        <li><a href="home.php?mod=space&uid={$_G[uid]}&do=profile&mycenter=1">资料修改</a></li>
                        <li><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">退出</a></li>
                        <!--{/if}-->  
                    </ul>
                </div>
            {/if}
            {if $_GET['mod'] == 'forumdisplay'}
                <a href="forum.php?mod=post&action=newthread&fid=$_G[fid]" class="a_2"></a>
            {elseif $_GET['mod'] == 'viewthread'}
                {if $_G[uid]}<a href="forum.php?mod=post&action=newthread&fid=$_G[fid]" class="a_2"></a>{/if}
			    <!--{if !IS_ROBOT && !$_GET['authorid'] && !$_G['forum_thread']['archiveid']}-->
			    <a href="forum.php?mod=viewthread&tid=$_G[tid]&page=$page&authorid=$_G[forum_thread][authorid]" class="a_4" rel="nofollow">楼主</a>
			    <!--{elseif !$_G['forum_thread']['archiveid']}-->
			    <a href="forum.php?mod=viewthread&tid=$_G[tid]&page=$page" class="a_4 a_5" rel="nofollow">楼主</a>
			    <!--{/if}-->
            {elseif $_GET['do'] == 'pm'}
                <a href="home.php?mod=spacecp&ac=pm" class="a_2"></a>
            {/if}
            <div id="float-open" class="float-open"><a class="open-btn" href="javascript:void(0);">{if $_G[member][newpm] || $_G[member][newprompt]}<em class="new">{if $_G[member][newprompt]}{$_G[member][newprompt]}{/if}</em>{/if}</a></div>
        </div>
    </div>
</div>

<!--{if $webshow_nav_b ==1}-->
<!--{if $_GET['mod'] !== 'forumdisplay' && $_GET['mod'] !== 'viewthread' && $_GET['mod'] !== 'post'}-->
<!--底部导航-->
<div id="btoolbar">
    <div class="btool btoolft cl">
        <ul>
            <li class="li1{if $_GET['mod'] == 'guide'} current{/if}"><a href="forum.php?mod=guide&view=hot">首页</a></li>
            <li class="li2{if $_GET['mod'] !== 'guide' && $_GET['mod'] !== 'space' && $_GET['mod'] !== 'forum'} current{/if} current2"><a href="forum.php?forumlist=1">进吧</a></li>
            <li class="li4 current4"><a href="search.php?mod=forum">搜索</a></li>
            <li class="li3 current3{if $_G[member][newpm]} current3_pm{/if}"><a href="{if $_G[uid]}home.php?mod=space&do=pm{else}member.php?mod=logging&action=login{/if}">消息</a></li>
            <li class="li5{if $_GET['mod'] == 'space'} current{/if} current5"><a href="{if $_G[uid]}home.php?mod=space&uid=$_G[uid]&do=profile&mycenter=1{else}member.php?mod=logging&action=login{/if}">{if $_G[uid]}个人中心{else}登录{/if}</a></li>
        </ul>
    </div>
</div>
<!--{/if}-->
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