<?php

require_once './models/TarjetasModel.php';

class TarjetasController{

    public function all(){
        $tarjetas = new TarjetasModel();
        $result = $tarjetas->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function deleteCard(){
        $card = new TarjetasModel();
        if(isset($_POST['ID'])){
            $result = $card->selectOne($_POST['ID']);
            $imagen = $result->imagen;
            if($imagen != ""){
                $this->eliminarImagen($imagen);
            }
            $result = $card->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no eliminada"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function selectOneTarjeta(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['ID'])){
            $result = $tarjeta->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no encontrada"));
            }
        }
    }

    public function updateCard(){
        $tarjeta = new TarjetasModel();
        $imagen = '';
        if(isset($_FILES["imagen"])) {
            if($_POST['imagenActual'] != $_FILES["imagen"]['name']){
                $this->eliminarImagen($_POST['imagenActual']);
                $imagen = $this->guardarImagen($_FILES["imagen"]);
            }else{
                $imagen = $_POST['imagenActual'];
            }
        }else{
            $imagen = $_POST['imagenActual'];
        }
        if(isset($_POST['id_tarjeta']) && isset($_POST['nombre']) && isset($_POST['id_sello']) && isset($_POST['id_emisor']) && isset($_POST['tipo']) && isset($_POST['uso'])){
            $result = $tarjeta->update($_POST['id_tarjeta'],
                $_POST['nombre'],
                $_POST['id_sello'],
                $_POST['id_emisor'],
                $_POST['tipo'],
                $_POST['uso'],
                $_POST['costo_de_emision'],
                $_POST['costo_primer_anio'],
                $_POST['costo_renovacion'],
                $_POST['costo_adicionales'],
                $_POST['comision_compras_exterior'],
                $_POST['pago'] ,
                $_POST['cashback'],
                $_POST['programa_de_puntos'],
                $_POST['limite_de_gasto_maximo'],
                $_POST['interes_cuotas'],
                $_POST['cuenta_bancaria'],
                $_POST['aumento_de_limite_por_viaje'] ,
                $_POST['costo_envio_estado_de_cuenta'],
                $_POST['envio_estado_de_cuenta_email']  ,
                $_POST['adelanto_de_efectivo']  ,
                $_POST['informacion_adicional'] ,
                $imagen,
                $_POST['fecha_de_cierre']  ,
                $_POST['cambio_fecha_de_cierre'] ,
                $_POST['telefono_para_extravio'] ,
                $_POST['contactless'],
                $_POST['reimpresion_de_plastico'],
                $_POST['reimpresion_de_pin'],
                $_POST['reemplazo_por_robo_extravio'],
                $_POST['urlForm'],
                $_POST['urlpedido'],
                ($_POST['recomendado']=="true" ? 1 : 0));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no modificada"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function insertCard(){
        $tarjeta = new TarjetasModel();
        $imagen = '';
        if(isset($_FILES["imagen"])){
            $imagen = $this->guardarImagen($_FILES["imagen"]);
        }
        if(isset($_POST['nombre']) && isset($_POST['id_sello']) && isset($_POST['id_emisor']) && isset($_POST['tipo']) && isset($_POST['uso'])){
            // ECODEAR TODOS LOS TEXT AREA. DESARROLLAR METODO DE SANETIZACION DE LOS DATOS.
            $result = $tarjeta->insert(
                $_POST['nombre'] ?? '',
                $_POST['id_sello'] ?? '',
                $_POST['id_emisor']?? '',
                $_POST['tipo']?? '',
                $_POST['uso']?? '',
                $this->SanitizarDatos($_POST['costo_de_emision'])?? '',
                $this->SanitizarDatos($_POST['costo_primer_anio'])?? '',
                ($this->SanitizarDatos($_POST['costo_renovacion']))?? '',
                ($this->SanitizarDatos($_POST['costo_adicionales']))?? '',
                ($this->SanitizarDatos($_POST['comision_compras_exterior'])) ?? '',
                ($this->SanitizarDatos($_POST['pago']))?? '',
                $_POST['cashback']?? '',
                $_POST['programa_de_puntos']?? '',
                ($this->SanitizarDatos($_POST['limite_de_gasto_maximo']))?? '',
                ($this->SanitizarDatos($_POST['interes_cuotas']))?? '',
                $_POST['cuenta_bancaria']?? '',
                ($this->SanitizarDatos($_POST['aumento_de_limite_por_viaje']))?? '',
                ($this->SanitizarDatos($_POST['costo_envio_estado_de_cuenta']))?? '',
                $_POST['envio_estado_de_cuenta_email']?? '',
                ($this->SanitizarDatos($_POST['adelanto_de_efectivo']))?? '',
                ($this->SanitizarDatos($_POST['informacion_adicional']))?? '',
                $imagen?? '',
                ($this->SanitizarDatos($_POST['fecha_de_cierre']))?? '',
                ($this->SanitizarDatos($_POST['cambio_fecha_de_cierre']))?? '',
                ($this->SanitizarDatos($_POST['telefono_para_extravio']))?? '',
                $_POST['contactless']?? '',
                ($this->SanitizarDatos($_POST['reimpresion_de_plastico']))?? '',
                ($this->SanitizarDatos($_POST['reimpresion_de_pin']))?? '',
                ($this->SanitizarDatos($_POST['reemplazo_por_robo_extravio']))?? '',
                $_POST['urlForm']?? '',
                $_POST['urlpedido']?? '',
                ($_POST['recomendado']=="true" ? 1 : 0));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error tarjeta no ingresada"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function updateLugaresDePagoTarjeta(){
        $tarjeta = new TarjetasModel();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $result = $tarjeta->updateLugaresDePagoTarjeta($data);
        exit(json_encode($result));
    }

    public function updateCategoriasTarjeta(){
        $tarjeta = new TarjetasModel();
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $result = $tarjeta->updateCategoriasTarjeta($data);
        exit(json_encode($result));
    }

    public function getLugaresDePagoTarjeta(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['id_tarjeta'])){
            $result = $tarjeta->getLugarDePagoTarjetas($_POST['id_tarjeta']);
            exit(json_encode($result));
        }else{
            exit(json_encode("Faltan datos"));
        }
    }

