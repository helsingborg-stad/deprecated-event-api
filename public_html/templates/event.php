<?php
$get = $app->request->get();

# TODO Handle a comma separated event_id string with several events
# TODO Handle other parameters than event_id
$event_id = $get['event_id'];

$Wordpress = new Wordpress($app);
$wp_response = $Wordpress->GetEvent($event_id);

# TODO Handle incorrect response, for example if event_id is incorrect
if ($wp_response->code == 200){
	# TODO Extract construction of schema.org event JSON object to a separate Class
	$event_url = $wp_response->body->link;
	$event_name = $wp_response->body->title->rendered;
	$event = ['url' => $event_url, 'name' => $event_name];
	$response = ['events' => [$event]];
	
	$app->contentType("application/json; charset=utf-8");
	$app->response->setBody(json_encode($response, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
}

?>