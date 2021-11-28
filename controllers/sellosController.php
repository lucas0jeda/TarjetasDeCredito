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
            $result = $sello->update($_POST['ID'], $_POST['nombre'], $_POST['desc']);
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
            $result = $sello->insert($_POST['nombre'],$_POST['descripcion']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error sello no insertado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }
}

