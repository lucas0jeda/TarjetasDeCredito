<?php
require_once __DIR__.'/../models/CategorysModel.php';
require_once __DIR__.'/../models/SelloModel.php';
require_once __DIR__.'/../models/EmisoresModel.php';
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
        $categoriaModel = new CategorysModel();
        $categoria = $categoriaModel->selectOne((int) $value);

        $categories = $categoriaModel->all();
        $sellosModel = new SelloModel();
        $sellos = $sellosModel->all();
        $emisoresModel = new EmisoresModel();
        $emisores = $emisoresModel->all();
        $tarjetas = $tarjeta->all();

        return generarHtml("category", ['tarjeta' => $result, 'categoria' => $categoria, 'categories' => $categories, 'sellos' => $sellos,'emisores' => $emisores, 'tarjetas' => $tarjetas]);

    }
}