<?php exit;?>
<!--{template common/header}-->
<style>body { background:#FFF!important;}</style>
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" media="all" />
<script type="text/javascript">
$().ready(function(){
$(".m_txt").html("{$space[username]}-帖子");
});
</script>
<!--{if $space[uid]}-->
<div class="cc_home">
    <div class="cc_home_h">
        <div class="s1"><img src="template/webshow_mtb0115/touch/img/space_bg.jpg"></div>
        <div class="s2"></div>
        <div class="s3"><a href="home.php?mod=space&uid=$space[uid]"><img src="{avatar($space[uid], middle, true)}" /></a></div>
        <div class="s4">{$space[username]}</div>
        
        <!--{if $space[uid] == $_G[uid]}-->
        <div class="s5"><a href="home.php?mod=space&uid={$_G[uid]}&do=profile&mycenter=1">修改资料</a></div>
        <!--{else}-->
        <div class="s6">
            <a href="home.php?mod=space&uid=$space[uid]&do=profile&from=space" class="s61">个人资料</a>
            <!--{if helper_access::check_module('follow')}-->
                <!--{if !ckfollow($space['uid'])}-->
                    <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&ac=follow&op=add&hash={FORMHASH}&fuid=$space[uid]" class="s62">添加关注</a>
                <!--{else}-->
                    <a id="followmod" onclick="showWindow(this.id, this.href, 'get', 0);" href="home.php?mod=spacecp&ac=follow&op=del&fuid=$space[uid]" class="s62">取消关注</a>
                <!--{/if}-->
            <!--{/if}-->
            <!--{if helper_access::check_module('follow')}-->
		    <script type="text/javascript">
		                function succeedhandle_followmod(url, msg, values) {
			                var fObj = $('followmod');
			                if(values['type'] == 'add') {
				                fObj.innerHTML = '取消关注';
				                fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid='+values['fuid'];
			                } else if(values['type'] == 'del') {
				                fObj.innerHTML = '+ 关注';
				                fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash={FORMHASH}&fuid='+values['fuid'];
			                }
		                }
            </script>
            <!--{/if}-->
        </div>
        <!--{/if}-->
        
    </div>
</div>
<!--{/if}-->

<div class="tag_main">
    <div class="mfmlist mfmlist2">
    <ul id="alist">
	<!--{if $list}-->
        <!--{eval require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/plus.php';}-->
		<!--{loop $list $thread}-->
            <li class="li_main">
                <dl class="cl">
                    <dt class="cl">
                        <span class="cl">
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
                        <!--{/if}-->
			            <!--{if $viewtype == 'reply' || $viewtype == 'postcomment'}-->
			            <a href="forum.php?mod=redirect&goto=findpost&ptid=$thread[tid]&pid=$thread[pid]" target="_blank">$thread[subject]</a>
			            <!--{else}-->
			            <a href="forum.php?mod=viewthread&tid=$thread[tid]" target="_blank" {if $thread['displayorder'] == -1}class="grey"{/if}>$thread[subject]</a>
			            <!--{/if}-->
                        </span>
                        <!--{eval $piclist=threadpics($thread[tid],3);}-->
                        <!--{if $piclist}-->                                                                 
                        <ul class="cl">
                            <!--{loop $piclist $o}-->
                                <li><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra"><img src="apic.php?aid=$o[aid]&size=101x101" /></a></li>
                            <!--{/loop}-->
                        </ul>
                        <!--{/if}-->
                    </dt>
                    <dd class="cl">
                        <span class="s1"><!--{if $thread['authorid'] && $thread['author']}--> {$thread[author]}<!--{else}--><!--{if $_G['forum']['ismoderator']}-->{lang anonymous}<!--{else}-->{$_G[setting][anonymoustext]}<!--{/if}--><!--{/if}--><em>$thread[dateline]</em></span>
                        <span class="s2">$thread[replies]</span>
                    </dd>
                </dl>
            </li>
    <!--{/loop}-->
	<!--{else}-->
		<li class="note_none">{lang no_related_posts}</li>
	<!--{/if}-->
    </ul>
    <div class="cl">{$multi}</div>
    </div>
</div>


<!--{template common/footer}-->
