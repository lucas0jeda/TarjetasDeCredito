<?php



class Beneficio{
    private $id_beneficio;
    private $id_tarjeta;
    private $titulo_beneficio;
    private $descripcion;
    private $informacion_adicional;
    
    function __construct($args = []){
        $this->$id_beneficio = $args['id_beneficio'] ?? 0;
        $this->$id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->$titulo_beneficio = $args['titulo_beneficio'] ?? '';
        $this->$descripcion = $args['descripcion'] ?? '';
        $this->$informacion_adicional = $args['informacion_adicional'] ?? '';
    }

    
}