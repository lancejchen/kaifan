<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');
0
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/viewthread.htm', './template/webshow_mtb0115/touch/forum/forumdisplay_fastpost.htm', 1408947305, 'diy', './data/template/2_diy_touch_forum_viewthread.tpl.php', './template/webshow_mtb0115', 'touch/forum/viewthread')
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/viewthread.htm', './template/webshow_mtb0115/touch/common/seccheck.htm', 1408947305, 'diy', './data/template/2_diy_touch_forum_viewthread.tpl.php', './template/webshow_mtb0115', 'touch/forum/viewthread')
;?>
<?php $threadsort = $threadsorts = null;?><?php include template('common/header'); $_G['forum_thread']['starttime'] = dgmdate($_G['forum_thread']['dateline'], 'Y-m-d H:i');?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_top_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_top_mobile'];?>
<link rel="stylesheet" href="template/webshow_mtb0115/touch/img/css/thread.css" type="text/css">

<div class="mv_head">
    <dl>
        <dt>
            <?php echo $_G['forum_thread']['subject'];?>
            <?php if($_G['forum_thread']['displayorder'] == -2) { ?> <span>(审核中)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span>(已忽略)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span>(草稿)</span>
            <?php } ?>
        </dt>
        <dd class="dd1">
            <a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>"><span class="s1"><?php echo $_G['forum']['name'];?></span></a>
        </dd>
        <dd class="dd2">
            <span class="s3"><?php echo $_G['forum_thread']['starttime'];?></span>
            <span class="s4"><?php echo $_G['forum_thread']['replies'];?></span>
        </dd>
    </dl>       
</div>

