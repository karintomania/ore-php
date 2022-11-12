<?php

class App{

	private array $resolveMap;


	function __construct(){

		// register autload function
		spl_autoload_register(function ($class) {
			include  str_replace("\\", "/", $class) . '.php';
		});

		$this->resolveMap = [
			// IndexService::class => function(App $app) {
			// 	$tr = $app->resolve(ThreadRepository::class);
			// 	var_dump('resolver');
			// 	return new IndexService($tr);
			// }
		];
	}

	function resolve(string $className){

		if(isset($this->resolveMap[$className])){
			return $this->resolveMap[$className]($this);
		}

		$class = new ReflectionClass($className);

		$constructor = $class->getConstructor();

		if($constructor === null){
			return $class->newInstance();
		}

		$params = $constructor->getParameters();

		if(count($params) === 0){
			return $class->newInstance();
		}

		$args = [];
		foreach($params as $param){
			$args[] = $this->resolve($param->getType());
		}

		return $class->newInstanceArgs($args);

	}
}

$app = new App();

return $app;
?>
