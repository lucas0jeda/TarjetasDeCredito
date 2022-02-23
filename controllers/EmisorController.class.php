<?php
require_once __DIR__.'/../models/TarjetasModel.php';

require_once __DIR__.'/../models/EmisoresModel.php';

class EmisorController{

    private function getIdEmsiorByNombre($nombre){
        $emisor = new EmisoresModel();
        $emisor = $emisor->selectOneByUrl($nombre);
        if($emisor){
            return $emisor->id_emisor;
        }
        header('Location: /');
        die();
    }

    public function get(){
        $r = $_SERVER['REQUEST_URI']; 
        $r = explode('/', $r);
        if(!isset($r[1])){    
            header('Location: /');
            die();
        }
        $value = self::getIdEmsiorByNombre($r[1]);
        $tarjetaModel = new TarjetasModel();
        $card = $tarjetaModel->getTarjetasPorEmisor((int) $value);
        $emisor = new EmisoresModel();
        $emisor = $emisor->selectOne((int) $value);
        return generarHtml("emisor", ['card' => $card, 'emisor' => $emisor]);
    }


}
