<?php

namespace Tests\Services;

use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Services\CreateThreadService;

class CreateThreadServiceTest extends Test{

	use ViewTest;
	function __construct(
		private CreateThreadService $cts,
	){}

	function test_IndexService_returns_index_view(){

		$html = $this->cts->__invoke();

		// includes row nums
		$this->assertViewContainsId("thread-form", $html);
	}

}


?>
