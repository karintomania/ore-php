<?php

namespace Tests\Services;

use Models\Thread;
use OreFramework\Tests\Test;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Services\StoreResponseService;

class StoreResponseServiceTest extends Test{

	private int $threadId;

	function __construct(
		private StoreResponseService $srs,
		private ThreadRepository $tr,
		private ResponseRepository $rr,
	){}

	function test_StoreResponseService_stores_response(){

		$inputThread = new Thread(name: 'thread 1');
		$this->threadId = $this->tr->create($inputThread);
		$thread = $this->tr->findById($this->threadId);

		$input = [
			'threadId' => $this->threadId,
			'content' => 'content',
			'userName' => 'userName',
		];

		$result = $this->srs->__invoke($input);

		$this->assertEquals($result['success'], true);
		$responses = $this->rr->findByThread($this->threadId);

		$this->assertEquals(1, count($responses));

		$response = $responses[0];
		$this->assertEquals($input['threadId'], $response->threadId);
		$this->assertEquals($input['content'], $response->content);
		$this->assertEquals($input['userName'], $response->userName);

	}

	function test_StoreResponseService_validates_empty_content(){

		$input = [
			'threadId' => $this->threadId,
			'content' => '',
			'userName' => 'userName',
		];

		$result = $this->srs->__invoke($input);
		$this->assertEquals(false, $result['success']);

	}

	function test_StoreResponseService_validates_empty_name(){

		$input = [
			'threadId' => $this->threadId,
			'content' => 'test content',
			'userName' => '',
		];

		$result = $this->srs->__invoke($input);
		$this->assertEquals(false, $result['success']);

	}
}


?>
