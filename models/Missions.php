<?php

class Missions {

    public function __construct() {

    }

    static function show_all() {
        $db = new Database();
        $sql = "SELECT * FROM missions";
        $missions = $db->query($sql);

        
        if (empty($missions)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'missions_show_all_thead.php';

            foreach ($missions as $mission) {
                
                $geo = new Geo();
                $data = $geo->country($mission->id_geo);
                $pays= $data[0]->country;

                $speciality = new Specialities();
                $data = $speciality->speciality($mission->id_speciality);
                $spe = $data[0]->name;
                ?>
                <tr>
                <th scope="row"> <?= $mission->id_mission; ?></th>
                <td><?= $mission->title; ?></td>
                <td><span title='<?=htmlspecialchars($mission->description, ENT_QUOTES); ?>'><?= substr($mission->description, 0, 35).'(...)';?></span></td>
                <td><?= $mission->code_name; ?></td>
                <td><?= $mission->statut; ?></td>
                <td><?= $mission->type; ?></td>
                <td><?= date("d/m/Y", strtotime($mission->start_date)); ?></td>
                <td><?= date("d/m/Y", strtotime($mission->end_date)); ?></td>
                <td><?= $mission->id_speciality; ?> - <?= $spe; ?></td>
                <td><?= $mission->id_geo; ?> - <?= $pays; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="missionss">
                    <input type="hidden" name="deRow[]" value="id_mission">
                    <input type="hidden" name="delRow" value="<?= $mission->id_mission; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    static function show_all_min() {
        $db = new Database();
        $sql = "SELECT * FROM missions";
        $missions = $db->query($sql);

        
        if (empty($missions)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'missions_show_all_min_thead.php';

            foreach ($missions as $mission) {
                switch ($mission->statut) {
                    case 'en préparation':
                        $table = 'table-light';
                        break;
                    case 'en cours':
                        $table = 'table-warning';
                        break;
                    case 'terminée':
                        $table = 'table-success';
                        break;
                    case 'échec':
                        $table = 'table-danger';
                        break;
                    default:
                    include PAGES.'error.php';
                }
                $geo = new Geo();
                $data = $geo->country($mission->id_geo);
                $pays= $data[0]->country;
                ?>
                <tr class="<?= $table; ?>">
                <th scope="row"> <?= $mission->title; ?></th>
                <td><?= $mission->code_name; ?></td>
                <td><?= $pays; ?></td>
                <td><span title='<?=htmlspecialchars($mission->description, ENT_QUOTES); ?>'><?= substr($mission->description, 0, 35).'(...)';?></span></td>
                <td><?= $mission->statut; ?></td>
                <td><a href="./index.php?section=home&id=<?= $mission->id_mission ?>" target="_blank"><button class="btn"> (voir) </button></a></td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function details($id) {
        $db = new Database();
        $sql = "SELECT * FROM missions WHERE id_mission = '$id'";
        $mission = $db->query($sql);

        if (empty($mission)) {
            echo 'aucune donnée à afficher !';
        } else {
            return $mission;
        }
    }
}