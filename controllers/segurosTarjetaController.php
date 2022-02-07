<?php

require_once './models/SegurosTarjetaModel.php';
class SegurosTarjetaController{

    public function all(){
        $seguro = new SegurosTarjetaModel();
        $result = $seguro->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneSeguro(){
        $seguro = new SegurosTarjetaModel();
        if(isset($_POST['ID'])){
            $result = $seguro->selectOneSeguro($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error seguro no encontrado"));
            }
        }
    }

    public function updateSeguro(){
        $seguro = new SegurosTarjetaModel();
        if(isset($_POST['id']) && isset($_POST['idTarjeta']) && isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['informacionAdicional'])){
            $result = $seguro->update($_POST['id'], $_POST['idTarjeta'], $_POST['titulo'],json_encode($this->SanitizarDatos($_POST['desc'])),json_encode($this->SanitizarDatos($_POST['informacionAdicional'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error seguro no modificado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function deleteSeguro(){
        $seguro = new SegurosTarjetaModel();
        if(isset($_POST['ID'])){
            $result = $seguro->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error seguro no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertSeguro(){
        $seguro = new SegurosTarjetaModel();
        if(isset($_POST['idTarjeta']) && isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['informacionAdicional'])){
            $result = $seguro->insert($_POST['idTarjeta'], $_POST['titulo'], json_encode($this->SanitizarDatos($_POST['desc'])), json_encode($this->SanitizarDatos($_POST['informacionAdicional'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error seguro no insertado"));
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
