<?php

namespace Views\Index;

use Config;
use Models\Thread;

class ThreadCard{

	function __construct(
		 private Config $config
	)
	{}

	/**
	 * @parma int $rowNum number of row in thread list
	 * @parma Thread $thread
	 */
	function render(int $rowNum, Thread $thread): string{

		$html = <<<HTML
			<div>
				<div>{$rowNum}</div>
				<a href="{$this->config::URLS['THREAD']}?id={$thread->id}">{$thread->name}</a>
				<div>{$thread->createdAt->format('Y/m/d H:i:s')}</div>
			</div>
		HTML;

		return $html;
	}
}

?>
