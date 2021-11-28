<?php

class SistemaDePuntos{
    private $id;
    private $id_tarjeta;
    private $nombre;
    private $equivalencia;
    private $informacion_adicional;
    private $link_de_catalogo;

    function __construct($args = []){
        $this->$id = $args['id'] ?? 0;
        $this->$id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->$nombre = $args['nombre'] ?? '';
        $this->$equivalencia = $args['equivalencia'] ?? '';
        $this->$informacion_adicional = $args['informacion_adicional'] ?? '';
        $this->$link_de_catalogo = $args['link_de_catalogo'] ?? '';
    }

}