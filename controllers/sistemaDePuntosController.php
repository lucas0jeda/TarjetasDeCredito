<?php

require_once './models/SistemaDePuntosModel.php';
class SistemaDePuntosController{

    public function all(){
        $sisPuntos = new SistemaDePuntosModel();
        $result = $sisPuntos->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneSistemaDePuntos(){
        $sisPuntos = new SistemaDePuntosModel();
        if(isset($_POST['ID'])){
            $result = $sisPuntos->selectOneSistemaDePuntos($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("error emisor no encontrado"));
            }
        }
    }

    public function updateSistemaDePuntos(){
        $sisPuntos = new SistemaDePuntosModel();
        if(isset($_POST['ID']) && isset($_POST['tarjetaId']) && isset($_POST['nombre']) && isset($_POST['equivalencia']) && isset($_POST['informacion']) && isset($_POST['link'])){
            $result = $sisPuntos->updateSistemaDePuntos($_POST['ID'], $_POST['tarjetaId'],$_POST['nombre'],$_POST['equivalencia'],json_encode($this->SanitizarDatos($_POST['informacion'])),$_POST['link']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sistema de puntos no modificado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function deleteSistemaDePuntos(){
        $sisPuntos = new SistemaDePuntosModel();
        if(isset($_POST['ID'])){
            $result = $sisPuntos->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sistema de puntos no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertSistemaDePuntos(){
        $sisPuntos = new SistemaDePuntosModel();
        if(isset($_POST['tarjetaId']) && isset($_POST['nombre']) && isset($_POST['equivalencia']) && isset($_POST['informacion']) && isset($_POST['link'])){
            $result = $sisPuntos->insertSistemaDePuntos($_POST['tarjetaId'],$_POST['nombre'],$_POST['equivalencia'],json_encode($this->SanitizarDatos($_POST['informacion'])),$_POST['link']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error beneficio no insertado"));
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



