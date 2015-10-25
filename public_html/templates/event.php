<?php
$get = $app->request->get();

# TODO Handle a comma separated event_id string with several events
$event_ids = [$get['event_id']];
# TODO Handle if both event_id and query are set, now query is used if set and then event_id is ignored
$query = $get['q'];

if (!empty($query)){
	$Search = new Search($app);
	$event_ids = $Search->SearchEvents($get);	
}

# TODO Handle other parameters than event_id and query
# TODO Handle if required parameters are missing

$Wordpress = new Wordpress($app);

# TODO Ask WP API in one request for several events
$events = [];
foreach ($event_ids as $event_id) {
	$wp_response = $Wordpress->GetEvent($event_id);

	# TODO Handle incorrect response, for example if event_id is incorrect
	if ($wp_response->code == 200){	
		# TODO Extract construction of schema.org event JSON object to a separate Class
		$event_url = $wp_response->body->link;
		$event_name = $wp_response->body->title->rendered;
		$event = ['url' => $event_url, 'name' => $event_name];
	
		array_push($events, $event);
	}
}


$response = ['events' => $events];	
$app->contentType("application/json; charset=utf-8");
$app->response->setBody(json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));

?>