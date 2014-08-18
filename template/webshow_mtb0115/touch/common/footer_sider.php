<?php exit;?>
<!--右侧-->
<div class="ttool_r ui-icon-bars" data-icon="bars"">
{if !$_G[uid] && !$_G['connectguest']}
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