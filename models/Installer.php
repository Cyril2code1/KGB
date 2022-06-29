<?php

class Installer {

    public function __construct() {
        
    }

    static function check(){
        if (!isset($_GET['section']) && !file_exists(CONF.'db_const.php')){
            $_GET['section'] = 'install';
            $_GET['action'] = 'conf';
        }       
    }

    static function install(){
        if (isset ($_GET['section']) && ($_GET['action'])){
            switch ($_GET['action']){

                case 'conf':
                    require_once INC.'instructions.php';
                    break;

                case 'input':
                    require_once  INC.'input.php';
                    break;

                case 'tables':
                    require_once INC.'tablesSQL.php';
                    $database = new Database();
                    foreach ($tablesSQL as $sql) {
                        $database->query($sql);
                    }
                    require_once INC.'dbok.php'; 
                    break;


                default:

                echo 'action non trouvée';

            }     
        
        } else {
            echo 'ceci est inattendu ! (action sans section)';
        }

    }
}