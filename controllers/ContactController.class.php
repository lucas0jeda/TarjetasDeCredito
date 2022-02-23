<?php

class ContactController{

    public function contact(){
        return generarHtml("contact", []);
    }

    public function about(){
        return generarHtml("about", []);
    }

    public function faq(){
        return generarHtml("faq", []);
    }

    public function datosDeContacto(){
        return generarHtml('datos-de-contacto', []);
    }

}
