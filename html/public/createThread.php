<?php

use Services\CreateThreadService;

$app = include '../app.php';
$service = $app->resolve(CreateThreadService::class);

$view = $service->__invoke();

?>

<?= $view ?>
