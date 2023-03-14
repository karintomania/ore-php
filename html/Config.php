<?php

class Config{
	const URLS = [
		'INDEX' => '/',
		'THREAD' => '/thread',
		'CREATE_THREAD' => '/createThread',
		'STORE_THREAD' => '/storeThread',
		'STORE_RESPONSE' => '/storeResponse',
	];

	const RESPONSE_FORM = [
		'USER_NAME_ERROR_MESSAGE' => 'name shouldn\'t be blank',
		'CONTENT_ERROR_MESSAGE' => 'content shouldn\'t be blank',
	];
}

?>
