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
		// All WP API specific code should really be in this class
		return $response;
	}

	public function CreateEvent($request_body){
		$url = $this->app->config('wordpress')['api_base_url'] . 'event';		
		$headers = array("Accept" => "application/json", "Content-Type" => "application/json");

		# TODO Validate request body and handle errors
		$request_body = json_decode($request_body);
		$title = $request_body->title;

		$body = ['title' => $title];
		Unirest\Request::auth($this->app->config('wordpress')['username'], $this->app->config('wordpress')['password']);
		$response = Unirest\Request::post($url, $headers, json_encode($body));	

		// Returning complete WP JSON to be rendered in template, probably not the right solution in the long run
		// All WP API specific code should really be in this class
		return $response;
	}
}