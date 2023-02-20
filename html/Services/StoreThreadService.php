<?php

namespace Services;

use Models\Response;
use Models\Thread;
use Repositories\ResponseRepository;
use Repositories\ThreadRepository;

class StoreThreadService{


	function __construct(
		private ThreadRepository $tr,
		private ResponseRepository $rr,
	){}

	/**
 	 * @param array $request
	 * @return int $threadId
	 */
	function __invoke(array $request): int{

		// create thread
		$thread = new Thread(
			name: $request['name'],
		);

		$threadId = $this->tr->create($thread);
		
		$userName = $request['userName'];
		$content = $request['content'];

		// create response
		$this->rr->create(
			new Response(
				threadId: $threadId,
				content: $content,
				userName: $userName,
			)
		);

		return $threadId;

	}

}

?>
