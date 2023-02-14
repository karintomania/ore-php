<?php

namespace Views\Thread;

use Models\Response;
use Models\Thread;
use Views\Layout;
use Views\Thread\ResponseList;

class ThreadMain{

	function __construct(
		private Layout $layout,
		private ResponseList $responseList,
		private ResponseForm $responseForm
	){}

	/**
	 * @param Response[] $response
	 */
	function render(Thread $thread, array $responses): string{

		$threadTitle = <<<TITLE
			<div>
				<a href="/">←もどる</a>
			</div>
			<h1>{$thread->name}</h1>
		TITLE;

		$responseList = $this->responseList->render($responses);
		$responseForm = $this->responseForm->render($thread->id);

		$html = <<<HTML
			<div>
				{$threadTitle}
				{$responseList}
				{$responseForm}
			</div>
		HTML;

		return $this->layout->render($html);
	}
}

?>
