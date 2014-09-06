<?php exit;?>
<!--{eval $threadsort = $threadsorts = null;}-->
<!--{template common/header}-->
<!--{eval $_G['forum_thread']['starttime'] = dgmdate($_G['forum_thread']['dateline'], 'Y-m-d H:i');}-->
<!--{hook/viewthread_top_mobile}-->


<!--header for title, distance & reply numbers-->
<ul data-role="listview" data-inset="true" id="shop_info">
    <li>
        <h1 style="display:inline;">
            {$_G[forum_thread][subject]}
            <!--{if $_G['forum_thread'][displayorder] == -2}--> <span>({lang moderating})</span>
            <!--{elseif $_G['forum_thread'][displayorder] == -3}--> <span>({lang have_ignored})</span>
            <!--{elseif $_G['forum_thread'][displayorder] == -4}--> <span>({lang draft})</span>
            <!--{/if}-->
            <span class="loc ui-icon-location ui-btn-icon-left" style="position:relative;
            ">{$thread['distance']}</span>
        </h1>
        <h2><span class="loc ui-icon-comment ui-btn-icon-left" style="position:relative;">
                {$shop_comments}
            </span>
        </h2>
    </li>
<!--    shop location & tel-->
    <li id="telLine">
        <table style="width:100%;height:100%;">
            <tr id="address_tel" style="height: 100%;">
                <td id="address"><a href="{$shop_map_url}">{$shop_address}</a></td>
                <td id="tel"><a href="tel:{$shop_tel}">
                        <span class="ui-icon-phone ui-btn-icon-left"
                              style="position:relative;
            ">拨打</span>
                </a></td>
            </tr>
        </table>
    </li>
</ul>

<div class="postlist">
	<!--{eval $postcount = 0;}-->
	<!--{loop $postlist $post}-->
	<!--{eval $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);}-->
	<!--{hook/viewthread_posttop_mobile $postcount}-->
   <div class="plc cl" id="pid$post[pid]">
		   <div class="message">


               <!--{if $post['first']}-->
                    <!--{if !$_G[forum_thread][special]}-->
                        $post[message]
                    <!--{elseif $_G[forum_thread][special] == 1}-->
                        <!--{template forum/viewthread_poll}-->
                    <!--{elseif $_G[forum_thread][special] == 2}-->
                        <!--{template forum/viewthread_trade}-->
                    <!--{elseif $_G[forum_thread][special] == 3}-->
                        <!--{template forum/viewthread_reward}-->
                    <!--{elseif $_G[forum_thread][special] == 4}-->
                        <!--{template forum/viewthread_activity}-->
                    <!--{elseif $_G[forum_thread][special] == 5}-->
                        <!--{template forum/viewthread_debate}-->
                    <!--{elseif $threadplughtml}-->
                        $threadplughtml
                        $post[message]
                    <!--{else}-->
                        $post[message]
                    <!--{/if}-->

                <!--{else}-->

                <!--{/if}-->

		   </div>
        <!--{if $post['attachment']}-->
           <div class="grey quote">
           {lang attachment}: <em><!--{if $_G['uid']}-->{lang attach_nopermission}<!--{else}-->{lang attach_nopermission_login}<!--{/if}--></em>
           </div>

        <!--{elseif $post['imagelist'] || $post['attachlist']}-->
               <!--{if $post['imagelist']}-->
                    <!--{if count($post['imagelist']) == 1}-->
                    <ul class="img_one">{echo showattach($post, 1)}</ul>
                    <!--{else}-->
                    <ul class="img_list cl vm">{echo showattach($post, 1)}</ul>
                    <!--{/if}-->
                <!--{/if}-->
              <!--{if $post['attachlist']}-->
                <ul>{echo showattach($post)}</ul>
              <!--{/if}-->
        <!--{/if}-->


           <!--{if $webshow_vrelate ==1}-->
           <!--{if $post['relateitem'] && $post['first']}-->
			<div class="mv_relate">
				<h2>{lang related_thread}</h2>
				<ul class="cl">
					<!--{loop $post['relateitem'] $var}-->
					<li>&#8226; <a href="forum.php?mod=viewthread&tid=$var[tid]" title="$var[subject]">$var[subject]</a></li>
					<!--{/loop}-->
				</ul>
			</div>
           <!--{/if}-->
           <!--{/if}-->
       </div>

   <!--{hook/viewthread_postbottom_mobile $postcount}-->
   <!--{eval $postcount++;}-->
   <!--{/loop}-->
</div>



<div class="comments">
    <ul data-role="listview" data-inset="true">
        <li data-role="list-divider">用户评论</li>
    <!--{loop $comments $comment}-->
        <li>
            <h2>{$comment['author']}</h2>
            <p>{$comment['message']}</p>
            <p class="ui-li-aside">{$comment['dateline']}</p>
        </li>
    <!--{/loop}-->
    </ul>
</div>
   <!--{subtemplate forum/forumdisplay_fastpost}-->
{$multipage}
<!--{hook/viewthread_bottom_mobile}-->
<script type="text/javascript">
	$('.favbtn').on('click', function() {
		var obj = $(this);
		$.ajax({
			type:'POST',
			url:obj.attr('href') + '&handlekey=favbtn&inajax=1',
			data:{'favoritesubmit':'true', 'formhash':'{FORMHASH}'},
			dataType:'xml',
		})
		.success(function(s) {
			popup.open(s.lastChild.firstChild.nodeValue);
			evalscript(s.lastChild.firstChild.nodeValue);
		})
		.error(function() {
			window.location.href = obj.attr('href');
			popup.close();
		});
		return false;
	});
//    var $reload_once=0;
//        $(document).ready(function(){
//
//            while($reload_once<1){
//                location.reload();
//                console.log('run');
//                $reload_once++;
//            }
//        });

</script>
<!--{template common/footer}-->