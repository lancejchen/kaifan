<?php exit;?>
<!--{eval $threadsort = $threadsorts = null;}-->
<!--{template common/header}-->
<!--{eval $_G['forum_thread']['starttime'] = dgmdate($_G['forum_thread']['dateline'], 'Y-m-d H:i');}-->
<!--{hook/viewthread_top_mobile}-->
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/thread.css" type="text/css">

<div class="mv_head">
    <dl>
        <dt>
            {$_G[forum_thread][subject]}
            <!--{if $_G['forum_thread'][displayorder] == -2}--> <span>({lang moderating})</span>
            <!--{elseif $_G['forum_thread'][displayorder] == -3}--> <span>({lang have_ignored})</span>
            <!--{elseif $_G['forum_thread'][displayorder] == -4}--> <span>({lang draft})</span>
            <!--{/if}-->
        </dt>
        <dd class="dd1">
            <a href="forum.php?mod=forumdisplay&fid=$_G[fid]"><span class="s1">{$_G['forum']['name']}</span></a>
        </dd>
        <dd class="dd2">
            <span class="s3">$_G['forum_thread']['starttime']</span>
            <span class="s4">$_G[forum_thread][replies]</span>
        </dd>
    </dl>       
</div>

<div class="postlist">
	<!--{eval $postcount = 0;}-->
	<!--{loop $postlist $post}-->
	<!--{eval $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);}-->
	<!--{hook/viewthread_posttop_mobile $postcount}-->
   <div class="plc cl" id="pid$post[pid]">
       <div class="display pi">
       
           <div class="mv_headin">
               <dl class="cl">
                   <dt><img src="<!--{if !$post['authorid'] || $post['anonymous']}--><!--{avatar(0, small, true)}--><!--{else}--><!--{avatar($post[authorid], small, true)}--><!--{/if}-->" /></dt>
                   <dd class="dd1">
                       <div class="s1 cl">
                           <span class="ss1">
					       <!--{if $post['authorid'] && $post['username'] && !$post['anonymous']}-->
							   <a href="home.php?mod=space&uid=$post[authorid]">$post[author]</a>
						   <!--{else}-->
							   <!--{if !$post['authorid']}-->
							   <a href="javascript:;">{lang guest} <em>$post[useip]{if $post[port]}:$post[port]{/if}</em></a>
							   <!--{elseif $post['authorid'] && $post['username'] && $post['anonymous']}-->
							   <!--{if $_G['forum']['ismoderator']}--><a href="home.php?mod=space&uid=$post[authorid]" target="_blank">{lang anonymous}</a><!--{else}-->{lang anonymous}<!--{/if}-->
							   <!--{else}-->
							   $post[author] <em>{lang member_deleted}</em>
							   <!--{/if}-->
						   <!--{/if}-->
                           </span>
                         <!--{if !$post['anonymous']}-->
                           <!--{if $post['authorid']}-->
                           <span class="ss2 ss2{$post[stars]}{if $post[stars]>7} ss2red{/if}">{$post[stars]}</span>
                           <!--{/if}-->
                           <!--{if $post['gender'] == 1}-->
                           <span class="ss3 ss41"></span>
                           <!--{elseif $post['gender'] == 2}-->
                           <span class="ss3 ss42">女</span>
                           <!--{/if}-->
                           <!--{if $post[groupid]==1}-->
                           <span class="ss5">管理员</span>
                           <!--{/if}-->
                         <!--{/if}-->

                           <!--{if $post['authorid'] == $_G[forum_thread][authorid]}-->
                           <span class="ss6">楼主</span>
                           <!--{/if}-->
                       </div>
                       <!--{eval $fav=DB::fetch_first("SELECT * FROM  ".DB::table('home_favorite')." WHERE  uid=".$_G[uid]." and `idtype`='tid' and id=".$_G[tid]."");}-->
                       <div class="s2{if $fav[id]} s21{/if}{if !$post[first]} s22{/if}">
                           <a href="{if $fav[id]}home.php?mod=space&uid={$_G[uid]}&do=favorite&view=me&type=thread{else}home.php?mod=spacecp&ac=favorite&type=thread&id=$_G[tid]{/if}" {if !$fav[id]}class="favbtn"{/if} target="_blank">
						   <!--{if $post[number] == -1}-->
							{lang recommend_post}
						   <!--{else}-->
							{$post[number]}楼
						   <!--{/if}-->   
                           </a>                  
                        </div> 
                   </dd>
                   <dd class="dd2">{$post[dateline]}</dd>
               </dl>
           </div>

		   <div class="message">
                	<!--{if $post['warned']}-->
                        <span class="grey quote">{lang warn_get}</span>
                    <!--{/if}-->
                    <!--{if !$post['first'] && !empty($post[subject])}-->
                        <h2><strong>$post[subject]</strong></h2>
                    <!--{/if}-->
                    <!--{if $_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])}-->
                        <div class="grey quote">{lang message_banned}</div>
                    <!--{elseif $_G['adminid'] != 1 && $post['status'] & 1}-->
                        <div class="grey quote">{lang message_single_banned}</div>
                    <!--{elseif $needhiddenreply}-->
                        <div class="grey quote">{lang message_ishidden_hiddenreplies}</div>
                    <!--{elseif $post['first'] && $_G['forum_threadpay']}-->
						<!--{template forum/viewthread_pay}-->
					<!--{else}-->

                    	<!--{if $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))}-->
                            <div class="grey quote">{lang admin_message_banned}</div>
                        <!--{elseif $post['status'] & 1}-->
                            <div class="grey quote">{lang admin_message_single_banned}</div>
                        <!--{/if}-->
                        <!--{if $_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0}-->
                            {lang pay_threads}: <strong>$_G[forum_thread][price] {$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][unit]}{$_G['setting']['extcredits'][$_G['setting']['creditstransextra'][1]][title]} </strong> <a href="forum.php?mod=misc&action=viewpayments&tid=$_G[tid]" >{lang pay_view}</a>
                        <!--{/if}-->

                        <!--{if $post['first'] && $threadsort && $threadsortshow}-->
                        	<!--{if $threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']}-->
                                <!--{if $threadsortshow['optionlist'] == 'expire'}-->
                                    {lang has_expired}
                                <!--{else}-->
                                    <div class="box_ex2 viewsort">
                                        <h4>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</h4>
                                    <!--{loop $threadsortshow['optionlist'] $option}-->
                                        <!--{if $option['type'] != 'info'}-->
                                            $option[title]: <!--{if $option['value']}-->$option[value] $option[unit]<!--{else}--><span class="grey">--</span><!--{/if}--><br />
                                        <!--{/if}-->
                                    <!--{/loop}-->
                                    </div>
                                <!--{/if}-->
                            <!--{/if}-->
                        <!--{/if}-->
                        <!--{if $post['first']}-->
                  
                        
    <!--分类信息-->                  
 	<!--{if $post['first']}--> 
		<!--{if $threadsortshow}-->
			<!--{if $threadsortshow['typetemplate']}-->
				$threadsortshow[typetemplate]
			<!--{elseif $threadsortshow['optionlist']}-->
				<div class="typeoption">
					<!--{if $threadsortshow['optionlist'] == 'expire'}-->
						{lang has_expired}
					<!--{else}-->
						<table summary="{lang threadtype_option}" cellpadding="0" cellspacing="0" class="cgtl mbm" width="100%">
							<caption>$_G[forum][threadsorts][types][$_G[forum_thread][sortid]]</caption>
							<tbody>
								<!--{loop $threadsortshow['optionlist'] $option}-->
									<!--{if $option['type'] !== 'info'}-->
                                    <!--{if $option['type'] !== 'image'}-->
										<tr>
											<th>$option[title]</th>
											<td><!--{if $option['value'] || ($option['type'] == 'number' && $option['value'] !== '')}-->$option[value] $option[unit]<!--{else}-->-<!--{/if}--></td>
										</tr>
									<!--{/if}-->
                                    <!--{/if}-->
								<!--{/loop}-->
							</tbody>
						</table>
					<!--{/if}-->
				</div>
			<!--{/if}-->
		<!--{/if}-->
	<!--{/if}-->
                        

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
                            $post[message]
                        <!--{/if}-->

					<!--{/if}-->
			</div>
			<!--{if $_G['setting']['mobile']['mobilesimpletype'] == 0}-->

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
		   <!--{/if}-->

           <!--{if $webshow_vtag ==1}-->
           <!--{if $post['first'] && ($post[tags] || $relatedkeywords) && $_GET['from'] != 'preview'}-->
			<div class="mv_tag cl">
				<!--{if $post[tags]}-->
                    <a class="current">标签</a>
					<!--{loop $post[tags] $var}-->
						<a title="$var[1]" href="misc.php?mod=tag&id=$var[0]">$var[1]</a>
					<!--{/loop}-->
				<!--{/if}-->
				<!--{if $relatedkeywords}--><span>$relatedkeywords</span><!--{/if}-->
			</div>
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


           <!--新增贴内顶部底部-->
           <div class="mv_main_b">
               <div class="mv_main_b_menu cl">
               <!--{if $post['invisible'] == 0}-->
                   <!--{if $allowpostreply && $post['allowcomment'] && (!$thread['closed'] || $_G['forum']['ismoderator'])}--><a class="cmmnt" href="forum.php?mod=misc&action=comment&tid=$post[tid]&pid=$post[pid]&extra=$_GET[extra]&page=$page{if $_G['forum_thread']['special'] == 127}&special=$specialextra{/if}">回复</a><!--{/if}-->
                   <!--{if $_G[uid] && $allowpostreply && !$post[first]}-->
                       <a href="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&repquote=$post[pid]&extra=$_GET[extra]&page=$page" style=" display:none;">回复此楼</a>
                   <!--{/if}-->
               <!--{/if}-->
               <!--{if $_G['forum']['ismoderator']}-->
                   <!--{if $post[first]}-->
						<a href="#moption_$post[pid]" class="popup blue">{lang manage}</a>
						<div id="moption_$post[pid]" popup="true" class="manage" style="display:none;">
							<!--{if !$_G['forum_thread']['special']}-->
							<input type="button" value="{lang edit}" class="redirect button" href="forum.php?mod=post&action=edit&fid=$_G[fid]&tid=$_G[tid]&pid=$post[pid]<!--{if $_G[forum_thread][sortid]}--><!--{if $post[first]}-->&sortid={$_G[forum_thread][sortid]}<!--{/if}--><!--{/if}-->{if !empty($_GET[modthreadkey])}&modthreadkey=$_GET[modthreadkey]{/if}&page=$page">
							<!--{/if}-->
							<input type="button" value="{lang delete}" class="dialog button" href="forum.php?mod=topicadmin&action=moderate&fid={$_G[fid]}&moderate[]={$_G[tid]}&operation=delete&optgroup=3&from={$_G[tid]}">
							<input type="button" value="{lang close}" class="dialog button" href="forum.php?mod=topicadmin&action=moderate&fid={$_G[fid]}&moderate[]={$_G[tid]}&from={$_G[tid]}&optgroup=4">
							<input type="button" value="{lang admin_banpost}" class="dialog button" href="forum.php?mod=topicadmin&action=banpost&fid={$_G[fid]}&tid={$_G[tid]}&topiclist[]={$_G[forum_firstpid]}">
							<input type="button" value="{lang topicadmin_warn_add}" class="dialog button" href="forum.php?mod=topicadmin&action=warn&fid={$_G[fid]}&tid={$_G[tid]}&topiclist[]={$_G[forum_firstpid]}">
						</div>
					<!--{else}-->
						<a href="#moption_$post[pid]" class="popup blue">{lang manage}</a>
						<div id="moption_$post[pid]" popup="true" class="manage" style="display:none;">
							<input type="button" value="{lang edit}" class="redirect button" href="forum.php?mod=post&action=edit&fid=$_G[fid]&tid=$_G[tid]&pid=$post[pid]{if !empty($_GET[modthreadkey])}&modthreadkey=$_GET[modthreadkey]{/if}&page=$page">
							<!--{if $_G['group']['allowdelpost']}--><input type="button" value="{lang modmenu_deletepost}" class="dialog button" href="forum.php?mod=topicadmin&action=delpost&fid={$_G[fid]}&tid={$_G[tid]}&operation=&optgroup=&page=&topiclist[]={$post[pid]}"><!--{/if}-->
							<!--{if $_G['group']['allowbanpost']}--><input type="button" value="{lang modmenu_banpost}" class="dialog button" href="forum.php?mod=topicadmin&action=banpost&fid={$_G[fid]}&tid={$_G[tid]}&operation=&optgroup=&page=&topiclist[]={$post[pid]}"><!--{/if}-->
							<!--{if $_G['group']['allowwarnpost']}--><input type="button" value="{lang modmenu_warn}" class="dialog button" href="forum.php?mod=topicadmin&action=warn&fid={$_G[fid]}&tid={$_G[tid]}&operation=&optgroup=&page=&topiclist[]={$post[pid]}"><!--{/if}-->
						</div>
                   <!--{/if}-->
               <!--{/if}-->
               </div>       
               
               <!--{if $_GET['from'] != 'preview' && $_G['setting']['commentnumber'] && !empty($comments[$post[pid]])}-->
               <div id="comment_$post[pid]" class="mv_lzl">
                   <em></em>
                   <ul>
                   <!--{loop $comments[$post[pid]] $comment}-->
                   <li>
                       <div class="mv_lzl_li cl">
                       <span class="s1"><!--{if $comment['authorid']}--><a href="home.php?mod=space&uid=$comment[authorid]">$comment[author]<!--{if $comment[authorid] == $_G[forum_thread][authorid]}--><i>楼主</i><!--{/if}-->：</a><!--{else}-->{lang guest}<!--{/if}--></span><span class="s2">{$comment[comment]}</span>
                       <span class="s3"><!--{date($comment[dateline], 'u')}--></span>
                       </div>
                   </li>
                   <!--{/loop}-->
                   </div>
               </div>
               <!--{/if}-->

               <!--{if $webshow_sign ==1}-->
		       <!--{if $post['signature'] && ($_G['setting']['bannedmessages'] & 4 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1)))}-->
			       <div class="sign cl">{lang member_signature_banned}</div>
                   <div class="sign_blank"> </div>
		       <!--{elseif $post['signature'] && !$post['anonymous'] && $showsignatures}-->
			       <div class="sign cl" style="max-height:{$_G['setting']['maxsigrows']}px;maxHeightIE:{$_G['setting']['maxsigrows']}px; overflow:hidden;">$post[signature]</div>
                   <div class="sign_blank"> </div>
		       <!--{elseif !$post['anonymous'] && $showsignatures && $_G['setting']['globalsightml']}-->
			       <div class="sign cl">$_G['setting']['globalsightml']</div>
                   <div class="sign_blank"> </div>
		       <!--{/if}-->
               <!--{/if}-->
           </div>
           <!--viewthread main botom end-->
       </div>
   </div>
   <!--{hook/viewthread_postbottom_mobile $postcount}-->
   <!--{eval $postcount++;}-->
   <!--{/loop}-->
   <!--{subtemplate forum/forumdisplay_fastpost}-->
</div>
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
</script>
<!--{template common/footer}-->