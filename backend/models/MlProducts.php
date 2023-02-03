<?php

class MlProducts extends BaseModel{
    public function __construct(){
        $this->name= "mlProducts";
        $this->createSql= 
            "CREATE TABLE IF NOT EXISTS mlProducts (
            id int not null AUTO_INCREMENT,
            numero_publicacion varchar(50),
            numero_variante varchar(50),
            sku varchar (255),
            titulo varchar (255),
            variantes varchar (255),
            cantidad int (11),
            canal_venta varchar (50),
            precio_mercadolibre decimal (40,4),
            precio_mercadoshops decimal (40,4),
            precio_vincular varchar (100),
            moneda varchar (3),
            condicion varchar (15),
            forma_envio_mercadolibre varchar (200),
            forma_envio_mercadoshops varchar (200),
            retiro_en_persona varchar(20),
            tipo_publicacion varchar (20),
            cargo_venta_mercadolibre decimal (5,2),
            cargo_venta_mercadoshops decimal (5,2),
            estado varchar (20),
            tipo_garantia varchar(200),
            tiempo_garantia int(20),
            duracion_garantia varchar (100),
            disponibilidad_stock varchar (100),
            categoria varchar (100),
            PRIMARY KEY (id)
        )";
    }    
}