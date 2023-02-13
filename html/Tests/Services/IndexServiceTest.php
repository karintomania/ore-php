<?php

namespace Tests\Services;

use Models\Thread;
use OreFramework\Tests\Test;
use Repositories\ThreadRepository;
use Services\IndexService;
use OreFramework\Tests\ViewTest;

class IndexServiceTest extends Test{

	use ViewTest;
	function __construct(
		private IndexService $is,
		private ThreadRepository $tr,
	){}

	// test 
	function test_IndexService_returns_index_view(){

		$input = [
			new Thread(name: 'thread 1'),
			new Thread(name: 'thread 2'),
		];

		foreach($input as $thread){
			$this->tr->create($thread);
		}

		$threads = $this->tr->findAll();

		$html = $this->is->__invoke();

		// includes row nums
		$this->assertViewTagContainsString("1", "div", $html);
		$this->assertViewTagContainsString("2", "div", $html);
		// includes thread name
		$this->assertViewContains($threads[0]->name, $html);
		$this->assertViewContains($threads[1]->name, $html);

		// includes date time
		$this->assertViewContains(
			$threads[0]->createdAt->format('Y/m/d H:i:s'), $html
		);
		$this->assertViewContains(
			$threads[1]->createdAt->format('Y/m/d H:i:s'), $html
		);
		
		// TODO: add test for layout id (layout-body)
		$this->assertViewContains("layout-body", $html);
	}

}


?>
