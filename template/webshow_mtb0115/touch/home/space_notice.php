<?php exit;?>
<!--{eval $_G['home_tpl_titles'] = array('{lang remind}');}-->
<!--{template common/header}-->
<style>body, #mwp, #mcontent { background:#FFF!important;}</style>
<script type="text/javascript">
$().ready(function(){
$(".m_txt").html("提醒中心");
});
</script>

<div class="tx_menu">
	<ul class="cl">
		<!--{loop $_G['notice_structure'] $key $type}-->
		<li id="notice_$key" $opactives[$key]><em class="notice_$key"></em><a href="home.php?mod=space&do=notice&view=$key"><!--{eval echo lang('template', 'notice_'.$key)}--><!--{if $_G['member']['category_num'][$key]}-->($_G['member']['category_num'][$key])<!--{/if}--></a></li>
		<!--{/loop}-->
	</ul>
</div>

<!--{if $_G['notice_structure'][$view] && ($view == 'mypost' || $view == 'interactive')}-->
<div class="tx_nav cl">
    <ul class="cl">
        <!--{loop $_G['notice_structure'][$view] $subtype}-->
        <li$readtag[$subtype]><a href="home.php?mod=space&do=notice&view=$view&type=$subtype"><!--{eval echo lang('template', 'notice_'.$view.'_'.$subtype)}--><!--{if $_G['member']['newprompt_num'][$subtype]}-->($_G['member']['newprompt_num'][$subtype])<!--{/if}--></a></li>
        <!--{/loop}-->
    </ul>
</div>
<!--{else}-->
<div class="tx_nav cl">
    <ul class="cl">
        <li class="a"><a href="home.php?mod=space&do=notice&view=$view"><!--{eval echo lang('template', 'notice_'.$view)}--></a></li>
    </ul>
</div>
<!--{/if}-->

<!--{if $view=='userapp'}-->
<!--{else}-->
<div class="tx_main cl">
			<!--{if empty($list)}-->
			<div class="note_none">
				<!--{if $new == 1}-->
					{lang no_new_notice}<a href="home.php?mod=space&do=notice&isread=1">{lang view_old_notice}</a>
				<!--{else}-->
					{lang no_notice}
				<!--{/if}-->
			</div>
			<!--{/if}-->
			<script type="text/javascript">
				function deleteQueryNotice(uid, type) {
					var dlObj = $(type + '_' + uid);
					if(dlObj != null) {
						var id = dlObj.getAttribute('notice');
						var x = new Ajax();
						x.get('home.php?mod=misc&ac=ajax&op=delnotice&inajax=1&id='+id, function(s){
							dlObj.parentNode.removeChild(dlObj);
						});
					}
				}
				function errorhandle_pokeignore(msg, values) {
					deleteQueryNotice(values['uid'], 'pokeQuery');
				}
			</script>

			<!--{if $list}-->
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
                <!--{loop $list $key $value}-->
                <tr>
                    <th>
                        <div class="cl {if $key==1}bw0{/if}" $value[rowid] notice="$value[id]">
                            <!--{if $value[authorid]}-->
                            <a href="home.php?mod=space&uid=$value[authorid]"><!--{avatar($value[authorid],small)}--></a>
                            <!--{else}-->
                            <img src="{IMGDIR}/systempm.png" alt="systempm" />
                            <!--{/if}-->
                        </div>
                    </th>
                    <td>
                        <div class="s1">
                            <span class="xg1 xw0"><!--{date($value[dateline], 'u')}--></span>
                        </div>
						<div class="dd2" style="$value[style]">{$value[note]}</div>
                        <!--{if $value[from_num]}-->
						<div class="dd3">{lang ignore_same_notice_message}</div>
						<!--{/if}-->
                    </td>
                </tr>
                <!--{/loop}-->
            </table>
            <!--{if $multi}--><div class="cl">{$multi}</div><!--{/if}-->
			<!--{/if}-->
</div>
<!--{/if}-->
<!--{template common/footer}-->