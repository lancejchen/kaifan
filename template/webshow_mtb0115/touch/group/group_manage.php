<?php exit;?>
<script type="text/javascript">
$().ready(function(){
$(".m_txt").html("群组管理");
});
</script>
<div class="tx_nav" style="margin:-10px 10px 0 0;">
    <ul class="cl">
	    <li{if $_GET['op'] == 'group'} class="a"{/if}><a href="forum.php?mod=group&action=manage&op=group&fid=$_G[fid]">设置</a>
<!--{if !empty($groupmanagers[$_G[uid]]) || $_G['adminid'] == 1}-->
	    <li{if $_GET['op'] == 'checkuser'} class="a"{/if}><a href="forum.php?mod=group&action=manage&op=checkuser&fid=$_G[fid]">审核</a>
        <li{if $_GET['op'] == 'manageuser'} class="a"{/if}><a href="forum.php?mod=group&action=manage&op=manageuser&fid=$_G[fid]">管理</a>
<!--{/if}-->
<!--{if $_G['forum']['founderuid'] == $_G['uid'] || $_G['adminid'] == 1}-->
        <li{if $_GET['op'] == 'threadtype'} class="a"{/if}><a href="forum.php?mod=group&action=manage&op=threadtype&fid=$_G[fid]">分类</a>
        <li{if $_GET['op'] == 'demise'} class="a"{/if}><a href="forum.php?mod=group&action=manage&op=demise&fid=$_G[fid]">转让</a>
<!--{/if}-->
    </ul>
</div>

<style>
.cc_group_c th { width:60px!important;}
</style>
<!--{if $_GET['op'] == 'group'}-->
<div class="cc_home_c cc_group_c">
    <form enctype="multipart/form-data" action="forum.php?mod=group&action=manage&op=group&fid=$_G[fid]" name="manage" method="post" autocomplete="off">
    <input type="hidden" value="{FORMHASH}" name="formhash" />
    <table cellspacing="0" cellpadding="0" width="100%" summary="{lang group_admin_panel}">
				<tbody>
					<!--{if !empty($specialswitch['allowchangename']) && ($_G['uid'] == $_G['forum']['founderuid'] || $_G['adminid'] == 1)}-->
					<tr>
						<th><span class="rq">*</span>{lang group_name}:</th>
						<td><input type="text" id="name" name="name" tabindex="1" value="$_G[forum][name]" autocomplete="off" tabindex="1" /></td>
					</tr>
					<!--{/if}-->
					<!--{if !empty($specialswitch['allowchangetype']) && ($_G['uid'] == $_G['forum']['founderuid'] || $_G['adminid'] == 1)}-->
					<tr>
						<th><span class="rq">*</span>{lang group_category}:</th>
						<td>
							<select name="parentid" tabindex="2" class="ps" onchange="ajaxget('forum.php?mod=ajax&action=secondgroup&fupid='+ this.value, 'secondgroup');">
								$groupselect[first]
							</select>
							<em id="secondgroup"><!--{if $groupselect['second']}--><select id="fup" name="fup" class="ps" >$groupselect[second]</select><!--{/if}--></em>
						</td>
					</tr>
					<!--{/if}-->
					<tr>
						<th>{lang group_description}</th>
						<td><textarea id="descriptionmessage" name="descriptionnew">$_G[forum][descriptionnew]</textarea></td>
					</tr>
					<tr>
						<th>{lang group_perm_visit}</th>
						<td>
							<label class="lb"><input type="radio" name="gviewpermnew" class="pr" value="1" $gviewpermselect[1] />{lang group_perm_all_user}</label>
							<label class="lb"><input type="radio" name="gviewpermnew" class="pr" value="0" $gviewpermselect[0] />{lang group_perm_member_only}</label>
						</td>
					</tr>
					<tr>
						<th>{lang group_join_type}</th>
						<td>
							<label class="lb"><input type="radio" name="jointypenew" class="pr" value="0" $jointypeselect[0] />{lang group_join_type_free}</label>
							<label class="lb"><input type="radio" name="jointypenew" class="pr" value="2" $jointypeselect[2] />{lang group_join_type_moderate}</label>
							<label class="lb"><input type="radio" name="jointypenew" class="pr" value="1" $jointypeselect[1] />{lang group_join_type_invite}</label>
							<!--{if !empty($specialswitch['allowclosegroup'])}-->
							<label class="lb"><input type="radio" name="jointypenew" class="pr" value="-1" $jointypeselect[-1] />{lang close}</label>
							<p class="d">{lang group_close_notice}</p>
							<!--{/if}-->
						</td>
					</tr>
					<!--{if $_G['setting']['allowgroupdomain'] && !empty($_G['setting']['domain']['root']['group']) && $domainlength}-->
					<tr>
						<th>{lang subdomain}</th>
						<td>
							http://<input type="text" name="domain" value="$_G[forum][domain]" />.{$_G['setting']['domain']['root']['group']}
							<p class="d">
								{lang group_domain_message}<br/>
								<!--{if $_G[forum][domain] && $consume}-->{lang group_edit_domain_message}<!--{/if}-->
							</p>
						</td>
					</tr>
					<!--{/if}-->
				
					<tr>
						<th>{lang group_icon}</th>
						<td class="td_input_none">
							<input type="file" id="iconnew" name="iconnew" />
							<p class="d">
								{lang group_icon_resize} &nbsp;
								<!--{if $_G[setting][group_imgsizelimit]}-->
									{lang group_image_filesize_limit}
								<!--{/if}--></p>
							<!--{if $_G['forum']['icon']}-->
								<img width="48" height="48" alt="" class="vm" style="margin-right: 1em;" src="$_G[forum][icon]?{TIMESTAMP}" />
							<!--{/if}-->
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><button type="submit" name="groupmanage" class="mbutton" value="1"><strong>{lang submit}</strong></button></td>
					</tr>
				</tbody>
    </table>
    </form>
