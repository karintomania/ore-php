<?php

namespace Views\Thread;

use Config;

class ResponseForm{

	function __construct(
		private Config $config
	)
	{}

	function render(int $threadId): string{

		$html = <<<HTML
			<div>
				<h3>投稿する</h3>
				<form id="response-form" action="{$this->config::URLS['STORE_RESPONSE']}" method="POST">
					<input type="hidden" name="threadId" value="{$threadId}">
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

		return $html;
	}
}

?>
