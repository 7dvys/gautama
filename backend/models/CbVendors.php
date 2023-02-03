<?php
class CbVendors extends BaseModel{
    public function __construct(){
        $this->nombre = "cbVendors";
        $this->createSql = "CREATE TABLE IF NOT EXISTS cbVendors (
            id INT NOT NULL AUTO_INCREMENT,
            codigo INT,
            razon_social VARCHAR(255),
            documento bigint,
            PRIMARY KEY (id)
        );
        ";
    }
}