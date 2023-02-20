<?php

namespace Tests\Views\Index;

use Config;
use DateTimeImmutable;
use Models\Thread;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Index\ThreadCard;

class ThreadCardTest extends Test{

	use ViewTest;

	function __construct(
		private ThreadCard $threadCard,
		private Config $config,
	){}

	function test_render_renders_thread_card(){

		$rowNum = 5;
		$input = new Thread(
			id: 1,
			name: 'test thread',
			createdAt: new DateTimeImmutable()
		);

		$html = $this->threadCard->render($rowNum, $input);

		$this->assertViewTagContainsString($rowNum, 'div', $html);
		$this->assertViewTagContainsString($input->name, 'a', $html);
		$this->assertViewContains(
			$this->config::URLS['THREAD'] . "?id={$input->id}", $html
		);
		$this->assertViewContains(
			$input->createdAt->format('Y/m/d H:i:s'), $html
		);
	}

}


?>
