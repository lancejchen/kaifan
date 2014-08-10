<!DOCTYPE html>
<html>
<head time='1406620189'>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="baidu-tc-cerfication" content="5f496895eb9bff9ec4db4512a7e4e95c" />
    <meta name="description" content="鸥翼汇开饭喽微信公众号致力于为用户提供一个约饭及讨论的社区。用户在这个社区中可以发现附近有相同口味的其它吃货，并可以在社区中讨论各种跟吃有关的话题。"/>
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="http://kaifan.oss-cn-hangzhou.aliyuncs.com/cdn/k.ico"/>
    <title>上传照片</title>
    <!--<script src="http://202.189.99.83:8081/target/target-script-min.js#anonymous"></script>-->
    <script type="text/javascript">
        var hostAddr = window.location.host;
        window.g_module = [];
        var STATIC_DOMAIN = location.protocol + "//"+ hostAddr + '/static/js/mobile',
                ARS_TIME = '1406620189',
                IMG_LOADING = 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
        var g_tsBase = new Date(),g_ts = {};
        var PathUtil = {
            getCPath: function() {
                return STATIC_DOMAIN + '/quan/scripts/';
            }
        };
        g_ts.css_start=new Date();
        var pageName = '';
    </script>
    <link rel="stylesheet" href="{STATICURL}image/mobile/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="{STATICURL}css/uploadImg/style.css?"
          onload="g_ts.css_end = new Date();" onerror="g_ts.css_end = new Date();">
    <link rel="stylesheet" href="{STATICURL}css/uploadImg/post.css"  onload="g_ts.css_end = new
     Date();" onerror="g_ts.css_end = new Date();">

    <script src="{STATICURL}js/mobile/jquery-1.8.3.min.js?{VERHASH}"></script>
    <link rel="stylesheet" href="{STATICURL}css/jquery.mobile-1.4.3.min.css" type="text/css"
          media="all">
    <script src="{STATICURL}js/mobile/jquery.mobile-1.4.3.min.js?{VERHASH}"></script>
    <script src="{STATICURL}js/mobile/common.js?{VERHASH}" charset="{CHARSET}"></script>
    <!--debug-->
    <script type="text/javascript">
        var sId = 253851172,
                tId = 0,
                uId = 49716061,
                isNullNick = '0' | false,
                isManager = 1,
                authUrl = '',
                siteLogo = 'http://shp.qlogo.cn/gqclogo/0/253851172/104?max-age=2592000&amp;t=1402732921',
                CSRFToken = "5f457df2",
                debug = '' | false,
                DOMAIN = location.protocol + '//'+ hostAddr + '/',
                _speedMark = new Date(),
                isWX = '' | false,
                isMQ = '' | false,
                isAppBar = '' | false,
                isQQBrowser = '' | false,
                isWeixinLink = '' | false,
                newMsgCount = '',
                isFriendSite = '0',
                enabledSmiley = '1|25';

        window.addEventListener("DOMContentLoaded", function() {g_ts.domready = new Date();});
        window.addEventListener("load", function() {g_ts.domload = new Date();});
        document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
            WeixinJSBridge.call('hideToolbar');
            WeixinJSBridge.call('showOptionMenu');
        });

    </script>
