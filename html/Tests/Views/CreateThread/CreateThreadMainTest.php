<?php

namespace Tests\Views\CreateThread;

use OreFramework\Tests\Test;
use OreFramework\Tests\ViewTest;
use Views\CreateThread\CreateThreadMain;

class CreateThreadMainTest extends Test{

	use ViewTest;

	function __construct(
		private CreateThreadMain $view,
	){}

	function test_render_renders_main(){

		$html = $this->view->render();

		$this->assertViewContainsId('thread-form', $html);

		// includes form to StoreThread
		$this->assertViewContains('action="/storeThread.php"', $html);
		$this->assertViewContains('method="POST"', $html);

		// include forms
		$this->assertViewContains('name="name"', $html);
		$this->assertViewContains('name="userName"', $html);
		$this->assertViewContains('name="content"', $html);
		$this->assertViewContains('type="submit"', $html);

	}

}


?>
