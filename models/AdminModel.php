<?php

require_once 'DataBase.php';
class AdminModel{
    
    private $db;
    private $id;
    private $usuario;
    private $password;

    public function __construct($id = 0, $usuario = "", $password = ""){
        $this->db = DataBase::conectarDB();
        $this->id = $id;
        $this->usuario = $usuario;
        $this->password = $password;
    }

    public function login($user, $pass){
        $query = "SELECT * FROM admins WHERE usuario='$user' AND pass='$pass'";
        $result = false;
        $login = $this->db->query($query);
        if(mysqli_num_rows($login) == 1 && $login){
            $result = $login->fetch_object();
        }
        return $result;
    }

}