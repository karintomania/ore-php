<?php

namespace Services;

use Repositories\ThreadRepository;

class IndexService{

	private ThreadRepository $tr;

	function __construct(ThreadRepository $tr){
		$this->tr = $tr;
	}

	function test(){
		var_dump('index');
	}

}

?>
