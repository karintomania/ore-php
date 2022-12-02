<?php

namespace Tests\Repositories;

use OreFramework\Tests\Test;
use PDO;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Models\Response;
use Models\Thread;

class ResponseRepositoryTest extends Test{

	function __construct(
		private ThreadRepository $tr,
		private ResponseRepository $rr,
		private PDO $pdo,
	){}

	function test_create_creates_response(){
		$threadId = $this->createThread();

		$response = new Response(
			threadId:  $threadId,
			userName:  'test name',
			content: 'test content',
		);

		$responseId = $this->rr->create($response);

		$responseCreated = $this->rr->findById($responseId);

		$this->assertEquals($responseId, $responseCreated->id);
		$this->assertEquals($response->userName, $responseCreated->userName);
		$this->assertEquals($response->content,  $responseCreated->content);
		$this->assertEquals($response->threadId, $responseCreated->threadId);
		$this->assertEquals(date('Y-m-d H:i:s'), $responseCreated->createdAt->format('Y-m-d H:i:s'));

	}

	function test_findById_finds_response(){
		$threadId = $this->createThread();

		$response = new Response(
			threadId:  $threadId,
			userName:  'test name',
			content: 'test content',
		);

		$responseId = $this->rr->create($response);

		$responseCreated = $this->rr->findById($responseId);

		$this->assertEquals($responseId, $responseCreated->id);
		$this->assertEquals($response->userName, $responseCreated->userName);
		$this->assertEquals($response->content,  $responseCreated->content);
		$this->assertEquals($response->threadId, $responseCreated->threadId);
		$this->assertEquals(date('Y-m-d H:i:s'), $responseCreated->createdAt->format('Y-m-d H:i:s'));


	}

	function test_findByThread_returns_all_responses_in_thread(){

		$this->truncate();

		$threadId = $this->createThread();
		$threadId2 = $this->createThread();

		$input = [
			new Response(
				threadId: $threadId,
				content: 'content 1',
				userName: 'name 1'
			),
			new Response(
				threadId: $threadId,
				content: 'content 2',
				userName: 'name 2'
			),
			new Response(
				threadId: $threadId,
				content: 'content 3',
				userName: 'name 3'
			),
			new Response( // insert a response for a different thread
				threadId: $threadId2,
				content: 'content 3',
				userName: 'name 3'
			),
		];

		$responseIds = array_map(
			fn($response) => $this->rr->create($response),
			$input
		);


		$responses = $this->rr->findByThread($threadId);

		$this->assertEquals(count($input) - 1, count($responses));
		$this->assertEquals($responseIds[0], $responses[0]->id);
		$this->assertEquals($responseIds[1], $responses[1]->id);
		$this->assertEquals($responseIds[2], $responses[2]->id);
	}

	private function createThread(): int{
		$threadId = $this->tr->create(
			new Thread(name: 'test')
		);
		return $threadId;
	}


	private function truncate(){
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=0');

		$this->pdo->exec('TRUNCATE TABLE responses');
		$this->pdo->exec('TRUNCATE TABLE threads');

		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=1');
	}

}


?>
