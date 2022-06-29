<?php

class Agents {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM agents";
        $agents = $db->query($sql);

        
        if (empty($agents)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'agents_show_all_thead.php';

            foreach ($agents as $agent) {
                $civil = new Civils();
                $datas = $civil->civil($agent->id_civil);
                $lastname = $datas[0]->last_name;
                $firstname = $datas[0]->first_name;
                ?>
                <tr>
                <th scope="row"> <?= $agent->identification_code; ?></th>
                <td><span title="<?= $lastname.' '.$firstname; ?>"><?= $agent->id_civil; ?> *</span></td>
                <td>
                    <input type="hidden" name="delRow[]" value="agents">
                    <input type="hidden" name="deRow[]" value="identification_code">
                    <input type="hidden" name="delRow" value="<?= $agent->identification_code; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function civil($idCode) {
        $db = new Database();
        $sql = "SELECT id_civil FROM agents WHERE identification_code = '$idCode'";
        $id = $db->query($sql);
        return $id;

    }

    public function all_datas($idCode) {
        $db = new Database();
        $sql = "SELECT * FROM agents
        LEFT JOIN civils ON agents.id_civil = civils.id_civil
        LEFT JOIN geo ON civils.id_geo = geo.id_geo
        LEFT JOIN agentskills ON agents.identification_code = agentskills.identification_code
        LEFT JOIN specialities ON agentskills.id_speciality = specialities.id_speciality
        LEFT JOIN activities ON agents.identification_code = activities.identification_code 
        LEFT JOIN missions ON activities.id_mission = missions.id_mission       
        WHERE agents.identification_code = '$idCode'";
        $datas = $db->query($sql);
        return $datas;
    }

}