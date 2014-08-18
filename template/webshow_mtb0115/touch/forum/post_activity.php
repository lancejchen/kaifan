<?php exit;?>

    <!--开饭日期-->
    <div class="spmf cl" id="certainstarttime" data-role="fieldcontainer">
    <label for="starttimefrom_0">{lang kaifan_startday}<span class="rq">*</span></label>
    <input type="text" name="starttimefrom" id="starttimefrom_0" class="px" value="$activity[starttimefrom]" tabindex="1" readonly/>
    </div>

    <!--开饭时间-->
    <div id="kaifan_starttimeBlk" date-role="fieldcontainer">
        <label for="kaifan_starttime">{lang kaifan_starttime}
        <span class="rq">*{lang kaifan_timeformat}</span>
        </label>
        <input type="text" name="kaifan_starttime" id="kaifan_starttime"/>
    </div>

    <!--continuous? -->
    <div class="spmf cl" data-role="fieldcontainer">
        <label for="activitytime">{lang continuous_event}</label>
        <input type="checkbox" id="activitytime" name="activitytime" class="pc"  value="1"  />
    </div>

    <!--结束时间-->
<div class="spmf cl" id="endtime" data-role="fieldcontainer" style="display: none" >
    <label for="kaifan_endday">{lang kaifan_endday}</label>
    <input type="text" name="kaifan_endday" id="kaifan_endday" readonly/>
</div>

<!--
    <div data-role="fieldcontainer">
    <div id="uncertainstarttime"  {if !$activity['starttimeto']}style="display: none"{/if}>
    <label for="starttimefrom_1">{lang kaifan_endtime}</label>
    <input type="date" name="starttimefrom[1]" id="starttimefrom_1" class="px" autocomplete="off" value="$activity[starttimefrom]" tabindex="1" />
    <span> ~ </span>
    <input type="date" autocomplete="off" id="starttimeto" name="starttimeto" class="px" value="{if $activity['starttimeto']}$activity[starttimeto]{/if}" tabindex="1" />
    </div>
    </div>
-->
<!--开饭地址-->
<div data-role="fieldcontainer">
    <label for="activityplace">{lang activity_space}
        <span class="rq">*(请放心填写您的详细地址确保参加者能找到您，详细地址只有在您同意对方加入这次约饭时才会显示给对方)</span></label>
    <input type="text" name="activityplace" id="activityplace" class="px oinf" value="$activity[place]" tabindex="1" />
</div>

<!--菜单-->
<div data-role="fieldcontainer">
    <label for="kaifan_menu">菜单
        <span class="rq">*</span>
    </label>
    <textarea id="kaifan_menu" name="kaifan_menu"></textarea>
</div>

<!--主食-->
<div data-role="fieldcontainer">
    <label for=“staple”>主食</label>
    <input type="text" name="staple" id="staple" />
</div>
<!--
<button value="点我" onclick="javascript: window.history.back();"></button>
-->
<!--预计费用-->
<div data-role="fieldcontainer">
    <label for="cost">{lang activity_payment} <span class="rq">*</span>
       <span> (请填写数字。注意有的参加者可能饭量比较大，类似要求请在费用解释中申明)</span></label>
    <input type="text" name="cost" id="cost" class="px" value="$activity[cost]" tabindex="1" />
</div>

<!--费用解释-->
<div data-role="fieldcontainer">
    <label for="fee_explaination">费用解释
    </label>
    <textarea id="fee_explaination" name="fee_explaination"></textarea>
</div>

<!--最低成团人数-->
<div data-role="fieldcontainer">
    <label for="activitynumber">最低成团人数
    </label>
    <input type="text" name="activitynumber" id="activitynumber" />
</div>


<!--相约形式-->
<div data-role="fieldcontainer">
    <label for="appointment_style">相约形式</label>
    <select id="appointment_style" name="appointment_style">
        <option value="1">我提供拼饭场地（参加者分工劳动）</option>
        <option value="2">我服务客人（客人不用做饭劳动）</option>
        <option value="3">其它，请在“其它信息”中标注</option>
    </select>
