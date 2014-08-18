<?php exit;?>
<script type="text/javascript">
$().ready(function(){
$(".m_txt").html("群组创建");
});
</script>
<style>#main_messaqge .cc_home_c th { width:60px!important;} #main_messaqge .cc_home_c .td input { width:150px!important;}</style>
<div id="main_messaqge">
    <h2 class="h2_t">
        {lang group_create_new}
        <!--{if $_G['setting']['groupmod']}--><span>{lang group_create_mod}</span><!--{/if}-->
    </h2>

	<p style="margin:0 10px; color:#FF7777;">{lang group_you_have}</p>

	<div class="cc_home_c">
		<form method="post" autocomplete="off" name="groupform" id="groupform" class="s_clear" onsubmit="checkCategory();ajaxpost('groupform', 'returnmessage4', 'returnmessage4', 'onerror');return false;" action="forum.php?mod=group&action=create">
			<input type="hidden" name="formhash" value="{FORMHASH}" />
			<input type="hidden" name="referer" value="{echo dreferer()}" />
			<input type="hidden" name="handlekey" value="creategroup" />
			<table cellspacing="0" cellpadding="0" width="100%">
				<tbody>
					<tr>
						<th><strong class="rq y">*</strong>{lang group_name}:</th>
						<td class="td">
							<input type="text" name="name" id="name" class="px" size="36" tabindex="1" value="" autocomplete="off" onBlur="checkgroupname()" tabindex="1" />
						</td>
					</tr>
					<tr>
						<th><strong class="rq y">*</strong>{lang group_category}:</th>
						<td>
							<select name="parentid" tabindex="2" class="ps" onchange="ajaxget('forum.php?mod=ajax&action=secondgroup&fupid='+ this.value, 'secondgroup');">
								<option value="0">{lang choose_please}</option>
								$groupselect[first]
							</select>
                            <em id="secondgroup"></em>
						</td>
					</tr>
					<tr>
						<th>{lang group_description}:</th>
						<td><textarea id="descriptionmessage" name="descriptionnew" tabindex="3" class="pt" rows="3"></textarea></td>
					</tr>
					<tr>
						<th><strong class="rq y">*</strong>{lang group_perm_visit}:</th>
						<td>
							<label class="lb"><input type="radio" name="gviewperm" class="pr" tabindex="4" value="1" checked="checked" />{lang group_perm_all_user}</label>
							<label class="lb"><input type="radio" name="gviewperm" class="pr" value="0" />{lang group_perm_member_only}</label>
						</td>
					</tr>
					<tr>
						<th><strong class="rq y">*</strong>{lang group_join_type}:</th>
						<td>
							<label class="lb"><input type="radio" name="jointype" class="pr" tabindex="5" value="0" checked="checked" />{lang group_join_type_free}</label>
							<label class="lb"><input type="radio" name="jointype" class="pr" value="2" />{lang group_join_type_moderate}</label>
							<label class="lb"><input type="radio" name="jointype" class="pr" value="1" />{lang group_join_type_invite}</label>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="hidden" name="createsubmit" value="true"><button type="submit" class="mbutton" tabindex="6"><strong>{lang create}</strong></button>
							<!--{if $_G['group']['buildgroupcredits']}-->&nbsp;&nbsp;&nbsp;(<strong class="rq">{lang group_create_buildcredits} $_G['group']['buildgroupcredits'] $_G['setting']['extcredits'][$creditstransextra]['unit']{$_G['setting']['extcredits'][$creditstransextra]['title']}</strong>)<!--{/if}-->
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
