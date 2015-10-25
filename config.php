<?php	
	define("TWD", realpath(dirname(__FILE__)));
	
	require_once(TWD . "/vendor/autoload.php");	
	require_once(TWD . "/Middleware/Middlewares.php");
	require_once(TWD . "/Classes/Wordpress.php");
	require_once(TWD . "/Classes/Search.php");

	// Set global Unirest timeout
	Unirest\Request::timeout(30);

	// Get configuration files from the config directory
	// Using prod_ config files if existing, otherwise test_ and finally dev_ if no other files exists
	$files = glob(TWD . '/Config/{prod_,test_,dev_}*.{json}', GLOB_BRACE);
	$settings = Zend\Config\Factory::fromFiles($files);
	