<?php exit;?>
<!--{template common/header}-->
<script type="text/javascript">
$().ready(function(){
    $(".m_txt").html("{$curtype[name]}-群组");
});
</script>

<div class="g_list">
    <!--{if $typelist}-->
    <div class="g_cat_list cl">
    <!--{loop $typelist $fid $type}--><a href="group.php?sgid=$fid">$type[name]<span>($type[groupnum])</span></a><!--{if $type[groupnum]}--><!--{/if}--><!--{/loop}-->
    </div>
    <!--{/if}-->
    
    <!--{if $list}-->
        <h2 class="h2_title">
            <span class="y">
					<select title="{lang orderby}" onchange="location.href=this.value" class="ps">
						<option value="$url" $selectorder[default]>{lang orderby_default}</option>
						<option value="$url&orderby=thread" $selectorder[thread]>{lang stats_main_threads_count}</option>
						<option value="$url&orderby=membernum" $selectorder[membernum]>{lang group_member_count}</option>
						<option value="$url&orderby=dateline" $selectorder[dateline]>{lang group_create_time}</option>
						<option value="$url&orderby=activity" $selectorder[activity]>{lang group_activities}</option>
					</select>
            </span>
            {lang group_total_numbers}
        </h2>
        <div class="g_list_c">
	    <table cellspacing="0" cellpadding="0" width="100%">
            <!--{loop $list $fid $val}-->
            <tr>
                <th><a href="forum.php?mod=group&fid=$fid"><img src="$val[icon]" /></a></th>
                <td>
                    <dl>
                        <dt><a href="forum.php?mod=group&fid=$fid">$val[name]</a></dt>
                        <dd class="dd1">{lang group_total_members_threads}</dd>
                        <dd class="dd2">{lang group_founded_in}: $val[dateline]</dd>
                        <dd class="dd3">$val[description]</dd>
                    </dl>
                </td>
            </tr>
            <!--{/loop}-->
		</table> 
        </div> 
    <!--{else}-->
        <div class="note_none">
            <h2>{lang group_category_no_groups}</h2>
            <p>{lang group_category_no_groups_detail}</p>
        </div>
    <!--{/if}-->
        
	<!--{if $list}-->
	    <div class="pgs cl">{$multipage}</div>
	<!--{/if}-->   
</div>
<!--{template common/footer}-->