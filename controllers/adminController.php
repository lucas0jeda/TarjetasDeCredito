<?php

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