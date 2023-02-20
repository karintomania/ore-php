<?php

use Services\StoreThreadService;


$app = include '../app.php';


$service = $app->resolve(StoreThreadService::class);
$threadId = $service($_POST);

if(is_numeric($threadId)){
	header("Location: /thread.php?id=".$threadId);
	die();
}


?>

