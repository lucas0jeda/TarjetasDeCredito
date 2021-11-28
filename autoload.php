<?php

function autoload($classname){
    if(file_exists(__DIR__."/controllers/".lcfirst($classname).".php")) {
        include 'controllers/' . $classname . '.php';
    }
}

spl_autoload_register('autoload');