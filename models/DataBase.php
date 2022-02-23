<?php


class DataBase{

    public static function conectarDB() : mysqli{
         $db = new mysqli('localhost:8889', 'test', 'Clavered1!', 'tarjetasdecredito');
        
        if ($db->connect_errno) {
            printf("Falló la conexión: ".$db->connect_error);
            exit();
        }
        return $db;
    }

}
