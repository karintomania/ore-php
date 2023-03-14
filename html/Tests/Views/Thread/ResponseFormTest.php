<?php

namespace Tests\Views\Thread;

use Config;
use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use OreFramework\Validation\ErrorManager;
use Views\Thread\ResponseForm;

class ResponseFormTest extends Test{

	use ViewTest;

	function __construct(
		private ResponseForm $view,
		private Config $config,
		private ErrorManager $em,
	){}

	function test_render_renders_response_form(){

		$threadId = 123;
		$html = $this->view->render($threadId, [], []);

		$this->assertViewContains(123, $html);
		$this->assertViewContainsId('response-form', $html);
		$this->assertViewContains('name="userName"', $html);
		$this->assertViewContains('action="'. $this->config::URLS['STORE_RESPONSE'] . '"', $html);

		$this->assertViewContains('name="content"', $html);
		$this->assertViewContains('name="threadId"', $html);

		$this->assertViewContains('type="submit"', $html);
	}

	function test_render_renders_error_and_original_value(){

		$errors = [
			'name' => $this->config::RESPONSE_FORM['USER_NAME_ERROR_MESSAGE'],
			'content' => $this->config::RESPONSE_FORM['CONTENT_ERROR_MESSAGE'],
		];

		$original = [
			'name' => 'original name',
			'content' => 'original content',
		];

		$threadId = 123;
		$html = $this->view->render($threadId, $original, $errors);

		$this->assertViewContains($this->config::RESPONSE_FORM['USER_NAME_ERROR_MESSAGE'], $html);

		$this->assertViewContains($original['name'], $html);
		$this->assertViewContains($this->config::RESPONSE_FORM['USER_NAME_ERROR_MESSAGE'], $html);

		$this->assertViewContains($original['content'], $html);
		$this->assertViewContains($this->config::RESPONSE_FORM['CONTENT_ERROR_MESSAGE'], $html);
	}

}


?>
