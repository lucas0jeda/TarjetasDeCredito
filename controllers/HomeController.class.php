<?php
require_once __DIR__.'/../models/CategorysModel.php';

 class HomeController{

    public function home(){
        $categoriesModel = new CategorysModel();
        $categories = $categoriesModel->all();
        return generarHtml("home", ['categories' => $categories]);
    }

}
