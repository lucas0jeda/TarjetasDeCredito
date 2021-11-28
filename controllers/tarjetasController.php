<?php

require_once './models/TarjetasModel.php';

class TarjetasController{

    public function all(){
        $tarjetas = new TarjetasModel();
        $result = $tarjetas->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function deleteCard(){
        $card = new TarjetasModel();
        if(isset($_POST['ID'])){
            $result = $card->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no eliminada"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function selectOneTarjeta(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['ID'])){
            $result = $tarjeta->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no encontrada"));
            }
        }
    }
}