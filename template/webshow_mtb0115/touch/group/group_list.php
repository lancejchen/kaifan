<?php exit;?>
<div class="mfmlist mfmlist1">
    <ul>
	<!--{if $livethread}-->
    <li class="cl">
        <span class="s1">直播</span>
        <span class="s2">回复$livethread[replies]</span>
        <a href="forum.php?mod=viewthread&tid=$livethread[tid]">$livethread[subject]</a>
    </li>
	<!--{/if}-->
    <!--{if $_G['forum_threadcount']}-->
        <!--{loop $_G['forum_threadlist'] $key $thread}-->
        <!--{if in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
            <!--{if !$_G['setting']['mobile']['mobiledisplayorder3'] && $thread['displayorder'] > 0}-->
                {eval continue;}
            <!--{/if}-->
            <!--{if $thread['displayorder'] > 0 && !$displayorder_thread}-->
                {eval $displayorder_thread = 1;}
            <!--{/if}-->
            <!--{if $thread['moved']}-->
                <!--{eval $thread[tid]=$thread[closed];}-->
            <!--{/if}-->
			<li class="cl">
                <!--{if in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
                    <span class="s1">置顶</span>
                <!--{/if}-->   
				<!--{if $thread['digest'] > 0}-->
                    <span class="s2">精</span>
                <!--{/if}-->
				<!--{if $thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
                    <span class="s2">图</span>
                <!--{/if}-->
                <a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra">{$thread[subject]}</a>
            </li>
        <!--{/if}--> 
        <!--{/loop}-->
    <!--{/if}-->
	</ul>
</div>


<!--{eval require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/plus.php';}-->
<div class="mfmlist mfmlist2">
    <ul id="alist">
    <!--{if $_G['forum_threadcount']}-->
        <!--{loop $_G['forum_threadlist'] $key $thread}-->
        <!--{if !in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
		    <!--{if $thread['moved']}--><!--{eval $thread[tid]=$thread[closed];}--><!--{/if}-->
            <li class="li_main">
                <dl class="cl">
                    <dt class="cl">
                        <span class="cl">
                        <a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra" $thread[highlight]>
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
                        <!--{/if}-->
                        <i>{$thread[subject]}</i></a></span>
                        <!--{if $webshow_forumdisplay_pic ==1}-->
                        <!--{eval $piclist=threadpics($thread[tid],3);}-->
                        <!--{eval $medialist=mmsgtaglist('media',$thread[message],2);}-->
                        <!--{eval $flashlist=mmsgtaglist('flash',$thread[message],2);}-->
                        <!--{if $flashlist || $medialist || $piclist}-->                                                                 
                        <ul class="cl">
                            <!--{loop $piclist $o}-->
                                <li><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra"><img src="apic.php?aid=$o[aid]&size=101x101" /></a></li>
                            <!--{/loop}-->
                            <!--{loop $medialist $media}-->
                                {if preg_match('/v_(.*)\.swf/',$media,$reg)}
                                    <li class="li_v"><a href="http://www.56.com/u8/v_{$reg[1]}.html"><em></em><img src="vpic.php?size=101x101&url={$media}" /></a></li>
                                {elseif preg_match('/sid\/(.*)\/v.swf/',$media,$reg)}
                                    <li class="li_v"><a href="http://v.youku.com/v_show/id_{$reg[1]}.html"><em></em><img src="vpic.php?size=101x101&url={$media}" /></a></li>
                                {else}
                                    <li class="li_v"><a href="{$media}"><em></em><img src="vpic.php?size=101x101&url={$media}" /></a></li>
                                {/if}
                            <!--{/loop}-->
                            <!--{loop $flashlist $flash}-->
                                {if preg_match('/v_(.*)\.swf/',$flash,$reg)}
                                    <li class="li_v"><a href="http://www.56.com/u8/v_{$reg[1]}.html"><em></em><img src="vpic.php?size=101x101&url={$media}" /></a></li>
                                {elseif preg_match('/sid\/(.*)\/v.swf/',$flash,$reg)}
                                    <li class="li_v"><a href="http://v.youku.com/v_show/id_{$reg[1]}.html"><em></em><img src="vpic.php?size=101x101&url={$media}" /></a></li>
                                {/if}
                            <!--{/loop}-->
                        </ul>
                        <!--{/if}-->
                        <!--{/if}-->
                        
                        <!--{if $webshow_forumdisplay_txt ==1}-->
                        {if $thread[message]}<p><!--{echo delubb(messagecutstr($thread[message],70,"..."));}--></p>{/if}
                        <!--{/if}-->
                    </dt>
                    <dd class="cl">
                        <span class="s1">$thread[author]<em>$thread[dateline]</em></span>
                        <span class="s2">$thread[replies]</span>
                    </dd>
                </dl>
            </li>
        <!--{/if}-->
        <!--{/loop}-->

        <!--{if $_G['forum_threadcount'] > $_G['tpp']}-->
        <div id="ajaxshow"></div>
        <div id="a_pg">
            <div id="ajaxld"></div>
            <div id="ajnt"><a href="forum.php?mod=forumdisplay&fid={$_G[fid]}&filter={$filter}&orderby={$_GET[orderby]}{$forumdisplayadd[page]}&{$multipage_archive}" onclick="return ajaxpage(this.href);">点击加载下一页</a></div>
        </div>
		<script src="template/webshow_mtb0115/touch/img/js/ajaxpage.js" type="text/javascript"></script> 
		<script type="text/javascript">
		var pages=$_G['page'];
		var allpage={echo $thispage = ceil($_G['forum_threadcount'] / $_G['tpp']);};
		function ajaxpage(url){
						jq("ajaxld").style.display='block';
						jq("ajnt").style.display='none';
						var x = new Ajax("HTML");
						pages++;
						url=url+'&page='+pages;
						x.get(url, function (s) {
							s = s.replace(/\\n|\\r/g, "");//alert(s);
							s = s.substring(s.indexOf("<ul id=\"alist\""), s.indexOf("<div id=\"ajaxshow\"></div>"));//alert(s);
							jq('ajaxshow').innerHTML+=s;
							jq("ajaxld").style.display='none';
						if(pages==allpage){							
							jq("a_pg").style.display='none';
						}else{
							jq("ajnt").style.display='block';
						}
						});
						return false;
		}
		</script> 
		<!--{/if}-->
    <!--{else}-->
		<li class="mforum_no">{lang forum_nothreads}</li>
	<!--{/if}-->
	</ul>
</div>

<!--{if helper_access::check_module('group')}--><div class="mforum_page none">$multipage</div><!--{/if}-->

<a class="mfresh" href="forum.php?mod=forumdisplay&fid={$_G[fid]}&filter={$filter}&orderby={$_GET[orderby]}{$forumdisplayadd[page]}&{$multipage_archive}"></a>
<script type="text/javascript">
$('.favorite').on('click', function() {
		var obj = $(this);
		$.ajax({
			type:'POST',
			url:obj.attr('href') + '&handlekey=favorite&inajax=1',
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

$(function(){
    var setSkin = function(){
    $('#JCSS').attr('href',$('.mskin a').eq($.cookie('CK_EQ')).attr('rel'));
    $('.mskin a').eq($.cookie('CK_EQ')).addClass('seleted').siblings('a').removeClass('seleted');
    };
    $('.mskin a').click(function(){
    $.cookie('CK_EQ', $(this).index(), {expires:7, path: '/' });
    setSkin();
    });
    setSkin(); 
});
</script>