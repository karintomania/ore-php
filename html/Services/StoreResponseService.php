<?php

namespace Services;

use Models\Response;
use Repositories\ResponseRepository;

class StoreResponseService{


	function __construct(
		private ResponseRepository $rr,
	){}

	function __invoke(array $request){

		if(!$this->validate($request)) return ['success' => false];

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

		return ['success' =>true];

	}

	private function validate(array $request){
		if(!$request['threadId']){
			return false;
		}
		if(!$request['userName']){
			return false;
		}
		if(!$request['content']){
			return false;
		}

		return true;
	}

}

?>
