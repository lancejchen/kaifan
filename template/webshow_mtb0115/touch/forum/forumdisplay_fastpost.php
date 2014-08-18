<?php exit;?>
<div id="post_new"></div>
<div id="btoolbar" class="btoolbar btoolbarv">
    <div class="btool btoolmv cl{if $secqaacheck || $seccodecheck} btoolmv_sec{/if}">
	<form method="post" name="fastpostform" autocomplete="off" id="fastpostform" action="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&extra=$_GET[extra]&replysubmit=yes&mobile=2">
	<input type="hidden" name="formhash" value="{FORMHASH}" />
    <ul>
        <li class="li1"><a href="forum.php?mod=post&action=reply&fid=$_G[fid]&tid=$_G[tid]&reppost=$_G[forum_firstpid]&page=$page"></a></li>
		<li class="li2">
            <textarea value="{lang send_reply_fast_tip}" color="gray" name="message" id="fastpostmessage"></textarea>
        </li>
        <!--{if $secqaacheck || $seccodecheck}-->
        <li class="li3">
            <!--{subtemplate common/seccheck}-->
        </li>
        <!--{/if}-->
        <li class="li4"><input type="button" value="发送" name="replysubmit" id="fastpostsubmit"></li>
	</ul>
    </form>
    </div>
</div>
 
<script type="text/javascript">
$(document).ready(function(){
    $("#fastpostmessage").focus(function(){  
	    $("#btoolbar").removeClass("btoolbarv");
        $("#btoolbar").addClass("btoolbar_v");  
    }).blur(function(){
	    $('#fastpostsubmit').click(function(){
	        $("#btoolbar").addClass("btoolbarv"); 
            $("#btoolbar").removeClass("btoolbar_v"); 
	    });
    })
});
$('.message').click(function(){
   $("#btoolbar").removeClass("btoolbar_v"); 
   $("#btoolbar").addClass("btoolbarv"); 
})
</script>
<script type="text/javascript">
(function() {
		var form = $('#fastpostform');
		<!--{if !$allowpostreply}-->
		$('#fastpostmessage').on('focus', function() {
			<!--{if !$_G[uid]}-->
				popup.open('{lang nologin_tip}', 'confirm', 'member.php?mod=logging&action=login');
			<!--{else}-->
				popup.open('{lang nopostreply}', 'alert');
			<!--{/if}-->
			this.blur();
		});
		<!--{else}-->
		$('#fastpostmessage').on('focus', function() {
			var obj = $(this);
			if(obj.attr('color') == 'gray') {
				obj.attr('value', '');
				obj.removeClass('grey');
				obj.attr('color', 'black');
				$('#fastpostsubmitline').css('display', 'block');
			}
		})
		//.on('blur', function() {
			//var obj = $(this);
			//if(obj.attr('value') == '') {
				//obj.addClass('grey');
				//obj.attr('value', '{lang send_reply_fast_tip}');
				//obj.attr('color', 'gray');
			//}
		//});
		<!--{/if}-->
		$('#fastpostsubmit').on('click', function() {
			var msgobj = $('#fastpostmessage');
			if(msgobj.val() == '{lang send_reply_fast_tip}') {
				msgobj.attr('value', '');
			}
			$.ajax({
				type:'POST',
				url:form.attr('action') + '&handlekey=fastpost&loc=1&inajax=1',
				data:form.serialize(),
				dataType:'xml'
			})
			.success(function(s) {
				evalscript(s.lastChild.firstChild.nodeValue);
			})
			.error(function() {
				window.location.href = obj.attr('href');
				popup.close();
			});
			return false;
		});

		$('#replyid').on('click', function() {
			$(document).scrollTop($(document).height());
			$('#fastpostmessage')[0].focus();
		});

	})();

	function succeedhandle_fastpost(locationhref, message, param) {
		var pid = param['pid'];
		var tid = param['tid'];
		if(pid) {
			$.ajax({
				type:'POST',
				url:'forum.php?mod=viewthread&tid=' + tid + '&viewpid=' + pid + '&mobile=2',
				dataType:'xml'
			})
			.success(function(s) {
				$('#post_new').append(s.lastChild.firstChild.nodeValue);
			})
			.error(function() {
				window.location.href = 'forum.php?mod=viewthread&tid=' + tid;
				popup.close();
			});
		} else {
			if(!message) {
				message = '{lang postreplyneedmod}';
			}
			popup.open(message, 'alert');
		}
		$('#fastpostmessage').attr('value', '');
		if(param['sechash']) {
			$('.seccodeimg').click();
		}
	}

	function errorhandle_fastpost(message, param) {
		popup.open(message, 'alert');
	}
</script>