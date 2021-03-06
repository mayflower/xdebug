--TEST--
Test for bug #57: Crash with overloading functions (ZE2)
--SKIPIF--
<?php if (!extension_loaded("xdebug")) print "skip"; ?>
<?php if(version_compare(zend_version(), "2.0.0-dev", '<')) echo "skip Zend Engine 2 needed\n"; ?>
--INI--
xdebug.default_enable=1
xdebug.auto_trace=0
xdebug.collect_params=1
xdebug.collect_assignments=0
xdebug.show_mem_delta=0
xdebug.profiler_enable=0
error_reporting=2047
--FILE--
<?php
class OO {
	var $a = 111;
	var $elem = array('b' => 9, 'c' => 42);

	// Callback method for executing a method
	function __call($function, $params)
	{
		echo strlen($params[0]);
	}
}

$o = new OO;

echo $o->foo('80');

?> 
--EXPECTF--
2
