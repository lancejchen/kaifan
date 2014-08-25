<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('post');
0
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/post.htm', './template/webshow_mtb0115/touch/common/seccheck.htm', 1408677174, '2', './data/template/2_2_touch_forum_post.tpl.php', './template/webshow_mtb0115', 'touch/forum/post')
;?><?php include template('common/header'); if($isfirstpost && $sortid) { ?>
<script type="text/javascript">
    var forum_optionlist = <?php if($forum_optionlist) { ?>'<?php echo $forum_optionlist;?>'<?php } else { ?>''<?php } ?>;
</script>
<script src="template/webshow_mtb0115/touch/img/js/threadsort.js" type="text/javascript"></script>
<?php } $adveditor = $isfirstpost && $special && ($_GET['action'] == 'newthread' || $_GET['action'] == 'reply' && !empty($_GET['addtrade']) || $_GET['action'] == 'edit' );?><form method="post" name="postform" id="postform"
<?php if($_GET['action'] == 'newthread') { ?>action="forum.php?mod=post&amp;action=<?php if($special != 2) { ?>newthread<?php } else { ?>newtrade<?php } ?>&amp;fid=<?php echo $_G['fid'];?>&amp;extra=<?php echo $extra;?>&amp;topicsubmit=yes&amp;mobile=2"
<?php } elseif($_GET['action'] == 'reply') { ?>action="forum.php?mod=post&amp;action=reply&amp;fid=<?php echo $_G['fid'];?>&amp;tid=<?php echo $_G['tid'];?>&amp;extra=<?php echo $extra;?>&amp;replysubmit=yes&amp;mobile=2"
<?php } elseif($_GET['action'] == 'edit') { ?>action="forum.php?mod=post&amp;action=edit&amp;extra=<?php echo $extra;?>&amp;editsubmit=yes&amp;mobile=2" <?php echo $enctype;?>
<?php } ?>>

<input type="hidden" name="formhash" id="formhash" value="<?php echo FORMHASH;?>" />
<input type="hidden" name="posttime" id="posttime" value="<?php echo TIMESTAMP;?>" />
<?php if(!empty($_GET['modthreadkey'])) { ?><input type="hidden" name="modthreadkey" id="modthreadkey" value="<?php echo $_GET['modthreadkey'];?>" /><?php } if($_GET['action'] == 'reply') { ?>
<input type="hidden" name="noticeauthor" value="<?php echo $noticeauthor;?>" />
<input type="hidden" name="noticetrimstr" value="<?php echo $noticetrimstr;?>" />
<input type="hidden" name="noticeauthormsg" value="<?php echo $noticeauthormsg;?>" />
<?php if($reppid) { ?>
<input type="hidden" name="reppid" value="<?php echo $reppid;?>" />
<?php } if($_GET['reppost']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_GET['reppost'];?>" />
<?php } elseif($_GET['repquote']) { ?>
<input type="hidden" name="reppost" value="<?php echo $_GET['repquote'];?>" />
<?php } } if($_GET['action'] == 'edit') { ?>
<input type="hidden" name="fid" id="fid" value="<?php echo $_G['fid'];?>" />
<input type="hidden" name="tid" value="<?php echo $_G['tid'];?>" />
<input type="hidden" name="pid" value="<?php echo $pid;?>" />
<input type="hidden" name="page" value="<?php echo $_GET['page'];?>" />
<?php } if($special) { ?>
<input type="hidden" name="special" value="<?php echo $special;?>" />
<?php } if($specialextra) { ?>
<input type="hidden" name="specialextra" value="<?php echo $specialextra;?>" />
<?php } ?>

