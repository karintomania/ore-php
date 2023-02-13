<?php

namespace Tests\Services;

use Models\Response;
use Models\Thread;
use OreFramework\Tests\Test;
use Repositories\ThreadRepository;
use OreFramework\Tests\ViewTest;
use Repositories\ResponseRepository;
use Services\ThreadService;

class ThreadServiceTest extends Test{

	use ViewTest;

	function __construct(
		private ThreadService $ts,
		private ThreadRepository $tr,
		private ResponseRepository $rr,
	){}

	// test 
	function test_ThreadService_returns_thread_view(){
		$inputThread = new Thread(name: 'test thread 1');
		$threadId = $this->tr->create($inputThread);
		$thread = $this->tr->findById($threadId);

		$inputResponse = new Response(
			threadId: $threadId,
			content: 'test content 1',
			userName: 'test user name 1');
		$this->rr->create($inputResponse);
		$responses = $this->rr->findByThread($threadId);

		$input = ['id' => $threadId];

		$html = $this->ts->__invoke($input);

		$this->assertViewContains("layout-body", $html);

		$this->assertViewContains($thread->name, $html);

		$this->assertViewTagContainsString(1, 'div', $html);
		$this->assertViewContainsId('response-1', $html);
		$this->assertViewContains($responses[0]->content, $html);
		$this->assertViewContains($responses[0]->userName, $html);
		$this->assertViewContains(
			$responses[0]->createdAt->format('Y/m/d H:i:s'), $html
		);

	}

}


?>
