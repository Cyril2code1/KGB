<?php
?>

<h2><u> Panneau d'administration: </u></h2>
<p> laissez le curseur au dessus des infos portant un asterisque pour plus de détails </p>
<p> fonctions d'ajout et de modification non implémentées, boutons de suppression ne fonctionnent pas </p>

<?php

$form = new Form();
?>
<form method='POST' id='adminForm' name='selectTable'>

<?php
$list = 'administrators,
activities,
agents,
agentSkills,
civils,
contacts,
fallbacks,
geo,
hideouts,
missions,
specialities,
targets';

$form->select('table', $list);

/* Fatal error: Uncaught Error: Class ' activities' not found ... prob with ucfirst ?
$values = explode(",", $list);
        foreach ($values as $value){
          ?>
          <div id="select-<?= $value ?>" class="select-table"> 
          <?php
          ucfirst($value)::show_all();
          ?>
          </div>
          <?php
        }
*/

?>

<div id="select-administrators" class="select-table"> 
<?php
Administrators::show_all();
?>
</div>

<div id="select-activities" class="select-table">
<?php 
Activities::show_all();
?>
</div>

<div id="select-agents" class="select-table"> 
<?php 
Agents::show_all();
?>
</div>

<div id="select-agentSkills" class="select-table"> 
<?php 
AgentSkills::show_all();
?>
</div>

<div id="select-civils" class="select-table"> 
<?php 
Civils::show_all();
?>
</div>

<div id="select-contacts" class="select-table"> 
<?php 
Contacts::show_all();
?>
</div>

<div id="select-fallbacks" class="select-table"> 
<?php 
Fallbacks::show_all();
?>
</div>

<div id="select-geo" class="select-table"> 
<?php
Geo::show_all();
?>
</div>

<div id="select-hideouts" class="select-table"> 
<?php
Hideouts::show_all();
?>
</div>

<div id="select-missions" class="select-table"> 
<?php
Missions::show_all();
?>
</div>

<div id="select-specialities" class="select-table"> 
<?php
Specialities::show_all();
?>
</div>

<div id="select-targets" class="select-table"> 
<?php
Targets::show_all();
?>
</div>
</form>


<?php
/*
 doesn't work yet - all the submit value are the same no different name...
if (isset($_POST['delRow']))
{
  $table = $_POST['delRow'][0];
  $id = $_POST['delRow'][1];
  $delete = $_POST['delRow'][2];
  $db = new Database();

  switch ($table) {
      case 'activities':
          $del1 = substr($delete, 0, 36);
          $del2 = substr($delete, -10, 0);
          $sql = "DELETE FROM '$table' WHERE 'id_mission' = '$del1' and 'identification_code' = '$del2'";
          break;

      case 'agentskills':
          $del1 = substr($delete, 0, -10);
          $del2 = substr($delete, -10, 0);
          $sql = "DELETE FROM '$table' WHERE 'id_speciality' = '$del1' and 'identification_code' = '$del2'";
          break;

      case 'contacts':
          $del1 = substr($delete, 0, 36);
          $del2 = substr($delete, -36, 0);
          $sql = "DELETE FROM '$table' WHERE 'id_civil' = '$del1' and 'id_mission' = '$del2'";
          break;

      case 'fallbacks':
          $del1 = substr($delete, 0, 36);
          $del2 = substr($delete, -36, 0);
          $sql = "DELETE FROM '$table' WHERE 'code' = '$del1' and 'id_mission' = '$del2'";
          break;

      case 'targets':
          $del1 = substr($delete, 0, 36);
          $del2 = substr($delete, -36, 0);
          $sql = "DELETE FROM '$table' WHERE 'id_civil' = '$del1' and 'id_mission' = '$del2'";
          break;


    default:
      $sql = "DELETE FROM '$table' WHERE '$id' = '$delete'";
      break;

  }


  $db->query($sql);
}

*/
?>

<!-- style mis ici car ne fonctionne pas dans le template/default.php -->
<style>
.select-table{
    display:none
  }

.select-table-show{
    display:block
  }
</style>
