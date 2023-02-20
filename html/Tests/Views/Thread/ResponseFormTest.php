<?php

namespace Tests\Views\Thread;

use Config;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\Thread\ResponseForm;

class ResponseFormTest extends Test{

	use ViewTest;

	function __construct(
		private ResponseForm $view,
		private Config $config,
	){}

	function test_render_renders_response_list(){

		$threadId = 123;
		$html = $this->view->render($threadId);

		$this->assertViewContains(123, $html);
		$this->assertViewContainsId('response-form', $html);
		$this->assertViewContains('name="userName"', $html);
		$this->assertViewContains('action="'. $this->config::URLS['STORE_RESPONSE'] . '"', $html);

		$this->assertViewContains('name="content"', $html);
		$this->assertViewContains('name="threadId"', $html);

		$this->assertViewContains('type="submit"', $html);
	}

}


?>
