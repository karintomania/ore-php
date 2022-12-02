<?php

namespace Models;

use DateTimeImmutable;

class Thread{

	public function __construct(
		public string $name,
		public ?int $id = null,
		public ?DateTimeImmutable $createdAt = null){}

}

?>
