<?php

namespace Services;

use Views\CreateThread\CreateThreadMain;

class CreateThreadService{


	function __construct(
		private CreateThreadMain $view
	){}

	function __invoke(){

		return $this->view->render();

	}

}

?>
