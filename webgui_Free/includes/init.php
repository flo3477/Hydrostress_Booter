<?php
	if(strpos(strtolower($_SERVER['SCRIPT_NAME']),strtolower(basename(__FILE__)))){
		die('Error, Your IP Address Has Been Logged!');
	}
	function getRealIpAddr(){
		if(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])){
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} elseif(!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	$_SERVER['REMOTE_ADDR'] = getRealIpAddr();
	require('functions.php');
	$user = new user;
        $stats = new stats;
	$url = 'http://cannon.hydroclub.info/';

?>