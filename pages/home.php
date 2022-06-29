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





/*
$db = new Database();


$sql= "INSERT INTO `missions` (
`id_mission`,
`title`,
`description`,
`code_name`,
 `statut`,
  `type`,
   `start_date`,
    `end_date`,
     `id_speciality`,
      `id_geo`)
       VALUES(
        'f4906519-f44d-11ec-b584-d493900031d9', 
        'Il faut sauver l\'agent Ryan',
         'l\'agent Ryan est sequestré au château Danijel de Konak, il faut l\'exfiltrer et le ramener en vie ', 
         'Espoir pour Ryan', 
         'échec', 
         'renseignement', 
         '1975-07-24', 
         '1975-08-05', 2, 1);
)";
$db->query($sql);
*/
