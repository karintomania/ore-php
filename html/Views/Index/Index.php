<?php

namespace Views\Index;

use Models\Thread;
use Views\Layout;

class Index{

	function __construct(
		private Layout $layout,
		private ThreadCard $threadCard,
	){}

	/**
	 * @param Thread[] $threads
	 */
	function render(array $threads): string{

		$rowNum = 1;
		$threadHtml = array_reduce(
			$threads,
			function(string $carry, Thread $thread) use (&$rowNum){
				$carry .= "\n" . $this->threadCard->render($rowNum, $thread);
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
