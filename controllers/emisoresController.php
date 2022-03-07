<?php

require_once './models/EmisoresModel.php';
class EmisoresController{

    public function all(){
        $emisores = new EmisoresModel();
        $result = $emisores->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneEmisores(){
        $emisores = new EmisoresModel();
        if(isset($_POST['ID'])){
            $result = $emisores->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("error emisor no encontrado"));
            }
        }
    }

    public function updateEmisor(){
        $emisores = new EmisoresModel();
        $imagen = '';
        if(isset($_FILES["imagen"])) {
            if($_POST['logoActual'] != $_FILES["imagen"]['name']){
                $this->eliminarImagen($_POST['logoActual']);
                $imagen = $this->guardarImagen($_FILES["imagen"]);
            }else{
                $imagen = $_POST['logoActual'];
            }
        }else{
            $imagen = $_POST['logoActual'];
        }
        if(isset($_POST['ID']) && isset($_POST['nombre']) && isset($_POST['descripcion'])){
            $result = $emisores->update($_POST['ID'], $_POST['nombre'], $imagen ,json_encode($this->SanitizarDatos($_POST['descripcion'])), $_POST['urlForm']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error emisor no modificado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function deleteEmisor(){
        $emisores = new EmisoresModel();
        if(isset($_POST['ID'])){
            $result = $emisores->selectOne($_POST['ID']);
            $imagen = $result->logo;
            if($imagen != ""){
                $this->eliminarImagen($imagen);
            }
            $result = $emisores->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error emisor no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertEmisor(){
        $emisores = new EmisoresModel();
        $imagen = '';
        if(isset($_FILES["imagen"])){
            $imagen = $this->guardarImagen($_FILES["imagen"]);
        }
        if(isset($_POST['nombre']) && isset($_POST['descripcion'])){
            $result = $emisores->insert($_POST['nombre'], $imagen ,json_encode($this->SanitizarDatos($_POST['descripcion'])),$_POST['urlForm']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error emisor no insertado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    private function eliminarImagen($imagenData){
        unlink('images/emisorImg/logos/'.$imagenData);
    }

    private function guardarImagen($imagenData){
        $imagen = $imagenData;
        $nombre = $this->formatearNombres($imagen['name']);
        $nombreTmp = $imagen["tmp_name"];
        $destino = "images/emisorImg/logos/".$nombre;
        move_uploaded_file($nombreTmp, $destino);
        return $nombre;
    }

    private function formatearNombres($string){
        $result = str_replace(' ', '', $string);
        return $result;
    }

    private function SanitizarDatos($dato){
        $texto = preg_replace('([^A-Za-z0-9 ,.\r|\n])', '', $dato);
        return $texto;
    }
}
