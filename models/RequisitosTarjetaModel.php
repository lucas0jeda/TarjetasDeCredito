<?php

require_once 'DataBase.php';
class RequisitosTarjetaModel{
    private $db;
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
        $this->db = DataBase::conectarDB();
        $this->id = $args['id'] ?? 0;
        $this->id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->ingresos_minimos = $args['ingresos_minimos'] ?? '';
        $this->edad_minima = $args['edad_minima'] ?? 0;
        $this->edad_maxima = $args['edad_maxima'] ?? 0;
        $this->clering = $args['clering'] ?? false;
        $this->antiguedad_laboral = $args['antiguedad_laboral'] ?? '';
        $this->constancia_de_domicilio = $args['constancia_de_domicilio'] ?? false;
        $this->cedula_de_identidad = $args['cedula_de_identidad'] ?? false;
        $this->fotocopia_CI = $args['fotocopia_CI'] ?? false;
        $this->recibo_de_sueldo = $args['recibo_de_sueldo'] ?? false;
        $this->certificado_de_ingresos = $args['certificado_de_ingresos'] ?? false;
    }

    public function insertRequisito($idTarjeta,$ingresosMinimos,$edadMinima,$edadMaxima,$clering,$antiguedadLaboral,$constanciaDeDomicilio,$cedulaDeIdentidad,$fotocopiaCI, $reciboDeSueldo,$certificadoDeIngresos){
        $query = "INSERT INTO requisito_tarjeta (id_tarjeta, ingresos_minimos, edad_minima, edad_maxima, clering, antiguedad_laboral, constancia_de_domicilio, cedula_de_identidad, fotocopia_CI, recibo_de_sueldo, certificado_de_ingresos) VALUES (${idTarjeta},${ingresosMinimos},${edadMinima},${edadMaxima},${clering},${antiguedadLaboral},${constanciaDeDomicilio},${cedulaDeIdentidad},${fotocopiaCI},${reciboDeSueldo},${certificadoDeIngresos})";
        $result = $this->db->query($query);
        return $result;
    }

    public function updateRequisito($id,$idTarjeta,$ingresosMinimos,$edadMinima,$edadMaxima,$clering,$antiguedadLaboral,$constanciaDeDomicilio,$cedulaDeIdentidad,$fotocopiaCI, $reciboDeSueldo,$certificadoDeIngresos){
        $query = "UPDATE requisito_tarjeta SET id_tarjeta = ${idTarjeta}, ingresos_minimos = ${ingresosMinimos}, edad_minima = ${edadMinima}, edad_maxima = ${edadMaxima} , clering = ${clering}, antiguedad_laboral = ${antiguedadLaboral}, constancia_de_domicilio = ${constanciaDeDomicilio}, cedula_de_identidad = ${cedulaDeIdentidad}, fotocopia_CI = ${fotocopiaCI}, recibo_de_sueldo = ${reciboDeSueldo}, certificado_de_ingresos = ${certificadoDeIngresos} WHERE  id = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function deleteRequisito($id){
        $query = "DELETE FROM requisito_tarjeta where id = ${id}";
        $result = $this->db->query($query);
        return $result;
    }
}