</head>
<body class="pt pb"><div class="warp">
    <div data-role="content">
    <form method="post" action="forum.php?mod=post&action=uploadImg&fid={$_G['fid']}&extra={$extra}&imgtid={$imgtid}&imgpid={$imgpid}&topicsubmit=yes&mobile=2" id="newthread" name="postform">
        <input type="hidden" name="CSRFToken" value="5f457df2">
        <input type="hidden" name="sId" value="253851172">
        <div class="selTagCon" style="padding:5px 15px 0;background:#fafafa;display:none;">
            <span class="tagTopic db" style="width:50px;display:none;"></span>
        </div>
        <div class="sendCon pr" style="display: none;">
            <textarea id="content" name="content" cols="" rows="" class="sInput f13" placeholder="说两句吧.."></textarea>
        </div>
        <div class="photoList" style="display:none;">
            <ul>
                <li class="on" id="addPic">
                    <input type="file" class="on needsclick" style="z-index:200;opacity:0;filter:alpha(opacity=0);-ms-filter:'alpha(opacity=0)';" id="uploadFile" accept="image/*" single>
                </li>
            </ul>
            <p class="textTip f12">还可上传<span id="onlyUploadNum">8</span>张照片呦~</p>
        </div>

        <div class="sendNav">
            <ul>
                <!-- <li><a href="javascript:;" class="iconExpression f21 db c9 cf expreSelect"></a></li> -->
                <li class="pr">
                    <a data-id='1' href="javascript:;" class="operatIcon iconSendImg db f21 c9 cf pr"
                       style="z-index:1;">点我传图哦</a>
                    <input type="file" class="pa" style="height:100%;width:100%;left:0;top:0;z-index:200;opacity:0;filter:alpha(opacity=0);-ms-filter:'alpha(opacity=0)';" id="fistUploadFile" accept="image/*" single>
                </li>
                <!-- <li><a href="javascript:;" class="iconVideo db"></a></li>
                <li><a href="javascript:;" class="iconVideo iconVideoOn db"></a></li>
                <li><a href="javascript:;" class="iconAdd db f21 c9 cf"></a></li> -->
            </ul>
        </div>
        <div data-role="controlgroup" data-type="horizontal">
            <input type="button" data-rel="back" data-direction="reverse" class="ui-icon-back" data-icon="back"
                   value="后退" onclick="javascript:history.go(-1);"/>
            <input type="button" value="取消上传" onclick="javascript: location.reload()" />
            <input type="submit" value="提交" id="submitPhotos"/>
        </div>
    </form>
</div>
<ul data-role="listview">
    <li>微信中传图可能会稍慢，请饭客稍等片刻！</li>
    <li style="white-space:normal;">如果您手机无法传图，请加速下您的手机再行传图! （关闭多余手机app，可用百度手机卫士，猎豹清洁大师等加速工具）</li>
</ul>
<script id="tmpl_customTag" type="text/html">
    <div>
        <% for (var i in labelList) { %>
        <a href="javascript:;" class="f12 filter<%if (filterType == labelList[i].labelId) {%> on<%}%>" labelId="<%=labelList[i].labelId%>"><%=labelList[i].labelName%></a>
        <%}%>
    </div>
</script>

</div>

<script type="text/javascript">
    var isForceReload = '0',
            isLiked = '1';
</script>

<script type="text/javascript" charset="utf-8" src="{STATICURL}js/mobile/quan/scripts/jpegmeta
.js"></script>
<script type="text/javascript" charset="utf-8" src="{STATICURL}js/mobile/quan/scripts/jpeg.encoder.basic.js"></script>
<script type="text/javascript" charset="utf-8" src="{STATICURL}js/mobile/quan/scripts/image_compress
.js?t=1406620189"></script>

<script type="text/javascript">
    var userGender= '0';
    g_module.push('module/newthread');
</script>

<script type="application/javascript">g_ts.body_view = new Date();</script>

<script type="application/javascript">
    var url = '{STATICURL}js/mobile/quan/scripts/seajs-0.1.5.js';
    var node = document.createElement('script');
    node.onload = function(){g_ts.seajs = new Date();};
    node.src = url;document.body.appendChild(node);
    if (window.statConf) {
        setTimeout(function() {
            window.seajs && seajs.use('lib/stat', function(_a) {
                _a.init();
            });
        }, 2000);
    }
</script>

