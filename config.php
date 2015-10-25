<?php	
	define("TWD", realpath(dirname(__FILE__)));
	
	require_once(TWD . "/vendor/autoload.php");	
	require_once(TWD . "/Middleware/Middlewares.php");
	require_once(TWD . "/Classes/Wordpress.php");

	// Set global Unirest timeout
	Unirest\Request::timeout(30);

	// Get configuration files from the config directory
	$files = glob(TWD . '/Config/{prod_,test_,dev_}*.{json}', GLOB_BRACE);
	$settings = Zend\Config\Factory::fromFiles($files);
	