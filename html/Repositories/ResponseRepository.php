<?php

namespace Repositories;

use Models\Response;
use DateTimeImmutable;

class ResponseRepository{

	function __construct(private \PDO $pdo){}

	function findById(int $id): Response{
		$stmt = $this->pdo->prepare('
			SELECT * FROM responses
			WHERE id = :id');
		$stmt->execute(['id' => $id]);

		$responseArray = $stmt->fetch();
		return $this->arrayToResponse($responseArray);
	}

	function findAll(): array{
		$stmt = $this->pdo->query('SELECT * FROM responses');
		$stmt->execute();

		return $stmt->fetchAll();
	}

	function create(Response $response): int{
		$stmt = $this->pdo->prepare('
			INSERT INTO responses (threadId, userName, content)
			VALUES (:threadId, :userName, :content)');
		$stmt->execute([
			"threadId" => $response->threadId,
			"userName" => $response->userName,
			"content"  => $response->content,
		]);
		return $this->pdo->lastInsertId();
	}

	/**
	 * @return Response[]
	 */
	function findByThread(int $threadId):array {

		$stmt = $this->pdo->prepare('
			SELECT * FROM responses
			WHERE threadId = :threadId
		');
		$stmt->execute(['threadId' => $threadId]);

		$responseAry = $stmt->fetchAll();

		$responses = array_map(
			fn($ary) => $this->arrayToResponse($ary),
			$responseAry);
		return $responses;

	}

	private function arrayToResponse(array $array): Response{
		return new Response(
			id:       $array['id'],
			threadId: $array['threadId'],
			userName: $array['userName'],
			content:  $array['content'],
			createdAt: new DateTimeImmutable($array['createdAt']),
		);
	}

}

?>
