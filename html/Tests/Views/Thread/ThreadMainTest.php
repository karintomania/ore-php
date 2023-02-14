<?php

namespace Tests\Views\Thread;

use DateTimeImmutable;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Models\Response;
use Models\Thread;
use Views\Thread\ThreadMain;

class ThreadMainTest extends Test{

	use ViewTest;

	function __construct(
		private ThreadMain $threadMain
	){}

	function test_render_renders_response_list(){

		$thread = new Thread(
			id: 3,
			name: 'test thread 1',
			createdAt: new DateTimeImmutable(),
		);

		$responses = [
			new Response(
				id: 2,
				threadId: 3,
				content: 'test content 1',
				userName: 'user 1',
				createdAt: new DateTimeImmutable(),
			),
			new Response(
				id: 5,
				threadId: 3,
				content: 'test content 2',
				userName: 'user 2',
				createdAt: new DateTimeImmutable(),
			),
		];

		$html = $this->threadMain->render($thread, $responses);

		$this->assertViewContains("layout-body", $html);

		// test title
		$this->assertViewContains($thread->name, $html);
		$this->assertViewContains('href="/"', $html);

		$this->assertViewTagContainsString(1, 'div', $html);
		$this->assertViewContainsId('response-1', $html);
		$this->assertViewContains($responses[0]->content, $html);
		$this->assertViewContains($responses[0]->userName, $html);
		$this->assertViewContains(
			$responses[0]->createdAt->format('Y/m/d H:i:s'), $html
		);

		$this->assertViewTagContainsString(2, 'div', $html);
		$this->assertViewContainsId('response-2', $html);
		$this->assertViewContains($responses[1]->content, $html);
		$this->assertViewContains($responses[1]->userName, $html);
		$this->assertViewContains(
			$responses[1]->createdAt->format('Y/m/d H:i:s'), $html
		);

		// test response form
		$this->assertViewContainsId('response-form', $html);
		$this->assertViewContains('value="'.$thread->id.'"', $html);
	}

}


?>
