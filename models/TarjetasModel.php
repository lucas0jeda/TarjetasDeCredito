<?php
require_once 'DataBase.php';
class TarjetasModel {
    private $db;
    private $id_tarjeta;
    private $nombre;
    private $id_sello;
    private $id_emisor;
    private $tipo;
    private $uso;
    private $costo_de_emison;
    private $costo_primer_anio;
    private $costo_renovacion;
    private $costo_adicionales;
    private $comision_compras_exterior;
    private $pago;
    private $cashback;
    private $programa_de_puntos;
    private $limite_de_gasto_maximo;
    private $interes_cuotas;
    private $cuenta_bancaria;
    private $costo_envio_estado_de_cuenta;
    private $envio_estado_de_cuenta_email;
    private $adelanto_de_efectivo;
    private $aumento_de_limite_por_viaje;
    private $telefono_para_extravio;
    private $contactless;
    private $reimpresion_de_plastico;
    private $reimpresion_de_pin;
    private $cambio_fecha_de_cierre;
    private $fecha_de_cierre;
    private $imagen;
    private $informacion_adicional;

    function __construct($args = []){
        $this->db = DataBase::conectarDB();
        $this->id_tarjeta = $args['id_tarjeta'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->id_sello = $args['id_sello'] ?? 0;
        $this->id_emisor = $args['id_emisor'] ?? 0;
        $this->tipo = $args['tipo'] ?? '';
        $this->uso = $args['uso'] ?? '';
        $this->costo_de_emison = $args['costo_de_emison'] ?? '';
        $this->costo_primer_anio = $args['costo_primer_anio'] ?? '';
        $this->costo_renovacion = $args['costo_renovacion'] ?? '';
        $this->costo_adicionales = $args['costo_adicionales'] ?? '';
        $this->comision_compras_exterior = $args['comision_compras_exterior'] ?? '';
        $this->pago = $args['pago'] ?? '';
        $this->cashback = $args['cashback'] ?? false;
        $this->programa_de_puntos = $args['programa_de_puntos'] ?? false;
        $this->limite_de_gasto_maximo = $args['limite_de_gasto_maximo'] ?? '';
        $this->interes_cuotas = $args['interes_cuotas'] ?? '';
        $this->cuenta_bancaria = $args['cuenta_bancaria'] ?? false;
        $this->costo_envio_estado_de_cuenta = $args['costo_envio_estado_de_cuenta'] ?? '';
        $this->envio_estado_de_cuenta_email = $args['envio_estado_de_cuenta_email'] ?? false;
        $this->adelanto_de_efectivo = $args['adelanto_de_efectivo'] ?? '';
        $this->aumento_de_limite_por_viaje = $args['aumento_de_limite_por_viaje'] ?? '';
        $this->telefono_para_extravio = $args['telefono_para_extravio'] ?? '';
        $this->contactless = $args['contactless'] ?? false;
        $this->reimpresion_de_plastico = $args['reimpresion_de_plastico'] ?? '';
        $this->reimpresion_de_pin = $args['reimpresion_de_pin'] ?? '';
        $this->cambio_fecha_de_cierre = $args['cambio_fecha_de_cierre'] ?? '';
        $this->fecha_de_cierre = $args['fecha_de_cierre'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->informacion_adicional = $args['informacion_adicional'] ?? '';
    }

    public function all(){
        $query = "SELECT e.nombre as nombreEmisor, s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function delete($id){
        $query = "DELETE FROM tarjetas WHERE id_tarjeta = ${id}";
        $result = $this->db->query($query);
        return $result;
    }

    public function selectOne($id){
        $query = "SELECT e.nombre as nombreEmisor, s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello  AND t.id_tarjeta = $id";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }
}

/*
 insert into tarjetas (nombre, id_sello, id_emisor, tipo, uso, costo_de_emision, costo_primer_anio, costo_renovacion, costo_adicionales, comision_compras_exterior, pago, cashback, programa_de_puntos, limite_de_gasto_maximo, interes_cuotas, cuenta_bancaria, costo_envio_estado_de_cuenta, envio_estado_de_cuenta_email, adelanto_de_efectivo, aumento_de_limite_por_viaje, telefono_para_extravio, contactless, reimpresion_de_plastico, reimpresion_de_pin, reemplazo_por_robo_extravio, cambio_fecha_de_cierre, fecha_de_cierre, imagen, informacion_adicional) VALUES ()

  */