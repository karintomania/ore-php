<?php

namespace Tests\Repositories;

use OreFramework\Tests\Test;
use PDO;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Models\Response;

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

	function test_findByThread_returns_all_responses(){

		// $this->truncate();

		// $input = [
		// 	'test 1',
		// 	'test 2',
		// 	'test 3',
		// ];

		// $this->tr->create($input[0]);
		// $this->tr->create($input[1]);
		// $this->tr->create($input[2]);

		// $responses = $this->tr->findAll();

		// $this->assertEquals(3, count($responses));
		// $this->assertEquals($input[0], $responses[0]['name']);
		// $this->assertEquals($input[1], $responses[1]['name']);
		// $this->assertEquals($input[2], $responses[2]['name']);
	}

	private function createThread(): int{
		$threadId = $this->tr->create('test');
		return $threadId;
	}

	private function truncate(){
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=0');
		$this->pdo->exec('TRUNCATE TABLE responses');
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=1');
	}

}


?>
