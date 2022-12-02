<?php

namespace Repositories;

use DateTimeImmutable;
use Models\Thread;

class ThreadRepository{

	function __construct(private \PDO $pdo){}

	function findById(int $id): Thread{
		$stmt = $this->pdo->prepare('
			SELECT * FROM threads
			WHERE id = :id');
		$stmt->execute(['id' => $id]);

		$threadArray = $stmt->fetch();
		return $this->arrayToThread($threadArray);
	}

	/**
	 * @return Thread[]
	 */
	function findAll(): array{
		$stmt = $this->pdo->query('SELECT * FROM threads');
		$stmt->execute();

		$threadsArray = $stmt->fetchAll();

		$threads =  array_map(
			fn($threadArray) => $this->arrayToThread($threadArray),
			$threadsArray
		);

		return $threads;
	}

	function create(Thread $thread): int{
		$stmt = $this->pdo->prepare('
			INSERT INTO threads (name)
			VALUES (:name)');
		$stmt->execute(['name' => $thread->name]);
		return $this->pdo->lastInsertId();
	}

	private function arrayToThread(array $array): Thread{
		return new Thread(
			name: $array['name'],
			id: $array['id'],
			createdAt: new DateTimeImmutable($array['createdAt']),
		);
	}

}

?>
