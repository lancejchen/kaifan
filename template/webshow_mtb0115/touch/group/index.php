<?php exit;?>
<!--{template common/header}-->
<script type="text/javascript">
$().ready(function(){
    $(".m_txt").html("群组首页");
});
</script>

<div class="th_tab">
    <div class="cl">
        <a id="tab_a1" onclick="javascript:view_a(1);" class="on">推荐</a>    
        <a id="tab_a2" onclick="javascript:view_a(2);">分类</a>
        <a id="tab_a3" onclick="javascript:view_a(3);">排行</a>
        <a id="tab_a4" onclick="javascript:view_a(4);" style="display:none!important;"></a>
        <!--{if helper_access::check_module('group')}-->
        <!--{if empty($gid) && empty($sgid)}-->
        <!--{if helper_access::check_module('group')}-->
        <a href="forum.php?mod=group&action=create" class="onn">创建群组</a>
        <!--{/if}-->
        <!--{else}-->
        <a href="forum.php?mod=group&action=create&fupid=$fup&groupid=$sgid" class="onn">创建群组</a>
        <!--{/if}-->
        <!--{/if}-->
        <a href="group.php?mod=my" class="onn">我的群组</a>
    </div>
</div>

<!--BLOCK1-->
<div id="box_a1" class="th" style="display:block;">
    <div class="wap_p4">
        <h2>推荐群组</h2>
        <ul>
        <!--{loop dunserialize($_G['setting']['group_recommend']) $val}-->
        <li class="li{currentorder}">
            <dl class="cl">
                <dt><a href="forum.php?mod=group&fid=$val[fid]"><img src="$val[icon]" alt="$val[name]" /></a></dt>
                <dd class="dd1"><a href="forum.php?mod=group&fid=$val[fid]">$val[name]</a></dd>
                <dd class="dd2">{$val[description]}</dd>
            </dl>
        </li>
        <!--{/loop}-->
        </ul>
    </div>
</div>

<!--BLOCK2-->
<div id="box_a2" class="th th_np">
    <h2>群组分类</h2>
    <!--{loop $first $groupid $group}-->
    <dl class="cl">
        <dt class="pbn">
            <span class="y xi2"><!--{loop $group['secondlist'] $fid}--><a href="group.php?sgid=$fid">$second[$fid][name]</a> <!--{/loop}--><a href="group.php?gid=$groupid">{lang more} &rsaquo;</a></span>
            <strong class="xs2"><a href="group.php?gid=$groupid">$group[name]</a></strong><!--{if $group[groupnum]}--><span class="xg1">($group[groupnum])</span><!--{/if}-->
        </dt>
        <dd class="cl">
        <!--{loop $lastupdategroup[$groupid] $val}-->
        <a href="forum.php?mod=group&fid=$val[fid]">$val[name]</a>
        <!--{/loop}-->
        </dd>
    </dl>
    <!--{/loop}-->
</div>


<!--BLOCK3-->
<div id="box_a3" class="th th_np">
    <h2>群组排行</h2>
    <!--{if $topgrouplist}-->
    <ul>
    <!--{loop $topgrouplist $fid $group}-->
    <li><span>$group[commoncredits]</span><a href="forum.php?mod=group&fid=$group[fid]" title="$group[name]">$group[name]</a></li>
    <!--{/loop}-->
    </ul>
    <!--{/if}-->
</div>

<!--BLOCK4-->
<div id="box_a4" class="th th_np"></div>
<!--{template common/footer}-->