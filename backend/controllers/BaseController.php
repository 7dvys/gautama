<?php

Class BaseController{

    public function getParams(){
        $params = [];
        foreach ($_GET as $field => $value) {
            $param_decoded=explode(",",Database::escape_string($value));
            $params[$field]=$param_decoded;
        }
        return $params;
    }

    protected static function outputData($data){
        $output = json_encode($data);
        header('Content-Type: application/json');
        header($_SERVER['SERVER_PROTOCOL'].' 200 Ok');
        echo $output;
    } 
}
