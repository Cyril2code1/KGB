<?php

class Targets {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM targets";
        $targets = $db->query($sql);

        
        if (empty($targets)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'targets_show_all_thead.php';

            foreach ($targets as $target) {  
                $civil = new Civils();
                $datas = $civil->civil($target->id_civil);
                $lastname = $datas[0]->last_name;
                $firstname = $datas[0]->first_name;

                $mission = new Missions();
                $datas = $mission->details($target->id_mission);
                $title = $datas[0]->title;

                ?>
                <tr>
                <th scope="row"><span title="<?= $lastname.' '.$firstname; ?>"> <?= $target->id_civil; ?> *</span></th>
                <td><span title="<?= $title; ?>"><?= $target->id_mission; ?> *</span></td>
                <td><?= $target->code_name; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="targets">
                    <input type="hidden" name="delRow[]" value="x">
                    <input type="hidden" name="delRow" value="<?= $target->id_civil.$target->code_name; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function code_names($id) {
        $db = new Database();
        $sql = "SELECT * FROM targets WHERE id_mission = '$id'";
        $datas = $db->query($sql);
        return $datas;
    }
}