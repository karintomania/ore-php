<?php

namespace Tests\Views;

use OreFramework\Tests\Test;
use Views\Layout;
use OreFramework\Tests\ViewTest;

class LayoutTest extends Test{

	use ViewTest;

	function __construct(private Layout $layout){}

	function test_render_renders_layout(){
		$content = 'Hello';
		$html = $this->layout->render($content);

		$this->assertViewContains($content, $html);
	}

}


?>
