<?php

class AgentSkills {

    public function __constructor() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM agentskills";
        $agtskls = $db->query($sql);

        
        if (empty($agtskls)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'agentskills_show_all_thead.php';

            foreach ($agtskls as $agtskl) {  
                $speciality = new Specialities();
                $data = $speciality->speciality($agtskl->id_speciality);
                $speName = $data[0]->name;

                $agent = new Agents();
                $datas = $agent->civil($agtskl->identification_code);
                $idCivil = $datas[0]->id_civil;

                $civil = new Civils();
                $datas = $civil->civil($idCivil);
                $lastname = $datas[0]->last_name;
                $firstname = $datas[0]->first_name;
                ?>
                <tr>
                <th scope="row"> <?= $agtskl->id_speciality.' - '.$speName; ?></th>
                <td><?= $agtskl->identification_code.' - '.$lastname.' '.$firstname; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="agentskills">
                    <input type="hidden" name="deRow[]" value="x">
                    <input type="hidden" name="delRow" value="<?= $agtskl->id_speciality.$agtskl->identification_code; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function speciality($identificationCode) {
        $db = new Database();
        $sql = "SELECT id_speciality FROM agentskills WHERE identification_code = '$identificationCode'";
        $data = $db->query($sql);
        return $data;
    }
}