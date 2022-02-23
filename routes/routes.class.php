<?php
require __DIR__ . "/../utils/autoloader.php";
require __DIR__ . "/../models/EmisoresModel.php";
require __DIR__ . "/../models/TarjetasModel.php";
require __DIR__ . "/../models/CategorysModel.php";
class Routes
{
    private static $routes = array();
    private static $notFound;

    public static function Add($url, $metodo, $funcion, $middleware = null)
    {
        array_push(self::$routes, [
            'url' => $url,
            'funcion' => $funcion,
            'metodo' => $metodo,
            'vista' => null,
            'tipo' => "controlador",
            'middleware' => $middleware
        ]);
    }

    public static function AddView($url, $vista, $middleware = null)
    {
        array_push(self::$routes, [
            'url' => $url,
            'funcion' => null,
            'metodo' => "get",
            'tipo' => "vista",
            'vista' => $vista,
            'middleware' => $middleware
        ]);
    }

    public static function Validate(){
        $url = substr($_SERVER['REQUEST_URI'],1);
        foreach (self::$routes as $route){
            if($route['url'] == $url) return;
        }
        // buscar en categories
        $categorias = new categorysModel();
        $categorias->selectOneByUrl($url);
        if($categorias){
            self::Add($_SERVER['REQUEST_URI'], 'get','CategoriesController::category');
        }
        // buscar en emisores
        $emisores = new EmisoresModel();
        $emisores->selectOneByTitle($url);
        if($emisores){
            self::Add($_SERVER['REQUEST_URI'], 'get','EmisorController::get');
        }
        // buscar en tarjetas
        $tarjetas = new TarjetasModel();
        $tarjetas->selectOneByUrl($url);
        if($tarjetas){
            self::Add($_SERVER['REQUEST_URI'], 'get','CreditCardsController::get');
        }

        return;
    }

    public static function Run()
    {
        $urlNavegador = $_SERVER['REQUEST_URI'];
        $metodoNavegador = strtolower($_SERVER['REQUEST_METHOD']);

        self::$notFound = true;
        $tipo = null;
        $vista = null;
        $middleware = null;
        $urlNavegador = explode("?",$urlNavegador)[0] ?? $urlNavegador;
        foreach (self::$routes as $route) {
            if ($route['tipo'] == "controlador") {
                if ($urlNavegador === $route['url'] && $metodoNavegador === $route['metodo']) {
                    $funcion = $route['funcion'];
                    $tipo = $route['tipo'];
                    self::$notFound = false;
                    $middleware = $route['middleware'];
                    break;
                }
            } else {
                if ($urlNavegador === $route['url']) {
                    $tipo = $route['tipo'];
                    self::$notFound = false;
                    $vista = $route['vista'];
                    $middleware = $route['middleware'];
                    break;
                }
            }
        }

        if (self::$notFound) cargarVista("404");
        if ($tipo === "vista")
            if ($middleware)
                self::ejecutarMiddlewareView($middleware, $vista);
            else
                cargarVista($vista);
        if ($tipo === "controlador") {
            if ($middleware){
                self::ejecutarMiddleware($middleware, $funcion);
            }else{
                self::ejecutarControlador($funcion);
            }
        }
    }

    private static function ejecutarControlador($funcion)
    {
        $contexto = [
            'post' => $_POST,
            'get' => $_GET,
            'server' => $_SERVER
        ];
        call_user_func($funcion, $contexto);
    }

    private static function ejecutarMiddleware($middleware, $funcion)
    {
        $contexto = [
            'post' => $_POST,
            'get' => $_GET,
            'server' => $_SERVER,
            'funcion' => $funcion
        ];

        call_user_func_array($middleware, $contexto);
    }

    private static function ejecutarMiddlewareView($middleware, $vista)
    {
        $contexto = [
            'post' => $_POST,
            'get' => $_GET,
            'server' => $_SERVER,
            'vista' => $vista
        ];
        call_user_func_array($middleware, $contexto);
    }
}
