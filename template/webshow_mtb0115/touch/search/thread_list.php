<?php exit;?>
<style>.cc_search .h2_title span { position:relative; left:1px!important; top:auto!important;}</style>
<div class="cc_main mfmlist mfmlist2 cc_search" style="background:none;">
	<h2 class="h2_title h2_title_t"><!--{if $keyword}-->{lang search_result_keyword} <!--{if $modfid}--><a href="forum.php?mod=modcp&action=thread&fid=$modfid&keywords=$modkeyword&submit=true&do=search&page=$page" target="_blank">{lang goto_memcp}</a><!--{/if}--><!--{else}-->{lang search_result}<!--{/if}--></h2>
    
    <ul id="alist">
	<!--{if empty($threadlist)}-->
	<li class="note_none"><a href="javascript:;">{lang search_nomatch}</a></li>
	<!--{else}-->
        <!--{loop $threadlist $thread}-->
    
            <li class="li_main">
                <dl class="cl">
                    <dt>
                        <span class="cl">
                        <a href="forum.php?mod=viewthread&tid=$thread[realtid]&highlight=$index[keywords]" $thread[highlight]>
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
                        <i>$thread[subject]</i></a>
                        </span>
                    </dt>
                    <dd class="cl">
                        <span class="s1"><!--{if $thread['authorid'] && $thread['author']}--> {$thread[author]}<!--{else}--><!--{if $_G['forum']['ismoderator']}-->{lang anonymous}<!--{else}-->{$_G[setting][anonymoustext]}<!--{/if}--><!--{/if}--><em>$thread[dateline]</em></span>
                        <span class="s2">$thread[replies]</span>
                    </dd>
                </dl>
            </li>
        <!--{/loop}-->
	<!--{/if}-->
	$multipage
</div>
