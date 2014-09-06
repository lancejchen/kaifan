<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: table_forum_activityapply.php 28709 2012-03-08 08:53:48Z liulanbo $
 */

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_forum_trade_period extends discuz_table
{
    public function __construct() {

        $this->_table = 'forum_trade_period';
        $this->_pk    = '';

        parent::__construct();
    }

//    public function
    public function fetch_by_pid($pid) {
//        return DB::query('SELECT * FROM pre_forum_trade_period where pid='.$pid);
        return DB::fetch_all("SELECT * FROM %t WHERE pid=%d ORDER BY start_time", array($this->_table, $pid));
    }
}

?>