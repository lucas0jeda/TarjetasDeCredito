<?php

require_once 'DataBase.php';

class SistemaDePuntosModel{
    private $db;
    private $id;
    private $id_tarjeta;
    private $nombre;
    private $equivalencia;
    private $informacion_adicional;
    private $link_de_catalogo;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id = $args['id'] ?? 0;
        $this->id_tarjeta = $args['id_tarjeta'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->equivalencia = $args['equivalencia'] ?? '';
        $this->informacion_adicional = $args['informacion_adicional'] ?? '';
        $this->link_de_catalogo = $args['link_de_catalogo'] ?? '';
    }

    public function all(){
        $query = "SELECT t.nombre as nombreTarjeta,s.* FROM tarjetas as t, sistema_de_puntos as s where t.id_tarjeta = s.id_tarjeta";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectOneSistemaDePuntos($id){
        $query = "SELECT t.nombre as nombreTarjeta,s.* FROM tarjetas as t, sistema_de_puntos as s where t.id_tarjeta = s.id_tarjeta and s.id = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function updateSistemaDePuntos($id, $idTarjeta, $nombre, $equivalencia, $infoAdicional, $linkDeCatlogo){
        $query = "update sistema_de_puntos set id_tarjeta = ${idTarjeta}, Nombre = '${nombre}', equivalencia = '${equivalencia}', informacion_adicional = ${infoAdicional}, link_de_catalogo = '${linkDeCatlogo}'  where id = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM sistema_de_puntos WHERE id = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function insertSistemaDePuntos($idTarjeta, $nombre, $equivalencia, $infoAdicional, $linkDeCatlogo){
        $query = "INSERT into sistema_de_puntos (id_tarjeta, Nombre, equivalencia, informacion_adicional, link_de_catalogo) VALUES (${idTarjeta}, '${nombre}', '${equivalencia}', ${infoAdicional}, '${linkDeCatlogo}')";
        $result = $this->db->query($query);
        return $result;
    }

}