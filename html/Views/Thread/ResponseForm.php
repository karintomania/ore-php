<?php

namespace Views\Thread;

use Config;

class ResponseForm{

	function __construct(
		private Config $config
	)
	{}

	function render(int $threadId, array $original, array $errors): string{

		$nameError = $errors['name'] ?? '';
		$nameValue = $original['name'] ?? '';

		$contentError = $errors['content'] ?? '';
		$contentValue = $original['content'] ?? '';
		
		$html = <<<HTML
			<div>
				<h3>投稿する</h3>
				<form id="response-form" action="{$this->config::URLS['STORE_RESPONSE']}" method="POST">
					<input type="hidden" name="threadId" value="{$threadId}">
					<div>
						<label>名前：</label><input type="text" name="userName" value="{$nameValue}">
						<div>{$nameError}</div>
					</div>
					<div>
						<label>内容：</label><input type="text" name="content" value="{$contentValue}">
						<div>{$contentError}</div>
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
