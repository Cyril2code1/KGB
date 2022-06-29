<?php

if (isset ($_GET['action']))  {
    switch ($_GET['action']) {
        case 'login':
            include_once INC.'login.php';
            break;
        case 'logout':
            include_once INC.'logout.php';
        default:
            include 'error.php';
    }
} else {
    if(isset ($_GET['id'])) {
        include_once INC.'mission_details.php';
    } else {
    ?>
    <h2> Liste des missions </h2>
    
    <?php
    Missions::show_all_min();
    }
}

