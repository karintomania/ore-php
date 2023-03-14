<?php

namespace Services;

use Config;
use Models\Response;
use OreFramework\Validation\ErrorManager;
use Repositories\ResponseRepository;

class StoreResponseService{


	function __construct(
		private ResponseRepository $rr,
		private ErrorManager $em,
		private Config $config,
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
			$this->em->register(
				'name',
				$this->config::RESPONSE_FORM['USER_NAME_ERROR_MESSAGE'],
				$request,
			);
			return false;
		}
		if(!$request['content']){
			$this->em->register(
				'content',
				$this->config::RESPONSE_FORM['CONTENT_ERROR_MESSAGE'],
				$request,
			);
			return false;
		}

		return true;
	}

}

?>
