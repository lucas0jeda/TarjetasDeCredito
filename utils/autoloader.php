<?php
spl_autoload_register(function ($clase){
    if(file_exists("../models/$clase.class.php"))
        require "../models/$clase.class.php";

    if(file_exists("../controllers/$clase.class.php"))
        require "../controllers/$clase.class.php";

    if(file_exists("../middlewares/$clase.class.php"))
        require "../middlewares/$clase.class.php";

    if(file_exists("../exceptions/$clase.class.php"))
        require "../exceptions/$clase.class.php";
});
require_once 'render.php';

@session_start();