<?php

// Middleware to validate key
$validateKey = function($route){	
	$app = \Slim\Slim::getInstance();
	$key_parameter = $app->request()->params("key");	

	foreach($app->config("keys") as $key){
    	if($key['key'] == $key_parameter){
    		# Valid key, place author_id in session
        	$app->flashNow("author_id" , $key['author_id']);
    	}
	}

	# TODO Handle if the key is incorrect or missing
};
