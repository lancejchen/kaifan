<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');
0
|| checktplrefresh('./template/webshow_mtb0115/touch/forum/forumdisplay.htm', './template/webshow_mtb0115/touch/forum/search_sortoption.htm', 1408677170, 'diy', './data/template/2_diy_touch_forum_forumdisplay.tpl.php', './template/webshow_mtb0115', 'touch/forum/forumdisplay')
;?><?php include template('common/header'); ?><link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" media="all" />
<link rel="stylesheet" type="text/css" href="template/webshow_mtb0115/touch/img/css/forumdisplay_list.css" id="JCSS" media="all" />
<script src="template/webshow_mtb0115/touch/img/js/jquery.cookie.js" type="text/javascript" type="text/javascript"></script> 

<div class="mforum_head">
    <div class="mforum_h_1">
        <?php if(!in_array($_G['fid'],array(36,115,2000))) { ?>
        <div class="mskin">
            <a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_1.css">简</a>
            <?php if($webshow_forumdisplay_txt ==1) { ?><a rel="template/webshow_mtb0115/touch/img/css/forumdisplay_list_simple_2.css">概要</a><?php } ?>
            <?php if($webshow_forumdisplay_pic ==1) { ?><a rel="">视图</a><?php } ?>
        </div>
        <?php } ?>
        <dl class="cl">
            <dt>
            <?php if($_G['forum']['icon']) { ?>
                <img src="data/attachment/common/<?php echo $_G['forum']['icon'];?>" onerror="this.onerror=null;this.src='<?php echo $_G['forum']['icon'];?>'" />
            <?php } else { ?>
                <img src="template/webshow_mtb0115/touch/img/icon_no.png" />
            <?php } ?>
            </dt>
            <dd class="dd1"><?php echo $_G['forum']['name'];?></dd>
            <dd class="dd2">
                <span class="s1">主题<em><?php echo $_G['forum']['threads'];?></em></span>
                <span class="s2">帖子<em><?php echo $_G['forum']['posts'];?></em></span>
            </dd>
            <dd class="dd3">
                <cite><span><?php echo $_G['group']['stars'];?></span><em><?php echo $_G['group']['grouptitle'];?></em></cite>
                <?php $fav=DB::fetch_first("SELECT * FROM  ".DB::table('home_favorite')." WHERE  uid=".$_G[uid]." and `idtype`='fid' and id=".$_G[fid]."");?> 
                <cite><?php if($fav['id']) { ?><a href="javascript:void(0);" class="a1">已关注</a><?php } else { ?><a href="home.php?mod=spacecp&amp;ac=favorite&amp;type=forum&amp;id=<?php echo $_G['fid'];?>" class="a2"><i>+</i>关注</a><?php } ?></cite>         
            </dd>
        </dl>
    </div>
    
    <?php if(!in_array($_G['fid'],array(36,115,2000))) { if($subexists && $_G['page'] == 1 || ($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || count($_G['forum']['threadsorts']['types']) > 0) { ?>
    <div class="mforum_h_2">
        <?php if($subexists && $_G['page'] == 1) { ?>
        <ul class="cl">
            <li class="li_w">子版块</li>
    <?php if(is_array($sublist)) foreach($sublist as $sub) { ?>    <li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $sub['fid'];?>"><?php echo $sub['name'];?></a></li>
    <?php } ?>
</ul>
        <?php } ?>
        <?php if(($_G['forum']['threadtypes'] && $_G['forum']['threadtypes']['listable']) || count($_G['forum']['threadsorts']['types']) > 0) { ?>
        <ul class="cl">
<li id="ttp_all" <?php if(!$_GET['typeid'] && !$_GET['sortid']) { ?>class="a"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php if($_G['forum']['threadsorts']['defaultshow']) { ?>&amp;filter=sortall&amp;sortall=1<?php } if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>">全部</a></li>
<?php if($_G['forum']['threadtypes']) { if(is_array($_G['forum']['threadtypes']['types'])) foreach($_G['forum']['threadtypes']['types'] as $id => $name) { if($_GET['typeid'] == $id) { ?>
<li class="a"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php if($_GET['sortid']) { ?>&amp;filter=sortid&amp;sortid=<?php echo $_GET['sortid'];?><?php } if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?php echo $_G['forum']['threadtypes']['icons'][$id];?>" alt="" /> <?php } ?><?php echo $name;?><?php if($showthreadclasscount['typeid'][$id]) { ?><span class="xg1 num"><?php echo $showthreadclasscount['typeid'][$id];?></span><?php } ?></a></li>
<?php } else { ?>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=typeid&amp;typeid=<?php echo $id;?><?php echo $forumdisplayadd['typeid'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php if($_G['forum']['threadtypes']['icons'][$id] && $_G['forum']['threadtypes']['prefix'] == 2) { ?><img class="vm" src="<?php echo $_G['forum']['threadtypes']['icons'][$id];?>" alt="" /> <?php } ?><?php echo $name;?><?php if($showthreadclasscount['typeid'][$id]) { ?><span class="xg1 num"><?php echo $showthreadclasscount['typeid'][$id];?></span><?php } ?></a></li>
<?php } } } if($_G['forum']['threadsorts']) { if($_G['forum']['threadtypes']) { ?><li><span class="pipe">|</span></li><?php } if(is_array($_G['forum']['threadsorts']['types'])) foreach($_G['forum']['threadsorts']['types'] as $id => $name) { if($_GET['sortid'] == $id) { ?>
<li class="xw1 a"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php if($_GET['typeid']) { ?>&amp;filter=typeid&amp;typeid=<?php echo $_GET['typeid'];?><?php } if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php echo $name;?><?php if($showthreadclasscount['sortid'][$id]) { ?><span class="xg1 num"><?php echo $showthreadclasscount['sortid'][$id];?></span><?php } ?></a></li>
<?php } else { ?>
<li><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $id;?><?php echo $forumdisplayadd['sortid'];?><?php if($_GET['archiveid']) { ?>&amp;archiveid=<?php echo $_GET['archiveid'];?><?php } ?>"><?php echo $name;?><?php if($showthreadclasscount['sortid'][$id]) { ?><span class="xg1 num"><?php echo $showthreadclasscount['sortid'][$id];?></span><?php } ?></a></li>
<?php } } } ?>
         </ul>
        <?php } ?>
        
        
    <?php if($quicksearchlist && !$_GET['archiveid']) { ?>
     <script type="text/javascript">
var forum_optionlist = <?php if($forum_optionlist) { ?>'<?php echo $forum_optionlist;?>'<?php } else { ?>''<?php } ?>;
</script>
<script src="<?php echo $_G['setting']['jspath'];?>threadsort.js?<?php echo VERHASH;?>" type="text/javascript"></script><?php if(is_array($quicksearchlist)) foreach($quicksearchlist as $optionid => $option) { $formsearch = '';?>        <?php if(getstatus($option['search'], 1)) { ?>
        <?php
$__VERHASH = VERHASH;$formsearch = <<<EOF

            <div class="divli cl">
                <span class="s1">{$option['title']}:</span>
                
EOF;
 if(in_array($option['type'], array('radio', 'checkbox', 'select', 'range'))) { 
$formsearch .= <<<EOF

                    <span class="s2" id="select_{$option['identifier']}">
                    
EOF;
 if($option['type'] == 'select') { 
$formsearch .= <<<EOF

                        
EOF;
 if($_GET['searchoption'][$optionid]['value']) { 
$formsearch .= <<<EOF

                            <script type="text/javascript">
                                changeselectthreadsort('{$_GET['searchoption'][$optionid]['value']}', {$optionid}, 'search');
                            </script>
                        
EOF;
 } else { 
$formsearch .= <<<EOF

                            <select name="searchoption[{$optionid}][value]" id="{$option['identifier']}" onchange="changeselectthreadsort(this.value, '{$optionid}', 'search');" class="ps vm">
                                <option value="0">请选择</option>
                            
EOF;
 if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { 
$formsearch .= <<<EOF
                                
EOF;
 if(!$value['foptionid']) { 
$formsearch .= <<<EOF

                                <option value="{$id}">{$value['content']} 
EOF;
 if($value['level'] != 1) { 
$formsearch .= <<<EOF
&raquo;
EOF;
 } 
$formsearch .= <<<EOF
</option>
                                
EOF;
 } 
$formsearch .= <<<EOF

                            
EOF;
 } 
$formsearch .= <<<EOF

                            </select>
<input type="hidden" name="searchoption[{$optionid}][type]" value="{$option['type']}">
                        
EOF;
 } 
$formsearch .= <<<EOF

                    
EOF;
 } elseif($option['type'] != 'checkbox') { 
$formsearch .= <<<EOF

                        <select name="searchoption[{$optionid}][value]" id="{$option['identifier']}" class="ps vm">
                            <option value="0">请选择</option>
                        
EOF;
 if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { 
$formsearch .= <<<EOF
                            <option value="{$id}" 
EOF;
 if($_GET['searchoption'][$optionid]['value'] == $id) { 
$formsearch .= <<<EOF
selected="selected"
EOF;
 } 
$formsearch .= <<<EOF
>{$value}</option>
                        
EOF;
 } 
$formsearch .= <<<EOF

                        </select>
                        <input type="hidden" name="searchoption[{$optionid}][type]" value="{$option['type']}">
                    
EOF;
 } else { 
$formsearch .= <<<EOF

                        
EOF;
 if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { 
$formsearch .= <<<EOF
                            <label><input type="checkbox" class="pc" name="searchoption[{$optionid}][value][{$id}]" value="{$id}" 
EOF;
 if(is_array($_GET['searchoption'][$optionid]) && $_GET['searchoption'][$optionid]['value'][$id]) { 
$formsearch .= <<<EOF
checked="checked"
EOF;
 } 
$formsearch .= <<<EOF
>{$value}</label>
                        
EOF;
 } 
$formsearch .= <<<EOF

                        <input type="hidden" name="searchoption[{$optionid}][type]" value="checkbox">
                    
EOF;
 } 
$formsearch .= <<<EOF

                    </span>
                
EOF;
 } else { 
$formsearch .= <<<EOF

                    
EOF;
 if($option['type'] == 'calendar') { 
$formsearch .= <<<EOF

                        <script src="{$_G['setting']['jspath']}calendar.js?{$__VERHASH}" type="text/javascript"></script>
                        <input type="text" name="searchoption[{$optionid}][value]" size="15" class="px vm" value="
EOF;
 if(is_array($_GET['searchoption'][$optionid])) { 
$formsearch .= <<<EOF
{$_GET['searchoption'][$optionid]['value']}
EOF;
 } 
$formsearch .= <<<EOF
" onclick="showcalendar(event, this, false)" />
                    
EOF;
 } else { 
$formsearch .= <<<EOF

                        <input type="text" name="searchoption[{$optionid}][value]" size="15" class="px vm" value="
EOF;
 if(is_array($_GET['searchoption'][$optionid])) { 
$formsearch .= <<<EOF
{$_GET['searchoption'][$optionid]['value']}
EOF;
 } 
$formsearch .= <<<EOF
" />
                    
EOF;
 } 
$formsearch .= <<<EOF

                
EOF;
 } 
$formsearch .= <<<EOF

            </div>
            
EOF;
?>
<?php } ?>
    <?php $formsearch_html .= $formsearch;?><?php $fontsearch = '';$showoption = array();$tmpcount = 0;?><?php if(getstatus($option['search'], 2)) { ?>
    <?php
$fontsearch = <<<EOF

<tr>
<th width="8%" style="white-space: nowrap">{$option['title']}:</th>
            <td>
                <ul class="cl">
                    <li
EOF;
 if($_GET[''.$option['identifier']] == 'all') { 
$fontsearch .= <<<EOF
 class="a"
EOF;
 } 
$fontsearch .= <<<EOF
><a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}&amp;filter=sortid&amp;sortid={$_GET['sortid']}&amp;searchsort=1{$filterurladd}&amp;{$option['identifier']}=all{$sorturladdarray[$option['identifier']]}" class="xi2">不限</a></li>

EOF;
 if($option['type'] == 'select') { if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { if($value['foptionid'] == 0) { 
$fontsearch .= <<<EOF

<li
EOF;
 if(preg_match('/^'.$value['optionid'].'\./i', $_GET[''.$option['identifier']]) || preg_match('/^'.$value['optionid'].'$/i', $_GET[''.$option['identifier']])) { 
$fontsearch .= <<<EOF
 class="a"
EOF;
 } 
$fontsearch .= <<<EOF
><a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}&amp;filter=sortid&amp;sortid={$_GET['sortid']}&amp;searchsort=1&amp;{$option['identifier']}={$id}{$sorturladdarray[$option['identifier']]}" class="xi2">{$value['content']}</a></li>

EOF;
 } } if(!($_GET[''.$option['identifier']] == 'all' || !isset($_GET[''.$option['identifier']]))) { if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { if((preg_match('/^'.$value['foptionid'].'\./i', $_GET[''.$option['identifier']]) || preg_match('/^'.$value['foptionid'].'$/i', $_GET[''.$option['identifier']])) && ($showoption[$value['count']][$id] = $value)) { } } if(ksort($showoption)) { } if(is_array($showoption)) foreach($showoption as $optioncount => $values) { if($tmpcount != $optioncount && ($tmpcount = $optioncount)) { 
$fontsearch .= <<<EOF

</ul><ul class="subtsm cl">
EOF;
 if(is_array($values)) foreach($values as $id => $value) { 
$fontsearch .= <<<EOF
<li
EOF;
 if(preg_match('/^'.$value['optionid'].'\./i', $_GET[''.$option['identifier']]) || preg_match('/^'.$value['optionid'].'$/i', $_GET[''.$option['identifier']])) { 
$fontsearch .= <<<EOF
 class="a"
EOF;
 } 
$fontsearch .= <<<EOF
><a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}&amp;filter=sortid&amp;sortid={$_GET['sortid']}&amp;searchsort=1&amp;{$option['identifier']}={$id}{$sorturladdarray[$option['identifier']]}" class="xi2">{$value['content']}</a></li>

EOF;
 } 
$fontsearch .= <<<EOF

</ul><ul>

EOF;
 } } } } else { if(is_array($option['choices'])) foreach($option['choices'] as $id => $value) { 
$fontsearch .= <<<EOF
<li
EOF;
 if($_GET[''.$option['identifier']] && !strcmp($id, $_GET[''.$option['identifier']])) { 
$fontsearch .= <<<EOF
 class="a"
EOF;
 } 
$fontsearch .= <<<EOF
><a href="forum.php?mod=forumdisplay&amp;fid={$_G['fid']}&amp;filter=sortid&amp;sortid={$_GET['sortid']}&amp;searchsort=1&amp;{$option['identifier']}={$id}{$sorturladdarray[$option['identifier']]}" class="xi2">{$value}</a></li>

EOF;
 } } 
$fontsearch .= <<<EOF

                </ul>
            </td>
</tr>

EOF;
?>
     <?php } ?>
     <?php $fontsearch_html .= $fontsearch;?><?php } if($formsearch_html || $fontsearch_html) { ?>
<style>
.search_sort { margin:5px 0 0 0; padding:5px 0 0 0; border-top:1px dashed #DDD;}
.search_sort th { white-space: nowrap; text-align:right; }
.search_sort td { padding:0 0 0 5px;}
.search_sort td a { color:#999;}
.divli { padding:0 0 5px 0; height:23px; overflow: hidden;}
.divli span { float:left;}
.divli .s1 { width:60px; overflow:hidden; text-align:right; margin:0 5px 0 0;}
.divli  input { border:1px solid #DDD; background:#FFF;}
</style>
<div class="search_sort">
<?php if($fontsearch_html) { ?>
    <div>
    <table id="fontsearch" class="tsm cl">
         <?php echo $fontsearch_html;?>
    </table>
    </div>
<?php } if($formsearch_html) { ?>
    <form method="post" autocomplete="off" name="searhsort" id="searhsort" class="bbs bm_c pns mfm cl" action="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=sortid&amp;sortid=<?php echo $_GET['sortid'];?>">
        <input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
        <?php echo $formsearch_html;?>
        <div class="cl" style="text-align:right"><button type="submit" class="btn_pn btn_pn_blue" name="searchsortsubmit"><em>搜索</em></button></div>
    </form>
<?php } ?>
</div>
<?php } ?>    <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
</div>

<?php if(!in_array($_G['fid'],array(36,115,2000))) { if(!$subforumonly) { ?>
<div class="mfmlist mfmlist1">
    <ul>
<?php if($livethread) { ?>
    <li class="cl">
        <span class="s1">直播</span>
        <span class="s2">回复<?php echo $livethread['replies'];?></span>
        <a href="forum.php?mod=viewthread&amp;tid=<?php echo $livethread['tid'];?>"><?php echo $livethread['subject'];?></a>
    </li>
<?php } ?>
    <?php if($_G['forum_threadcount']) { ?>
        <?php if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { ?>        <?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
            <?php if(!$_G['setting']['mobile']['mobiledisplayorder3'] && $thread['displayorder'] > 0) { ?>
                <?php continue;?>            <?php } ?>
            <?php if($thread['displayorder'] > 0 && !$displayorder_thread) { ?>
                <?php $displayorder_thread = 1;?>            <?php } ?>
            <?php if($thread['moved']) { ?>
                <?php $thread[tid]=$thread[closed];?>            <?php } ?>
<li class="cl">
            <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>">
                <?php if(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
                    <span class="s1">置顶</span>
                <?php } ?>   
<?php if($thread['digest'] > 0) { ?>
                    <span class="s2">精</span>
                <?php } if($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>
                    <span class="s2">图</span>
                <?php } ?>
                <i><?php echo $thread['subject'];?></i></a>
            </li>
        <?php } ?> 
        <?php } ?>
    <?php } ?>
</ul>
</div>
<?php } } if(!$subforumonly) { ?>
  <?php if(in_array($_G['fid'],array(36,115,2000))) { ?>
  <!--瀑布流-->
  <script src="template/webshow_mtb0115/touch/img/js/jquery.masonry.js" type="text/javascript"></script>
  <div class="wf_wrap">
    <div id="waterfall" class="cl">
    <?php if($_G['forum_threadcount']) { ?>
        <?php if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { ?>        <?php if($thread['attachment']==2) { ?>
        <div class="wf_item">
            <div class="wf_main">
                <div class="wf_pic"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>"><img src="tpic.php?tid=<?php echo $thread['tid'];?>&amp;size=140x0" /></a></div>
                <div class="wf_title"><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>" <?php echo $thread['highlight'];?>><?php echo $thread['subject'];?></a></div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    <?php } ?>
    </div>
  </div>
  <?php if($multipage) { ?><?php echo $multipage;?><?php } ?>
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
  
  <?php } else { ?>
  
  <!--三模式选择--><?php require DISCUZ_ROOT.'template/webshow_mtb0115/touch/img/plus/plus.php';?><div class="mfmlist mfmlist2">
    <ul id="alist">
    <?php if($_G['forum_threadcount']) { ?>
        <?php if(is_array($_G['forum_threadlist'])) foreach($_G['forum_threadlist'] as $key => $thread) { ?>        <?php if(!in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
    <?php if($thread['moved']) { $thread[tid]=$thread[closed];?><?php } ?>
            <li class="li_main">
                <dl class="cl">
                    <dt class="cl">
                        <span class="cl">
                        <a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>" <?php echo $thread['highlight'];?>>
                        <?php if($thread['folder'] == 'lock') { ?>
                            <em>锁定</em>
                        <?php } elseif($thread['special'] == 1) { ?>
                            <em>投票</em>
                        <?php } elseif($thread['special'] == 2) { ?>
                            <em>商品</em>
                        <?php } elseif($thread['special'] == 3) { ?>
                            <em>悬赏</em>
                        <?php } elseif($thread['special'] == 4) { ?>
                            <em>活动</em>
                        <?php } elseif($thread['special'] == 5) { ?>
                            <em>辩论</em>
                        <?php } elseif(in_array($thread['displayorder'], array(1, 2, 3, 4))) { ?>
                            <em>置顶</em>
    <?php } elseif($thread['digest'] > 0) { ?>
        <em>精华</em>
    <?php } elseif($thread['attachment'] == 2 && $_G['setting']['mobile']['mobilesimpletype'] == 0) { ?>             
                        <?php } ?>
                        <i><?php echo $thread['subject'];?></i></a></span>
                        <?php if($webshow_forumdisplay_pic ==1) { ?>
                        <?php $piclist=threadpics($thread[tid],3);?>                        <?php $medialist=mmsgtaglist('media',$thread[message],2);?>                        <?php $flashlist=mmsgtaglist('flash',$thread[message],2);?>                        <?php if($flashlist || $medialist || $piclist) { ?>                                                                 
                        <ul class="cl">
                            <?php if(is_array($piclist)) foreach($piclist as $o) { ?>                                <li><a href="forum.php?mod=viewthread&amp;tid=<?php echo $thread['tid'];?>&amp;extra=<?php echo $extra;?>"><img src="apic.php?aid=<?php echo $o['aid'];?>&amp;size=101x101" /></a></li>
                            <?php } ?>
                            <?php if(is_array($medialist)) foreach($medialist as $media) { ?>                                <?php if(preg_match('/v_(.*)\.swf/',$media,$reg)) { ?>
                                    <li class="li_v"><a href="http://www.56.com/u8/v_<?php echo $reg['1'];?>.html"><em></em><img src="vpic.php?size=101x101&amp;url=<?php echo $media;?>" /></a></li>
                                <?php } elseif(preg_match('/sid\/(.*)\/v.swf/',$media,$reg)) { ?>
                                    <li class="li_v"><a href="http://v.youku.com/v_show/id_<?php echo $reg['1'];?>.html"><em></em><img src="vpic.php?size=101x101&amp;url=<?php echo $media;?>" /></a></li>
                                <?php } else { ?>
                                    <li class="li_v"><a href="<?php echo $media;?>"><em></em><img src="vpic.php?size=101x101&amp;url=<?php echo $media;?>" /></a></li>
                                <?php } ?>
                            <?php } ?>
                            <?php if(is_array($flashlist)) foreach($flashlist as $flash) { ?>                                <?php if(preg_match('/v_(.*)\.swf/',$flash,$reg)) { ?>
                                    <li class="li_v"><a href="http://www.56.com/u8/v_<?php echo $reg['1'];?>.html"><em></em><img src="vpic.php?size=101x101&amp;url=<?php echo $media;?>" /></a></li>
                                <?php } elseif(preg_match('/sid\/(.*)\/v.swf/',$flash,$reg)) { ?>
                                    <li class="li_v"><a href="http://v.youku.com/v_show/id_<?php echo $reg['1'];?>.html"><em></em><img src="vpic.php?size=101x101&amp;url=<?php echo $media;?>" /></a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                        <?php } ?>
                        
                        <?php if($webshow_forumdisplay_txt ==1) { ?>
                        <?php if($thread['message']) { ?><p><?php echo delubb(messagecutstr($thread['message'],70,"..."));; ?></p><?php } ?>
                        <?php } ?>
                    </dt>
                    <?php if($stemplate && $sortid) { ?><div class="dd_sort cl"><?php echo $stemplate[$sortid][$thread['tid']];?></div><?php } ?>
                    <dd class="cl">
                        <span class="s1">
                        <?php if($thread['authorid'] && $thread['author']) { ?><a href="home.php?mod=space&amp;uid=<?php echo $thread['authorid'];?>" target="_blank"><?php echo $thread['author'];?></a><?php } else { ?>匿名<?php } ?><em><?php echo $thread['dateline'];?></em></span><span class="s2"><?php echo $thread['replies'];?></span>
                    </dd>
                </dl>
            </li>
        <?php } ?>
        <?php } ?>
        
        <?php if($_G['forum_threadcount'] > $_G['tpp']) { ?>
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
<?php } ?>
    <?php } else { ?>
<li class="mforum_no">本版块或指定的范围内尚无主题</li>
<?php } ?>
</ul>
</div>
  <?php if($multipage) { ?><div class="mforum_page none"><?php echo $multipage;?></div><?php } ?>
  <?php } } if(!in_array($_G['fid'],array(36,115,2000))) { ?>
<a class="mfresh" href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;filter=<?php echo $filter;?>&amp;orderby=<?php echo $_GET['orderby'];?><?php echo $forumdisplayadd['page'];?>&amp;<?php echo $multipage_archive;?>"></a>
<?php } ?>



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
</script> <?php include template('common/footer'); ?>