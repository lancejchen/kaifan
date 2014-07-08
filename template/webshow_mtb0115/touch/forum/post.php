<?php exit;?>
<!--{template common/header}-->
<!--{if $isfirstpost && $sortid}-->
<script type="text/javascript">
    var forum_optionlist = <!--{if $forum_optionlist}-->'$forum_optionlist'<!--{else}-->''<!--{/if}-->;
</script>
<script type="text/javascript" src="template/webshow_mtb0115/touch/img/js/threadsort.js"></script>
<!--{/if}-->

<!--{eval $adveditor = $isfirstpost && $special && ($_GET['action'] == 'newthread' || $_GET['action'] == 'reply' && !empty($_GET['addtrade']) || $_GET['action'] == 'edit' );}-->

<form method="post" name="postform" id="postform"
{if $_GET[action] == 'newthread'}action="forum.php?mod=post&action={if $special != 2}newthread{else}newtrade{/if}&fid=$_G[fid]&extra=$extra&topicsubmit=yes&mobile=2"
{elseif $_GET[action] == 'reply'}action="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&extra=$extra&replysubmit=yes&mobile=2"
{elseif $_GET[action] == 'edit'}action="forum.php?mod=post&action=edit&extra=$extra&editsubmit=yes&mobile=2" $enctype
{/if}>
<input type="hidden" name="formhash" id="formhash" value="{FORMHASH}" />
<input type="hidden" name="posttime" id="posttime" value="{TIMESTAMP}" />
<!--{if !empty($_GET['modthreadkey'])}--><input type="hidden" name="modthreadkey" id="modthreadkey" value="$_GET['modthreadkey']" /><!--{/if}-->

<!--{if $_GET[action] == 'reply'}-->
<input type="hidden" name="noticeauthor" value="$noticeauthor" />
<input type="hidden" name="noticetrimstr" value="$noticetrimstr" />
<input type="hidden" name="noticeauthormsg" value="$noticeauthormsg" />
<!--{if $reppid}-->
<input type="hidden" name="reppid" value="$reppid" />
<!--{/if}-->
<!--{if $_GET[reppost]}-->
<input type="hidden" name="reppost" value="$_GET[reppost]" />
<!--{elseif $_GET[repquote]}-->
<input type="hidden" name="reppost" value="$_GET[repquote]" />
<!--{/if}-->
<!--{/if}-->

<!--{if $_GET[action] == 'edit'}-->
<input type="hidden" name="fid" id="fid" value="$_G[fid]" />
<input type="hidden" name="tid" value="$_G[tid]" />
<input type="hidden" name="pid" value="$pid" />
<input type="hidden" name="page" value="$_GET[page]" />
<!--{/if}-->

<!--{if $special}-->
<input type="hidden" name="special" value="$special" />
<!--{/if}-->
<!--{if $specialextra}-->
<input type="hidden" name="specialextra" value="$specialextra" />
<!--{/if}-->

