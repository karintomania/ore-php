<?php

try {
    $dbh = new PDO('mysql:host=vanilla-php-db;dbname=app', 'root', 'root');
	print('success');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
}

?>
