<?php

namespace Tests\Views\Thread;

use DateTimeImmutable;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Models\Response;
use Views\Thread\ResponseList;

class ResponseListTest extends Test{

	use ViewTest;

	function __construct(
		private ResponseList $responseList
	){}

	function test_render_renders_response_list(){

		$input = [
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

		$html = $this->responseList->render($input);

		$this->assertViewTagContainsString(1, 'div', $html);
		$this->assertViewContainsId('response-1', $html);
		$this->assertViewContains($input[0]->content, $html);
		$this->assertViewContains($input[0]->userName, $html);
		$this->assertViewContains(
			$input[0]->createdAt->format('Y/m/d H:i:s'), $html
		);

		$this->assertViewTagContainsString(2, 'div', $html);
		$this->assertViewContainsId('response-2', $html);
		$this->assertViewContains($input[1]->content, $html);
		$this->assertViewContains($input[1]->userName, $html);
		$this->assertViewContains(
			$input[1]->createdAt->format('Y/m/d H:i:s'), $html
		);
	}

}


?>
