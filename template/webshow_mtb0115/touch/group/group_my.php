<?php exit;?>
<!--{template common/header}-->
<script type="text/javascript">
$().ready(function(){
    $(".m_txt").html("我的群组");
});
</script>

<div class="tx_menu">
    <ul class="cl">
	    <li $actives[groupthread]><a href="group.php?mod=my&view=groupthread">{lang group_thread}</a></li>
        <li $actives[mythread]><a href="group.php?mod=my&view=mythread">{lang my_thread}</a></li>
        <li $actives[join]><a href="group.php?mod=my&view=join">{lang my_join}</a></li>
        <li $actives[manager]><a href="group.php?mod=my&view=manager">{lang my_manage}</a></li>
    </ul>
</div>

<!--{if $view == 'groupthread' || $view == 'mythread'}-->
<div class="tx_nav">
    <ul class="cl">
        <li id="ttp_all"{if empty($typeid)} class="a"{/if}><a href="group.php?mod=my&view=$view">{lang all}</a></li>
        <!--{loop $usergroups['grouptype'] $type}-->
        <li{if $typeid == $type['fid']} class="a"{/if}><a href="group.php?mod=my&view=$view{if $typeid != $type['fid']}&typeid=$type[fid]{/if}">$type[name]</a></li>
        <!--{/loop}-->
    </ul>
</div>
<!--{/if}-->

<div class="gmy_list">
<!--{if $view == 'groupthread' || $view == 'mythread'}-->
    <!--{if $attentionthread}-->
    <!--{loop $attentionthread $groupid $threads}-->
	<h2 class="h2_t"><i>{$usergroups['groups'][$groupid]}</i><span><a href="forum.php?mod=group&fid=$groupid">查看全部</a></span></h2>
	<div class="mfmlist mfmlist2">
    	<ul id="alist">
    	<!--{loop $threads $tid $thread}-->
            <li class="li_main">
                <dl class="cl">
                    <dt class="cl">
                        <span>
                        <!--{if $thread[folder] == 'lock'}-->
                            <em>锁定</em>
                        <!--{elseif $thread['special'] == 1}-->
                            <em>投票</em>
                        <!--{elseif $thread['special'] == 2}-->
                            <em>商品</em>
                        <!--{elseif $thread['special'] == 3}-->
                            <em>悬赏</em>
                        <!--{elseif $thread['special'] == 4}-->
                            <em>活动</em>
                        <!--{elseif $thread['special'] == 5}-->
                            <em>辩论</em>
                        <!--{elseif in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
                            <em>置顶</em>
					    <!--{elseif $thread['digest'] > 0}-->
					        <em>精华</em>
					    <!--{elseif $thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
					        <em>图 </em>               
                        <!--{/if}-->
                        <a href="forum.php?mod=viewthread&tid=$tid">{$thread[subject]}</a></span>
                    </dt>
                    <dd class="cl">
                        <span class="s1"><!--{if $thread['lastposter']}--><a href="home.php?mod=space&username=$thread[lastposter]">$thread[lastposter]</a><!--{else}-->{lang anonymous}<!--{/if}--><em>$thread[dateline]</em></span>
                        <span class="s2">$thread[replies]</span>
                    </dd>
                </dl>
            </li>
   	    <!--{/loop}-->
        </ul>
	</div>
    <!--{/loop}-->
    <!--{/if}-->
    
    <h2 class="h2_t"><i><!--{if $view == 'groupthread'}-->{lang last_topic_in_group}<!--{else}-->{lang my_last_topic_in_group}<!--{/if}--></i><span></h2>
	<div class="mfmlist mfmlist2">
		<!--{if $groupthreadlist}-->
        <ul id="alist">
		<!--{loop $groupthreadlist $tid $thread}-->
            <li class="li_main">
                <dl class="cl">
                    <dt class="cl">
                        <span class="cl">
                        <a href="forum.php?mod=viewthread&tid=$tid">
                        <!--{if $thread[folder] == 'lock'}-->
                            <em>锁定</em>
                        <!--{elseif $thread['special'] == 1}-->
                            <em>投票</em>
                        <!--{elseif $thread['special'] == 2}-->
                            <em>商品</em>
                        <!--{elseif $thread['special'] == 3}-->
                            <em>悬赏</em>
                        <!--{elseif $thread['special'] == 4}-->
                            <em>活动</em>
                        <!--{elseif $thread['special'] == 5}-->
                            <em>辩论</em>
                        <!--{elseif in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
                            <em>置顶</em>
					    <!--{elseif $thread['digest'] > 0}-->
					        <em>精华</em>
					    <!--{elseif $thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
					        <em>图 </em>               
                        <!--{/if}-->
                        <i>{$thread[subject]}</i></a></span>
                    </dt>
                    <dd class="cl">
                        <span class="s1"><!--{if $thread['lastposter']}--><a href="home.php?mod=space&username=$thread[lastposter]">$thread[lastposter]</a><!--{else}-->{lang anonymous}<!--{/if}--><em>$thread[dateline]</em></span>
                        <span class="s2">$thread[replies]</span>
                    </dd>
                </dl>
            </li>
   	    <!--{/loop}-->
        </ul>
		<!--{else}-->
		    <div class="note_none">{lang no_related_posts}</div>
		<!--{/if}-->
    </div>
    <!--{if $multipage}--><div class="pgs cl">$multipage</div><!--{/if}-->

<!--{elseif $view == 'manager' || $view == 'join'}-->
	<!--{if $grouplist}-->
        <div class="g_list_c">
        <table cellpadding="0" cellspacing="0" border="0" width="100%">
            <!--{loop $grouplist $groupid $group}-->
            <tr>
                <th><a href="forum.php?mod=group&fid=$groupid"><img src="$group[icon]" /></a></th>
				<td>
                    <dl>
                        <dt><a href="forum.php?mod=group&fid=$groupid">$group[name]</a></dt>
                        <!--{if $group['flevel'] == '-1'}--><dd>{lang group_wait_mod}</dd><!--{/if}-->
                    </dl>
                </td>
            </tr>
            <!--{/loop}-->
        </table>
        </div>
	    <!--{if $multipage}--><div class="pgs">$multipage</div><!--{/if}-->
	<!--{else}-->
        <div class="note_none"><!--{if $view == 'manager'}-->{lang no_group_create_now} <!--{elseif $view == 'join'}-->{lang no_group_join} <!--{/if}--></div>
    <!--{/if}-->
<!--{/if}-->
</div>
<!--{template common/footer}-->