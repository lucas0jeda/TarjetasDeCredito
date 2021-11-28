<?php


class RequisitoTarjeta{
    private $id;
    private $id_tarjeta;
    private $ingresos_minimos;
    private $edad_minima;
    private $edad_maxima;
    private $clering;
    private $antiguedad_laboral;
    private $constancia_de_domicilio;
    private $cedula_de_identidad;
    private $fotocopia_CI;
    private $recibo_de_sueldo;
    private $certificado_de_ingresos;

    function __construct($args = []){
        $this->$id = $args['id'] ?? 0;
        $this->$id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->$ingresos_minimos = $args['ingresos_minimos'] ?? '';
        $this->$edad_minima = $args['edad_minima'] ?? 0;
        $this->$edad_maxima = $args['edad_maxima'] ?? 0;
        $this->$clering = $args['clering'] ?? false;
        $this->$antiguedad_laboral = $args['antiguedad_laboral'] ?? '';
        $this->$constancia_de_domicilio = $args['constancia_de_domicilio'] ?? false;
        $this->$cedula_de_identidad = $args['cedula_de_identidad'] ?? false;
        $this->$fotocopia_CI = $args['fotocopia_CI'] ?? false;
        $this->$recibo_de_sueldo = $args['recibo_de_sueldo'] ?? false;
        $this->$certificado_de_ingresos = $args['certificado_de_ingresos'] ?? false;
    }

    
}