<div class="mv_post_dp mv_post_main">
    <h2><!--{if $_GET[action] == 'edit'}-->{lang edit}<!--{else}-->{lang kaifan_newthread}<!--{/if}--></h2>
    <div class="mv_post_c">

        <div data-role="fieldcontainer">
            <!--{if $_GET['action'] != 'reply'}-->
            <input type="text" tabindex="1" class="px" id="needsubject" size="30" autocomplete="off" value="$postinfo[subject]" name="subject" placeholder="{lang thread_subject}" fwin="login">
            <!--{else}-->
            RE: $thread['subject']
            <!--{if $quotemessage}-->$quotemessage<!--{/if}-->
            <!--{/if}-->
        </div>

        <!--{if $showthreadsorts}-->
        <!--分类信息发布-->
        <!--{if $sortid}-->
        <input type="hidden" name="sortid" value="$sortid" />
        <!--{/if}-->
        <!--{template forum/post_sortoption}-->
        <!--{elseif $adveditor}-->
        <div class="mv_post_s">
            <!--{if $special == 1}--><!--{template forum/post_poll}-->
            <!--{elseif $special == 3}--><!--{template forum/post_reward}-->

            <!--通过这一行调用post_activity-->
            <!--{elseif $special == 4}--><!--{template forum/post_activity}-->
            <!--{elseif $special == 5}--><!--{template forum/post_debate}-->
            <!--{elseif $specialextra}--><div>$threadplughtml</div>
            <!--{/if}-->
        </div>
        <!--{/if}-->

        <div data-role="fieldcontainer" class="li_2 cl">
            <a class="a1" href="javascript:;"><input type="file" name="Filedata" id="filedata" style="width:30px;height:30px;font-size:30px;opacity:0;"/></a>
            <!--{if $_G[setting][fastsmilies]}-->
            <a class="a2" onclick="$(this).hide(); $('#fastsmiliesdiv_data').fadeIn();"></a>
            <div class="cl"></div>
            <div id="fastsmiliesdiv_data" style="display:none;"><div id="fastsmilies"></div></div>
            <!--{/if}-->
        </div>

        <!--{if $_GET[action] == 'edit' && $isorigauthor && ($isfirstpost && $thread['replies'] < 1 || !$isfirstpost) && !$rushreply && $_G['setting']['editperdel']}-->
        <div data-role="fieldcontainer" class="li_4">
            <input type="checkbox" name="delete" id="delete" class="pc" value="1" title="{lang post_delpost}{if $thread[special] == 3}{lang reward_price_back}{/if}"> {lang delete_check}
        </div>
        <!--{/if}-->

        <div data-role="fieldcontainer" class="li_5">
            <textarea class="pt" id="needmessage" tabindex="3" autocomplete="off" id="{$editorid}_textarea" name="$editor[textarea]" cols="80" rows="2"  placeholder="{lang thread_content}" fwin="reply">$postinfo[message]</textarea>
        </div>


        <!--{if $_GET[action] != 'edit' && ($secqaacheck || $seccodecheck)}-->
        <!--{subtemplate common/seccheck}-->
        <!--{/if}-->

        <div id="imglist" class="post_imglist cl">
        </div>

        <button id="postsubmit" class="btn_pn <!--{if $_GET[action] == 'edit'}-->btn_pn_blue" disable="false"<!--{else}-->btn_pn_grey" disable="true"<!--{/if}-->><span><!--{if $_GET[action] == 'newthread'}-->{lang send_thread}<!--{elseif $_GET[action] == 'reply'}-->{lang join_thread}<!--{elseif $_GET[action] == 'edit'}-->{lang edit_save}<!--{/if}--></span></button>
        <input type="hidden" name="{if $_GET[action] == 'newthread'}topicsubmit{elseif $_GET[action] == 'reply'}replysubmit{elseif $_GET[action] == 'edit'}editsubmit{/if}" value="yes">
    </div>
</div>
</form>


<!--{if $_G[setting][fastsmilies]}-->
<script src="data/cache/common_smilies_var.js" type="text/javascript"></script>
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
<!--{/if}-->

<script type="text/javascript">
    (function() {
        var needsubject = needmessage = false;

        <!--{if $_GET[action] == 'reply'}-->
        needsubject = true;
        <!--{elseif $_GET[action] == 'edit'}-->
        needsubject = needmessage = true;
        <!--{/if}-->

        <!--{if $_GET[action] == 'newthread' || ($_GET[action] == 'edit' && $isfirstpost)}-->
        $('#needsubject').on('keyup input', function() {
            var obj = $(this);
            if(obj.val()) {
                needsubject = true;
                if(needmessage == true) {
                    $('.btn_pn').removeClass('btn_pn_grey').addClass('btn_pn_blue');
                    $('.btn_pn').attr('disable', 'false');
                }
            } else {
                needsubject = false;
                $('.btn_pn').removeClass('btn_pn_blue').addClass('btn_pn_grey');
                $('.btn_pn').attr('disable', 'true');
            }
        });
        <!--{/if}-->
        $('#needmessage').on('keyup input', function() {
            var obj = $(this);
            if(obj.val()) {
                needmessage = true;
                if(needsubject == true) {
                    $('.btn_pn').removeClass('btn_pn_grey').addClass('btn_pn_blue');
                    $('.btn_pn').attr('disable', 'false');
                }
            } else {
                needmessage = false;
                $('.btn_pn').removeClass('btn_pn_blue').addClass('btn_pn_grey');
                $('.btn_pn').attr('disable', 'true');
            }
        });

        $('#needmessage').on('scroll', function() {
            var obj = $(this);
            if(obj.scrollTop() > 0) {
                obj.attr('rows', parseInt(obj.attr('rows'))+2);
            }
        }).scrollTop($(document).height());
    })();
