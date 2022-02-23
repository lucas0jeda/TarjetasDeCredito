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
    private $url;

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
        $this->url = $args['url'] ?? '';
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
        $this->deleteCascada($id);
        return $result;
    }

    private function deleteCascada($id){
        $query = "delete from beneficios where id_tarjeta = ${id}";
        $result = $this->db->query($query);
        $query = "delete from categorias_tarjetas where id_tarjeta = ${id}";
        $result = $this->db->query($query);
        $query = "delete from lugares_de_pago_tarjetas where id_tarjeta = ${id}";
        $result = $this->db->query($query);
        $query = "delete from requisito_tarjeta where id_tarjeta = ${id}";
        $result = $this->db->query($query);
        $query = "delete from seguros where id_tarjeta = ${id}";
        $result = $this->db->query($query);
        $query = "delete from sistema_de_puntos where id_tarjeta = ${id}";
        $result = $this->db->query($query);
    }

    public function update($id, $nombre, $idSello, $idEmisor, $tipo, $uso, $costoDeEmision, $costoPrimerAnio, $costoRenovacion, $costoAdicionales, $comisionComprasExterior, $pago, $cashback, $programaDePuntos, $limiteDeGastoMaximo, $interesCuotas, $cuentaBancaria, $aumentoDeLimitePorViaje, $costoEnvioEstadoDeCuenta, $envioEstadoDeCuentaEmail, $adelantoDeEfectivo, $informacionAdicional, $Imagen, $fechaDeCierre, $cambioFechaDeCierre, $telefonoParaExtravio, $Contactless, $reimpresionDePlastico, $reimpresionDePin, $reemplazoPorRoboExtravio, $url){
        $query = "UPDATE tarjetas SET url = '${url}', nombre = '${nombre}', id_sello = ${idSello}, id_emisor = ${idEmisor}, tipo = '${tipo}', uso = '${uso}', costo_de_emision = '${costoDeEmision}', costo_primer_anio = '${costoPrimerAnio}', costo_renovacion = '${costoRenovacion}', costo_adicionales = '${costoAdicionales}', comision_compras_exterior = '${comisionComprasExterior}', pago = '${pago}', cashback = ${cashback}, programa_de_puntos = ${programaDePuntos}, limite_de_gasto_maximo = '${limiteDeGastoMaximo}', interes_cuotas = '${interesCuotas}', cuenta_bancaria = ${cuentaBancaria}, costo_envio_estado_de_cuenta = '${costoEnvioEstadoDeCuenta}', envio_estado_de_cuenta_email = ${envioEstadoDeCuentaEmail}, adelanto_de_efectivo = '${adelantoDeEfectivo}', aumento_de_limite_por_viaje = '${aumentoDeLimitePorViaje}', telefono_para_extravio = '${telefonoParaExtravio}', contactless = ${Contactless}, reimpresion_de_plastico = '${reimpresionDePlastico}', reimpresion_de_pin = '${reimpresionDePin}', reemplazo_por_robo_extravio = '${reemplazoPorRoboExtravio}', cambio_fecha_de_cierre = '${cambioFechaDeCierre}', fecha_de_cierre = '${fechaDeCierre}', imagen = '${Imagen}', informacion_adicional = '${informacionAdicional}' WHERE id_tarjeta = ${id} ";
        $result = $this->db->query($query);
        return $result;
    }

    public function selectOne($id){
        // SELECT lp.Nombre as nombreLugarDePago, lp.id_lugar_de_pago as idLugarDePago, lp.logo as logoLugarDePago, e.nombre as nombreEmisor, s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s, lugares_de_pago_tarjetas as lpt, lugares_de_pago as lp where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello AND t.id_tarjeta = lpt.id_tarjeta AND lpt.id_lugar_de_pago = lp.id_lugar_de_pago
        $query = "SELECT e.nombre as nombreEmisor, e.logo as LogoEmisor , s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello  AND t.id_tarjeta = $id";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }

    public function selectOneByUrl($url){
        // SELECT lp.Nombre as nombreLugarDePago, lp.id_lugar_de_pago as idLugarDePago, lp.logo as logoLugarDePago, e.nombre as nombreEmisor, s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s, lugares_de_pago_tarjetas as lpt, lugares_de_pago as lp where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello AND t.id_tarjeta = lpt.id_tarjeta AND lpt.id_lugar_de_pago = lp.id_lugar_de_pago
        $query = "SELECT e.nombre as nombreEmisor, e.logo as LogoEmisor , s.nombre as nombreSello, t.* from tarjetas as t, emisores as e, sellos s where t.id_emisor = e.id_emisor AND t.id_sello = s.id_sello  AND t.url = $url";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result = $select->fetch_object();
        }
        return $result;
    }


    public function insert($nombre, $idSello, $idEmisor, $tipo, $uso, $costoDeEmision, $costoPrimerAnio, $costoRenovacion, $costoAdicionales, $comisionComprasExterior, $pago, $cashback, $programaDePuntos, $limiteDeGastoMaximo, $interesCuotas, $cuentaBancaria, $aumentoDeLimitePorViaje, $costoEnvioEstadoDeCuenta, $envioEstadoDeCuentaEmail, $adelantoDeEfectivo, $informacionAdicional, $Imagen, $fechaDeCierre, $cambioFechaDeCierre, $telefonoParaExtravio, $Contactless, $reimpresionDePlastico, $reimpresionDePin, $reemplazoPorRoboExtravio, $url){
        $query = "insert into tarjetas (url, nombre, id_sello, id_emisor, tipo, uso, costo_de_emision, costo_primer_anio, costo_renovacion, costo_adicionales, comision_compras_exterior, pago, cashback, programa_de_puntos, limite_de_gasto_maximo, interes_cuotas, cuenta_bancaria, costo_envio_estado_de_cuenta, envio_estado_de_cuenta_email, adelanto_de_efectivo, aumento_de_limite_por_viaje, telefono_para_extravio, contactless, reimpresion_de_plastico, reimpresion_de_pin, reemplazo_por_robo_extravio, cambio_fecha_de_cierre, fecha_de_cierre, imagen, informacion_adicional) VALUES ('${url}','${nombre}', ${idSello}, ${idEmisor}, '${tipo}', '${uso}', ${costoDeEmision}, ${costoPrimerAnio}, ${costoRenovacion}, ${costoAdicionales}, ${comisionComprasExterior}, ${pago}, ${cashback}, ${programaDePuntos}, ${limiteDeGastoMaximo}, ${interesCuotas}, ${cuentaBancaria}, ${costoEnvioEstadoDeCuenta}, ${envioEstadoDeCuentaEmail}, ${adelantoDeEfectivo}, ${aumentoDeLimitePorViaje}, ${telefonoParaExtravio}, ${Contactless}, ${reimpresionDePlastico}, ${reimpresionDePin}, ${reemplazoPorRoboExtravio} , ${cambioFechaDeCierre} , ${fechaDeCierre} , '${Imagen}', ${informacionAdicional})";
        $result = $this->db->query($query);
        return $result;
    }

    public function getLugarDePagoTarjetas($id){
        $query = "select lp.id_lugar_de_pago ,lp.Nombre as NombreLugar, t.nombre, t.id_tarjeta from lugares_de_pago as lp ,lugares_de_pago_tarjetas as lpt, tarjetas as t where lpt.id_tarjeta = t.id_tarjeta AND lp.id_lugar_de_pago = lpt.id_lugar_de_pago AND t.id_tarjeta = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function updateLugaresDePagoTarjeta($data){
        if(isset($data)){
            foreach ($data as $value) {
                switch ($value["action"]){
                    case "delete":
                        $query = "DELETE FROM lugares_de_pago_tarjetas WHERE id_tarjeta = ${value["idTarjeta"]} AND id_lugar_de_pago = ${value["id"]}";
                        $result = $this->db->query($query);
                        if(!$result){
                            exit(json_encode($result));
                        }
                        break;
                    case "insert":
                        $query = "INSERT INTO lugares_de_pago_tarjetas (id_lugar_de_pago, id_tarjeta) VALUES (${value["id"]} ,${value["idTarjeta"]})";
                        $result = $this->db->query($query);
                        if(!$result){
                            exit(json_encode($result));
                        }
                        break;
                    default:

                        break;
                }
            }
        }
        exit(json_encode("ok"));
    }

    public function updateCategoriasTarjeta($data){
        if(isset($data)){
            foreach ($data as $value) {
                switch ($value["action"]){
                    case "delete":
                        $query = "DELETE FROM categorias_tarjetas WHERE id_tarjeta = ${value["idTarjeta"]} AND id_categoria = ${value["id"]}";
                        $result = $this->db->query($query);
                        if(!$result){
                            exit(json_encode($result));
                        }
                        break;
                    case "insert":
                        $query = "insert into categorias_tarjetas (id_categoria, id_tarjeta) VALUES (${value["id"]} ,${value["idTarjeta"]})";
                        $result = $this->db->query($query);
                        if(!$result){
                            exit(json_encode($result));
                        }
                        break;
                    default:

                        break;

                }
            }
        }
        exit(json_encode("ok"));
    }

    public function getCategoriasTarjeta($id){
        $query = "select c.id_categoria, c.titulo_categoria as tituloCategoria, t.nombre, t.id_tarjeta from categorias as c,categorias_tarjetas as ct, tarjetas as t where ct.id_tarjeta = t.id_tarjeta AND c.id_categoria = ct.id_categoria AND t.id_tarjeta = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function getRequisitos($id){
        $query = "SELECT RT.* FROM requisito_tarjeta as RT, tarjetas as T WHERE RT.id_tarjeta = T.id_tarjeta AND RT.id_tarjeta = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function getTarjetasCategoria($id){
        $query = "Select e.nombre as NombreEmisor, s.nombre as NombreSello, t.* from categorias_tarjetas as ct,tarjetas as t, sellos as s, emisores as e where ct.id_tarjeta = t.id_tarjeta and s.id_sello = t.id_sello and e.id_emisor = t.id_emisor and ct.id_categoria = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function getTarjetasPorEmisor($id){
        $query = "Select e.nombre as NombreEmisor, s.nombre as NombreSello, t.* from tarjetas as t, sellos as s, emisores as e where s.id_sello = t.id_sello and e.id_emisor = t.id_emisor and e.id_emisor = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if($select){
            $result = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    public function selectCompleteInformation($id){
        $query = "SELECT * from requisito_tarjeta where id_tarjeta = ${id}";
        $result = false;
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result["requisitos"] = $select->fetch_object();
        }
        $query = "SELECT * from beneficios where id_tarjeta = ${id}";
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result["beneficios"] = $select->fetch_object();
        }
        $query = "select * from seguros where id_tarjeta = ${id}";
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result["seguros"] = $select->fetch_object();
        }
        $query = "SELECT * from sistema_de_puntos where id_tarjeta = ${id}";
        $select = $this->db->query($query);
        if(mysqli_num_rows($select) == 1 && $select){
            $result["sistema_de_puntos"] = $select->fetch_object();
        }
        $query = "SELECT LP.* from lugares_de_pago_tarjetas as LPT , lugares_de_pago as LP where LP.id_lugar_de_pago = LPT.id_lugar_de_pago AND LPT.id_tarjeta = ${id}";
        $select = $this->db->query($query);
        if($select){
            $result['lugares_de_pago'] = $select->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }
}




/*


  */