<div class="mv_post_dp mv_post_main">
    <h2><?php if($_GET['action'] == 'edit') { ?>编辑<?php } else { ?>发布新开饭<?php } ?></h2>
    <div class="mv_post_c">
        <span class="rq">*（带*表示必填）</span>

        <!--activity type-->
        <div data-role="fieldcontainer">
            <label for="activityclass">活动类别:<span class="rq">*</span></label>
            <select id="activityclass" name="activityclass">
                <?php if($activitytypelist) { ?>
                <?php if(is_array($activitytypelist)) foreach($activitytypelist as $key => $val) { ?>                <option value="<?php echo $val;?>"><?php echo $val;?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>


        <!--开饭标题-->
        <div data-role="fieldcontainer">
            <?php if($_GET['action'] != 'reply') { ?>
            <label for="needsubject">开饭标题</label>
            <input type="text" tabindex="1" class="px" id="needsubject" size="30" autocomplete="off" value="<?php echo $postinfo['subject'];?>" name="subject" placeholder="标题" fwin="login">
            <?php } else { ?>
            RE: <?php echo $thread['subject'];?>
            <?php if($quotemessage) { ?><?php echo $quotemessage;?><?php } ?>
            <?php } ?>
        </div>


        <?php if($_GET['action'] == 'edit' && $isorigauthor && ($isfirstpost && $thread['replies'] < 1 || !$isfirstpost) && !$rushreply && $_G['setting']['editperdel']) { ?>
        <div data-role="fieldcontainer" class="li_4">
            <input type="checkbox" name="delete" id="delete" class="pc" value="1" title="删除本帖<?php if($thread['special'] == 3) { ?>，返还悬赏费用，不退还手续费<?php } ?>"> 删?
        </div>
        <?php } ?>

        <!--活动描述-->
        <div data-role="fieldcontainer" class="li_5">
            <textarea class="pt" id="needmessage" tabindex="3" autocomplete="off" id="<?php echo $editorid;?>_textarea" name="<?php echo $editor['textarea'];?>" cols="80" rows="2"  placeholder="活动描述" fwin="reply"><?php echo $postinfo['message'];?></textarea>
        </div>


        <div id="imglist" class="post_imglist cl">
        </div>

        <?php if($showthreadsorts) { ?>
        <!--分类信息发布-->
        <?php if($sortid) { ?>
        <input type="hidden" name="sortid" value="<?php echo $sortid;?>" />
        <?php } ?>
        <?php } elseif($adveditor) { ?>
        <div class="mv_post_s">
            <?php if($special == 1) { include template('forum/post_poll'); ?>            <?php } elseif($special == 3) { include template('forum/post_reward'); ?>            <!--通过这一行调用post_activity-->

            <?php } elseif($special == 4) { include template('forum/post_activity'); ?>            <?php } elseif($special == 5) { include template('forum/post_debate'); ?>            <?php } elseif($specialextra) { ?><div><?php echo $threadplughtml;?></div>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if($_GET['action'] != 'edit' && ($secqaacheck || $seccodecheck)) { ?>
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
        <?php } ?>

        <!--最下面的提交按钮-->
        <div data-role="controlgroup" data-type="horizontal" >
        <button id="cancelBtn" data-inline="true" data-icon="delete" style="width:100px !important;background-color:#f2f9fd">取消</button>
         <!--<a href="./template/webshow_mtb0115/touch/delete.htm" date-rel="dialog" data-transition="pop" data-role="button">delete</a>-->
        <button id="postsubmit" style="width:100px !important; background-color:#f2f9fd;" data-icon="check" data-inline="true" class="btn_pn <?php if($_GET['action'] == 'edit') { ?>" <!--<?php } else { ?>" <?php } ?>><span><?php if($_GET['action'] == 'newthread') { ?>发布并上传图片<?php } elseif($_GET['action'] == 'reply') { ?>回复<?php } elseif($_GET['action'] == 'edit') { ?>保存<?php } ?></span></button>
        </div>


        <input type="hidden" name="<?php if($_GET['action'] == 'newthread') { ?>topicsubmit<?php } elseif($_GET['action'] == 'reply') { ?>replysubmit<?php } elseif($_GET['action'] == 'edit') { ?>editsubmit<?php } ?>" value="yes">
    </div>
</div>
</form>

<?php if($_G['setting']['fastsmilies']) { ?>
<!--js for showing emoction-->
<script src="data/cache/common_smilies_var.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
    function seditor_insertunit(key, smilies) {
        textarea = document.postform.message;
        textarea.value += smilies;
        textarea.focus();
    }
    var j = 1, smilies_fastdata = '',  img, seditorkey = "fastpost";
    for(i = 0;i < smilies_fast.length; i++) {
        if(j == 0) {
            smilies_fastdata += '<tr>';
        }
        j = ++j > 10 ? 0 : j;
        s = smilies_array[smilies_fast[i][0]][smilies_fast[i][1]][smilies_fast[i][2]];
        smilieimg = "static/" + 'image/smiley/' + smilies_type['_' + smilies_fast[i][0]][1] + '/' + s[2];
        smilies_fastdata += s ? '<td onclick="' + (typeof wysiwyg != 'undefined' ? 'insertSmiley(' + s[0] + ')': 'seditor_insertunit(\'' + seditorkey + '\', \'' + s[1].replace(/'/, '\\\'') + '\')') +
            '" ><img src="' + smilieimg + '" />' : '<td>';
    }
</script>
<?php } ?>


<script src="<?php echo STATICURL;?>js/mobile/activityFormCheck.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="<?php echo STATICURL;?>js/mobile/ajaxfileupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script src="<?php echo STATICURL;?>js/mobile/buildfileupload.js?<?php echo VERHASH;?>" type="text/javascript"></script>

<script type="text/javascript">
    var imgexts = typeof imgexts == 'undefined' ? 'jpg, jpeg, gif, png' : imgexts;
    var STATUSMSG = {
        '-1' : '内部服务器错误',
        '0' : '上传成功',
        '1' : '不支持此类扩展名',
        '2' : '服务器限制无法上传那么大的附件',
        '3' : '用户组限制无法上传那么大的附件',
        '4' : '不支持此类扩展名',
        '5' : '文件类型限制无法上传那么大的附件',
        '6' : '今日您已无法上传更多的附件',
        '7' : '请选择图片文件(' + imgexts + ')',
        '8' : '附件文件无法保存',
        '9' : '没有合法的文件被上传',
        '10' : '非法操作',
        '11' : '今日您已无法上传那么大的附件'
    };

    var form = $('#postform');

    $(document).on('change', '#filedata', function() {
        popup.open('<img src="' + IMGDIR + '/imageloading.gif">');
        uploadsuccess = function(data) {
            if(data == '') {
                popup.open('上传失败，请稍后再试', 'alert');
            }
            var dataarr = data.split('|');
            if(dataarr[0] == 'DISCUZUPLOAD' && dataarr[2] == 0) {
                popup.close();
                $('#imglist').append('<li><span aid="'+dataarr[3]+'" class="del"><a href="javascript:;"><img src="<?php echo STATICURL;?>image/mobile/images/icon_del.png"></a></span><span class="p_img"><a href="javascript:;"><img style="height:54px;width:54px;" id="aimg_'+dataarr[3]+'" title="'+dataarr[6]+'" src="<?php echo $_G['setting']['attachurl'];?>forum/'+dataarr[5]+'" /></a></span><input type="hidden" name="attachnew['+dataarr[3]+'][description]" /></li>');
            } else {
                var sizelimit = '';
                if(dataarr[7] == 'ban') {
                    sizelimit = '(附件类型被禁止)';
                } else if(dataarr[7] == 'perday') {
                    sizelimit = '(不能超过'+Math.ceil(dataarr[8]/1024)+'K)';
                } else if(dataarr[7] > 0) {
                    sizelimit = '(不能超过'+Math.ceil(dataarr[7]/1024)+'K)';
                }
                popup.open(STATUSMSG[dataarr[2]] + sizelimit, 'alert');
            }
        };

        if(typeof FileReader != 'undefined' && this.files[0]) {//note 支持html5上传新特性

            $.buildfileupload({
                uploadurl:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
                files:this.files,
                uploadformdata:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])?>"},
                    uploadinputname:'Filedata',
                maxfilesize:"<?php echo $swfconfig['max'];?>",
                success:uploadsuccess,
                error:function() {
                popup.open('上传失败，请稍后再试', 'alert');
            }
        });

    } else {

        $.ajaxfileupload({
            url:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
            data:{uid:"<?php echo $_G['uid'];?>", hash:"<?php echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])?>"},
                dataType:'text',
            fileElementId:'filedata',
            success:uploadsuccess,
            error: function() {
            popup.open('上传失败，请稍后再试', 'alert');
        }
    });

    }
    });

    $(document).on('click', '.del', function() {
        var obj = $(this);
        $.ajax({
            type:'GET',
            url:'forum.php?mod=ajax&action=deleteattach&inajax=yes&aids[]=' + obj.attr('aid'),
        })
            .success(function(s) {
                obj.parent().remove();
            })
            .error(function() {
                popup.open('网络出现问题，请稍后再试', 'alert');
            });
        return false;
    });

</script><?php include template('common/footer'); ?>