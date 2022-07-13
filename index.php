<?php

//echo phpinfo();exit;
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' .DS);
define('VENDOR', ROOT . 'vendor/');

// echo uniqid();
// exit;

try{
	require_once VENDOR . 'autoload.php';
	require_once APP_PATH . 'Config.php';
	require_once APP_PATH . 'Autoload.php';
	require_once APP_PATH . 'Database.php';

	Session::init();


	Bootstrap::run(new Request);
}catch(Exception $e){
	echo $e->getMessage();
}
