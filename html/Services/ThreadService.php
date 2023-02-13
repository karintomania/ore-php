<?php

namespace Services;

use Repositories\ResponseRepository;
use Repositories\ThreadRepository;
use Views\Thread\ThreadMain;

class ThreadService{


	function __construct(
		private ThreadRepository $tr,
		private ResponseRepository $rr,
		private ThreadMain $view
	){}

	function __invoke(array $request){

		$threadId = $request['id'];

		$thread = $this->tr->findById($threadId);
		$responses = $this->rr->findByThread($thread->id);

		return $this->view->render($thread, $responses);

	}

}

?>
