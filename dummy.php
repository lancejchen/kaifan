<?php
echo 'hello';
@ini_set('zend_monitor.enable', 0);
echo 'hello1';

if(@function_exists('output_cache_disable')) {
	@output_cache_disable();
}
if(isset($_GET['debugger_connect']) && $_GET['debugger_connect'] == 1) {
	if(function_exists('debugger_connect'))  {
		debugger_connect();
        echo 'show me';
		exit();
	} else {
		echo "No connector is installed.";
	}
}
?>
