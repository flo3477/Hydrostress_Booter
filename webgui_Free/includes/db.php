<?php
	if(strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__)))){
		die('Error, Your IP Address Has Been Logged!');
	}
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'hackuniverse');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'hobbit36');
	$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
?>