<script type="text/javascript">
    var imgexts = typeof imgexts == 'undefined' ? 'jpg, jpeg, gif, png' : imgexts;
    var STATUSMSG = {
        '-1' : '{lang uploadstatusmsgnag1}',
        '0' : '{lang uploadstatusmsg0}',
        '1' : '{lang uploadstatusmsg1}',
        '2' : '{lang uploadstatusmsg2}',
        '3' : '{lang uploadstatusmsg3}',
        '4' : '{lang uploadstatusmsg4}',
        '5' : '{lang uploadstatusmsg5}',
        '6' : '{lang uploadstatusmsg6}',
        '7' : '{lang uploadstatusmsg7}(' + imgexts + ')',
        '8' : '{lang uploadstatusmsg8}',
        '9' : '{lang uploadstatusmsg9}',
        '10' : '{lang uploadstatusmsg10}',
        '11' : '{lang uploadstatusmsg11}'
    };

    var form = $('#newthread');

    $(document).on('change', '#filedata', function() {
        popup.open('<img src="' + IMGDIR + '/imageloading.gif">');
        uploadsuccess = function(data) {
            if(data == '') {
                popup.open('{lang uploadpicfailed}', 'alert');
            }
            var dataarr = data.split('|');
            if(dataarr[0] == 'DISCUZUPLOAD' && dataarr[2] == 0) {
                popup.close();
                $('#imglist').append('<li><span aid="'+dataarr[3]+'" class="del"><a href="javascript:;"><img src="{STATICURL}image/mobile/images/icon_del.png"></a></span><span class="p_img"><a href="javascript:;"><img style="height:54px;width:54px;" id="aimg_'+dataarr[3]+'" title="'+dataarr[6]+'" src="{$_G[setting][attachurl]}forum/'+dataarr[5]+'" /></a></span><input type="hidden" name="attachnew['+dataarr[3]+'][description]" /></li>');
            } else {
                var sizelimit = '';
                if(dataarr[7] == 'ban') {
                    sizelimit = '{lang uploadpicatttypeban}';
                } else if(dataarr[7] == 'perday') {
                    sizelimit = '{lang donotcross}'+Math.ceil(dataarr[8]/1024)+'K)';
                } else if(dataarr[7] > 0) {
                    sizelimit = '{lang donotcross}'+Math.ceil(dataarr[7]/1024)+'K)';
                }
                popup.open(STATUSMSG[dataarr[2]] + sizelimit, 'alert');
            }
        };

        if(typeof FileReader != 'undefined' && this.files[0]) {//note 支持html5上传新特性

            $.buildfileupload({
                uploadurl:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
                files:this.files,
                uploadformdata:{uid:"$_G[uid]", hash:"<!--{eval echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])}-->"},
                    uploadinputname:'Filedata',
                maxfilesize:"$swfconfig[max]",
                success:uploadsuccess,
                error:function() {
                popup.open('{lang uploadpicfailed}', 'alert');
            }
        });

    } else {

        $.ajaxfileupload({
            url:'misc.php?mod=swfupload&operation=upload&type=image&inajax=yes&infloat=yes&simple=2',
            data:{uid:"$_G[uid]", hash:"<!--{eval echo md5(substr(md5($_G[config][security][authkey]), 8).$_G[uid])}-->"},
                dataType:'text',
            fileElementId:'filedata',
            success:uploadsuccess,
            error: function() {
            popup.open('{lang uploadpicfailed}', 'alert');
        }
    });

    }
    });

    $(document).on('click', '.del', function() {
        var obj = $(this);
        $.ajax({
            type:'GET',
            url:'forum.php?mod=ajax&action=deleteattach&inajax=yes&aids[]=' + obj.attr('aid'),
        })
            .success(function(s) {
                obj.parent().remove();
            })
            .error(function() {
                popup.open('{lang networkerror}', 'alert');
            });
        return false;
    });
    $(document).ready(function(){
        $('#submitPhotos').on('click',function(){

            IMGDIR = '{IMGDIR}';
            popup.open('<img src="' + IMGDIR + '/imageloading.gif">');


            $.ajax({
                type:'POST',
                url:form.attr('action') +'&inajax=1',
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
        })
    });

</script>

</body>
</html>