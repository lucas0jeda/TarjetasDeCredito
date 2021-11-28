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
        if(isset($_POST['ID']) && isset($_POST['nombre']) && isset($_POST['descripcion'])){
            $result = $emisores->update($_POST['ID'], $_POST['nombre'], $_POST['descripcion']);
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
        if(isset($_POST['nombre']) && isset($_POST['descripcion'])){
            $result = $emisores->insert($_POST['nombre'],$_POST['descripcion']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error emisor no insertado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }
}
