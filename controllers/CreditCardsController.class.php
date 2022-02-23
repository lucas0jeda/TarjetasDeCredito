<?php

require_once __DIR__.'/../models/TarjetasModel.php';

class CreditCardsController{



    private function getIdCreditCard($title){
        $tarjeta = new TarjetasModel();
        $tarjeta = $tarjeta->selectOneByUrl($title);
        if($tarjeta){
            return $tarjeta->id_tarjeta;
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
        $value = self::getIdCreditCard($r[1]);
        $tarjetaInstance = new TarjetasModel();
        $card = $tarjetaInstance->selectOne((int) $value);
        $moreInformation = $tarjetaInstance->selectCompleteInformation((int) $value);
        $card->MoreInformation = $moreInformation;
        return generarHtml("credit-cards", ['card' => $card]);
    }


}
