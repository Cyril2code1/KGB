<?php

class Hideouts {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM hideouts";
        $hideouts = $db->query($sql);

        
        if (empty($hideouts)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'hideouts_show_all_thead.php';

            foreach ($hideouts as $hideout) { 
                $geo = new Geo();
                $data = $geo->country($hideout->id_geo);
                $country= $data[0]->country; 
                ?>
                <tr>
                <th scope="row"> <?= $hideout->code; ?></th>
                <td><?= $hideout->address; ?></td>
                <td><?= $hideout->type; ?></td>
                <td><?= $hideout->id_geo .' - '. $country; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="hideouts">
                    <input type="hidden" name="deRow[]" value="code">
                    <input type="hidden" name="delRow" value="<?= $hideout->code; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }

    public function info($code) {
        $db = new Database();
        $sql = "SELECT * FROM hideouts WHERE code = '$code'";
        $hideouts = $db->query($sql);
        return $hideouts;
    }
}