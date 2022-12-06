<?php

namespace Views\Index;

use Models\Thread;

class Index{

	/**
	 * @param Thread[] $threads
	 */
	function render(array $threads): string{

		$html = <<<HTML
			<div>
				thread
			</div>
		HTML;
		return $html;
	}
}

?>
