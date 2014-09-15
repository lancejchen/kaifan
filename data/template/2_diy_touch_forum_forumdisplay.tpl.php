<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" id="JCSS" media="all" />
<script src="template/webshow_mtb0115/touch/img/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script>


<?php if(!$subforumonly) { require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/plus.php';?><div class="mfmlist mfmlist2">
    <div id="alist">
    <?php if($_G['forum_threadcount']) { ?>
        <?php if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { ?>        <?php if(!in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
    <?php if($thread['moved']) { $thread[tid]=$thread[closed];?><?php } ?>

            <?php $link='forum.php?mod=viewthread&tid='.$thread['tid'].'&mobile=2'?>        <ul data-role="listview" data-inset="true" class="items">
            <li data-role="list-divider"><?php echo $thread['subject'];?>
                <span class="loc ui-icon-location ui-btn-icon-left" style="position:relative; float:right;
                "><?php echo $thread['distance'];?></span>
            </li>
            <?php $trades_count=0;?>            <?php if($thread['trades']) { ?>
            <?php if(is_array($thread['trades'])) foreach($thread['trades'] as $trades_key => $trade) { ?>                <?php if($trades_count<2) { ?>
                    <li>
                        <div>
                            <a href="<?php echo $link;?>" data-transition="flip">
                                <?php if($trade['thumb']) { ?>
                                    <?php $imgSrc=$aliOss.$trade['thumb']?>                                <?php } else { ?>
                                    <?php $imgSrc=$aliOss.'nophotosmall.gif'?>                                <?php } ?>
                                    <img id="trade_thumb" src="<?php echo $imgSrc;?>"  width="90" style="float:left;
                                    "height="90"
                                         alt="<?php echo $trade['subject'];?>" />

                                <div style="display: inline-block;">
                                    <table id="price_list" >
                                        <tr>
                                            <td colspan="2"><?php echo $trade['subject'];?></td>
                                            <td>
                                                <?php if($trade['availNow']) { ?>
                                                即时可用
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $trade['price'];?></td>
                                            <td><del><?php echo $trade['costprice'];?></del></td>
                                            <td>
                                            <?php $lefts=0;$lefts=$trade['amount']-$trade['totalitems'];?>                                                仅剩<?php echo $lefts;?>个
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>使用时间</td>
                                            <td colspan="2" style="text-align: right;">
                                                <?php echo $trade['start_date'];?>至<?php echo $trade['end_date'];?>
                                            </td>
                                        </tr>
                                        <tr style="font-size:small;">
                                            <?php if(is_array($trade['periods'])) foreach($trade['periods'] as $period_index => $period) { ?>                                                <?php $start_time=His2Hi($period['start_time']);$end_time=His2Hi($period['end_time'])?>                                                <?php if($period_index<1) { ?>
                                                    <td class="right_border">
                                                        <?php echo $start_time;?>到<?php echo $end_time;?>
                                                    </td>
                                                <?php } elseif($period_index<2) { ?>
                                                    <td style="text-align: right;">
                                                        <?php echo $start_time;?>到<?php echo $end_time;?>
                                                    </td>
                                                <?php } elseif($period_index<3) { ?>
                                                    <td style="text-align: right;">
                                                         更多
                                                    </td>
                                                <?php } ?>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </div>
                            </a>
                        </div>
                    </li>
                    <?php $trades_count++;?>                <?php } elseif($trades_count===2) { ?>
                    <li>
                        <a href="<?php echo $link;?>">
                            <h2>
                                <?php $left_trade = sizeof($thread['trades'])-3?>                                还有<?php echo $left_trade;?>个优惠，点击查看<?php echo $thread['subject'];?>所有优惠。
                            </h2>
                        </a>
                    </li>
                <?php $trades_count++;?>                <?php } ?>
            <?php } ?>
            <?php } ?>
        </ul>



        <?php } ?>
        <?php } ?>

        <?php if($_G['forum_threadcount'] > $_G['tpp']) { ?>
        <!--add a count function, if display is less than 10, then no refresh -->
        <?php $threadCount=sizeof($_G['forum_threadcount'])?>        <?php if($threadCount>=10) { ?>
        <div id="ajaxshow"></div>
        <div id="a_pg">
            <div id="ajaxld"></div>
            <div id="ajnt"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=<?php echo $filter;?>&amp;orderby=<?php echo $_GET['orderby'];?><?php echo $forumdisplayadd['page'];?>&amp;<?php echo $multipage_archive;?>" onclick="return ajaxpage(this.href);">点击加载下一页</a></div>
        </div>


<script src="template/webshow_mtb0115/touch/img/js/ajaxpage.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
var pages=<?php echo $_G['page'];?>;
var allpage=<?php echo $thispage = ceil($_G['forum_threadcount'] / $_G['tpp']);; ?>;

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
        <script src="template/webshow_mtb0115/touch/img/js/test.js" type="text/javascript" type="text/javascript"></script>
<?php } ?>
        <?php } ?>
    <?php } else { ?>
<li class="mforum_no">本版块或指定的范围内尚无主题</li>
</div>

  <?php if($multipage) { ?><div class="mforum_page none"><?php echo $multipage;?></div><?php } ?>
  <?php } ?>
</div>
<?php } if(!in_array($_G['fid'],array(36,115,2000))) { ?>
<a class="mfresh" href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=<?php echo $filter;?>&amp;orderby=<?php echo $_GET['orderby'];?><?php echo $forumdisplayadd['page'];?>&amp;<?php echo $multipage_archive;?>"></a>
<?php } ?>

</div>

<script type="text/javascript">
$('.favorite').on('click', function() {
var obj = $(this);
$.ajax({
type:'POST',
url:obj.attr('href') + '&handlekey=favorite&inajax=1',
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
</script><?php include template('common/footer'); ?>