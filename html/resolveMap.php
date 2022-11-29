<?php


return [
	\PDO::class => function(){
		$hostname = $_ENV['DB_HOST'];
		$dbname   = $_ENV['DB_NAME'];
		$user     = $_ENV['DB_USER'];
		$password = $_ENV['DB_PASSWORD'];

		return new PDO(
			"mysql:host={$hostname};dbname={$dbname}",
			$user,
			$password);
	},
];

