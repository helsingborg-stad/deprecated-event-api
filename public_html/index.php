<?php
define("CWD", realpath(dirname(__FILE__)));
define("PARENT", dirname( dirname(__FILE__)));
require_once(PARENT . "/config.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim($settings);
$app->config(array(
	"templates.path" => CWD . "/templates",
));

$app->get("/v1/event", $validateKey, function() use ($app) {
	$app->render("event.php", array(
		"app" => $app
	),200);
	// echo $app->config("templates.path");
	// echo $app->view()->getData("flash")['author_id'];
});

$app->run();

