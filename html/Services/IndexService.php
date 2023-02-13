<?php

namespace Services;

use Repositories\ThreadRepository;
use Views\Index\Index;

class IndexService{


	function __construct(
		private ThreadRepository $tr,
		private Index $view
	){}

	function __invoke(){
		$threads = $this->tr->findAll();

		return $this->view->render($threads);

	}

}

?>
