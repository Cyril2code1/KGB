<?php

class Specialities {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM specialities";
        $specialities = $db->query($sql);

        
        if (empty($specialities)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'specialities_show_all_thead.php';

            foreach ($specialities as $speciality) {  
                ?>
                <tr>
                <th scope="row"> <?= $speciality->id_speciality; ?></th>
                <td><?= $speciality->name; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="specialities">
                    <input type="hidden" name="deRow[]" value="id_speciality">
                    <input type="hidden" name="delRow" value="<?= $speciality->id_speciality; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
                <?php
            }
            echo '</tbody>';
            echo '</table>';

        }
    }


    public function speciality($id) {
        $db = new Database();
        $sql = "SELECT name FROM specialities WHERE id_speciality='$id'";
        $data = $db->query($sql);
        return $data;
    }


}