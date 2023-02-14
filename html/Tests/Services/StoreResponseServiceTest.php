<?php

namespace Tests\Services;

use Models\Thread;
use OreFramework\Tests\Test;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Services\StoreResponseService;

class StoreResponseServiceTest extends Test{

	function __construct(
		private StoreResponseService $srs,
		private ThreadRepository $tr,
		private ResponseRepository $rr,
	){}

	function test_StoreResponseService_stores_response(){

		$inputThread = new Thread(name: 'thread 1');
		$threadId = $this->tr->create($inputThread);
		$thread = $this->tr->findById($threadId);

		$input = [
			'threadId' => $threadId,
			'content' => 'content',
			'userName' => 'userName',
		];

		$html = $this->srs->__invoke($input);

		$responses = $this->rr->findByThread($threadId);

		$this->assertEquals(1, count($responses));

		$response = $responses[0];
		$this->assertEquals($input['threadId'], $response->threadId);
		$this->assertEquals($input['content'], $response->content);
		$this->assertEquals($input['userName'], $response->userName);

	}

}


?>
