<?php

namespace Tests\Views\Index;

use DateTimeImmutable;
use Models\Thread;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Index\ThreadCard;

class ThreadCardTest extends Test{

	use ViewTest;

	function __construct(private ThreadCard $threadCard){}

	function test_render_renders_thread_card(){

		$rowNum = 5;
		$input = new Thread(
			id: 1,
			name: 'test thread',
			createdAt: new DateTimeImmutable()
		);

		$html = $this->threadCard->render($rowNum, $input);

		$this->assertViewContains($rowNum, $html);
		$this->assertViewContains($input->name, $html);
		$this->assertViewContains(
			$input->createdAt->format('Y/m/d H:i:s'), $html
		);
	}

}


?>
