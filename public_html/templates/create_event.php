<?php

#TODO handle if author_id is missing (which it should not if key validation works correctly)
$author_id = $app->view()->getData("flash")['author_id'];

$Wordpress = new Wordpress($app);

# TODO Be more careful when handling request body
$wp_response = $Wordpress->CreateEvent($app->request->getBody());

# TODO Handle incorrect response, for example if an event was not created
$events = [];
if ($wp_response->code == 201){	
	# TODO Extract construction of schema.org event JSON object to a separate Class, now it is both here and in the event.php template
	$event_url = $wp_response->body->link;
	$event_name = $wp_response->body->title->rendered;
	$event = ['url' => $event_url, 'name' => $event_name];	
	
	array_push($events, $event);
}


$response = ['events' => $events];	
$app->contentType("application/json; charset=utf-8");
$app->response->setBody(json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));

?>