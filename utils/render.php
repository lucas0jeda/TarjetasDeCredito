<?php
require '../utils/autoloader.php';

function generarHtml($vista,$parametros){
    return require "../views/$vista.php";
}

function cargarVista($vista, $parametros){
    generarHtml($vista,$parametros);
}
