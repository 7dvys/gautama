<?php

spl_autoload_register(function ($class) { 

    $pathContorllers = './controllers/' . $class . '.php';
    $pathModels = './models/' . $class . '.php';

    if (file_exists($pathContorllers)) {
        require_once $pathContorllers;
    } elseif (file_exists($pathModels )) {
        require_once $pathModels ;
    }
});