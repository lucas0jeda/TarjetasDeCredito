<?php
require_once './models/LugarDePagoModel.php';
class LugarDePagoController{

    public function all(){
        $lugarDePago = new LugarDePagoModel();
        $result = $lugarDePago->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneLugarDePago(){
        $lugarDePago = new LugarDePagoModel();
        if(isset($_POST['ID'])){
            $result = $lugarDePago->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("error lugar de pago no encontrado"));
            }
        }
    }

    public function updateLugarDePago(){
        $lugarDePago = new LugarDePagoModel();
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
        if(isset($_POST['ID']) && isset($_POST['nombre']) && isset($_POST['logo'])){
            $result = $lugarDePago->update($_POST['ID'], $_POST['nombre'], $imagen);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error lugar de pago no modificado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function deleteLugarDePago(){
        $lugarDePago = new LugarDePagoModel();
        if(isset($_POST['ID'])){
            $result = $lugarDePago->selectOne($_POST['ID']);
            $imagen = $result->logo;
            if($imagen != ""){
                $this->eliminarImagen($imagen);
            }
            $result = $lugarDePago->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error lugar de pago no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertLugarDePago(){
        $lugarDePago = new LugarDePagoModel();
        $imagen = '';
        if(isset($_FILES["imagen"])){
            $imagen = $this->guardarImagen($_FILES["imagen"]);
        }
        if(isset($_POST['nombre'])){
            $result = $lugarDePago->insert($_POST['nombre'], $imagen);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error lugar de pago no ingresado"));
            }
        }else{
            exit(json_encode("Error fafltan datos"));
        }
    }

    private function eliminarImagen($imagenData){
        unlink('images/lugarDePagoImg/'.$imagenData);
    }

    private function guardarImagen($imagenData){
        $imagen = $imagenData;
        $nombre = $this->formatearNombres($imagen['name']);
        $nombreTmp = $imagen["tmp_name"];
        $destino = "images/lugarDePagoImg/".$nombre;
        move_uploaded_file($nombreTmp, $destino);
        return $nombre;
    }

    private function formatearNombres($string){
        $result = str_replace(' ', '', $string);
        return $result;
    }
}