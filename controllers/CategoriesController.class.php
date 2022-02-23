<?php
require_once __DIR__.'/../models/CategorysModel.php';
require_once __DIR__.'/../models/TarjetasModel.php';
class CategoriesController
{


    private function getIdCategoriaByTitle($title){
        $categoria = new CategorysModel();
        $categoria = $categoria->selectOneByUrl($title);
        if($categoria){
            return $categoria->id_categoria;
        }
        header('Location: /');
        die();
    }

    public function category()
    {  
        $r = $_SERVER['REQUEST_URI']; 
        $r = explode('/', $r);
        if(!isset($r[1])){    
            header('Location: /');
            die();
        } 
        $value = self::getIdCategoriaByTitle($r[1]);
        $tarjeta = new TarjetasModel();
        $result = $tarjeta->getTarjetasCategoria((int) $value);
        $categoria = new CategorysModel();
        $categoria = $categoria->selectOne((int) $value);
        return generarHtml("category", ['tarjetas' => $result, 'categoria' => $categoria]);

    }
}