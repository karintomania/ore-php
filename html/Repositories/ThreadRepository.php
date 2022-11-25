<?php

namespace Repositories;

class ThreadRepository{

	function __construct(private \PDO $pdo){}

	function findById(int $id): array{
		$stmt = $this->pdo->prepare('
			SELECT * FROM threads
			WHERE id = :id');
		$stmt->execute(['id' => $id]);

		return $stmt->fetch();
	}
	function findAll(){
	}
	function create(string $name): int{
		$stmt = $this->pdo->prepare('
			INSERT INTO threads (name)
			VALUES (:name)');
		$stmt->execute(['name' => $name]);
		return $this->pdo->lastInsertId();
	}

}

?>
