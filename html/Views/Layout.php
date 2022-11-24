<?php

namespace Views;

class Layout{

	function render(string $content): string{

		$html = <<<HTML
			<html>
				<head>
					<title>５１２ちゃんねる</title>
				</head>
				<body>
					{$content}
				</body>
			</html>
		HTML;
		return $html;
	}
}

?>
