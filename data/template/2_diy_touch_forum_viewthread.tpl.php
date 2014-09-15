<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('viewthread');
0
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/viewthread.htm', './template/webshow_mtb0115/touch/forum/forumdisplay_fastpost.htm', 1410787775, 'diy', './data/template/2_diy_touch_forum_viewthread.tpl.php', './template/webshow_mtb0115', 'touch/forum/viewthread')
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/viewthread.htm', './template/webshow_mtb0115/touch/common/seccheck.htm', 1410787775, 'diy', './data/template/2_diy_touch_forum_viewthread.tpl.php', './template/webshow_mtb0115', 'touch/forum/viewthread')
;?>
<?php $threadsort = $threadsorts = null;?><?php include template('common/header'); $_G['forum_thread']['starttime'] = dgmdate($_G['forum_thread']['dateline'], 'Y-m-d H:i');?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_top_mobile'])) echo $_G['setting']['pluginhooks']['viewthread_top_mobile'];?>


<!--header for title, distance & reply numbers-->
<ul data-role="listview" data-inset="true" id="shop_info">
    <li>
        <h1 style="display:inline;">
            <?php echo $_G['forum_thread']['subject'];?>
            <?php if($_G['forum_thread']['displayorder'] == -2) { ?> <span>(审核中)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -3) { ?> <span>(已忽略)</span>
            <?php } elseif($_G['forum_thread']['displayorder'] == -4) { ?> <span>(草稿)</span>
            <?php } ?>
            <span class="loc ui-icon-location ui-btn-icon-left" style="position:relative;
            "><?php echo $thread['distance'];?></span>
        </h1>
        <h2><span class="loc ui-icon-comment ui-btn-icon-left" style="position:relative;">
                <?php echo $shop_comments;?>
            </span>
        </h2>
    </li>
<!--    shop location & tel-->
    <li id="telLine">
        <table style="width:100%;height:100%;">
            <tr id="address_tel" style="height: 100%;">
                <td id="address"><a href="<?php echo $shop_map_url;?>"><?php echo $shop_address;?></a></td>
                <td id="tel"><a href="tel:<?php echo $shop_tel;?>">
                        <span class="ui-icon-phone ui-btn-icon-left"
                              style="position:relative;
            ">拨打</span>
                </a></td>
            </tr>
        </table>
    </li>
</ul>

<div class="postlist"><?php $postcount = 0;?><?php if(is_array($postlist)) foreach($postlist as $post) { $needhiddenreply = ($hiddenreplies && $_G['uid'] != $post['authorid'] && $_G['uid'] != $_G['forum_thread']['authorid'] && !$post['first'] && !$_G['forum']['ismoderator']);?><?php if(!empty($_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_posttop_mobile'][$postcount];?>
   <div class="plc cl" id="pid<?php echo $post['pid'];?>">
   <div class="message">


               <?php if($post['first']) { ?>
                    <?php if(!$_G['forum_thread']['special']) { ?>
                        <?php echo $post['message'];?>
                    <?php } elseif($_G['forum_thread']['special'] == 1) { ?>
                        <?php include template('forum/viewthread_poll'); ?>                    <?php } elseif($_G['forum_thread']['special'] == 2) { ?>
                        <?php include template('forum/viewthread_trade'); ?>                    <?php } elseif($_G['forum_thread']['special'] == 3) { ?>
                        <?php include template('forum/viewthread_reward'); ?>                    <?php } elseif($_G['forum_thread']['special'] == 4) { ?>
                        <?php include template('forum/viewthread_activity'); ?>                    <?php } elseif($_G['forum_thread']['special'] == 5) { ?>
                        <?php include template('forum/viewthread_debate'); ?>                    <?php } elseif($threadplughtml) { ?>
                        <?php echo $threadplughtml;?>
                        <?php echo $post['message'];?>
                    <?php } else { ?>
                        <?php echo $post['message'];?>
                    <?php } ?>

                <?php } else { ?>

                <?php } ?>

   </div>
        <?php if($post['attachment']) { ?>
           <div class="grey quote">
           附件: <em><?php if($_G['uid']) { ?>您所在的用户组无法下载或查看附件<?php } else { ?>您需要<a href="member.php?mod=logging&amp;action=login">登录</a>才可以下载或查看附件。没有帐号？<a href="member.php?mod=<?php echo $_G['setting']['regname'];?>" title="注册帐号"><?php echo $_G['setting']['reglinkname'];?></a><?php } ?></em>
           </div>

        <?php } elseif($post['imagelist'] || $post['attachlist']) { ?>
               <?php if($post['imagelist']) { ?>
                    <?php if(count($post['imagelist']) == 1) { ?>
                    <ul class="img_one"><?php echo showattach($post, 1); ?></ul>
                    <?php } else { ?>
                    <ul class="img_list cl vm"><?php echo showattach($post, 1); ?></ul>
                    <?php } ?>
                <?php } ?>
              <?php if($post['attachlist']) { ?>
                <ul><?php echo showattach($post); ?></ul>
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
       </div>

   <?php if(!empty($_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount])) echo $_G['setting']['pluginhooks']['viewthread_postbottom_mobile'][$postcount];?>
   <?php $postcount++;?>   <?php } ?>
</div>



<div class="comments">
    <ul data-role="listview" data-inset="true">
        <li data-role="list-divider">用户评论</li>
    <?php if(is_array($comments)) foreach($comments as $comment) { ?>        <li>
            <h2><?php echo $comment['author'];?></h2>
            <p><?php echo $comment['message'];?></p>
            <p class="ui-li-aside"><?php echo $comment['dateline'];?></p>
        </li>
    <?php } ?>
    </ul>
</div>
   <div id="post_new"></div>

<div id="btoolbar" class="btoolbar btoolbarv">
    <div class="btool btoolmv cl<?php if($secqaacheck || $seccodecheck) { ?> btoolmv_sec<?php } ?>" style="height:180px;">
<form method="post" name="fastpostform" autocomplete="off" id="fastpostform" action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $_GET['extra'];?>&amp;replysubmit=yes&amp;mobile=2">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
    <ul>
<li class="li2"><label for="fastpostmessage">评价：</label>
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
        <input name="secanswer" id="secqaaverify_<?php echo $sechash;?>" type="text" class="txt"  style="width:100px!important;"/>
        </p>
<?php } if($seccodecheck) { ?>
<div class="sec_code vm" style="display: inline;">
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
        <li class="li4" style="display:inline;">
            <input type="button" value="发送" name="replysubmit" id="fastpostsubmit" data-role="none">
        </li>
        <li>
            <a id="backBtnA" data-rel="back" data-direction="reverse" class="ui-icon-back" data-icon="back">
                返回
            </a>
        </li>
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
</script><?php echo $multipage;?>
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
//    var <?php echo $reload_once;?>=0;
//        $(document).ready(function(){
//
//            while(<?php echo $reload_once;?><1){
//                location.reload();
//                console.log('run');
//                <?php echo $reload_once;?>++;
//            }
//        });

</script><?php include template('common/footer'); ?>