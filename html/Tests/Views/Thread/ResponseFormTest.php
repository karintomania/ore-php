<?php

namespace Tests\Views\Thread;

use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Thread\ResponseForm;

class ResponseFormTest extends Test{

	use ViewTest;

	function __construct(
		private ResponseForm $view
	){}

	function test_render_renders_response_list(){

		$threadId = 123;
		$html = $this->view->render($threadId);

		$this->assertViewContains(123, $html);
		$this->assertViewContainsId('response-form', $html);
		$this->assertViewContains('name="userName"', $html);
		$this->assertViewContains('action="/storeResponse.php"', $html);

		$this->assertViewContains('name="content"', $html);
		$this->assertViewContains('name="threadId"', $html);

		$this->assertViewContains('type="submit"', $html);
	}

}


?>
