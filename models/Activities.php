<?php

class Activities {

    public function __construct(){

    }

    public function agents($id){
        $db = new Database();
        $sql = "SELECT identification_code FROM activities WHERE id_mission='$id'";
        $datas = $db->query($sql);
        return $datas;
    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM activities";
        $activities = $db->query($sql);

        
        if (empty($activities)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'activities_show_all_thead.php';

            foreach ($activities as $activity) {  
                $mission = new Missions();
                $datas = $mission->details($activity->id_mission);
                $title = $datas[0]->title;

                $agent = new Agents();
                $datas = $agent->civil($activity->identification_code);
                $idCivil = $datas[0]->id_civil;

                $civil = new Civils();
                $datas = $civil->civil($idCivil);
                $lastname = $datas[0]->last_name;
                $firstname = $datas[0]->first_name;

                ?>
                <tr>
                <th scope="row"><span title="<?= $title; ?>"> <?= $activity->id_mission; ?> *</span></th>
                <td><span title="<?= $lastname.' '.$firstname; ?>"><?= $activity->identification_code; ?> *</span></td>
                <td>
                    <input type="hidden" name="delRow[]" value="activities">
                    <input type="hidden" name="deRow[]" value="x">
                    <input type="hidden" name="delRow" value="<?= $activity->id_mission.$activity->identification_code; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }
}