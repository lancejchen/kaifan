<?php exit;?>
<!--{template common/header}-->
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" id="JCSS" media="all" />
<script src="template/webshow_mtb0115/touch/img/js/jquery.cookie.js" type="text/javascript"></script> 

<div class="mforum_head">
    <div class="mforum_h_1">
        <!--{if !in_array($_G[fid],array(36,115,2000))}-->
        <div class="mskin">
            <a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_1.css">简</a>
            {if $webshow_forumdisplay_txt ==1}<a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_2.css">概要</a>{/if}
            {if $webshow_forumdisplay_pic ==1}<a rel="">视图</a>{/if}
        </div>
        <!--{/if}-->
        <dl class="cl">
            <dt>
            {if $_G['forum']['icon']}
                <img src="data/attachment/common/$_G['forum']['icon']" onerror="this.onerror=null;this.src='$_G['forum']['icon']'" />
            {else}
                <img src="template/webshow_mtb0115/touch/img/icon_no.png" />
            {/if}
            </dt>
            <dd class="dd1">{$_G['forum']['name']}</dd>
            <dd class="dd2">
                <span class="s1">主题<em>$_G[forum][threads]</em></span>
                <span class="s2">帖子<em>$_G[forum][posts]</em></span>
            </dd>
            <dd class="dd3">
                <cite><span>{$_G[group][stars]}</span><em>{$_G[group][grouptitle]}</em></cite>
                <!--{eval $fav=DB::fetch_first("SELECT * FROM  ".DB::table('home_favorite')." WHERE  uid=".$_G[uid]." and `idtype`='fid' and id=".$_G[fid]."");}--> 
                <cite>{if $fav[id]}<a href="javascript:void(0);" class="a1">已关注</a>{else}<a href="home.php?mod=spacecp&ac=favorite&type=forum&id={$_G[fid]}" class="a2"><i>+</i>关注</a>{/if}</cite>         
            </dd>
        </dl>
    </div>
    
    <!--{if !in_array($_G[fid],array(36,115,2000))}-->
	<!--{if $subexists && $_G['page'] == 1 || ($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || count($_G['forum']['threadsorts']['types']) > 0}-->
    <div class="mforum_h_2">
        <!--{if $subexists && $_G['page'] == 1}-->
        <ul class="cl">
            <li class="li_w">子版块</li>
		    <!--{loop $sublist $sub}-->
		    <li><a href="forum.php?mod=forumdisplay&fid={$sub[fid]}">{$sub['name']}</a></li>
		    <!--{/loop}-->
		</ul>
        <!--{/if}-->
        <!--{if ($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || count($_G['forum']['threadsorts']['types']) > 0}-->
        <ul class="cl">
						<li id="ttp_all" {if !$_GET['typeid'] && !$_GET['sortid']}class="a"{/if}><a href="forum.php?mod=forumdisplay&fid=$_G[fid]{if $_G['forum']['threadsorts']['defaultshow']}&filter=sortall&sortall=1{/if}{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">{lang forum_viewall}</a></li>
						<!--{if $_G['forum']['threadtypes']}-->
							<!--{loop $_G['forum']['threadtypes']['types'] $id $name}-->
								<!--{if $_GET['typeid'] == $id}-->
								<li class="a"><a href="forum.php?mod=forumdisplay&fid=$_G[fid]{if $_GET['sortid']}&filter=sortid&sortid=$_GET['sortid']{/if}{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}"><!--{if $_G[forum][threadtypes][icons][$id] && $_G['forum']['threadtypes']['prefix'] == 2}--><img class="vm" src="$_G[forum][threadtypes][icons][$id]" alt="" /> <!--{/if}-->$name<!--{if $showthreadclasscount[typeid][$id]}--><span class="xg1 num">$showthreadclasscount[typeid][$id]</span><!--{/if}--></a></li>
								<!--{else}-->
								<li><a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=typeid&typeid=$id$forumdisplayadd[typeid]{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}"><!--{if $_G[forum][threadtypes][icons][$id] && $_G['forum']['threadtypes']['prefix'] == 2}--><img class="vm" src="$_G[forum][threadtypes][icons][$id]" alt="" /> <!--{/if}-->$name<!--{if $showthreadclasscount[typeid][$id]}--><span class="xg1 num">$showthreadclasscount[typeid][$id]</span><!--{/if}--></a></li>
								<!--{/if}-->
							<!--{/loop}-->
						<!--{/if}-->
						<!--{if $_G['forum']['threadsorts']}-->
							<!--{if $_G['forum']['threadtypes']}--><li><span class="pipe">|</span></li><!--{/if}-->
							<!--{loop $_G['forum']['threadsorts']['types'] $id $name}-->
								<!--{if $_GET['sortid'] == $id}-->
								<li class="xw1 a"><a href="forum.php?mod=forumdisplay&fid=$_G[fid]{if $_GET['typeid']}&filter=typeid&typeid=$_GET['typeid']{/if}{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">$name<!--{if $showthreadclasscount[sortid][$id]}--><span class="xg1 num">$showthreadclasscount[sortid][$id]</span><!--{/if}--></a></li>
								<!--{else}-->
								<li><a href="forum.php?mod=forumdisplay&fid=$_G[fid]&filter=sortid&sortid=$id$forumdisplayadd[sortid]{if $_GET['archiveid']}&archiveid={$_GET['archiveid']}{/if}">$name<!--{if $showthreadclasscount[sortid][$id]}--><span class="xg1 num">$showthreadclasscount[sortid][$id]</span><!--{/if}--></a></li>
								<!--{/if}-->
							<!--{/loop}-->
						<!--{/if}-->
         </ul>
        <!--{/if}-->
        
        
	    <!--{if $quicksearchlist && !$_GET['archiveid']}-->
		     <!--{subtemplate forum/search_sortoption}-->
	    <!--{/if}-->
    </div>
    <!--{/if}-->
    <!--{/if}-->
</div>

<!--{if !in_array($_G[fid],array(36,115,2000))}-->
<!--{if !$subforumonly}-->
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
            <a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra">
                <!--{if in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
                    <span class="s1">置顶</span>
                <!--{/if}-->   
				<!--{if $thread['digest'] > 0}-->
                    <span class="s2">精</span>
                <!--{/if}-->
				<!--{if $thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0}-->
                    <span class="s2">图</span>
                <!--{/if}-->
                <i>{$thread[subject]}</i></a>
            </li>
        <!--{/if}--> 
        <!--{/loop}-->
    <!--{/if}-->
	</ul>
</div>
<!--{/if}-->
<!--{/if}-->

<!--{if !$subforumonly}-->
  <!--{if in_array($_G[fid],array(36,115,2000))}-->
  <!--瀑布流-->
  <script type="text/javascript" src="template/webshow_mtb0115/touch/img/js/jquery.masonry.js"></script>
  <div class="wf_wrap">
    <div id="waterfall" class="cl">
    <!--{if $_G['forum_threadcount']}-->
        <!--{loop $_G['forum_threadlist'] $key $thread}-->
        <!--{if $thread[attachment]==2}-->
        <div class="wf_item">
            <div class="wf_main">
                <div class="wf_pic"><a href="forum.php?mod=viewthread&tid=$thread[tid]"><img src="tpic.php?tid=$thread[tid]&size=140x0" /></a></div>
                <div class="wf_title"><a href="forum.php?mod=viewthread&tid=$thread[tid]" $thread[highlight]>{$thread[subject]}</a></div>
            </div>
        </div>
        <!--{/if}-->
        <!--{/loop}-->
    <!--{/if}-->
    </div>
  </div>
  {if $multipage}{$multipage}{/if}
<script type="text/javascript">
jQuery(function(){
var jQuerycontainer = jQuery('#waterfall');
jQuerycontainer.imagesLoaded(function(){
jQuerycontainer.masonry({
itemSelector: '.wf_item',
columnWidth: 140,
gutterWidth: 16,
isAnimated: '!Modernizr.csstransitions',
cornerStampSelector: '.category',
isFitWidth: true
});
});
});
</script> 
  
  <!--{else}-->
  
  <!--三模式选择-->
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
                    <!--{if $stemplate && $sortid}--><div class="dd_sort cl">{$stemplate[$sortid][$thread[tid]]}</div><!--{/if}-->
                    <dd class="cl">
                        <span class="s1">
                        <!--{if $thread['authorid'] && $thread['author']}--><a href="home.php?mod=space&uid=$thread[authorid]" target="_blank">$thread[author]</a><!--{else}-->匿名<!--{/if}--><em>$thread[dateline]</em></span><span class="s2">$thread[replies]</span>
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
  {if $multipage}<div class="mforum_page none">{$multipage}</div>{/if}
  <!--{/if}-->
<!--{/if}-->

<!--{if !in_array($_G[fid],array(36,115,2000))}-->
<a class="mfresh" href="forum.php?mod=forumdisplay&fid={$_G[fid]}&filter={$filter}&orderby={$_GET[orderby]}{$forumdisplayadd[page]}&{$multipage_archive}"></a>
<!--{/if}-->



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
<!--{template common/footer}-->