</script>
<script type="text/javascript" src="{STATICURL}js/mobile/ajaxfileupload.js?{VERHASH}"></script>
<script type="text/javascript" src="{STATICURL}js/mobile/buildfileupload.js?{VERHASH}"></script>
<script type="text/javascript">
    var imgexts = typeof imgexts == 'undefined' ? 'jpg, jpeg, gif, png' : imgexts;
    var STATUSMSG = {
        '-1' : '{lang uploadstatusmsgnag1}',
        '0' : '{lang uploadstatusmsg0}',
        '1' : '{lang uploadstatusmsg1}',
        '2' : '{lang uploadstatusmsg2}',
        '3' : '{lang uploadstatusmsg3}',
        '4' : '{lang uploadstatusmsg4}',
        '5' : '{lang uploadstatusmsg5}',
        '6' : '{lang uploadstatusmsg6}',
        '7' : '{lang uploadstatusmsg7}(' + imgexts + ')',
        '8' : '{lang uploadstatusmsg8}',
        '9' : '{lang uploadstatusmsg9}',
        '10' : '{lang uploadstatusmsg10}',
        '11' : '{lang uploadstatusmsg11}'
    };
    var form = $('#postform');
    $(document).on('change', '#filedata', function() {
        popup.open('<img src="' + IMGDIR + '/imageloading.gif">');

        uploadsuccess = function(data) {
            if(data == '') {
                popup.open('{lang uploadpicfailed}', 'alert');
            }
            var dataarr = data.split('|');
            if(dataarr[0] == 'DISCUZUPLOAD' && dataarr[2] == 0) {
                popup.close();
                $('#imglist').append('<li><span aid="'+dataarr[3]+'" class="del"><a href="javascript:;"><img src="{STATICURL}image/mobile/images/icon_del.png"></a></span><span class="p_img"><a href="javascript:;"><img style="height:54px;width:54px;" id="aimg_'+dataarr[3]+'" title="'+dataarr[6]+'" src="{$_G[setting][attachurl]}forum/'+dataarr[5]+'" /></a></span><input type="hidden" name="attachnew['+dataarr[3]+'][description]" /></li>');
            } else {
                var sizelimit = '';
                if(dataarr[7] == 'ban') {
                    sizelimit = '{lang uploadpicatttypeban}';
                } else if(dataarr[7] == 'perday') {
                    sizelimit = '{lang donotcross}'+Math.ceil(dataarr[8]/1024)+'K)';
                } else if(dataarr[7] > 0) {
                    sizelimit = '{lang donotcross}'+Math.ceil(dataarr[7]/1024)+'K)';
                }
                popup.open(STATUSMSG[dataarr[2]] + sizelimit, 'alert');
            }
        };

        if(typeof FileReader != 'undefined' && this.files[0]) {//note 支持html5上传新特性

            $.buildfileupload({
                uploadurl:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
                files:this.files,
                uploadformdata:{uid:"$_G[uid]", hash:"<!--{eval echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])}-->"},
                    uploadinputname:'Filedata',
                maxfilesize:"$swfconfig[max]",
                success:uploadsuccess,
                error:function() {
                popup.open('{lang uploadpicfailed}', 'alert');
            }
        });

    } else {

        $.ajaxfileupload({
            url:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
            data:{uid:"$_G[uid]", hash:"<!--{eval echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])}-->"},
                dataType:'text',
            fileElementId:'filedata',
            success:uploadsuccess,
            error: function() {
            popup.open('{lang uploadpicfailed}', 'alert');
        }
    });

    }
    });

    <!--{if 0 && $_G['setting']['mobile']['geoposition']}-->
    geo.getcurrentposition();
    <!--{/if}-->
    $('#postsubmit').on('click', function() {
        var obj = $(this);
        if(obj.attr('disable') == 'true') {
            return false;
        }

        obj.attr('disable', 'true').removeClass('btn_pn_blue').addClass('btn_pn_grey');
        popup.open('<img src="' + IMGDIR + '/imageloading.gif">');

        var postlocation = '';
        if(geo.errmsg === '' && geo.loc) {
            postlocation = geo.longitude + '|' + geo.latitude + '|' + geo.loc;
        }

        $.ajax({
            type:'POST',
            url:form.attr('action') + '&geoloc=' + postlocation + '&handlekey='+form.attr('id')+'&inajax=1',
            data:form.serialize(),
            dataType:'xml'
        })
            .success(function(s) {
                popup.open(s.lastChild.firstChild.nodeValue);
            })
            .error(function() {
                popup.open('{lang networkerror}', 'alert');
            });
        return false;
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
                popup.open('{lang networkerror}', 'alert');
            });
        return false;
    });

</script>
<!--{template common/footer}-->
