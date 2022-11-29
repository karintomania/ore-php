<?php

namespace Tests\Repositories;

use OreFramework\Tests\Test;
use PDO;
use Repositories\ThreadRepository;

class ThreadRepositoryTest extends Test{

	function __construct(
		private ThreadRepository $tr,
		private PDO $pdo,
	){}

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

		$this->assertEquals($threadId, $thread['id']);
		$this->assertEquals($threadName, $thread['name']);

	}

	function test_findById_finds_thread(){
		$threadName = 'test thread';

		$threadId = $this->tr->create($threadName);

		$thread = $this->tr->findById($threadId);

		$this->assertEquals($threadId, $thread['id']);
		$this->assertEquals($threadName, $thread['name']);
		$this->assertEquals(date('Y-m-d H:i:s'), $thread['createdAt']);

	}

	function test_findAll_returns_all_threads(){

		$this->truncate();

		$input = [
			'test 1',
			'test 2',
			'test 3',
		];
		$this->tr->create($input[0]);
		$this->tr->create($input[1]);
		$this->tr->create($input[2]);

		$threads = $this->tr->findAll();

		$this->assertEquals(3, count($threads));
		$this->assertEquals($input[0], $threads[0]['name']);
		$this->assertEquals($input[1], $threads[1]['name']);
		$this->assertEquals($input[2], $threads[2]['name']);
	}

	private function truncate(){
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=0');
		$this->pdo->exec('TRUNCATE TABLE threads');
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=1');
	}

}


?>
