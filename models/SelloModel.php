<?php


class SelloModel{
    private $db;
    private $id_sello;
    private $nombre;
    private $logo;
    private $decripcion;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_sello = $args['id_sello'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->logo = $args['logo'] ?? '';
        $this->decripcion = $args['descripcion'] ?? '';
    }

    public function all(){
        $query = "SELECT * FROM sellos";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOne($id){
        $query = "select * from sellos where id_sello ='$id'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function update($id, $nombre, $logo,$descripcion){
        $query = "UPDATE sellos SET nombre = '${nombre}', descripcion = ${descripcion}, logo = '${logo}' WHERE id_sello = ${id} ";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM sellos WHERE id_sello = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function insert($nombre, $logo,$descripcion){
        $query = "INSERT INTO sellos (nombre, logo, descripcion) VALUES ('${nombre}', '${logo}', ${descripcion})";
        $result = $this->db->query($query);
        return $result;
    }
}