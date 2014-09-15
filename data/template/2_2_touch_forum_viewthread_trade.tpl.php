<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(count($trades) > 1 || ($_G['uid'] == $_G['forum_thread']['authorid'] || $_G['group']['allowedittrade'])) { ?>
<div class="box">
<em>商品数: <?php echo $tradenum;?></em><br/>
</div>
<?php } ?>

<style>
    .right_border{border-right:2px solid #ACACAC;}

</style>

<?php if($tradenum) { if($trades) { if(is_array($trades)) foreach($trades as $key => $trade) { ?><ul id="trade<?php echo $trade['pid'];?>" data-role="listview" data-inset="true" class="items">
        <li data-role="list-divider"><?php echo $trade['subject'];?></li>

        <!--recommended good-->
        <?php if($trade['displayorder'] > 0) { ?><li><em class="hot">推荐商品</em></li><?php } ?>

        <li>
            <div>
                <?php if($trade['thumb']) { ?>
                <img id="trade_thumb" src="<?php echo $trade['thumb'];?>" width="<?php if($trade['width'] > 90) { ?>90<?php } else { ?><?php echo $trade['width'];?><?php } ?>" _width="90" _height="90" alt="<?php echo $trade['subject'];?>" />
                <?php } else { ?>
                <img id="trade_thumb" src="<?php echo IMGDIR;?>/nophotosmall.gif" width="90" height="90" alt="<?php echo $trade['subject'];?>" />
                <?php } ?>

                <div style="display: inline-block;width: 75%;" >
                    <table id="price_list" style="width:100%;">
                        <tr>
                            <td><strong><?php echo $trade['price'];?></strong>&nbsp;元</td>
                            <td><del><?php echo $trade['costprice'];?> 元</del></td>
                        </tr>
                        <tr>
                            <td>
                                <?php if($trade['ava_now']) { ?>
                                    现在可用
                                <?php } ?>
                                <br/>仅剩:<?php echo $trade['lefts'];?></td>
                            <td><input type="button" height="1" id="pay_it" value="立即抢购"/></td>
                        </tr>
                    </table>
                </div>
            </div>

            <table style="width: 100%;">
                <tr>
                    <td class="right_border">使用时间: </td>
                    <td style="text-align: right;"><?php echo $trade['start_date'];?>日~<?php echo $trade['end_date'];?>日</td>
                </tr>

                <?php if(!empty($trade['time_slots'])) { ?>
                    <?php $even_odd=sizeof($trade['time_slots'])%2?>                    <?php if(is_array($trade['time_slots'])) foreach($trade['time_slots'] as $slot_key => $slot_value) { ?>                        <?php $break=intval($slot_key)%2?>                        <?php if($break===0) { ?>
                            <tr>
                                <td class="right_border"><?php echo $slot_value['start'];?>到<?php echo $slot_value['end'];?></td>
                        <?php } elseif($break===1) { ?>
                                <td style="text-align: right;"><?php echo $slot_value['start'];?>到<?php echo $slot_value['end'];?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <?php if($even_odd===1) { ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>


        </li>
    <?php if(!empty($trade['diff_from_general'])) { ?>
        <li>
            <h4>本单特别细则</h4>
            <p><?php echo $trade['diff_from_general'];?></p>
        </li>
    <?php } ?>
</ul>


<?php } } ?>
<div id="postmessage_<?php echo $post['pid'];?>"><?php echo $post['counterdesc'];?></div>
<?php } else { ?>
<div class="locked">本柜台无商品</div>
<?php } ?>

<ul data-role="listview" data-inset="true" id="need_to_know">
    <li data-role="list-divider">购买须知：</li>
    <!--    shop location & tel-->
    <li id="need_to_know_content">
        <p><?php echo $shop_need_to_know;?></p>
    </li>
</ul>






