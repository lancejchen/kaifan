<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: extend_thread_activity.php 30673 2012-06-11 07:51:54Z svn_project_zhangjie $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class extend_thread_activity extends extend_thread_base {

	public $activity;
	public $activitytime;



	public function before_newthread($parameters) {
        //continuous event attr
		$this->activitytime = intval($_GET['activitytime']);

        //check form values
        //kaifan start date.
        if(!trim($_GET['activityclass'])) {
            showmessage('activity_sort_please');
        }//attributes in post.php doesn't need to check here, for storing in diff table.
       // elseif(empty($_GET['starttimefrom'][$this->activitytime])) {
		//	showmessage('activity_fromtime_please');
		//}//kaifan time check
        elseif(!trim($_GET['kaifan_starttime'])){
            showmessage('kaifan_starttime_please');
        }//kaifan menu check
        elseif(!trim($_GET['activityplace'])) {
            showmessage('activity_address_please');
        }
        elseif(!trim($_GET['kaifan_menu'])){
            showmessage('kaifanmenu_please');
        }//cost check
        elseif(!trim($_GET['cost'])){
            showmessage('cost_please');
        }//house info check
        elseif(!trim($_GET['house_info'])){
            showmessage('house_info_please');
        }
        elseif(!trim($_GET['activitycredit'])){
            showmessage('credit_please');
        }

		$this->activity = array();
        //censor敏感词控制.
        //db activity type 后台可控制
		$this->activity['class'] = censor(dhtmlspecialchars(trim($_GET['activityclass'])));
        //开饭日期
		$this->activity['starttimefrom'] = trim($_GET['starttimefrom']);
        //开饭时间
        $this->activity['kaifan_starttime'] = trim($_GET['kaifan_starttime']);

        //db make standard time, and stored in db.
        $this->activity['start_datetime']=$this->makeStandardTime($this->activity['starttimefrom'],     $this->activity['kaifan_starttime']);

        //结束时间
        $this->activity['direct_endday'] = !empty($_GET['kaifan_endday'])?trim($_GET['kaifan_endday']):'';
        //db make end day
        $this->activity['kaifan_endday'] = $this->makeEndDay($this->activity['direct_endday']);

        //开饭地址
		$this->activity['place'] = censor(dhtmlspecialchars(trim($_GET['activityplace'])));
        //菜单
        $this->activity['kaifan_menu'] = trim($_GET['kaifan_menu']);
        //主食
        $this->activity['staple'] = trim($_GET['staple']);
        //预计费用
        $this->activity['cost'] = floatval($_GET['cost']);
        //费用解释
        $this->activity['fee_explaination'] = trim($_GET['fee_explaination']);
        //最低成团人数
        $this->activity['min_number'] = intval($_GET['activitynumber']);
        //相约形式
        $this->activity['appointment_style'] = intval($_GET['appointment_style']);
        //我如何做主人
        $this->activity['host_style'] = intval($_GET['host_style']);
        //发起成员人数
        $this->activity['hosts_number'] = intval($_GET['hosts_number']);
        //开饭房屋信息
        $this->activity['house_info'] = intval($_GET['house_info']);
        //房主要求
        $this->activity['host_requists'] = intval($_GET['host_requists']);
        //其它信息
        $this->activity['extra_info'] = intval($_GET['extra_info']);
        //后台控制多余的attr
		$extfield = $_GET['extfield'];
		$extfield = explode("\n", $_GET['extfield']);
		foreach($extfield as $key => $value) {
			$extfield[$key] = censor(trim($value));
			if($extfield[$key] === '' || is_numeric($extfield[$key])) {
				unset($extfield[$key]);
			}
		}
		$extfield = array_unique($extfield);
		if(count($extfield) > $this->setting['activityextnum']) {
			showmessage('post_activity_extfield_toomany', '', array('maxextfield' => $this->setting['activityextnum']));
		}

        //参加者必填资料
		$this->activity['ufield'] = array('userfield' => $_GET['userfield'], 'extfield' => $extfield);
		$this->activity['ufield'] = serialize($this->activity['ufield']);
        //花费积分
		if(intval($_GET['activitycredit']) > 0) {
			$this->activity['credit'] = intval($_GET['activitycredit']);
		}
		$this->param['extramessage'] = "\t".$_GET['activityplace']."\t".$_GET['activitycity']."\t".$_GET['activityclass'];
	}


    public function after_newthread() {
        if($this->group['allowpostactivity']) {
            $data = array('tid' => $this->tid, 'uid' => $this->member['uid'],'class' => $this->activity['class'],'start_datetime'=>$this->activity['start_datetime'],'activitytime'=>$this->activity['activitytime'],'kaifan_endday'=>$this->activity['kaifan_endday'], 'place' => $this->activity['place'],'kaifan_menu'=>$this->activity['kaifan_menu'],'staple'=>$this->activity['staple'],'cost' => $this->activity['cost'], 'fee_explaination'=>$this->activity['fee_explaination'],'min_number' => $this->activity['min_number'],'appointment_style'=>$this->activity['appointment_style'],'host_style'=>$this->activity['host_style'],'hosts_number'=>$this->activity['hosts_number'],'house_info'=>$this->activity['house_info'],'host_requists'=>$this->activity['host_requists'],'extra_info'=>$this->activity['extra_info'],'ufield' => $this->activity['ufield'],'credit' => $this->activity['credit']);

            C::t('forum_activity')->insert($data);
        }
    }

	public function before_feed() {
		$message = !$this->param['price'] && !$this->param['readperm'] ? $this->param['message'] : '';
		$this->feed['icon'] = 'activity';
		$this->feed['title_template'] = 'feed_thread_activity_title';
		$this->feed['body_template'] = 'feed_thread_activity_message';
		$this->feed['body_data'] = array(
			'subject' => "<a href=\"forum.php?mod=viewthread&tid={$this->tid}\">{$this->param['subject']}</a>",
			'starttimefrom' => $_GET['starttimefrom'][$this->activitytime],
			'activityplace'=> $this->activity['place'],
			'message' => messagecutstr($message, 150),
		);
		if($_GET['activityaid']) {
			$this->feed['images'] = array(getforumimg($_GET['activityaid']));
			$this->feed['image_links'] = array("forum.php?mod=viewthread&do=tradeinfo&tid={$this->tid}&pid={$this->pid}");
		}
	}

	public function before_editpost($parameters) {
		$isfirstpost = $this->post['first'] ? 1 : 0;
		if($isfirstpost) {
			if($this->thread['special'] == 4 && $this->group['allowpostactivity']) {
				$activitytime = intval($_GET['activitytime']);
				if(empty($_GET['starttimefrom'][$activitytime])) {
					showmessage('activity_fromtime_please');
				} elseif(strtotime($_GET['starttimefrom'][$activitytime]) === -1 || @strtotime($_GET['starttimefrom'][$activitytime]) === FALSE) {
					showmessage('activity_fromtime_error');
				} elseif($activitytime && ((@strtotime($_GET['starttimefrom']) > @strtotime($_GET['starttimeto']) || !$_GET['starttimeto']))) {
					showmessage('activity_fromtime_error');
				} elseif(!trim($_GET['activityclass'])) {
					showmessage('activity_sort_please');
				} elseif(!trim($_GET['activityplace'])) {
					showmessage('activity_address_please');
				} elseif(trim($_GET['activityexpiration']) && (@strtotime($_GET['activityexpiration']) === -1 || @strtotime($_GET['activityexpiration']) === FALSE)) {
					showmessage('activity_totime_error');
				}

				$activity = array();
				$activity['class'] = censor(dhtmlspecialchars(trim($_GET['activityclass'])));
				$activity['starttimefrom'] = @strtotime($_GET['starttimefrom'][$activitytime]);
				$activity['starttimeto'] = $activitytime ? @strtotime($_GET['starttimeto']) : 0;
				$activity['place'] = censor(dhtmlspecialchars(trim($_GET['activityplace'])));
				$activity['cost'] = intval($_GET['cost']);
				$activity['gender'] = intval($_GET['gender']);
				$activity['min_number'] = intval($_GET['activitynumber']);
				if($_GET['activityexpiration']) {
					$activity['expiration'] = @strtotime($_GET['activityexpiration']);
				} else {
					$activity['expiration'] = 0;
				}
				$extfield = $_GET['extfield'];
				$extfield = explode("\n", $_GET['extfield']);
				foreach($extfield as $key => $value) {
					$extfield[$key] = censor(trim($value));
					if($extfield[$key] === '' || is_numeric($extfield[$key])) {
						unset($extfield[$key]);
					}
				}
				$extfield = array_unique($extfield);
				if(count($extfield) > $this->setting['activityextnum']) {
					showmessage('post_activity_extfield_toomany', '', array('maxextfield' => $this->setting['activityextnum']));
				}
				$activity['ufield'] = array('userfield' => $_GET['userfield'], 'extfield' => $extfield);
				$activity['ufield'] = serialize($activity['ufield']);
				if(intval($_GET['activitycredit']) > 0) {
					$activity['credit'] = intval($_GET['activitycredit']);
				}
				$data = array('cost' => $activity['cost'], 'starttimefrom' => $activity['starttimefrom'], 'starttimeto' => $activity['starttimeto'], 'place' => $activity['place'], 'class' => $activity['class'], 'gender' => $activity['gender'], 'number' => $activity['number'], 'expiration' => $activity['expiration'], 'ufield' => $activity['ufield'], 'credit' => $activity['credit']);
				C::t('forum_activity')->update($this->thread['tid'], $data);

			}
		}


		if($parameters['special'] == 4 && $isfirstpost && $this->group['allowpostactivity']) {
			$activity = C::t('forum_activity')->fetch($this->thread['tid']);
			$activityaid = $activity['aid'];
			if($activityaid && $activityaid != $_GET['activityaid']) {
				$attach = C::t('forum_attachment_n')->fetch('tid:'.$this->thread['tid'], $activityaid);
				C::t('forum_attachment')->delete($activityaid);
				C::t('forum_attachment_n')->delete('tid:'.$this->thread['tid'], $activityaid);
				dunlink($attach);
			}
			if($_GET['activityaid']) {
				$threadimageaid = $_GET['activityaid'];
				convertunusedattach($_GET['activityaid'], $this->thread['tid'], $this->post['pid']);
				C::t('forum_activity')->update($this->thread['tid'], array('aid' => $_GET['activityaid']));
			}
		}
	}

    //basically, it's a data check
    private  function makeStandardTime($ext_date, $ext_time){
        $date=preg_split('/(\/+)|(\/+)/',$ext_date);
        $time=preg_split('/(:+)|(：+)/',$ext_time);
        list($year,$month,$day)=$date;
        list($hour,$min)=$time;
        $storeTime = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
        return $storeTime;
    }

    private  function makeEndDay($endDay){
        //check if it is empty
        if(!empty($endDay)){
            $endDayTmp = preg_split('/(\/+)|(\/+)/',$endDay);
            list($year, $month,$day)=$endDayTmp;
            $storeTime = $year.'-'.$month.'-'.$day;
            return $storeTime;
        }else return '';
    }

}

?>