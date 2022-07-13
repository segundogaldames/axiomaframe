<?php
#archivo de conexion para usar Eloquent
use Illuminate\Database\Capsule\Manager as Database;

$database = new Database;
$database->addConnection([
    'driver' => DB_DRIVER,
    'host' => DB_HOST,
    'database' => DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASS,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

date_default_timezone_set('America/Santiago');

$database->setAsGlobal();
$database->bootEloquent();