<?php

class Autoloader{

   static function register(){
    spl_autoload_register(function($class) {
        require MODELS.$class.'.php';
    });
   }

}