<?php

namespace Views\Thread;

use Models\Response;

class ResponseCard{

	function __construct(){}

	/**
	 * @param Thread[] $threads
	 */
	function render(int $rowNum, Response $response): string{

		$html = <<<HTML
			<div>
				<div id='response-{$rowNum}'>{$rowNum}</div>
				<div>{$response->userName}</div>
				<div>{$response->createdAt->format('Y/m/d H:i:s')}</div>
				<div>{$response->content}</div>
			</div>
		HTML;

		return $html;
	}
}

?>
