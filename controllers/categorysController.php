<?php
require_once './models/CategorysModel.php';
class CategorysController{

    public function all(){
        $Categorys = new CategorysModel();
        $result = $Categorys->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneCategory(){
        $Categorys = new CategorysModel();
        if(isset($_POST['ID'])){
            $result = $Categorys->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("error categoria no encontrada"));
            }
        }
    }

    public function updateCategory(){
        $Categorys = new CategorysModel();
        if(isset($_POST['ID']) && isset($_POST['titulo']) && isset($_POST['informacion'])){
            $result = $Categorys->update($_POST['ID'], $_POST['titulo'], $_POST['informacion']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error categoria no modificada"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function deleteCategory(){
        $Categorys = new CategorysModel();
        if(isset($_POST['ID'])){
            $result = $Categorys->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error categoria no eliminada"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertCategory(){
        $Categorys = new CategorysModel();
        if(isset($_POST['titulo']) && isset($_POST['informacion'])){
            $result = $Categorys->insert($_POST['titulo'],$_POST['informacion']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error categoria no insertada"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }
}