<?php

namespace Views\Thread;

use Models\Response;
use Views\Layout;

class ResponseList{

	function __construct(
		private Layout $layout,
		private ResponseCard $responseCard,
	){}

	/**
	 * @param Response[] $response
	 */
	function render(array $responses): string{

		$rowNum = 1;
		$threadHtml = array_reduce(
			$responses,
			function(string $carry, Response $response) use (&$rowNum){
				$carry .= "\n" . $this->responseCard->render($rowNum, $response);
				$rowNum ++;
				return $carry;
			},
			''
		);

		$html = <<<HTML
			<div>
				{$threadHtml}
			</div>
		HTML;

		return $this->layout->render($html);
	}
}

?>
