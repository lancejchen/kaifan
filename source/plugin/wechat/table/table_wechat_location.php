<?php
/**
 * Created by PhpStorm.
 * User: peterwhyle
 * Date: 8/25/14
 * Time: 12:08 AM
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_wechat_location extends discuz_table {

    public function __construct() {
        $this->_table = 'wechat_location';
        $this->_pk = 'openid';

        parent::__construct();
    }

    public function fetch_by_code($openid) {
        return DB::fetch_first('SELECT * FROM %t WHERE openid=%t', array($this->_table, $openid));
    }
/*
    public function update($data) {

        $this->delete($data['from']);
        $this->insert($insertLoc,false,true);
    }
*/
    public function insert($data){
        $timestamp=date('Y-m-d H:i:s',$data['time']);
        //$timestamp="FROM_UNIXTIME('".$data['time']."')";
        $insertLoc=array(
            'openid'=> $data['from'],
            'access_time'=>$timestamp,
            'la'=>$data['la'],
            'lo'=>$data['lo'],
            'prec'=>$data['p']
        );
        parent::insert($insertLoc,false,true);
    }

    public function delete($openid){
        $query="delete from pre_wechat_location where openid='".$openid."'";
        DB::query($query);
    }

}