    public function getCategoriasTarjeta(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['id_tarjeta'])){
            $result = $tarjeta->getCategoriasTarjeta($_POST['id_tarjeta']);
            exit(json_encode($result));
        }else{
            exit(json_encode("Faltan datos"));
        }
    }

    public function getRequisitosTarjeta(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['id_tarjeta'])){
            $result = $tarjeta->getRequisitos($_POST['id_tarjeta']);
            exit(json_encode($result));
        }else{
            exit(json_encode("Faltan datos"));
        }
    }

    public function getTarjetasCategoria(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['id_categoria'])){
            $result = $tarjeta->getTarjetasCategoria($_POST['id_categoria']);
            exit(json_encode($result));
        }else{
            exit(json_encode("faltan datos"));
        }
    }

    public function getTarjetasPorEmisor(){
        $tarjeta = new TarjetasModel();
        if(isset($_POST['id_emisor'])){
            $result = $tarjeta->getTarjetasPorEmisor($_POST['id_emisor']);
            exit(json_encode($result));
        }else{
            exit(json_encode("faltan datos"));
        }
    }

    private function guardarImagen($imagenData){
        $imagen = $imagenData;
        $nombre = $this->formatearNombres($imagen['name']);
        $nombreTmp = $imagen["tmp_name"];
        $destino = "/var/www/tarjetasdecredito.com.uy/html/images/cardsImg/".$nombre;
        move_uploaded_file($nombreTmp, $destino);
        return $nombre;
    }

    private function eliminarImagen($imagenData){
        unlink('images/cardsImg/'.$imagenData);
    }

    private function formatearNombres($string){
        $result = str_replace(' ', '', $string);
        return $result;
    }

    private function SanitizarDatos($dato){
        $texto = preg_replace('([^A-Za-z0-9 ,.\r|\n])', '', $dato);
        return $texto;
    }

    public function getOneCompleteInformationCard(){
        $tarjetaInstance = new TarjetasModel();
        if(isset($_POST['id_tarjeta'])){
            $tarjeta = $tarjetaInstance->selectOne($_POST['id_tarjeta']);
            $moreInformation = $tarjetaInstance->selectCompleteInformation($_POST['id_tarjeta']);
            $tarjeta->MoreInformation = $moreInformation;
            exit(json_encode($tarjeta));
        }
    }
}