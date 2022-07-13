<?php

function autoloadCore($class){
    if(file_exists(APP_PATH . ucfirst(strtolower($class)) . '.php')){
        include_once APP_PATH . ucfirst(strtolower($class)) . '.php';
    }
}

spl_autoload_register("autoloadCore");