</div>
<!--{elseif $_GET['op'] == 'checkuser'}-->
	<!--{if $checkusers}-->
	    <h2 class="h2_t">
            <a href="forum.php?mod=group&action=manage&op=checkuser&fid=$_G[fid]&checkall=2">{lang ignore_all}</a>
            <a>|</a>
		    <a href="forum.php?mod=group&action=manage&op=checkuser&fid=$_G[fid]&checkall=1">{lang pass_all}</a>
        </h2>
    
        <div class="doing_list">
        <ul>
        <!--{loop $checkusers $uid $user}-->
        <li>
	    <dl class="cl">
        <dt><!--{echo avatar($user[uid], 'small')}--></dt>
		    <dd class="dd1"><a href="home.php?mod=space&uid=$user[uid]">$user[username]</a> <span class="xw0">($user['joindateline'])</span></dd>
            <dd class="dd2"><button type="submit" name="checkusertrue" class="pn pnc" value="true" onclick="location.href='forum.php?mod=group&action=manage&op=checkuser&fid=$_G[fid]&uid=$user[uid]&checktype=1'"><em>{lang pass}</em></button> &nbsp; <button type="submit" name="checkuserfalse" class="pn" value="true" onclick="location.href='forum.php?mod=group&action=manage&op=checkuser&fid=$_G[fid]&uid=$user[uid]&checktype=2'"><em>{lang ignore}</em></button></dd>
        </dl>
        </li>
        <!--{/loop}-->
        </ul>
        </div>

		<!--{if $multipage}--><div class="pgs cl mtm">$multipage</div><!--{/if}-->
	<!--{else}-->
		<div class="note_none">{lang group_no_member_moderated}</div>
	<!--{/if}-->
