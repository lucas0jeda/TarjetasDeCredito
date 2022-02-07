<?php
require_once 'DataBase.php';
class SegurosTarjetaModel{
    private $db;
    private $id_seguro;
    private $id_tarjeta;
    private $titulo_seguro;
    private $descripcion;
    private $informacion_adicional;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_seguro = $args['id_seguro'] ?? 0;
        $this->id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->titulo_seguro = $args['titulo_seguro'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->informacion_adicional = $args['informacion_adicional'] ?? '';
    }

    public function all(){
        $query = "select t.nombre as nombreTarjeta ,s.* from tarjetas as t, seguros as s WHERE s.id_tarjeta = t.id_tarjeta";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOneSeguro($id){
        $query = "select t.nombre as nombreTarjeta ,s.* from tarjetas as t, seguros as s WHERE s.id_tarjeta = t.id_tarjeta AND s.id_seguro = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function insert($idTarjeta, $titulo, $desc, $informacionAdicional){
        $query = "INSERT INTO seguros (id_tarjeta, titulo_seguro, descripcion, informacion_adicional) VALUES (${idTarjeta},'${titulo}',${desc},${informacionAdicional})";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM seguros WHERE id_seguro = ${id} ";
        $result = $this->db->query($query);
        return $result;
    }

    public function update($id,$idTarjeta, $titulo, $desc, $informacionAdicional){
        $query = "UPDATE seguros SET id_tarjeta = ${idTarjeta}, titulo_seguro = '${titulo}', descripcion = ${desc}, informacion_adicional = ${informacionAdicional} WHERE id_seguro = ${id}";
        $result = $this->db->query($query);
        return $result;
    }
    
}