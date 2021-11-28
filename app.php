<?php

require __DIR__.'/autoload.php';

if(isset($_GET['controller'])){
    $name_controller = $_GET['controller']."Controller";
}else{
    PublicController::error("No existe controller");
}



$nameclass = ucfirst($name_controller);

if(class_exists($nameclass)){
    $controller = new $nameclass();
    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    }else{
        PublicController::error("Falta action o no exite metodo");
    }
}else{
    PublicController::error($nameclass);
}