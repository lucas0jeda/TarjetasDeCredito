<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}


require_once './models/AdminModel.php';
require_once './models/CategorysModel.php';

class AdminController{

    public function login(){
        $admin = new AdminModel();
        if(isset($_POST['username']) && isset($_POST['password'])){
            $result = $admin->login($_POST['username'],  $_POST['password']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode('No result'));
            }
        }else{
           exit(json_encode("Faltan datos"));
        }
    }

}