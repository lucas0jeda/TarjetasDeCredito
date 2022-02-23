<?php

require_once 'DataBase.php';
class categorysModel{

    private $db;
    private $id_categoria;
    private $titulo_categoria;
    private $informacion;
    private $url;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_categoria = $args['id_categoria'] ?? 0;
        $this->titulo_categoria = $args['titulo_categoria'] ?? '';
        $this->informacion = $args['informacion'] ?? '';
        $this->url = $args['url'] ?? '';
    }

    public function insert($titulo, $info, $url){
        $query = "INSERT INTO categorias (url, titulo_categoria, informacion) VALUES ('${titulo}', ${info} , '${url}')";
        $result = $this->db->query($query);
        return $result;
    }

    public function update($id, $titulo, $info, $url){
        $query = "UPDATE categorias SET titulo_categoria = '${titulo}', informacion = ${info} ,url = '${url}' WHERE id_categoria = ${id} ";

        $result = $this->db->query($query);
        return $result;
    }

    public function selectOne($id){
        $query = "SELECT * FROM categorias WHERE id_categoria='$id'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function selectOneByUrl($url){
        $query = "SELECT * FROM categorias WHERE url='$url'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function selectOneByTitle($titulo){
        $query = "SELECT * FROM categorias WHERE titulo_categoria='$titulo'";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function all(){
        $query = "SELECT * FROM categorias";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM categorias WHERE id_categoria = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

}