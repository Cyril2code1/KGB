<?php

class Administrators {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM administrators";
        $admins = $db->query($sql);

        
        if (empty($admins)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'administrators_show_all_thead.php';

            foreach ($admins as $admin) {  
                ?>
                <tr>
                <th scope="row"> <?= $admin->email; ?></th>
                <td><?= $admin->admin_lastname; ?></td>
                <td><?= $admin->admin_firstname; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="administrators">
                    <input type="hidden" name="deRow[]" value="id_admin">
                    <input type="hidden" name="delRow[]" value="<?= $admin->id_admin; ?>" />
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