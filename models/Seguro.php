<?php

class Seguro{
    private $id_seguro;
    private $id_tarjeta;
    private $titulo_seguro;
    private $descripcion;
    private $informacion_adicional;

    function __construct($args = []){
        $this->$id_seguro = $args['id_seguro'] ?? 0;
        $this->$id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->$titulo_seguro = $args['titulo_seguro'] ?? '';
        $this->$descripcion = $args['descripcion'] ?? '';
        $this->$informacion_adicional = $args['informacion_adicional'] ?? '';
    }

    
}