<!--{elseif $_GET['op'] == 'manageuser'}-->
	<script type="text/javascript">
		function groupManageUser(targetlevel_val) {
			getElem('targetlevel').value = targetlevel_val;
			getElem('manageuser').submit();
		}
	</script>
	<!--{if $_G['forum']['membernum'] > 50}-->
	<div class="cl" style="margin:0 10px 10px 10px;">
		<form action="forum.php?mod=group&action=manage&op=manageuser&fid=$_G[fid]" method="post">
		<input type="text" {if empty($_GET['srchuser'])}onclick="$('groupsearch').value=''"{/if} value="{if $_GET['srchuser']}$_GET[srchuser]{else}{lang enter_member_user}{/if}" size="15" class="minput" id="groupsearch" name="srchuser">&nbsp;
		<button class="mbutton25" type="submit"><span>{lang search}</span></button>
		</form>
	</div>
	<!--{/if}-->
	<form action="forum.php?mod=group&action=manage&op=manageuser&fid=$_G[fid]&manageuser=true" name="manageuser" id="manageuser" method="post" autocomplete="off" class="ptm">
		<input type="hidden" value="{FORMHASH}" name="formhash" />
        <input type="hidden" value="0" name="targetlevel" id="targetlevel" />
		<!--{if $adminuserlist}-->
			<h2 class="h2_t">{lang group_admin_member}</h2>
			<div class="gmlist gmlist_admin">
			    <ul class="cl">
						<!--{loop $adminuserlist $user}-->
						<li>
							<a href="home.php?mod=space&uid=$user[uid]" title="{if $user['level'] == 1}{lang group_moderator_title}{elseif $user['level'] == 2}{lang group_moderator_vice_title}{/if}{if $user['online']} {lang login_normal_mode}{/if}" class="avt">
								<!--{if $user['level'] == 1}-->
									<em class="gm"></em>
								<!--{elseif $user['level'] == 2}-->
									<em class="gm" style="filter: alpha(opacity=50); opacity: 0.5"></em>
								<!--{/if}-->
								<!--{if $user['online']}-->
									<em class="gol"></em>
								<!--{/if}-->
								<!--{echo avatar($user[uid], 'small')}-->
							</a>
							<p><a href="home.php?mod=space&uid=$user[uid]">$user[username]</a></p>
							<p><!--{if $_G['adminid'] == 1 || ($_G['uid'] != $user['uid'] && ($_G['uid'] == $_G['forum']['founderuid'] || $user['level'] > $groupuser['level']))}--><input type="checkbox" class="pc" name="muid[{$user[uid]}]" value="$user[level]" /><!--{/if}--></p>
						</li>
						<!--{/loop}-->
			    </ul>
			</div>
		<!--{/if}-->
		<!--{if $staruserlist || $userlist}-->
			<h2 class="h2_t">{lang member}</h2>
			<!--{if $staruserlist}-->
			<div class="gmlist gmlist_admin">
                <ul class="cl">
						<!--{loop $staruserlist $user}-->
						<li>
							<a href="home.php?mod=space&uid=$user[uid]" title="{lang group_star_member_title}{if $user['online']} {lang login_normal_mode}{/if}" class="avt">
								<em class="gs"></em>
								<!--{if $user['online']}-->
									<em class="gol"{if $user['level'] <= 3} style="margin-top: 15px;"{/if}></em>
								<!--{/if}-->
								<!--{echo avatar($user[uid], 'small')}-->
							</a>
							<p><a href="home.php?mod=space&uid=$user[uid]">$user[username]</a></p>
							<p><!--{if $_G['adminid'] == 1 || $user['level'] > $groupuser['level']}--><input type="checkbox" class="pc" name="muid[{$user[uid]}]" value="$user[level]" /><!--{/if}--></p>
						</li>
						<!--{/loop}-->
                </ul>
            </div>
            <!--{/if}-->
			<!--{if $userlist}-->
			<div class="gmlist gmlist_admin">
                <ul class="cl">
						<!--{loop $userlist $user}-->
						<li>
							<a href="home.php?mod=space&uid=$user[uid]" class="avt"><!--{echo avatar($user[uid], 'small')}--></a>
							<p><a href="home.php?mod=space&uid=$user[uid]">$user[username]</a></p>
							<p><!--{if $_G['adminid'] == 1 || $user['level'] > $groupuser['level']}--><input type="checkbox" class="pc" name="muid[{$user[uid]}]" value="$user[level]" /><!--{/if}--></p>
						</li>
						<!--{/loop}-->
                </ul>
            </div>
            <!--{/if}-->
		<!--{/if}-->
		<!--{if $multipage}--><div class="cl">$multipage</div><!--{/if}-->
		<div class="cl" style="margin:0 10px;">
			<!--{loop $mtype $key $name}-->
            	<!--{if $_G['forum']['founderuid'] == $_G['uid'] || $key > $groupuser['level'] || $_G['adminid'] == 1}-->
                <button type="button" name="manageuser" value="true" style="margin:0 0 3px 0;" onclick="groupManageUser('{$key}')"><span>$name</span></button>
                <!--{/if}-->
            <!--{/loop}-->
		</div>
	</form>
