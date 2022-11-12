<?php

runTests($argv);

function runTests($argv){

	$target = (isset($argv[1])) ? $argv[1] : __DIR__;

	$result = listAllFiles($target);
	$app = require __DIR__ . '/../app.php';

	foreach($result as $testClassName){
		$test = $app->resolve($testClassName);

		$test->run();

	}

}
function listAllFiles($target) {

	$result = [];

	if(is_dir($target)){
		$items = array_diff(scandir($target), array('.', '..'));

		foreach ($items as $item) {
			$path = $target . DIRECTORY_SEPARATOR . $item;
			$result = array_merge($result, listAllFiles($path));
		}
	}else{
		if(str_ends_with($target, 'Test.php')){
			$projectRoot = realpath(__DIR__ . '/../');
			$classPath = str_replace($projectRoot . '/', '', $target);
			$classPath = str_replace('/', '\\', $classPath);
			$classPath = str_replace('.php', '', $classPath);

			$result[] = $classPath;
		}
	}

	return $result;
}

?>

