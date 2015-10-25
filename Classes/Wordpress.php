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

		return $response;
	}
}