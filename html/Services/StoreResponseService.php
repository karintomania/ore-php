<?php

namespace Services;

use Models\Response;
use Repositories\ResponseRepository;

class StoreResponseService{


	function __construct(
		private ResponseRepository $rr,
	){}

	function __invoke(array $request){
		$threadId = $request['threadId'];
		$userName = $request['userName'];
		$content = $request['content'];

		$this->rr->create(
			new Response(
				threadId: $threadId,
				content: $content,
				userName: $userName,
			)
		);

		return true;

	}

}

?>
