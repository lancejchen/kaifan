<?php
/**
 * Created by PhpStorm.
 * User: peterwhyle
 * Date: 8/19/14
 * Time: 6:01 PM
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_wechat_login_info extends discuz_table {

    public function __construct() {
        $this->_table = 'wechat_login_info';
        $this->_pk = 'openid';
        $this->_pre_cache_key = 'common_member_wechat_';

        parent::__construct();
    }

    public function fetch_by_openid($openid) {
        return DB::fetch_first('SELECT * FROM %t WHERE openid=%s', array($this->_table, $openid));
    }

}