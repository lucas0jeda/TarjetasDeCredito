<?php
require_once '/models/RequisitosTarjetaModel.php';
class RequisitosTarjetaController{

    public function insertRequisito(){
        $requisito = new RequisitosTarjetaModel();
        if(isset($_POST['tarjeta'])){
            $result = $requisito->insertRequisito($_POST['tarjeta'],json_encode($this->SanitizarDatos($_POST['ingresosMinimos'])),$_POST['edad_minima'],$_POST['edad_maxima'],$_POST['clering'],json_encode($this->SanitizarDatos($_POST['antiguedad_laboral'])),$_POST['constancia_de_domicilio'],$_POST['cedula_de_identidad'],$_POST['fotocopia_CI'],$_POST['recibo_de_sueldo'],$_POST['certificado_de_ingresos']);
            if(true){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error requisito no ingresado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function updateRequisito(){
        $requisito = new RequisitosTarjetaModel();
        if(isset($_POST['tarjeta']) && isset($_POST['id'])){
            $result = $requisito->updateRequisito($_POST['id'],$_POST['tarjeta'],json_encode($this->SanitizarDatos($_POST['ingresosMinimos'])),$_POST['edad_minima'],$_POST['edad_maxima'],$_POST['clering'],json_encode($this->SanitizarDatos($_POST['antiguedad_laboral'])),$_POST['constancia_de_domicilio'],$_POST['cedula_de_identidad'],$_POST['fotocopia_CI'],$_POST['recibo_de_sueldo'],$_POST['certificado_de_ingresos']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error requisito no modificado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function deleteRequisito(){
        $requisito = new RequisitosTarjetaModel();
        if(isset($_POST['id'])){
            $result = $requisito->deleteRequisito($_POST['id']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error requisito no eliminado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    private function SanitizarDatos($dato){
        $texto = preg_replace('([^A-Za-z0-9 ,.\r|\n])', '', $dato);
        return $texto;
    }
}