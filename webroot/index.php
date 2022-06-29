<?php

// define some constants to use absolutes rather than relatives paths 
require './../core/website_const.php';

// autoloader for the other classes - classes have to be in models/
require CORE.'Autoloader.php';
Autoloader::register();

// start a buffer
ob_start();

//start session
session_start();

// check if we need to install/configure the database
Installer::check();

// router to home, install, admin or error
Router1::main_route();

// close the buffer and put the data in $content
$content = ob_get_clean();

require PAGES.'template/default.php';
