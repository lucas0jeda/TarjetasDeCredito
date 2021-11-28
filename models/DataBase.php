<?php


class DataBase{

    public static function conectarDB() : mysqli{

        $db = new mysqli('localhost', 'root', '', 'tarjetasdecredito');
        if ($db->connect_errno) {
            printf("Falló la conexión: %s\n", $mysqli->connect_error);
            exit();
        }
        return $db;
    }

}
