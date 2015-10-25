<?php

Class Search {

	protected $params = array();	
	protected $app;

	public function __construct($app){
		$this->app = $app;		
	}

	# TODO Make it possible to search for something else than tags, for example geo position
	public function SearchEvents($params){
		# TODO Handle if parameter q is missing
		$tags = explode(' ', $params['q']);

		// Assembling body that the Search API requires
		$body = ['startIndex' => 0, 
				 'limit' => 10,
				 'query' => [
				 	'type' => 'tagquery',
				 	'tags' => $tags
				 ]
				];

		$url = $this->app->config('search')['api_base_url'] . 'search';		
		$headers = array("Accept" => "application/json");		
		$response = Unirest\Request::post($url, $headers, $body);

		// TODO Handle error response
		if ($response->code == 200){			
			$event_ids = $response->body->searchResults;
						
			return $event_ids;
		}		
	}
}