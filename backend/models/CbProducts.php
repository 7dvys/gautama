<?php 
class CbProducts extends BaseModel{
    public function __construct(){
        $this->name= "cbProducts";
        $this->createSql= 
            "CREATE TABLE IF NOT EXISTS cbProducts(
            id INT NOT NULL AUTO_INCREMENT,
            codigo VARCHAR(255) NOT NULL,
            codigo_barras VARCHAR(255) NOT NULL,
            nombre VARCHAR(500) NOT NULL,
            costo_interno int(20) NOT NULL,
            rentabilidad INT(11) NOT NULL,
            sub_rubro VARCHAR(255),
            proveedor VARCHAR(255),
            PRIMARY KEY (id)
        )";


    }
}
