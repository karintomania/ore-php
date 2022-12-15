<?php

namespace OreFramework\Tests;

trait ViewTest{

	// TODO: complete this function
	function assertViewTagContainsString(string $str, string $tag, string $html):void {

		if (!preg_match("/<{$tag}.*?>{$str}<\/{$tag}>/", $html)) { 
			throw new \LogicException("Expected \"{$str}\" in {$tag} tag in the html, but not found. \n$html");
		}
	}

	function assertViewContains(string $str, string $html): void{
		if(!str_contains($html, $str)){
			throw new \LogicException("Expected $str in the html, but not found. \n$html");
		}

	}

	function assertViewContainsId(string $id, string $html): void{
		// check if the html contains id='{$id}' / "{$id}"
		if (!preg_match("/id=['\"]{$id}['\"]/", $html)) { 
			throw new \LogicException("Expected id:\"$id\" in the html, but not found. \n$html");
		}

	}
}

?>
