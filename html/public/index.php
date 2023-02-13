<?php

use Models\Thread;
use Repositories\ThreadRepository;
use Services\IndexService;

$app = include '../app.php';
$service = $app->resolve(IndexService::class);

$view = $service->__invoke();

?>

<?= $view ?>
