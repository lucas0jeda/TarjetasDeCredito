<?php

require_once './models/BeneficiosModel.php';

class BeneficiosController{

    public function all(){
        $beneficios = new BeneficiosModel();
        $result = $beneficios->all();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectorBeneficios(){
        $beneficios = new BeneficiosModel();
        $result = $beneficios->selectorTarjetaBeneficio();
        if($result){
            exit(json_encode($result));
        }else{
            exit(json_encode("error al obtener todos los datos"));
        }
    }

    public function selectOneBeneficio(){
        $beneficios = new BeneficiosModel();
        if(isset($_POST['ID'])){
            $result = $beneficios->selectOne($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error beneficio no encontrado"));
            }
        }
    }

    public function updateBeneficio(){
        $beneficios = new BeneficiosModel();
        if(isset($_POST['idBeneficio']) && isset($_POST['idTarjeta']) && isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['informacionAdicional'])){
            $result = $beneficios->updateBeneficio($_POST['idBeneficio'], $_POST['idTarjeta'], $_POST['titulo'], json_encode($this->SanitizarDatos($_POST['desc'])),json_encode($this->SanitizarDatos($_POST['informacionAdicional'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error beneficio no modificado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    public function deleteBeneficio(){
        $beneficios = new BeneficiosModel();
        if(isset($_POST['ID'])){
            $result = $beneficios->delete($_POST['ID']);
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error beneficio no eliminado"));
            }
        }else{
            exit(json_encode("Error faltan datos"));
        }
    }

    public function insertBeneficio(){
        $beneficios = new BeneficiosModel();
        if(isset($_POST['idTarjeta']) && isset($_POST['titulo']) && isset($_POST['desc']) && isset($_POST['informacionAdicional'])){
            $result = $beneficios->insertBeneficio($_POST['idTarjeta'], $_POST['titulo'], json_encode($this->SanitizarDatos($_POST['desc'])),json_encode($this->SanitizarDatos($_POST['informacionAdicional'])));
            if($result){
                exit(json_encode($result));
            }else{
                exit(json_encode("Error beneficio no insertado"));
            }
        }else{
            exit(json_encode("error faltan datos"));
        }
    }

    private function SanitizarDatos($dato){
        $texto = preg_replace('([^A-Za-z0-9 ,.\r|\n])', '', $dato);
        return $texto;
    }
}
