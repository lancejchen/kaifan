<?php
/**
 * Created by PhpStorm.
 * User: peterwhyle
 * Date: 9/5/14
 * Time: 11:32 AM
 */
$aliOss=$_G['config']['aliyun']['oss_pre'];
if(!empty($threadids)){

//retrieve trades bases on tid\
    $trades_by_tid=array();
    $thread_location=array();
    foreach($threadids as $num=>$t_id){
        //get its location
        $thread_location[$t_id]=C::t('forum_post_location')->fetch_by_tid($t_id);

        //beauty distance, if over 1km, then display km or display m
        $distance = intval($_G['forum_threadlist'][$num]['distance']);
        if($distance<1){
            $distance= round($distance*1000).'米';
        }elseif($distance<10){
            $distance= round($distance,1).'公里';
        }else{
            $distance=round($distance).'公里';
        }

        $_G['forum_threadlist'][$num]['distance'] = $distance;


        $_G['forum_threadlist'][$num]['location']=C::t('forum_post_location')->fetch_by_tid($t_id);


        //get its trades
        $thread_trades[$t_id]=C::t('forum_trade')->fetch_all_thread_goods($t_id);
        $_G['forum_threadlist'][$num]['trades']=C::t('forum_trade')->fetch_all_thread_goods($t_id);

        //in the trade, need the thumbnail.


        //get the trade periods, it is based on pid.
        foreach($_G['forum_threadlist'][$num]['trades'] as $trade_index=>$trade_content){
            $trade_pid=$trade_content['pid'];
            $get_time_slots = C::t('forum_trade_period')->fetch_by_pid($trade_pid);
            $_G['forum_threadlist'][$num]['trades'][$trade_index]['periods']= $get_time_slots;

            //get available status
            $startDate=$trade_content['start_date'];
            $endDate=$trade_content['expiration'];
            $_G['forum_threadlist'][$num]['trades'][$trade_index]['availNow']=availableNow($get_time_slots,
                $startDate,$endDate);

            //in the trade, need the thumbnail.
            $aid=$trade_content['aid'];
            if(!empty($aid)){
                $table_id=C::t('forum_attachment')->fetch_by_aid($aid);
                if(!empty($table_id['tableid'])){
                    $img_content=C::t('forum_attachment_n')->fetch($table_id['tableid'],$aid);
                    if(!empty($img_content['thumb'])){
                        $_G['forum_threadlist'][$num]['trades'][$trade_index]['thumb']=$img_content['thumb'];
                    }elseif(!empty($img_content['attachment'])){
                        $_G['forum_threadlist'][$num]['trades'][$trade_index]['thumb']=$img_content['attachment'];
                    }
                }
            }

            $start_date1=intval($trade_content['start_date']);
            if(!empty($start_date1)){
                if(date('y')===date('y',$start_date1)){
                    $_G['forum_threadlist'][$num]['trades'][$trade_index]['start_date']=date('m-d',$start_date1);
                }else{
                    $_G['forum_threadlist'][$num]['trades'][$trade_index]['start_date']=date('y-m-d',$start_date1);
                }
            }else{
                $_G['forum_threadlist'][$num]['trades'][$trade_index]['start_date']='今日';
            }


            $end_date1=intval($trade_content['expiration']);
            if(!empty($end_date1)){
                if(date('y')===date('y',$end_date1)){
                    $_G['forum_threadlist'][$num]['trades'][$trade_index]['end_date']=date('m-d',$end_date1);
                }else{
                    $_G['forum_threadlist'][$num]['trades'][$trade_index]['end_date']=date('y-m-d',$end_date1);
                }
            }else{
                $_G['forum_threadlist'][$num]['trades'][$trade_index]['end_date']='';
            }

        }

    }
}
