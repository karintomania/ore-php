<?php

namespace OreFramework\Tests;

trait ViewTest{

	function assertViewContains(string $str, $html){
		if(!str_contains($html, $str)){
			throw new \LogicException("Expected $str in the html, but not found. \n$html");
		}

	}
}

?>
