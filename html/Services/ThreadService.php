<?php

namespace Services;

use OreFramework\Validation\ErrorManager;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Views\Thread\ThreadMain;

class ThreadService{


	function __construct(
		private ThreadRepository $tr,
		private ResponseRepository $rr,
		private ThreadMain $view,
		private ErrorManager $em,
	){}

	function __invoke(array $request){

		$threadId = $request['id'];

		$thread = $this->tr->findById($threadId);
		$responses = $this->rr->findByThread($thread->id);

		return $this->view->render($thread, $responses);

	}

	private function getErrors(){

		$this->em->get()

	}

}

?>
