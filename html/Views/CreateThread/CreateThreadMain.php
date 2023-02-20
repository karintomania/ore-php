<?php

namespace Views\CreateThread;

use Config;
use Views\Layout;

class CreateThreadMain{

	function __construct(
		private Layout $layout,
		private Config $config
	){}

	/**
	 * @param Thread[] $threads
	 */
	function render(): string{

		$html = <<<HTML
			<div>
				<h3>スレを作る</h3>
				<form id="thread-form" action="{$this->config::URLS['STORE_THREAD']}" method="POST">
					<div>
						<label>スレタイトル：</label><input type="text" name="name">
					</div>
					<div>
						<label>名前：</label><input type="text" name="userName">
					</div>
					<div>
						<label>内容：</label><input type="text" name="content">
					</div>
					<div>
						<input type="submit" value="送る">
					</div>
				</form>
			</div>
		HTML;

		return $this->layout->render($html);
	}
}

?>
