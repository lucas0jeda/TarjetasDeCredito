<?php

require_once 'DataBase.php';
class LugarDePagoModel{

    private $db;
    private $id_lugar_de_pago;
    private $nombre;
    private $logo;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_lugar_de_pago = $args['id_lugar_de_pago'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->logo = $args['logo'] ?? '';
    }

    public function all(){
        $query = "SELECT * FROM lugares_de_pago";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOne($id){
        $query = "SELECT * FROM lugares_de_pago WHERE id_lugar_de_pago ='$id'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function update($id, $nombre, $logo){
        $query = "UPDATE lugares_de_pago SET Nombre = '${nombre}', logo = '${logo}' WHERE id_lugar_de_pago = ${id} ";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM lugares_de_pago WHERE id_lugar_de_pago = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function insert($nombre, $logo){
        $query = "INSERT INTO lugares_de_pago (Nombre, logo) VALUES ('${nombre}', ${logo})";
        $result = $this->db->query($query);
        return $result;
    }

}