<div class="postlist"><?php $postcount = 0;?><?php if(is_array($postlist)) foreach($postlist as $post) { $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount];?>
   <div class="plc cl" id="pid<?php echo $post['pid'];?>">
       <div class="display pi">
       
           <div class="mv_headin">
               <dl class="cl">
                   <dt><img src="<?php if(!$post['authorid'] || $post['anonymous']) { ?><?php echo avatar(0, small, true);?><?php } else { ?><?php echo avatar($post[authorid], small, true);?><?php } ?>" /></dt>
                   <dd class="dd1">
                       <div class="s1 cl">
                           <span class="ss1">
       <?php if($post['authorid'] && $post['username'] && !$post['anonymous']) { ?>
   <a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>"><?php echo $post['author'];?></a>
   <?php } else { ?>
   <?php if(!$post['authorid']) { ?>
   <a href="javascript:;">游客 <em><?php echo $post['useip'];?><?php if($post['port']) { ?>:<?php echo $post['port'];?><?php } ?></em></a>
   <?php } elseif($post['authorid'] && $post['username'] && $post['anonymous']) { ?>
   <?php if($_G['forum']['ismoderator']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $post['authorid'];?>" target="_blank">匿名</a><?php } else { ?>匿名<?php } ?>
   <?php } else { ?>
   <?php echo $post['author'];?> <em>该用户已被删除</em>
   <?php } ?>
   <?php } ?>
                           </span>
                         <?php if(!$post['anonymous']) { ?>
                           <?php if($post['authorid']) { ?>
                           <span class="ss2 ss2<?php echo $post['stars'];?><?php if($post['stars']>7) { ?> ss2red<?php } ?>"><?php echo $post['stars'];?></span>
                           <?php } ?>
                           <?php if($post['gender'] == 1) { ?>
                           <span class="ss3 ss41"></span>
                           <?php } elseif($post['gender'] == 2) { ?>
                           <span class="ss3 ss42">女</span>
                           <?php } ?>
                           <?php if($post['groupid']==1) { ?>
                           <span class="ss5">管理员</span>
                           <?php } ?>
                         <?php } ?>

                           <?php if($post['authorid'] == $_G['forum_thread']['authorid']) { ?>
                           <span class="ss6">楼主</span>
                           <?php } ?>
                       </div>
                       <?php $fav=DB::fetch_first("SELECT * FROM  ".DB::table('home_favorite')." WHERE  uid=".$_G[uid]." and `idtype`='tid' and id=".$_G[tid]."");?>                       <div class="s2<?php if($fav['id']) { ?> s21<?php } if(!$post['first']) { ?> s22<?php } ?>">
                           <a href="<?php if($fav['id']) { ?>home.php?mod=space&uid=<?php echo $_G['uid'];?>&do=favorite&view=me&type=thread<?php } else { ?>home.php?mod=spacecp&ac=favorite&type=thread&id=<?php echo $_G['tid'];?><?php } ?>" <?php if(!$fav['id']) { ?>class="favbtn"<?php } ?> target="_blank">
   <?php if($post['number'] == -1) { ?>
推荐
   <?php } else { ?>
<?php echo $post['number'];?>楼
   <?php } ?>   
                           </a>                  
                        </div> 
                   </dd>
                   <dd class="dd2"><?php echo $post['dateline'];?></dd>
               </dl>
           </div>

   <div class="message">
                	<?php if($post['warned']) { ?>
                        <span class="grey quote">受到警告</span>
                    <?php } ?>
                    <?php if(!$post['first'] && !empty($post['subject'])) { ?>
                        <h2><strong><?php echo $post['subject'];?></strong></h2>
                    <?php } ?>
                    <?php if($_G['adminid'] != 1 && $_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || $post['status'] == -1 || $post['memberstatus'])) { ?>
                        <div class="grey quote">提示: <em>作者被禁止或删除 内容自动屏蔽</em></div>
                    <?php } elseif($_G['adminid'] != 1 && $post['status'] & 1) { ?>
                        <div class="grey quote">提示: <em>该帖被管理员或版主屏蔽</em></div>
                    <?php } elseif($needhiddenreply) { ?>
                        <div class="grey quote">此帖仅作者可见</div>
                    <?php } elseif($post['first'] && $_G['forum_threadpay']) { include template('forum/viewthread_pay'); } else { ?>

                    	<?php if($_G['setting']['bannedmessages'] & 1 && (($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5))) { ?>
                            <div class="grey quote">提示: <em>作者被禁止或删除 内容自动屏蔽，只有管理员或有管理权限的成员可见</em></div>
                        <?php } elseif($post['status'] & 1) { ?>
                            <div class="grey quote">提示: <em>该帖被管理员或版主屏蔽，只有管理员或有管理权限的成员可见</em></div>
                        <?php } ?>
                        <?php if($_G['forum_thread']['price'] > 0 && $_G['forum_thread']['special'] == 0) { ?>
                            付费主题, 价格: <strong><?php echo $_G['forum_thread']['price'];?> <?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['unit'];?><?php echo $_G['setting']['extcredits'][$_G['setting']['creditstransextra']['1']]['title'];?> </strong> <a href="forum.php?mod=misc&amp;action=viewpayments&amp;tid=<?php echo $_G['tid'];?>" >记录</a>
                        <?php } ?>

                        <?php if($post['first'] && $threadsort && $threadsortshow) { ?>
                        	<?php if($threadsortshow['optionlist'] && !($post['status'] & 1) && !$_G['forum_threadpay']) { ?>
                                <?php if($threadsortshow['optionlist'] == 'expire') { ?>
                                    该信息已经过期
                                <?php } else { ?>
                                    <div class="box_ex2 viewsort">
                                        <h4><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></h4>
                                    <?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { ?>                                        <?php if($option['type'] != 'info') { ?>
                                            <?php echo $option['title'];?>: <?php if($option['value']) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?><span class="grey">--</span><?php } ?><br />
                                        <?php } ?>
                                    <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if($post['first']) { ?>
                  
                        
    <!--分类信息-->                  
 	<?php if($post['first']) { ?> 
<?php if($threadsortshow) { if($threadsortshow['typetemplate']) { ?>
<?php echo $threadsortshow['typetemplate'];?>
<?php } elseif($threadsortshow['optionlist']) { ?>
<div class="typeoption">
<?php if($threadsortshow['optionlist'] == 'expire') { ?>
该信息已经过期
<?php } else { ?>
<table summary="分类信息" cellpadding="0" cellspacing="0" class="cgtl mbm" width="100%">
<caption><?php echo $_G['forum']['threadsorts']['types'][$_G['forum_thread']['sortid']];?></caption>
<tbody><?php if(is_array($threadsortshow['optionlist'])) foreach($threadsortshow['optionlist'] as $option) { if($option['type'] !== 'info') { ?>
                                    <?php if($option['type'] !== 'image') { ?>
<tr>
<th><?php echo $option['title'];?></th>
<td><?php if($option['value'] || ($option['type'] == 'number' && $option['value'] !== '')) { ?><?php echo $option['value'];?> <?php echo $option['unit'];?><?php } else { ?>-<?php } ?></td>
</tr>
<?php } ?>
                                    <?php } } ?>
</tbody>
</table>
<?php } ?>
</div>
<?php } } } ?>
                        

                            <?php if(!$_G['forum_thread']['special']) { ?>
                                <?php echo $post['message'];?>
                            <?php } elseif($_G['forum_thread']['special'] == 1) { ?>
                                <?php include template('forum/viewthread_poll'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 2) { ?>
                                <?php include template('forum/viewthread_trade'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 3) { ?>
                                <?php include template('forum/viewthread_reward'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 4) { ?>
                                <?php include template('forum/viewthread_activity'); ?>                            <?php } elseif($_G['forum_thread']['special'] == 5) { ?>
                                <?php include template('forum/viewthread_debate'); ?>                            <?php } elseif($threadplughtml) { ?>
                                <?php echo $threadplughtml;?>
                                <?php echo $post['message'];?>
                            <?php } else { ?>
                            	<?php echo $post['message'];?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php echo $post['message'];?>
                        <?php } } ?>
</div>
<?php if($_G['setting']['mobile']['mobilesimpletype'] == 0) { if($post['attachment']) { ?>
               <div class="grey quote">
               附件: <em><?php if($_G['uid']) { ?>您所在的用户组无法下载或查看附件<?php } else { ?>您需要<a href="member.php?mod=logging&amp;action=login">登录</a>才可以下载或查看附件。没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="注册帐号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em>
               </div>
            <?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
               <?php if($post['imagelist']) { if(count($post['imagelist']) == 1) { ?>
<ul class="img_one"><?php echo showattach($post, 1); ?></ul>
<?php } else { ?>
<ul class="img_list cl vm"><?php echo showattach($post, 1); ?></ul>
<?php } } ?>
                <?php if($post['attachlist']) { ?>
<ul><?php echo showattach($post); ?></ul>
<?php } } ?>
   <?php } ?>

           <?php if($webshow_vtag ==1) { ?>
           <?php if($post['first'] && ($post['tags'] || $relatedkeywords) && $_GET['from'] != 'preview') { ?>
<div class="mv_tag cl">
<?php if($post['tags']) { ?>
                    <a class="current">标签</a><?php if(is_array($post['tags'])) foreach($post['tags'] as $var) { ?><a title="<?php echo $var['1'];?>" href="misc.php?mod=tag&amp;id=<?php echo $var['0'];?>"><?php echo $var['1'];?></a>
<?php } } if($relatedkeywords) { ?><span><?php echo $relatedkeywords;?></span><?php } ?>
</div>
           <?php } ?>
           <?php } ?>
        
           <?php if($webshow_vrelate ==1) { ?>
           <?php if($post['relateitem'] && $post['first']) { ?>
<div class="mv_relate">
<h2>相关帖子</h2>
<ul class="cl"><?php if(is_array($post['relateitem'])) foreach($post['relateitem'] as $var) { ?><li>&#8226; <a href="forum.php?mod=viewthread&amp;tid=<?php echo $var['tid'];?>" title="<?php echo $var['subject'];?>"><?php echo $var['subject'];?></a></li>
<?php } ?>
</ul>
</div>
           <?php } ?>
           <?php } ?>


           <!--新增贴内顶部底部-->
           <div class="mv_main_b">
               <div class="mv_main_b_menu cl">
               <?php if($post['invisible'] == 0) { ?>
                   <?php if($allowpostreply && $post['allowcomment'] && (!$thread['closed'] || $_G['forum']['ismoderator'])) { ?><a class="cmmnt" href="forum.php?mod=misc&amp;action=comment&amp;tid=<?php echo $post['tid'];?>&amp;pid=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?><?php if($_G['forum_thread']['special'] == 127) { ?>&amp;special=<?php echo $specialextra;?><?php } ?>">回复</a><?php } ?>
                   <?php if($_G['uid'] && $allowpostreply && !$post['first']) { ?>
                       <a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;repquote=<?php echo $post['pid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;page=<?php echo $page;?>" style=" display:none;">回复此楼</a>
                   <?php } ?>
               <?php } ?>
               <?php if($_G['forum']['ismoderator']) { ?>
                   <?php if($post['first']) { ?>
<a href="#moption_<?php echo $post['pid'];?>" class="popup blue">管理</a>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none;">
<?php if(!$_G['forum_thread']['special']) { ?>
<input type="button" value="编辑" class="redirect button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if($_G['forum_thread']['sortid']) { if($post['first']) { ?>&amp;sortid=<?php echo $_G['forum_thread']['sortid'];?><?php } } if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">
<?php } ?>
<input type="button" value="删除" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;operation=delete&amp;optgroup=3&amp;from=<?php echo $_G['tid'];?>">
<input type="button" value="关闭" class="dialog button" href="forum.php?mod=topicadmin&amp;action=moderate&amp;fid=<?php echo $_G['fid'];?>&amp;moderate[]=<?php echo $_G['tid'];?>&amp;from=<?php echo $_G['tid'];?>&amp;optgroup=4">
<input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
<input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;topiclist[]=<?php echo $_G['forum_firstpid'];?>">
</div>
<?php } else { ?>
<a href="#moption_<?php echo $post['pid'];?>" class="popup blue">管理</a>
<div id="moption_<?php echo $post['pid'];?>" popup="true" class="manage" style="display:none;">
<input type="button" value="编辑" class="redirect button" href="forum.php?mod=post&amp;action=edit&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;pid=<?php echo $post['pid'];?><?php if(!empty($_GET['modthreadkey'])) { ?>&amp;modthreadkey=<?php echo $_GET['modthreadkey'];?><?php } ?>&amp;page=<?php echo $page;?>">
<?php if($_G['group']['allowdelpost']) { ?><input type="button" value="删除" class="dialog button" href="forum.php?mod=topicadmin&amp;action=delpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } if($_G['group']['allowbanpost']) { ?><input type="button" value="屏蔽" class="dialog button" href="forum.php?mod=topicadmin&amp;action=banpost&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } if($_G['group']['allowwarnpost']) { ?><input type="button" value="警告" class="dialog button" href="forum.php?mod=topicadmin&amp;action=warn&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;operation=&amp;optgroup=&amp;page=&amp;topiclist[]=<?php echo $post['pid'];?>"><?php } ?>
</div>
                   <?php } ?>
               <?php } ?>
               </div>       
               
               <?php if($_GET['from'] != 'preview' && $_G['setting']['commentnumber'] && !empty($comments[$post['pid']])) { ?>
               <div id="comment_<?php echo $post['pid'];?>" class="mv_lzl">
                   <em></em>
                   <ul>
                   <?php if(is_array($comments[$post['pid']])) foreach($comments[$post['pid']] as $comment) { ?>                   <li>
                       <div class="mv_lzl_li cl">
                       <span class="s1"><?php if($comment['authorid']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $comment['authorid'];?>"><?php echo $comment['author'];?><?php if($comment['authorid'] == $_G['forum_thread']['authorid']) { ?><i>楼主</i><?php } ?>：</a><?php } else { ?>游客<?php } ?></span><span class="s2"><?php echo $comment['comment'];?></span>
                       <span class="s3"><?php echo dgmdate($comment[dateline], 'u');?></span>
                       </div>
                   </li>
                   <?php } ?>
                   </div>
               </div>
               <?php } ?>

               <?php if($webshow_sign ==1) { ?>
       <?php if($post['signature'] && ($_G['setting']['bannedmessages'] & 4 && ($post['memberstatus'] == '-1' || ($post['authorid'] && !$post['username']) || ($post['groupid'] == 4 || $post['groupid'] == 5) || ($post['status'] & 1)))) { ?>
       <div class="sign cl">签名被屏蔽</div>
                   <div class="sign_blank"> </div>
       <?php } elseif($post['signature'] && !$post['anonymous'] && $showsignatures) { ?>
       <div class="sign cl" style="max-height:<?php echo $_G['setting']['maxsigrows'];?>px;maxHeightIE:<?php echo $_G['setting']['maxsigrows'];?>px; overflow:hidden;"><?php echo $post['signature'];?></div>
                   <div class="sign_blank"> </div>
       <?php } elseif(!$post['anonymous'] && $showsignatures && $_G['setting']['globalsightml']) { ?>
       <div class="sign cl"><?php echo $_G['setting']['globalsightml'];?></div>
                   <div class="sign_blank"> </div>
       <?php } ?>
               <?php } ?>
           </div>
           <!--viewthread main botom end-->
       </div>
   </div>
   <?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount];?>
   <?php $postcount++;?>   <?php } ?>
   <div id="post_new"></div>
<div id="btoolbar" class="btoolbar btoolbarv">
    <div class="btool btoolmv cl<?php if($secqaacheck || $seccodecheck) { ?> btoolmv_sec<?php } ?>">
<form method="post" name="fastpostform" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;replysubmit=yes&amp;mobile=2">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <ul>
        <li class="li1"><a href="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;reppost=<?php echo $_G['forum_firstpid'];?>&amp;page=<?php echo $page;?>"></a></li>
<li class="li2">
            <textarea value="我也说一句" color="gray" name="message" id="fastpostmessage"></textarea>
        </li>
        <?php if($secqaacheck || $seccodecheck) { ?>
        <li class="li3">
            <?php $sechash = 'S'.random(4);
$sectpl = !empty($sectpl) ? explode("<sec>", $sectpl) : array('<br />',': ','<br />','');	
$ran = random(5, 1);?><?php if($secqaacheck) { $message = '';
$question = make_secqaa();
$secqaa = lang('core', 'secqaa_tips').$question;?><?php } if($sectpl) { if($secqaacheck) { ?>
<p>
        验证问答: 
        <span class="xg2"><?php echo $secqaa;?></span>
<input name="secqaahash" type="hidden" value="<?php echo $sechash;?>" />
        <input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt" />
        </p>
<?php } if($seccodecheck) { ?>
<div class="sec_code vm">
<input name="seccodehash" type="hidden" value="<?php echo $sechash;?>" />
        <div style="display: inline-block;padding-right: 10px;">
<input type="text" class="txt px vm" style="ime-mode:disabled;width:60px;background:white;" autocomplete="off" value="" id="seccodeverify_<?php echo $sechash;?>" name="seccodeverify" placeholder="验证码" fwin="seccode">
        </div>
        <img src="misc.php?mod=seccode&amp;update=<?php echo $ran;?>&amp;idhash=<?php echo $sechash;?>&amp;mobile=2" class="seccodeimg"/>
</div>
<?php } } ?>
<script type="text/javascript">
(function() {
$('.seccodeimg').on('click', function() {
$('#seccodeverify_<?php echo $sechash;?>').attr('value', '');
var tmprandom = 'S' + Math.floor(Math.random() * 1000);
$('.sechash').attr('value', tmprandom);
$(this).attr('src', 'misc.php?mod=seccode&update=<?php echo $ran;?>&idhash='+ tmprandom +'&mobile=2');
});
})();
</script>
        </li>
        <?php } ?>
        <li class="li4"><input type="button" value="发送" name="replysubmit" id="fastpostsubmit"></li>
</ul>
    </form>
    </div>
</div>
 
<script type="text/javascript">
$(document).ready(function(){
    $("#fastpostmessage").focus(function(){  
    $("#btoolbar").removeClass("btoolbarv");
        $("#btoolbar").addClass("btoolbar_v");  
    }).blur(function(){
    $('#fastpostsubmit').click(function(){
        $("#btoolbar").addClass("btoolbarv"); 
            $("#btoolbar").removeClass("btoolbar_v"); 
    });
    })
});
$('.message').click(function(){
   $("#btoolbar").removeClass("btoolbar_v"); 
   $("#btoolbar").addClass("btoolbarv"); 
})
</script>
<script type="text/javascript">
(function() {
var form = $('#fastpostform');
<?php if(!$allowpostreply) { ?>
$('#fastpostmessage').on('focus', function() {
<?php if(!$_G['uid']) { ?>
popup.open('您还未登录，立即登录?', 'confirm', 'member.php?mod=logging&action=login');
<?php } else { ?>
popup.open('您暂时没有权限发表', 'alert');
<?php } ?>
this.blur();
});
<?php } else { ?>
$('#fastpostmessage').on('focus', function() {
var obj = $(this);
if(obj.attr('color') == 'gray') {
obj.attr('value', '');
obj.removeClass('grey');
obj.attr('color', 'black');
$('#fastpostsubmitline').css('display', 'block');
}
})
//.on('blur', function() {
//var obj = $(this);
//if(obj.attr('value') == '') {
//obj.addClass('grey');
//obj.attr('value', '我也说一句');
//obj.attr('color', 'gray');
//}
//});
<?php } ?>
$('#fastpostsubmit').on('click', function() {
var msgobj = $('#fastpostmessage');
if(msgobj.val() == '我也说一句') {
msgobj.attr('value', '');
}
$.ajax({
type:'POST',
url:form.attr('action') + '&handlekey=fastpost&loc=1&inajax=1',
data:form.serialize(),
dataType:'xml'
})
.success(function(s) {
evalscript(s.lastChild.firstChild.nodeValue);
})
.error(function() {
window.location.href = obj.attr('href');
popup.close();
});
return false;
});

$('#replyid').on('click', function() {
$(document).scrollTop($(document).height());
$('#fastpostmessage')[0].focus();
});

})();

function succeedhandle_fastpost(locationhref, message, param) {
var pid = param['pid'];
var tid = param['tid'];
if(pid) {
$.ajax({
type:'POST',
url:'forum.php?mod=viewthread&tid=' + tid + '&viewpid=' + pid + '&mobile=2',
dataType:'xml'
})
.success(function(s) {
$('#post_new').append(s.lastChild.firstChild.nodeValue);
})
.error(function() {
window.location.href = 'forum.php?mod=viewthread&tid=' + tid;
popup.close();
});
} else {
if(!message) {
message = '本版回帖需要审核，您的帖子将在通过审核后显示';
}
popup.open(message, 'alert');
}
$('#fastpostmessage').attr('value', '');
if(param['sechash']) {
$('.seccodeimg').click();
}
}

function errorhandle_fastpost(message, param) {
popup.open(message, 'alert');
}
</script></div>
<?php echo $multipage;?>

<?php if(!empty($_G['setting']['pluginhooks']['viewthread_bottom_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_bottom_mobile'];?>
<script type="text/javascript">
$('.favbtn').on('click', function() {
var obj = $(this);
$.ajax({
type:'POST',
url:obj.attr('href') + '&handlekey=favbtn&inajax=1',
data:{'favoritesubmit':'true', 'formhash':'<?php echo FORMHASH;?>'},
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
</script><?php include template('common/footer'); ?>