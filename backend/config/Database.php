<?php
#Configuraciones de PHP
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
ini_set('upload_max_filesize','64M');
ini_set('post_max_size','64M');

#Configuracione de DB
define("DB_HOST", "localhost");
define("DB_USERNAME", "ryn");
define("DB_PASSWORD", "1133651449");
define("DB_DATABASE_NAME", "gautama");

#Iniciar database
class Database{
    #conectar 
    private static function connect(){
        $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_DATABASE_NAME);
        $conn->query("SET NAMES 'utf8'");
        return $conn;

        #generar base de datos si no existe;
    }

    public static function execQuery($sql){
        $conn = self::connect();

        if (!$query = $conn->query($sql)) {
            return $conn->error;
            
        }else{
            return $query->fetch_all();
            $conn->close();
        }
        
    }

    public static function execSql($sql){
        $conn = self::connect();

        if (!$query = $conn->query($sql)) {
            return $conn->error;
            
        }else{
            return $query;
            $conn->close();
        }
        
    }

    public static function escape_string($string){
        $conn = self::connect();

        return $conn->real_escape_string($string);
    }

}


