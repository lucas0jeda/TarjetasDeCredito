<?php

require_once './models/AdminModel.php';
require_once './models/SelloModel.php';

class SellosController{

    public function all(){
        $sello = new SelloModel();
        $result = $sello->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneSello(){
        $sello = new SelloModel();
        if(isset($_POST['ID'])){
            $result = $sello->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sello no encontrada"));
            }
        }
    }

    public function updateSello(){
        $sello = new SelloModel();
        if(isset($_POST['ID']) && isset($_POST['nombre']) && isset($_POST['desc'])){
            $result = $sello->update($_POST['ID'], $_POST['nombre'], 'logo',json_encode($this->SanitizarDatos($_POST['desc'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sello no modificado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function deleteSello(){
        $sello = new SelloModel();
        if(isset($_POST['ID'])){
            $result = $sello->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sello no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertSello(){
        $sello = new SelloModel();
        if(isset($_POST['nombre']) && isset($_POST['descripcion'])){
            $result = $sello->insert($_POST['nombre'], 'logo',json_encode($this->SanitizarDatos($_POST['descripcion'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sello no insertado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    private function eliminarImagen($imagenData){
        unlink('images/sellosImg/'.$imagenData);
    }

    private function guardarImagen($imagenData){
        $imagen = $imagenData;
        $nombre = $this->formatearNombres($imagen['name']);
        $nombreTmp = $imagen["tmp_name"];
        $destino = __DIR__."/sellosImg/".$nombre;
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

