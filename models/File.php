<?php

class File {

    public function __construct() {
        
    }
    
    static function write_conf() {
        $file = CONF.'db_const.php';

        file_put_contents($file,"<?php \ndefine ('DB_NAME', 'cwd_kgb');");

        foreach ($_POST as $key=>$value){
            $define = "\ndefine('$key', '$value');";
            file_put_contents($file, $define, FILE_APPEND);
        }
    }
}