</div>
<!--我如何做主人-->
    <div data-role="fieldcontainer">
        <label for="host_style">我如何做主人</label>
        <select id="host_style" name="host_style">
            <option value="1">我跟客人同桌吃饭</option>
            <option value="2">我给客人提供快餐类盒饭</option>
            <option value="3">我不与客人同桌吃饭，我给客人们提供一桌拼桌的饭菜</option>
            <option value="4">其它，请在“其它信息”中标注</option>
        </select>
    </div>

<!--发起成员人数-->
    <div data-role="fieldcontainer">
        <label for="hosts_number">发起成员人数</label>
        <select id="hosts_number" name="hosts_number">
            <option value="1">我自己</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">大于3人</option>
        </select>
    </div>

<!--开饭房屋信息-->
    <div data-role="fieldcontainer">
        <label for="house_info">开饭房屋信息（可多选）<span class="rq">*</span></label>
        <select id="house_info" name="house_info" multiple>
            <option value="1">小区房</option>
            <option value="2">商住两用房</option>
            <option value="3">平房</option>
            <option value="4">有电梯</option>
            <option value="5">有空调</option>
            <option value="6">有wifi</option>
        </select>
    </div>

<!--房主要求-->
    <div data-role="fieldcontainer">
        <label for="host_requists">房主要求（可多选）</label>
        <select id="host_requists" name="host_requists" multiple>
            <option value="1">请不要带宠物</option>
            <option value="2">请不要带10岁以下小朋友</option>
            <option value="3">室内请勿吸烟</option>
            <option value="4">请勿饮酒</option>
        </select>
    </div>

<!--额外信息-->
    <div data-role="fieldcontainer">
        <label for="extra_info">其它信息
        </label>
        <textarea id="extra_info" name="extra_info"></textarea>
    </div>

<!--参加者必填资料-->
    <!--{if $_G['setting']['activityfield']}-->
    <div data-role="fieldcontainer">
    <legend>{lang optional_data} </legend>
        <div data-role="controlgroup" data-type="horizontal">
        <!--{loop $_G['setting']['activityfield'] $key $val}-->
       <label for="userfield_$key">$val</label>
        <input type="checkbox" name="userfield[]" id="userfield_$key" class="pc" value="$key" {if $activity['ufield']['userfield'] && in_array($key, $activity['ufield']['userfield'])} checked="checked"{/if} />
    <!--{/loop}-->
        </div>
    </div>
    <!--{/if}-->

<!--消耗饭团-->
<div data-role="fieldcontainer">
    <label for="activitycredit">消耗饭团<span class="rq">*</span>
        <span> 当前剩余饭团数为： 。。。。。 (请填写整数)</span></label>
    <input type="text" name="activitycredit" id="activitycredit"/>
</div>


<script type="text/javascript" reload="1">

    function activityaid_upload(aid, url) {
        $('activityaid_url').value = url;
        updateactivityattach(aid, url, '{$_G['setting']['attachurl']}forum');
    }
    function validator(){

    }

    /* Chinese initialisation for the jQuery UI date picker plugin. */
    /* Written by Ressol (ressol@gmail.com). */
    (function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define([ "../jquery.ui.datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }(function( datepicker ) {
        datepicker.regional['zh-CN'] = {
            closeText: '关闭',
            prevText: '&#x3C;上月',
            nextText: '下月&#x3E;',
            currentText: '今天',
            monthNames: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
            monthNamesShort: ['一月','二月','三月','四月','五月','六月',
                '七月','八月','九月','十月','十一月','十二月'],
            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
            dayNamesMin: ['日','一','二','三','四','五','六'],
            weekHeader: '周',
            dateFormat: 'yy/mm/dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: '年'};
        datepicker.setDefaults(datepicker.regional['zh-CN']);

        return datepicker.regional['zh-CN'];

    }));





</script>