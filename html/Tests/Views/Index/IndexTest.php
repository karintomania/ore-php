<?php

namespace Tests\Views\Index;

use Config;
use DateInterval;
use DateTimeImmutable;
use Models\Thread;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Index\Index;
use Views\Index\ThreadCard;
use Views\Layout;

class IndexTest extends Test{

	use ViewTest;

	function __construct(
		private ThreadCard $threadCard,
		private Index $index,
		private Layout $layout,
		private Config $config,
	){}

	function test_render_renders_thread_card(){

		$input = [
			new Thread(
				id: 4,
				name: 'test thread 1',
				createdAt: (new DateTimeImmutable())
					->sub(new DateInterval('P1D'))
			),
			new Thread(
				id: 5,
				name: 'test thread 2',
				createdAt: new DateTimeImmutable()
			),
		];

		$html = $this->index->render($input);

		// includes row nums
		$this->assertViewTagContainsString("1", "div", $html);
		$this->assertViewTagContainsString("2", "div", $html);
		// includes thread name
		$this->assertViewContains($input[0]->name, $html);
		$this->assertViewContains($input[1]->name, $html);

		// include thread link
		$this->assertViewContains(
			$this->config::URLS['THREAD'] . "?id={$input[0]->id}", $html
		);
		$this->assertViewContains(
			$this->config::URLS['THREAD'] . "?id={$input[1]->id}", $html
		);

		// includes date time
		$this->assertViewContains(
			$input[0]->createdAt->format('Y/m/d H:i:s'), $html
		);
		$this->assertViewContains(
			$input[1]->createdAt->format('Y/m/d H:i:s'), $html
		);
		
		// includes layout
		$this->assertViewContains("layout-body", $html);

		// includes the link to /createThread
		$this->assertViewContains('href="' . $this->config::URLS['CREATE_THREAD'] . '"', $html);
	}

}


?>
