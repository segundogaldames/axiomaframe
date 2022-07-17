<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' .DS);
define('VENDOR', ROOT . 'vendor/');

$debug = true;

if ($debug == true) {

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

}
//echo phpinfo();exit;


//echo uniqid();
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
