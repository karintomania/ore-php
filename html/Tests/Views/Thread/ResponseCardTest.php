<?php

namespace Tests\Views\Thread;

use DateTimeImmutable;
use Models\Response;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Thread\ResponseCard;

class ResponseCardTest extends Test{

	use ViewTest;

	function __construct(
		private ResponseCard $responseCard
	){}

	function test_render_renders_response_card(){

		$rowNum = 4;
		$input = new Response(
			threadId: 1,
			content: 'test content',
			userName: 'user 1',
			id: 7,
			createdAt: new DateTimeImmutable()
		);

		$html = $this->responseCard->render($rowNum, $input);

		$this->assertViewTagContainsString($rowNum, 'div', $html);
		$this->assertViewContainsId('response-'.$rowNum, $html);
		$this->assertViewContains($input->content, $html);
		$this->assertViewContains($input->userName, $html);
		$this->assertViewContains(
			$input->createdAt->format('Y/m/d H:i:s'), $html
		);
	}

}


?>
