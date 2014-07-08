//侧边导航
$('.open-btn').bind('click', function() {
		$('#mcontent, .ttool, .btool').addClass('open');
		$('body').addClass('nvm');
});
$('.float-close').bind('click', function() {
		$('#mcontent, .ttool, .btool').removeClass('open');
		$('body').removeClass('nvm');
});
$(document).ready(function(){
	function ml_close_demo() {
		$('.float-news').animate({
	      	right: '-450px'
	    }, 300, function(){
	      	$('.float-open').delay(50).animate({
	        	//right: '-2px'
	      	}, 300);
	    });
	}
	function ml_open_demo() {
		$('.float-open').animate({
	      	//right: '-70px'
	    }, 100, function(){
	      	$('.float-news').delay(50).animate({
	        	right: '0px'
	      	}, 300);
	    });
	}
	$('.float-close').click(function(){
	    ml_close_demo();
	    return false;
	});
	$('.open-btn').click(function(){
	    ml_open_demo();
	    return false;
	});
	setTimeout(function(){ml_close_demo()},1000);
});
//会员菜单
$(document).ready(function(){
    $(".a_menu").toggle(function(){
		 $("#signin_menu").show('fast');
       },function(){
         $("#signin_menu").hide('slow');
       });
});
//宽度高度等修正
$(function(){  
    var mh1 = $("#mwp").outerHeight(); 
	var mw = $(window).width(); 
	var mh = $(window).height(); 
	var mht = $("#ttoolbar").outerHeight(); //顶部工具条高度，通用
	var mhb = $("#btoolbar").outerHeight(); //底部工具条高度，通用
	var mhnv = $("#side_nv .nv_c").outerHeight()
	var mhtt = mht+0; //顶部工具条高度 修正
	var mhbb = mhb+5;
	var mwscroll = (mw-10)/5
	var mvsmilie = mw-45;
	var wfloading = (mw-150)/2;
 
	$(".cc_home_h .s1 img").css({"width":mw});
	$(".float-news").css({"height":mh});
	$(".t_blank").css({"height":mhtt});
	$(".b_blank").css({"height":mhbb});
	$(".scroll #position em").css({"width":mwscroll});
	//$("#infscr-loading").css({"left":200});
});
//下拉隐藏/显示导航
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
			$('#ttoolbar').fadeIn();
		}else{
            if ($(document).scrollTop() >= 50) {
			    $('#ttoolbar').fadeOut();
	        }else if($(document).scrollTop() < 50){
		        $('#ttoolbar').fadeIn();
            }
		}
	});
});

//底部固定
$(document).ready(function(){
	$(window).scroll(function(){
		if($.browser.msie && $.browser.version=="6.0")$("#btoolbar").css("top",$(window).height()-$("#btoolbar").height()+$(document).scrollTop());
	});
});
//返回底部
$(document).ready(function(){
$('a#scrollToBottom').click(function(){
$('html, body, .content').animate({scrollTop: $(document).height()}, 300);
return false;
});
})
/*
//幻灯
var slider = new Swipe(document.getElementById('slider'), {
      callback: function(e, pos) {
        var i = bullets.length;
        while (i--) {
          bullets[i].className = ' ';
        }
        bullets[pos].className = 'on';

      }
    })
*/
//lance: after change, jquery mobile can be added in
if(document.getElementById('position')){
    bullets = document.getElementById('position').getElementsByTagName('em');
}

function view_a(a) {
    for(var i=1;i<=4;i++){
		document.getElementById('box_a' + i).style.display = 'none';
		document.getElementById('tab_a' + i).className = '';
    }
	    document.getElementById('box_a'+a).style.display='block';
	    document.getElementById('tab_a'+a).className='on';
}	