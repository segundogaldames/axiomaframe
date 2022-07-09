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
	require_once APP_PATH . 'Bootstrap.php';
	require_once APP_PATH . 'Controller.php';
	//require_once APP_PATH . 'Model.php';
	//require_once APP_PATH . 'DBase.php';
	require_once APP_PATH . 'Register.php';
	require_once APP_PATH . 'Request.php';
	require_once APP_PATH . 'View.php';
	require_once APP_PATH . 'Database.php';
	require_once APP_PATH . 'Session.php';
	require_once APP_PATH . 'Hash.php';
	require_once APP_PATH . 'Helper.php';

	//echo uniqid();
	//exit;

	Session::init();


	Bootstrap::run(new Request);
}catch(Exception $e){
	echo $e->getMessage();
}
