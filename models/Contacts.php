<?php

class Contacts {

    public function __construct() {

    }

    static function show_all() {

        $db = new Database();
        $sql = "SELECT * FROM contacts";
        $contacts = $db->query($sql);

        
        if (empty($contacts)) {
            echo 'aucune donnée à afficher !';
        } else {
            require_once INC.'contacts_show_all_thead.php';

            foreach ($contacts as $contact) {  
                $civil = new Civils();
                $datas = $civil->civil($contact->id_civil);
                $lastname = $datas[0]->last_name;
                $firstname = $datas[0]->first_name;

                $mission = new Missions();
                $datas = $mission->details($contact->id_mission);
                $title = $datas[0]->title;

                
                ?>
                <tr>
                <th scope="row"><span title="<?= $lastname.' '.$firstname; ?>"><?= $contact->id_civil; ?> *</span></th>
                <td><span title="<?= $title; ?>"><?= $contact->id_mission; ?> *</td>
                <td><?= $contact->code_name; ?></td>
                <td>
                    <input type="hidden" name="delRow[]" value="contacts">
                    <input type="hidden" name="deRow[]" value="x">
                    <input type="hidden" name="delRow" value="<?= $civil->id_civil.$contact->id_mission; ?>" />
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
        $sql = "SELECT * FROM contacts WHERE id_mission = '$id' or id_civil = '$id'";
        $datas = $db->query($sql);
        return $datas;
    }


    public function contacts_details($id){
        $db = new Database();
        $sql = "SELECT * FROM contacts INNER JOIN civils ON contacts.id_civil = civils.id_civil WHERE id_mission = '$id'";
        $datas = $db->query($sql);
        return $datas;
    }
}