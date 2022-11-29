<?php

namespace Models;

use DateTimeImmutable;

class Response{

	public function __construct(
		public int $threadId,
		public string $content,
		public string $userName,
		public ?int $id = null,
		public ?DateTimeImmutable $createdAt = null){}

}

?>
