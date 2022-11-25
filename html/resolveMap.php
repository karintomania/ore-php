<?php


return [
	\PDO::class => function(){
		$hostname = 'vanilla-php-db';
		$dbname = 'app';
		$password = 'root';
		$user = 'root';

		return new PDO(
			"mysql:host={$hostname};dbname={$dbname}",
			$user,
			$password);
	},
];

