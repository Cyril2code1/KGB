<?php

class Geo {

    public $id_geo;
    public $country;
    public $nationality;

    public function __construct(){
        
    }

    public function country($id) {
        $db = new Database();
        $sql = "SELECT country FROM geo WHERE id_geo='$id'";
        $data = $db->query($sql);
        return $data;
    }

    public function nationality($id) {
        $db = new Database();
        $sql = "SELECT nationality FROM geo WHERE id_geo='$id'";
        $data = $db->query($sql);
        return $data;
    }

    static function show_all() {
        $db = new Database();
        $sql = "SELECT * FROM geo";
        $geos = $db->query($sql);

        if (empty($geos)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'geos_show_all_thead.php';
             
            foreach ($geos as $geo) {
?>                
                <tr>
                  <th scope="row"> <?= $geo->id_geo; ?></th>
                  <td><?= $geo->country; ?></td>
                  <td><?= $geo->nationality; ?></td>
                  <td>
                    <input type="hidden" name="delRow[]" value="geo">
                    <input type="hidden" name="deRow[]" value="id_geo">
                    <input type="hidden" name="delRow" value="<?= $geo->id_geo; ?>" />
                    <button type="submit" class="btn btn-danger">X</button>               
                </td>
                </tr>
<?php
            }
        }
              echo '</tbody>';
            echo '</table>';
    

    }
}
