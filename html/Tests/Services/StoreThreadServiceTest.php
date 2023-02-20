<?php

namespace Tests\Services;

use Models\Thread;
use OreFramework\Tests\Test;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Services\StoreResponseService;
use Services\StoreThreadService;

class StoreThreadServiceTest extends Test{

	function __construct(
		private StoreThreadService $sts,
		private ThreadRepository $tr,
		private ResponseRepository $rr,
	){}

	function test_StoreThreadService_stores_thread_and_response(){

		$input = [
			'name' => 'test thread title',
			'content' => 'test content',
			'userName' => 'test name',
		];

		$threadId = $this->sts->__invoke($input);

		// thread is stored
		$thread = $this->tr->findById($threadId);
		$this->assertEquals($input['name'], $thread->name);

		$responses = $this->rr->findByThread($threadId);

		// response is stored
		$this->assertEquals(1, count($responses));

		$response = $responses[0];
		$this->assertEquals($threadId, $response->threadId);
		$this->assertEquals($input['content'], $response->content);
		$this->assertEquals($input['userName'], $response->userName);

	}

}


?>
