<?php

namespace OreFramework\Validation;

class ErrorManager{

	function __construct()
	{
		if(isset($_SESSION)) session_start();
	}

	function register(
		string $fieldKey,
		string $message,
		array $request,
	){
		$_SESSION[$fieldKey] = [
			'message' => $message,
			'form' => $request,
		];
	}

	function get(string $fieldKey){
		$value = $_SESSION[$fieldKey];
		unset($_SESSION[$fieldKey]);
		return $value;
	}

	function has(string $fieldKey){
		return isset($_SESSION[$fieldKey]);
	}

}

?>
