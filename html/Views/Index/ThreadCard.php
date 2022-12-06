<?php

namespace Views\Index;

use Models\Thread;

class ThreadCard{

	/**
	 * @parma int $rowNum number of row in thread list
	 * @parma Thread $thread
	 */
	function render(int $rowNum, Thread $thread): string{

		$html = <<<HTML
			<div>
				<div>{$rowNum}</div>
				<div>{$thread->name}</div>
				<div>{$thread->createdAt->format('Y/m/d H:i:s')}</div>
			</div>
		HTML;

		return $html;
	}
}

?>
