<?php

namespace Tests\Repositories;

use OreFramework\Tests\Test;
use Repositories\ThreadRepository;

class ThreadRepositoryTest extends Test{

	function __construct(private ThreadRepository $tr){}

	function test_create_creates_thread(){
		$threadName = 'test thread';

		$threadId = $this->tr->create($threadName);

		$thread = $this->tr->findById($threadId);

		$this->assertEquals($threadId, $thread['id']);
		$this->assertEquals($threadName, $thread['name']);
		$this->assertEquals(date('Y-m-d H:i:s'), $thread['createdAt']);

	}

	function test_create_creates_thread_with_japanese_name(){
		$threadName = 'テストスレ';

		$threadId = $this->tr->create($threadName);

		$thread = $this->tr->findById($threadId);

		// $this->assertEquals($threadId, $thread['id']);
		// $this->assertEquals($threadName, $thread['name']);

	}
	function test_findAll_returns_all_threads(){
		// $threads = $this->tr->findAll();

		// $this->assertEquals(1, 1);
	}

}


?>
