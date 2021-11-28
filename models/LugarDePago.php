<?php


class LugarDePago{
    private $id_lugar_de_pago;
    private $nombre;
    private $logo;

    function __construct($args = []){
        $this->$id_lugar_de_pago = $args['id_lugar_de_pago'] ?? 0;
        $this->$nombre = $args['nombre'] ?? '';
        $this->$logo = $args['logo'] ?? '';
    }

    
}