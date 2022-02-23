<?php


require_once 'DataBase.php';
class EmisoresModel{

    private $db;
    private $id_emisor;
    private $nombre;
    private $logo;
    private $descripcion;
    private $url;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_emisor = $args['id_emisor'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->logo = $args['logo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->url = $args['url'] ?? '';
    }

    public function all(){
        $query = "SELECT * FROM emisores";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOne($id){
        $query = "SELECT * FROM emisores WHERE id_emisor ='$id'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function selectOneByTitle($title){
        $query = "SELECT * FROM emisores WHERE nombre ='$title'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function selectOneByUrl($url){
        $query = "SELECT * FROM emisores WHERE url ='$url'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function update($id, $nombre, $logo, $descripcion, $url){
        $query = "UPDATE emisores SET nombre = '${nombre}', url = '${url}', descripcion = ${descripcion}, logo = '${logo}' WHERE id_emisor = ${id} ";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM emisores WHERE id_emisor = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function insert($nombre, $logo ,$descripcion, $url){
        $query = "INSERT INTO emisores (nombre, logo, descripcion, url) VALUES ('${nombre}', '${logo}', ${descripcion}, '${url}')";
        $result = $this->db->query($query);
        return $result;
    }
}