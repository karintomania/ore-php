<?php

namespace Views\Thread;


class ResponseForm{

	function render(int $threadId): string{

		$html = <<<HTML
			<div>
				<h3>投稿する</h3>
				<form id="response-form" action="/storeResponse.php" method="POST">
					<input type="hidden" name="threadId" value="{$threadId}">
					<div>
						<label>名前：</label><input type="text" name="userName">
					</div>
					<div>
						<label>内容：</label><input type="text" name="content">
					</div>
				</form>
			</div>
		HTML;

		return $html;
	}
}

?>