<!--{elseif $_GET['op'] == 'threadtype'}-->
		<!--{if empty($specialswitch['allowthreadtype'])}-->
			{lang group_level_cannot_do}
		<!--{else}-->
		<script type="text/JavaScript">
			var rowtypedata = [
				[
					[1,'<input type="checkbox" class="pc" disabled="disabled" />', ''],
					[1,'<input type="checkbox" class="pc" name="newenable[]" checked="checked" value="1" />', ''],
					[1,'<input class="px" type="text" size="2" name="newdisplayorder[]" value="0" />'],
					[1,'<input class="px" type="text" name="newname[]" />']
				],
			];
			var addrowdirect = 0;
			var typenumlimit = $typenumlimit;
			function addrow(obj, type) {
				var table = obj.parentNode.parentNode.parentNode.parentNode;
				if(typenumlimit <= obj.parentNode.parentNode.parentNode.rowIndex - 1) {
					alert('{lang group_threadtype_limit_1}'+typenumlimit+'{lang group_threadtype_limit_2}');
					return false;
				}
				if(!addrowdirect) {
					var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex);
				} else {
					var row = table.insertRow(obj.parentNode.parentNode.parentNode.rowIndex + 1);
				}

				var typedata = rowtypedata[type];
				for(var i = 0; i <= typedata.length - 1; i++) {
					var cell = row.insertCell(i);
					cell.colSpan = typedata[i][0];
					var tmp = typedata[i][1];
					if(typedata[i][2]) {
						cell.className = typedata[i][2];
					}
					tmp = tmp.replace(/\{(\d+)\}/g, function($1, $2) {return addrow.arguments[parseInt($2) + 1];});
					cell.innerHTML = tmp;
				}
				addrowdirect = 0;
			}
		</script>
        
		<div id="threadtypes">
			<form id="threadtypeform" action="forum.php?mod=group&action=manage&op=threadtype&fid=$_G[fid]" autocomplete="off" method="post" name="threadtypeform">
				<input type="hidden" value="{FORMHASH}" name="formhash" />
                <div class="cc_home_c cc_group_c">
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th>启用</th>
						<td>
							<label class="lb"><input type="radio" name="threadtypesnew[status]" class="pr" value="1" onclick="$('threadtypes_config').style.display = '';$('threadtypes_manage').style.display = '';" $checkeds[status][1] />{lang yes}</label>
							<label class="lb"><input type="radio" name="threadtypesnew[status]" class="pr" value="0" onclick="$('threadtypes_config').style.display = 'none';$('threadtypes_manage').style.display = 'none';"  $checkeds[status][0] />{lang no}</label>
							<p class="d">{lang threadtype_turn_on_comment}</p>
						</td>
					</tr>
					<tbody id="threadtypes_config" style="display: $display">
						<tr>
							<th>必须归类</th>
							<td>
								<label class="lb"><input type="radio" name="threadtypesnew[required]" class="pr" value="1" $checkeds[required][1] />{lang yes}</label>
								<label class="lb"><input type="radio" name="threadtypesnew[required]" class="pr" value="0" $checkeds[required][0] />{lang no}</label>
								<p class="d">{lang threadtype_required_force}</p>
							</td>
						</tr>
						<tr>
							<th>{lang threadtype_prefix}</th>
							<td>
								<label class="lb"><input type="radio" name="threadtypesnew[prefix]" class="pr" value="0" $checkeds[prefix][0] />{lang threadtype_prefix_off}</label>
								<label class="lb"><input type="radio" name="threadtypesnew[prefix]" class="pr" value="1" $checkeds[prefix][1] />{lang threadtype_prefix_on}</label>
								<p class="d">{lang threadtype_prefix_comment}</p>
							</td>
						</tr>
					</tbody>
				</table>
                </div>
                
                
				<div id="threadtypes_manage" style="display: $display">
                    <h2 class="h2_t">主题分类设置</h2>
                    <div class="cc_group_type_c">
					<table cellspacing="0" cellpadding="0" width="100%">
						<thead>
							<tr>
								<th width="25">{lang delete}</th>
								<th>{lang enable}</th>
								<th>{lang displayorder}</th>
								<th>{lang threadtype_name}</th>
							</tr>
						</thead>
						<!--{if $threadtypes}-->
							<!--{loop $threadtypes $val}-->
							<tbody>
								<tr>
									<td><input type="checkbox" class="pc" name="threadtypesnew[options][delete][]" value="{$val[typeid]}" /></td>
									<td><input type="checkbox" class="pc" name="threadtypesnew[options][enable][{$val[typeid]}]" value="1" class="pc" $val[enablechecked] /></td>
									<td><input type="text" name="threadtypesnew[options][displayorder][{$val[typeid]}]" class="px" size="2" value="$val[displayorder]" /></td>
									<td><input type="text" name="threadtypesnew[options][name][{$val[typeid]}]" class="px" value="$val[name]" /></td>
								</tr>
							</tbody>
							<!--{/loop}-->
						<!--{/if}-->
						<tr>
							<td colspan="4"><img class="vm" src="{IMGDIR}/addicn.gif" /> <a href="javascript:;" onclick="addrow(this, 0)">{lang threadtype_add}</a></td>
						</tr>
					</table>
                    </div>
				</div>
                <p style="text-align:center;">
				    <button type="submit" class="mbutton" name="groupthreadtype" value="1">{lang submit}</button>
                </p>
			</form>
		</div>
		<!--{/if}-->
	</div>
