<?php
require_once __DIR__.'/../models/CategorysModel.php';
require_once __DIR__.'/../models/SelloModel.php';
require_once __DIR__.'/../models/EmisoresModel.php';
require_once __DIR__.'/../models/TarjetasModel.php';

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

        $categoriesModel = new CategorysModel();
        $categories = $categoriesModel->all();
        $sellosModel = new SelloModel();
        $sellos = $sellosModel->all();
        $emisoresModel = new EmisoresModel();
        $emisores = $emisoresModel->all();
        $tarjetas = $tarjetaModel->all();
        return generarHtml("emisor", ['card' => $card, 'emisor' => $emisor, 'categories' => $categories, 'sellos' => $sellos,'emisores' => $emisores, 'tarjetas' => $tarjetas]);
    }


}
