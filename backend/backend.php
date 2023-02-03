<?php
require_once __DIR__."/config/Database.php";
require_once __DIR__."/config/autoload.php";
# Controlador frontal
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

try{

    if (isset($uri[3]) && !empty($uri[3])) {
        $controller_name=ucfirst($uri[3])."Controller";
        if (class_exists($controller_name)){
            $controller = new $controller_name();
            
            if (isset($uri[4]) && !empty($uri[4])) {
                $method = $uri[4];      
                $controller->$method();
            }else{
                $controller_name();
            }
        }
    }
    
}catch(Error $e){
    echo json_encode($e);
}