<!--{elseif $_GET['op'] == 'demise'}-->
		<!--{if $groupmanagers}-->
        <div class="mg_zr">
            <div class="mg_zr_tip">
		        {lang group_demise_comment}
                {lang group_demise_notice}
            </div>

			<form action="forum.php?mod=group&action=manage&op=demise&fid=$_G[fid]" name="groupdemise" method="post" class="exfm">
				<input type="hidden" value="{FORMHASH}" name="formhash" />
                <h2 class="h2_t">{lang transfer_group_to}</h2>
                <div class="gmlist gmlist_admin">
				    <ul class="cl">
								<!--{loop $groupmanagers $user}-->
								<li>
									<a href="home.php?mod=space&uid=$user[uid]" title="{if $user['level'] == 1}{lang group_moderator}{elseif $user['level'] == 2}{lang group_moderator_vice}{/if}{if $user['online']} {lang login_normal_mode}{/if}" class="avt">
										<!--{echo avatar($user[uid], 'small')}-->
									</a>
									<p><a href="home.php?mod=space&uid=$user[uid]">$user[username]</a></p>
									<p><!--{if $user['uid'] != $_G['uid']}--><input type="radio" class="pr" name="suid" value="$user[uid]" /><!--{/if}--></p>
								</li>
								<!--{/loop}-->
				    </ul>
					<p>{lang group_input_password}</p>
					<p><input type="password" name="grouppwd" class="minput" /></p>
					<p style="margin:8px 0 0 0;"><button type="submit" name="groupdemise" class="mbutton" value="1">{lang submit}</button></p>
			</form>
        </div>
		<!--{else}-->
			<div class="note_none">{lang group_no_admin_member}</div>
		<!--{/if}-->

<!--{/if}-->