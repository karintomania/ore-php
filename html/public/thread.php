<?php

use Models\Thread;
use Models\Response;
use Views\Thread\ThreadMain;


$app = include '../app.php';


$view = $app->resolve(ThreadMain::class);

$thread = new Thread(
	id: 3,
	name: 'test thread 1',
	createdAt: new DateTimeImmutable(),
);

$responses = [
	new Response(
		id: 2,
		threadId: 3,
		content: 'test content 1',
		userName: 'user 1',
		createdAt: new DateTimeImmutable(),
	),
	new Response(
		id: 5,
		threadId: 3,
		content: 'test content 2',
		userName: 'user 2',
		createdAt: new DateTimeImmutable(),
	),
];

$html = $view->render($thread, $responses);

?>

<?= $html ?>
