<?php


require_once 'DataBase.php';
class BeneficiosModel{
    private $db;
    private $id_beneficio;
    private $id_tarjeta;
    private $titulo_beneficio;
    private $descripcion;
    private $informacion_adicional;
    
    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_beneficio = $args['id_beneficio'] ?? 0;
        $this->id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->titulo_beneficio = $args['titulo_beneficio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->informacion_adicional = $args['informacion_adicional'] ?? '';
    }

    public function all(){
        $query = "select t.nombre as nombreTarjeta ,b.* from tarjetas as t, beneficios as b WHERE b.id_tarjeta = t.id_tarjeta";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectorTarjetaBeneficio(){
        $query = "select * from tarjetas where id_tarjeta NOT IN(select id_tarjeta from beneficios)";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOne($id){
        $query = "select t.nombre as nombreTarjeta ,b.* from tarjetas as t, beneficios as b WHERE b.id_tarjeta = t.id_tarjeta AND b.id_beneficio = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function updateBeneficio($idBeneficio, $idTarjeta, $titulo, $desc, $informacionAdicional){
        $query = "UPDATE beneficios SET id_tarjeta = ${idTarjeta}, titulo_beneficio = '${titulo}', descripcion = ${desc}, informacion_adicional = ${informacionAdicional} WHERE id_beneficio = ${idBeneficio}";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM beneficios WHERE id_beneficio = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function insertBeneficio($idTarjeta, $titulo, $desc, $informacionAdicional){
        $query = "INSERT INTO beneficios (id_tarjeta, titulo_beneficio, descripcion, informacion_adicional) VALUES (${idTarjeta},'${titulo}', ${desc} , ${informacionAdicional})";
        $result = $this->db->query($query);
        return $result;
    }

}