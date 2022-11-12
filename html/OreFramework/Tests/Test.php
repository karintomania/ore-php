<?php

namespace OreFramework\Tests;

class Test{

	function run(){
		$methods = get_class_methods($this);

		$className = get_class($this);
		print($className.':'.PHP_EOL);

		$countPass = 0;
		$countFail = 0;
		foreach($methods as $method){
			if(str_starts_with($method, 'test_')){
				try{
					$this->$method();
					print("\t".$method . ': OK'.PHP_EOL);
					$countPass ++;
				}catch(\LogicException $e){
					print("\t".$method . ': Fail '.$e->getMessage().PHP_EOL);
					$countFail ++;
				}
			} 
		}
		print("\t[Pass: " . $countPass . ' Fail: ' . $countFail . ']' . PHP_EOL);
	}

	function assertEquals($a, $b){
		if($a !== $b){
			throw new \LogicException("Expected $a, but $b is given.");
		}

	}
}

?>
