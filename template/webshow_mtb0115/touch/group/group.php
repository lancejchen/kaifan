<?php exit;?>
<!--{template common/header}-->
<script type="text/javascript" src="template/webshow_mtb0115/touch/img/js/group.js"></script>
<!--{if $action == 'list'}-->
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" id="JCSS" media="all" />
<script src="template/webshow_mtb0115/touch/img/js/jquery.cookie.js" type="text/javascript"></script> 
<div class="mforum_head">
    <div class="mforum_h_1">
        <div class="mskin">
            <a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_1.css">简</a>
            {if $webshow_forumdisplay_txt ==1}<a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_2.css">概要</a>{/if}
            {if $webshow_forumdisplay_pic ==1}<a rel="">视图</a>{/if}
        </div>
        <dl class="cl">
            <dt><img src="{$_G[forum][icon]}" /></dt>
            <dd class="dd1">{$_G['forum']['name']}</dd>
            <dd class="dd2">
                <span class="s1">主题<em>$_G[forum][threads]</em></span>
                <span class="s2">帖子<em>$_G[forum][posts]</em></span>
            </dd>
            <dd class="dd3 dd33">
                <cite><span>{$_G[group][stars]}</span><em>{$_G[group][grouptitle]}</em></cite>
                <!--{eval $fav=DB::fetch_first("SELECT * FROM  ".DB::table('home_favorite')." WHERE  uid=".$_G[uid]." and `idtype`='gid' and id=".$_G[fid]."");}--> 
                <cite class="c1">{if $fav[id]}<a href="javascript:void(0);" class="a1">已关注</a>{else}<a href="home.php?mod=spacecp&ac=favorite&type=group&id={$_G[forum][fid]}&handlekey=sharealbumhk_{$_G[forum][fid]}&formhash={FORMHASH}" class="a2"><i>+</i>关注</a>{/if}</cite>  
                <!--{if $status != 2 && $status != 3 && $status != 5}-->
				    <!--{if helper_access::check_module('group') && $status != 'isgroupuser'}-->
                    <cite class="c2"><button type="button" class="mbutton25" onclick="location.href='forum.php?mod=group&action=join&fid=$_G[fid]'">加入</button></cite>
                    <!--{/if}-->
                <!--{/if}-->  
                <!--{if $status == 'isgroupuser'}--><cite class="c2"><button type="button" class="mbutton25" onclick="location.href='forum.php?mod=group&action=out&fid=$_G[fid]'">退出</button></cite><!--{/if}-->   
            </dd>
        </dl>
    </div>
    
    <!--{if $_G['forum']['threadtypes']}-->
    <div class="mforum_h_2">
	    <ul class="cl">
		<li id="ttp_all"{if !$_GET['typeid']} class="xw1 a"{/if}><a href="forum.php?mod=forumdisplay&action=list&fid=$_G[fid]">{lang forum_viewall}</a></li>
		<!--{if $_G['forum']['threadtypes']}-->
			<!--{loop $_G['forum']['threadtypes']['types'] $id $name}-->
				<li{if $_GET['typeid'] == $id} class="xw1 a"{/if}><a href="forum.php?mod=forumdisplay&action=list&fid=$_G[fid]{if $_GET['typeid'] != $id}&filter=typeid&typeid=$id$forumdisplayadd[typeid]{/if}">$name</a>
			<!--{/loop}-->
		<!--{/if}-->
	    </ul>
    </div>
    <!--{/if}-->
</div>  
<!--{/if}-->

<!--{if $action !== 'create'}-->  
<!--{if $status != 2 && $status != 3}-->
<div class="tx_menu" style="margin:10px;">
    <ul class="cl">
        <li {if $action == 'list'}class="a"{/if}><a href="forum.php?mod=forumdisplay&fid=$_G[fid]" title="">{lang group_discuss_area}</a></li>
        <li {if $action == 'memberlist' || $action == 'invite'}class="a"{/if}><a href="forum.php?mod=group&action=memberlist&fid=$_G[fid]#groupnav" title="">{lang group_member_list}</a></li>
        <li {if $action == 'create'}class="a"{/if}><a href="forum.php?mod=group&action=create">创建群组</a></li>
        <!--{if $_G['forum']['ismoderator']}--><li {if $action == 'manage'}class="a"{/if}><a href="forum.php?mod=group&action=manage&fid=$_G[fid]#groupnav">{lang group_admin}</a></li><!--{/if}-->
     </ul>
 </div>
<!--{/if}-->
<!--{/if}-->

<!--{if $action == 'index' && $status != 2 && $status != 3}-->
    <script language="JavaScript">self.location='forum.php?mod=forumdisplay&action=list&fid=$_G[fid]';</script>
<!--{elseif $action == 'list'}-->
    <!--{subtemplate group/group_list}-->
<!--{elseif $action == 'memberlist'}-->
    <!--{subtemplate group/group_memberlist}-->
<!--{elseif $action == 'create'}-->
    <!--{subtemplate group/group_create}-->
<!--{elseif $action == 'invite'}-->
<!--{elseif $action == 'manage'}-->
    <!--{subtemplate group/group_manage}-->
<!--{/if}-->
            
<!--{template common/footer}-->