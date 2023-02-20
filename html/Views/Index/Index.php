<?php

namespace Views\Index;

use Config;
use Models\Thread;
use Views\Layout;

class Index{

	function __construct(
		private Layout $layout,
		private ThreadCard $threadCard,
		private Config $config,
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
				<div>
					<a href="{$this->config::URLS['CREATE_THREAD']}">スレを立てる</a>
				</div>
			</div>
		HTML;

		return $this->layout->render($html);
	}
}

?>
