<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forum_upload.php 32858 2013-03-15 03:36:22Z zhangjie $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class forum_upload_uri {

    var $uid;
    var $aid;
    var $simple;
    var $statusid;
    var $attach;
    var $error_sizelimit;
    var $getaid;
    var $width;

    function forum_upload_uri($getaid = 0) {
        global $_G;
        $this->uid = $_G['uid'];
        $this->aid = 0;
        $this->getaid = $getaid;
        $this->simple = !empty($_GET['simple']) ? $_GET['simple'] : 0;

        $upload = new discuz_upload();
        $upload->initUri($_POST['pic'], 'forum');
        $this->attach = &$upload->attach;

        if($upload->error()) {
            return $this->uploadmsg(2);
        }

        $allowupload = !$_G['group']['maxattachnum'] || $_G['group']['maxattachnum'] && $_G['group']['maxattachnum'] > getuserprofile('todayattachs');;
        if(!$allowupload) {
            return $this->uploadmsg(6);
        }

        if($_G['group']['attachextensions'] && (!preg_match("/(^|\s|,)".preg_quote($upload->attach['ext'], '/')."($|\s|,)/i", $_G['group']['attachextensions']) || !$upload->attach['ext'])) {
            return $this->uploadmsg(1);
        }

        if(empty($upload->attach['size'])) {
            return $this->uploadmsg(2);
        }

        if($_G['group']['maxattachsize'] && $upload->attach['size'] > $_G['group']['maxattachsize']) {
            $this->error_sizelimit = $_G['group']['maxattachsize'];
            return $this->uploadmsg(3);
        }

        loadcache('attachtype');
        if($_G['fid'] && isset($_G['cache']['attachtype'][$_G['fid']][$upload->attach['ext']])) {
            $maxsize = $_G['cache']['attachtype'][$_G['fid']][$upload->attach['ext']];
        } elseif(isset($_G['cache']['attachtype'][0][$upload->attach['ext']])) {
            $maxsize = $_G['cache']['attachtype'][0][$upload->attach['ext']];
        }
        if(isset($maxsize)) {
            if(!$maxsize) {
                $this->error_sizelimit = 'ban';
                return $this->uploadmsg(4);
            } elseif($upload->attach['size'] > $maxsize) {
                $this->error_sizelimit = $maxsize;
                return $this->uploadmsg(5);
            }
        }

        if($upload->attach['size'] && $_G['group']['maxsizeperday']) {
            $todaysize = getuserprofile('todayattachsize') + $upload->attach['size'];
            if($todaysize >= $_G['group']['maxsizeperday']) {
                $this->error_sizelimit = 'perday|'.$_G['group']['maxsizeperday'];
                return $this->uploadmsg(11);
            }
        }
        updatemembercount($_G['uid'], array('todayattachs' => 1, 'todayattachsize' => $upload->attach['size']));
        $upload->saveUriData();
        if($upload->error() == -103) {
            return $this->uploadmsg(8);
        } elseif($upload->error()) {
            return $this->uploadmsg(9);
        }
        $thumb = $remote = $width = 0;
        if($_GET['type'] == 'image' && !$upload->attach['isimage']) {
            return $this->uploadmsg(7);
        }
        if($upload->attach['isimage']) {

            if($_G['setting']['showexif']) {
                require_once libfile('function/attachment');
                $exif = getattachexif(0, $upload->attach['target']);
            }
            if($_G['setting']['thumbsource'] || $_G['setting']['thumbstatus']) {
                require_once libfile('class/image');
                $image = new image;
            }
            if($_G['setting']['thumbsource'] && $_G['setting']['sourcewidth'] && $_G['setting']['sourceheight']) {
                $thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['sourcewidth'], $_G['setting']['sourceheight'], 1, 1) ? 1 : 0;
                $width = $image->imginfo['width'];
                $upload->attach['size'] = $image->imginfo['size'];
            }
            if($_G['setting']['thumbstatus']) {
                $thumb = $image->Thumb($upload->attach['target'], '', $_G['setting']['thumbwidth'], $_G['setting']['thumbheight'], $_G['setting']['thumbstatus'], 0) ? 1 : 0;
                $width = $image->imginfo['width'];
            }
            if($_G['setting']['thumbsource'] || !$_G['setting']['thumbstatus']) {
                list($width) = @getimagesize($upload->attach['target']);
            }
        }
        if($_GET['type'] != 'image' && $upload->attach['isimage']) {
            $upload->attach['isimage'] = -1;
        }
        $this->aid = $aid = getattachnewaid($this->uid);
        $insert = array(
            'aid' => $aid,
            'dateline' => $_G['timestamp'],
            'filename' => dhtmlspecialchars(censor($upload->attach['name'])),
            'filesize' => $upload->attach['size'],
            'attachment' => $upload->attach['attachment'],
            'isimage' => $upload->attach['isimage'],
            'uid' => $this->uid,
            'thumb' => $thumb,
            'remote' => $remote,
            'width' => $width,
        );
        $this->width = $width;
        //lance: need to be changed into used
        C::t('forum_attachment_unused')->insert($insert);
        if($upload->attach['isimage'] && $_G['setting']['showexif']) {
            C::t('forum_attachment_exif')->insert($aid, $exif);
        }

        return $this->uploadmsg(0);
    }

    function uploadmsg($statusid) {
        global $_G;
        $picAttach = array(
            'aid' => $this->aid,
            'dateline' => $_G['timestamp'],
            'filename' => dhtmlspecialchars(censor($this->attach['name'])),
            'filesize' => $this->attach['size'],
            'attachment' => $this->attach['attachment'],
            'isimage' => $this->attach['isimage'],
            'uid' => $this->uid
        );
        //change $picAttach into string.
        $picData = implode("|",$picAttach);
        $retData = array('id'=>$this->aid,'picId'=>$picData);
        $retMsg = array('errCode'=>0,"jumpURL"=>null,"locationTime"=>2000,'message'=>'发表成功','showLogin'=>null,'data'=>$retData);
        echo json_encode($retMsg);

        exit;
    }
}

?>