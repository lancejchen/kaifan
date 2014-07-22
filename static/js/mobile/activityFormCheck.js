/**
 * Created by peterwhyle on 7/12/14.
 */

//TODO: check all necessary elements in the form, alert omitted ones if there is

var actFormSubmit = false;

function checkInput(){
    var msg = "";
    var tmpCheck = true;


    //check subject
    if(!$('.mv_post_dp .mv_post_c #needsubject').val()){
        msg += "别忘了活动标题哦！";
        tmpCheck = false;
        $('.mv_post_dp .mv_post_c #needsubject').focus();
        return msg;
    }

    //check start time
    if(!$('form .mv_post_s #starttimefrom_0').val()){

        msg += "别忘了填写开饭日期哦！";
        tmpCheck = false;
        $('form .mv_post_s #starttimefrom_0').focus();
        return msg;
    }

    var timeCheck = $('form .mv_post_s #kaifan_starttime').val();
    if(!timeCheck){
        msg += "别忘了填写开饭时间哦！";
        tmpCheck = false;
        $('form .mv_post_s #kaifan_starttime').focus();
        return msg;
    } else {
        var splitter = /[:：]/;
        var timePiece = timeCheck.split(splitter,2);
        var hourPiece = parseInt(timePiece[0]);
        var minPiece = parseInt(timePiece[1]);
        if(isNaN(hourPiece) || isNaN(minPiece) || timePiece.length>2 || hourPiece >24 || hourPiece < 0 || minPiece>60 || minPiece <0){
            tmpCheck = false;
            $('form .mv_post_s #kaifan_starttime').focus();
            if(hourPiece >23 || hourPiece < 0){
                return "小时范围在0-23之间。（标准格式如 18:00 ）"
            }
            else if(minPiece>59 || minPiece <0){
                return "分钟在0-59之间。（标准格式如 18:00 ）";
            }
            return "请按照24小时制标准时间格式填写。如: 18:00 ";
        }
    }


    //check address
    if(!$('form .mv_post_s #activityplace').val()){
        msg += "别忘了填写地址哟！";
        tmpCheck = false;
        $('form .mv_post_s #activityplace').focus();
        return msg;
    }

    //check menu
    if(!$('form .mv_post_s #kaifan_menu').val()){
        msg += "别忘了填写菜单哟！";
        tmpCheck = false;
        $('form .mv_post_s #kaifan_menu').focus();
        return msg;
    }

    //check fee
    var feePer = $('form .mv_post_s #cost').val();
    if(!feePer){
        msg += "别忘了填写每人花销哟！";
        tmpCheck = false;
        $('form .mv_post_s #cost').focus();
        return msg;
    }
    else if(isNaN(parseFloat(feePer))||parseFloat(feePer)<0){
        msg += "请在每人花销中填写大于0的纯数字";
        tmpCheck = false;
        $('form .mv_post_s #cost').focus();
        return msg;
    }

    //check 开饭房屋信息
    if(!$('form .mv_post_s #house_info').val()){
        msg += "别忘了选择开饭房屋信息哟！";
        tmpCheck = false;
        $('form .mv_post_s #house_info').focus();
        return msg;
    }

    //check 活动描述
    if(!$('form #needmessage').val()){
        msg += "别忘了填写活动描述哟！";
        tmpCheck = false;
        $('form #needmessage').focus();
        return msg;
    }

    //check 消耗饭团
    var credit = $('form .mv_post_s #activitycredit').val();
    if(!credit){
        msg += "别忘了填写消耗饭团哟！";
        tmpCheck = false;
        $('form .mv_post_s #activitycredit').focus();
        return msg;
    }
    else if(isNaN(parseInt(credit)) || parseInt(credit)<0){
        msg += "请在消耗饭团中填写大于0的纯数字(整数)";
        tmpCheck = false;
        $('form .mv_post_s #activitycredit').focus();
        return msg;
    }

    //check if all check passed
    if(tmpCheck === true){
        actFormSubmit = true;
    }
}

$(document).ready(function(){
    <!--{if 0 && $_G['setting']['mobile']['geoposition']}-->
    geo.getcurrentposition();
    <!--{/if}-->

    //show calendar
    $('#starttimefrom_0').datepicker({minDate: new Date()});

    $('#kaifan_endday').datepicker({minDate: new Date()});

    $endDate = $('#activitytime');
    $endDate.change(function(){
        if(!$endDate.attr("checked")){
            $('#endtime').hide();
        }else if($endDate.attr("checked")){
            $('#endtime').show();
        }
    });


    $('#postsubmit').on('click',function(){
        var formMsg = checkInput();
        if(!actFormSubmit){
            return false;
        }

        actFormSubmit = false;

        popup.open('<img src="' + IMGDIR + '/imageloading.gif">');

        var postlocation = '';
        if(geo.errmsg === '' && geo.loc) {
            postlocation = geo.longitude + '|' + geo.latitude + '|' + geo.loc;
        }

        $.ajax({
            type:'POST',
            url:form.attr('action') + '&geoloc=' + postlocation + '&handlekey='+form.attr('id')+'&inajax=1',
            data:form.serialize(),
            dataType:'xml'
        })
            .success(function(s) {
                popup.open(s.lastChild.firstChild.nodeValue);
            })
            .error(function() {
                popup.open('{lang networkerror}', 'alert');
            });
        return false;
    });
});
