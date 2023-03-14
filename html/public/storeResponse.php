<?php

use Services\StoreResponseService;


$app = include '../app.php';


$service = $app->resolve(StoreResponseService::class);

if($service($_POST)){
	header("Location: /thread.php?id=".$_POST['threadId']);
	die();
}else{
	header("Location: /thread.php?id=".$_POST['threadId']);
}


?>

