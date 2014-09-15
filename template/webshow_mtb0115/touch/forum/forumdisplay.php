<?php exit;?>
<!--{template common/header}-->
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" id="JCSS" media="all" />
<script src="template/webshow_mtb0115/touch/img/js/jquery.cookie.js" type="text/javascript"></script>


<!--{if !$subforumonly}-->

<!--{eval require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/plus.php';}-->
<div class="mfmlist mfmlist2">
    <div id="alist">
    <!--{if $_G['forum_threadcount']}-->
        <!--{loop $_G['forum_threadlist'] $key $thread}-->
        <!--{if !in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
		    <!--{if $thread['moved']}--><!--{eval $thread[tid]=$thread[closed];}--><!--{/if}-->

            <!--{eval $link='forum.php?mod=viewthread&tid='.$thread['tid'].'&mobile=2'}-->

        <ul data-role="listview" data-inset="true" class="items">
            <li data-role="list-divider">{$thread['subject']}
                <span class="loc ui-icon-location ui-btn-icon-left" style="position:relative; float:right;
                ">{$thread['distance']}</span>
            </li>
            <!--{eval $trades_count=0;}-->
            <!--{if $thread['trades']}-->
            <!--{loop $thread['trades'] $trades_key $trade}-->
                <!--{if $trades_count<2}-->
                    <li>
                        <div>
                            <a href="{$link}" data-transition="flip">
                                <!--{if $trade['thumb']}-->
                                    <!--{eval $imgSrc=$aliOss.$trade['thumb']}-->
                                <!--{else}-->
                                    <!--{eval $imgSrc=$aliOss.'nophotosmall.gif'}-->
                                <!--{/if}-->
                                    <img id="trade_thumb" src="{$imgSrc}"  width="90" style="float:left;
                                    "height="90"
                                         alt="$trade[subject]" />

                                <div style="display: inline-block;">
                                    <table id="price_list" >
                                        <tr>
                                            <td colspan="2">{$trade['subject']}</td>
                                            <td>
                                                <!--{if $trade['availNow']}-->
                                                即时可用
                                                <!--{/if}-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{$trade['price']}</td>
                                            <td><del>{$trade['costprice']}</del></td>
                                            <td>
                                            <!--{eval $lefts=0;$lefts=$trade['amount']-$trade['totalitems'];}-->
                                                仅剩{$lefts}个
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>使用时间</td>
                                            <td colspan="2" style="text-align: right;">
                                                {$trade['start_date']}至{$trade['end_date']}
                                            </td>
                                        </tr>
                                        <tr style="font-size:small;">
                                            <!--{loop $trade['periods'] $period_index $period}-->
                                                <!--{eval $start_time=His2Hi($period['start_time']);$end_time=His2Hi($period['end_time'])}-->
                                                <!--{if $period_index<1}-->
                                                    <td class="right_border">
                                                        {$start_time}到{$end_time}
                                                    </td>
                                                <!--{elseif $period_index<2}-->
                                                    <td style="text-align: right;">
                                                        {$start_time}到{$end_time}
                                                    </td>
                                                <!--{elseif $period_index<3}-->
                                                    <td style="text-align: right;">
                                                         更多
                                                    </td>
                                                <!--{/if}-->
                                            <!--{/loop}-->
                                        </tr>
                                    </table>
                                </div>
                            </a>
                        </div>
                    </li>
                    <!--{eval $trades_count++;}-->
                <!--{elseif $trades_count===2}-->
                    <li>
                        <a href="{$link}">
                            <h2>
                                <!--{eval $left_trade = sizeof($thread['trades'])-3}-->
                                还有{$left_trade}个优惠，点击查看{$thread['subject']}所有优惠。
                            </h2>
                        </a>
                    </li>
                <!--{eval $trades_count++;}-->
                <!--{/if}-->
            <!--{/loop}-->
            <!--{/if}-->
        </ul>



        <!--{/if}-->
        <!--{/loop}-->

        <!--{if $_G['forum_threadcount'] > $_G['tpp']}-->
        <!--add a count function, if display is less than 10, then no refresh -->
        <!--{eval $threadCount=sizeof($_G['forum_threadcount'])}-->
        <!--{if $threadCount>=10}-->
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
							s = s.substring(s.indexOf("<div id=\"alist\""), s.indexOf("<div id=\"ajaxshow\"></div>"));//alert(s);
							jq('ajaxshow').innerHTML+=s;
							jq("ajaxld").style.display='none';
//                                $("#real").page();
                            $('#ajaxshow ul').listview().listview('refresh');
						if(pages==allpage){
							jq("a_pg").style.display='none';
						}else{
							jq("ajnt").style.display='block';
						}
						});

						return false;
		}
		</script>
        <script src="template/webshow_mtb0115/touch/img/js/test.js" type="text/javascript"></script>
		<!--{/if}-->
        <!--{/if}-->
    <!--{else}-->
		<li class="mforum_no">{lang forum_nothreads}</li>
	</div>

  {if $multipage}<div class="mforum_page none">{$multipage}</div>{/if}
  <!--{/if}-->
</div>
<!--{/if}-->



<!--{if !in_array($_G[fid],array(36,115,2000))}-->
<a class="mfresh" href="forum.php?mod=forumdisplay&fid={$_G[fid]}&filter={$filter}&orderby={$_GET[orderby]}{$forumdisplayadd[page]}&{$multipage_archive}"></a>
<!--{/if}-->

</div>

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
