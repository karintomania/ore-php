<?php

namespace Tests\Repositories;

use OreFramework\Tests\Test;
use PDO;
use Repositories\ThreadRepository;
use Models\Thread;

class ThreadRepositoryTest extends Test{

	function __construct(
		private ThreadRepository $tr,
		private PDO $pdo,
	){}

	function test_create_creates_thread(){
		$input = new Thread(name: 'test thread');

		$threadId = $this->tr->create($input);

		$thread = $this->tr->findById($threadId);

		$this->assertEquals($threadId, $thread->id);
		$this->assertEquals($input->name, $thread->name);
		$this->assertEquals(date('Y-m-d H:i:s'), $thread->createdAt->format('Y-m-d H:i:s'));

	}

	function test_create_creates_thread_with_japanese_name(){
		$input = new Thread(name: 'テスト　スレ');

		$threadId = $this->tr->create($input);

		$thread = $this->tr->findById($threadId);

		$this->assertEquals($input->name, $thread->name);


	}

	function test_findById_finds_thread(){
		$input = new Thread(name: 'test thread');

		$threadId = $this->tr->create($input);

		$thread = $this->tr->findById($threadId);

		$this->assertEquals($threadId, $thread->id);
		$this->assertEquals($input->name, $thread->name);
		$this->assertEquals(date('Y-m-d H:i:s'), $thread->createdAt->format('Y-m-d H:i:s'));

	}

	function test_findAll_returns_all_threads(){

		$this->truncate();

		$input = [
			new Thread(name: 'test 1'),
			new Thread(name: 'test 2'),
			new Thread(name: 'test 3'),
		];

		foreach($input as $thread){
			$this->tr->create($thread);
		}

		$threads = $this->tr->findAll();

		$this->assertEquals(3, count($threads));
		$this->assertEquals($input[0]->name, $threads[0]->name);
		$this->assertEquals($input[1]->name, $threads[1]->name);
		$this->assertEquals($input[2]->name, $threads[2]->name);
	}

	private function truncate(){
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=0');
		$this->pdo->exec('TRUNCATE TABLE threads');
		$this->pdo->exec('SET FOREIGN_KEY_CHECKS=1');
	}

}


?>
