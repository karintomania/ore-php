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
	){}

	/**
	 * @param Response[] $response
	 */
	function render(Thread $thread, array $responses): string{

		$threadTitle = <<<TITLE
			<h1>{$thread->name}</h1>
		TITLE;

		$responseList = $this->responseList->render($responses);

		$html = <<<HTML
			<div>
				{$threadTitle}
				{$responseList}
			</div>
		HTML;

		return $this->layout->render($html);
	}
}

?>
