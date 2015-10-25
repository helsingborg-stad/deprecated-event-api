<?php

Class Wordpress {

	protected $params = array();	
	protected $app;

	public function __construct($app){
		$this->app = $app;		
	}

	public function GetEvent($event_id){
		# TODO handle missing event_id		
		$url = $this->app->config('wordpress')['api_base_url'] . 'event/' . $event_id;		
		$response = Unirest\Request::get($url);

		// Returning complete WP JSON to be rendered in template, probably not the right solution in the long run
		// All WP API specific code shoul really be in this class
		return $response;
	}
}