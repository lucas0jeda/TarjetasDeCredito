<?php
require_once __DIR__.'/../models/CategorysModel.php';
require_once __DIR__.'/../models/SelloModel.php';
require_once __DIR__.'/../models/EmisoresModel.php';
require_once __DIR__.'/../models/TarjetasModel.php';

 class HomeController{

    public function home(){
        $categoriesModel = new CategorysModel();
        $categories = $categoriesModel->all();
        $sellosModel = new SelloModel();
        $sellos = $sellosModel->all();
        $emisoresModel = new EmisoresModel();
        $emisores = $emisoresModel->all();
        $tarjetasModel = new TarjetasModel();
        $tarjetas = $tarjetasModel->all();
        return generarHtml("home", ['categories' => $categories, 'sellos' => $sellos,'emisores' => $emisores, 'tarjetas' => $tarjetas]);
    }

}
