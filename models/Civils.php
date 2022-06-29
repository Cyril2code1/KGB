<?php

class Civils {

    public function __construct() {

    }

    public function civil($id_civil) {
        $db = new Database();
        $sql = "SELECT * FROM civils WHERE id_civil='$id_civil'";
        $data = $db->query($sql);
        return $data;
    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM civils";
        $civils = $db->query($sql);

        
        if (empty($civils)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'civils_show_all_thead.php';

            foreach ($civils as $civil) {  
                $geo = new Geo();
                $data = $geo->nationality($civil->id_geo);
                $nat= $data[0]->nationality;
                ?>
                <tr>
                <th scope="row"> <?= $civil->id_civil; ?></th>
                <td><?= $civil->last_name; ?></td>
                <td><?= $civil->first_name; ?></td>
                <td><?= date("d/m/Y", strtotime($civil->birth_date)); ?></td>
                <td><?= $civil->id_geo; ?> - <?= $nat ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="civils">
                    <input type="hidden" name="deRow[]" value="id_civil">
                    <input type="hidden" name="delRow" value="<?= $civil->id_civil; ?>" />
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