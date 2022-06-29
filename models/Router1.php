<?php

class Router1 {

    public function __construct() {

    }

   static function main_route(){
    if (isset($_GET['section'])){
        $section = $_GET['section'];
    } else {
        $section = 'home';
    }

    if ($section === 'home' || $section === 'install' || $section === 'admin' ) {
        
        return require PAGES.$section.'.php';
        
    } else {
       
        return require PAGES.'error.php';
    }
   }
   
}