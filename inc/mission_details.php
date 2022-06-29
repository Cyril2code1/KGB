<?php
$idMission = $_GET['id'];
?>

<div class="row">
    <div class="col-md-3">
        <div class="row mission_card">
            <?php
            $card = new Cards();
            $card->mission_card($idMission);
            ?>
        </div>
        <div class="row fallback_card">
        <?php
            $fallbacks = new Fallbacks();
            $array = $fallbacks->fallbacks_id($idMission);
            foreach ($array as $fallback) {
                $code = $fallback->code;
                $card = new Cards();
                $card->fallback_card($code);
            }
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row targets">
        <?php
            $targets = new Targets();
            $array = $targets->code_names($idMission);
            foreach ($array as $target) {
                $codeName = $target->code_name;
                $idCivil = $target->id_civil;
                $card = new Cards();
                $card->target_card($codeName, $idCivil);
            }
            ?>
        </div>
    </div>
    <div class="col-md-6">   
        <div class="row agents">
            <?php
            $activities = new Activities();
            $array = $activities->agents($idMission);
            foreach ($array as $agent) {
                $idCode = $agent->identification_code;
                $card = new Cards();
                $card->agent_card($idCode);
            }
            ?>
        </div>
        <div class="row contacts">
            <?php
            $contacts = new Contacts();
            $array = $contacts->code_names($idMission);
            foreach ($array as $contact) {
                $codeName = $contact->code_name;
                $idCivil = $contact->id_civil;
                $card = new Cards();
                $card->contact_card($codeName, $idCivil);
            }
            ?>          
        </div>
    </div>
</div>



