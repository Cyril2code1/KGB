<?php

class Fallbacks {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM fallbacks";
        $fallbacks = $db->query($sql);

        
        if (empty($fallbacks)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'fallbacks_show_all_thead.php';

            foreach ($fallbacks as $fallback) {
                $hideout = new Hideouts();
                $datas = $hideout->info($fallback->code);  
                $address = $datas[0]->address;
                $type = $datas[0]->type;

                $geo = new Geo();
                $data = $geo->country($datas[0]->id_geo);
                $country = $data[0]->country;

                $text = "$type - $address - $country";

                $mission = new Missions();
                $datas = $mission->details($fallback->id_mission);
                $title = $datas[0]->title;

                ?>
                <tr>
                <th scope="row"><span title="<?= $text ?>"> <?= $fallback->code; ?> *</span></th>
                <td><span title="<?= $title; ?>"><?= $fallback->id_mission; ?> *</td>
                <td>
                    <input type="hidden" name="delRow[]" value="fallbacks">
                    <input type="hidden" name="deRow[]" value="x">
                    <input type="hidden" name="delRow" value="<?= $fallback->code.$fallback->id_mission; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function fallbacks_id($idMission) {
        $db = new Database();
        $sql = "SELECT code FROM fallbacks WHERE id_mission = '$idMission'";
        $fallbacks = $db->query($sql);
        return $fallbacks;
    }
}