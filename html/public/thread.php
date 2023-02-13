<?php

use Services\ThreadService;


$app = include '../app.php';


$service = $app->resolve(ThreadService::class);

$view = $service($_REQUEST);


?>

<?= $view ?>
