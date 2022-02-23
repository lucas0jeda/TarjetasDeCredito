<?php 
require __DIR__."/../routes/routes.class.php"; 

Routes::Add("/", "get", "HomeController::home");
Routes::Add("/contacto", "get", "ContactController::contact");
Routes::Add("/datos-de-contacto", "get", "ContactController::datosDeContacto");
Routes::Add("/about", "get", "ContactController::about");
Routes::Add("/faq", "get", "ContactController::faq");
Routes::Add("/emisor", "get", "EmisorController::get");
Routes::Validate();
Routes::Run();
