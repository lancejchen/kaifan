<?php
$current_time = "15:59";
$sunrise = "5:42";
$sunset = "14:26";
date_default_timezone_set('Asia/Hong_Kong');
$current_time= date('H:i');
//echo time();
//
$date1 = DateTime::createFromFormat('H:i', $current_time);
$date2 = DateTime::createFromFormat('H:i', $sunrise);
$date3 = DateTime::createFromFormat('H:i', $sunset);
if ($date1 > $date2 && $date1 < $date3)
{
    echo 'here';
}
?>