<?php

class Cards {

    public function __construct() {

    }

    public function agent_card($idCode){

     // go for civil ID
        $agent = new Agents();
        $res = $agent->civil($idCode);
        $idCivil = $res[0]->id_civil;

     // go for civil datas
        $civil = new Civils();
        $res = $civil->civil($idCivil);

        $lastName = $res[0]->last_name;
        $firstName = $res[0]->first_name;
        $birthDate = $res[0]->birth_date;

        $idGeo = $res[0]->id_geo;

      // go for nationality
        $geo = new Geo();
        $data = $geo->nationality($idGeo);
        $nationality = $data[0]->nationality;

      // go for specialities
        $agentSkills = new AgentSkills();
        $datas = $agentSkills->speciality($idCode);

        $header = 'Agent: ' .$idCode;
        $title =  $lastName .' '. $firstName;
        $text = '<p>né(e) le: '.date("d/m/Y", strtotime($birthDate)).'</p>';
        $text.= '<p>nationalité: '.$nationality.'</p>';     
        $text.= '<p>spécialités:';
        $text.= '<ul>';
             
            foreach ($datas as $data){ 
              $speciality = new specialities();
              $idSpe = $data->id_speciality;
              $speName = $speciality->speciality($idSpe);
              $text.= '<li>'.$speName[0]->name.'</li> ';
            } 

        $text.= '</ul></p>';
        $class = 'text-white bg-danger';
        include INC.'card.php';
    }

    public function contact_card($codeName, $idCivil){
        $civil = new Civils();
        $res = $civil->civil($idCivil);

        $lastName = $res[0]->last_name;
        $firstName = $res[0]->first_name;
        $birthDate = $res[0]->birth_date;

        $idGeo = $res[0]->id_geo;

      // go for nationality
        $geo = new Geo();
        $data = $geo->nationality($idGeo);
        $nationality = $data[0]->nationality;

        $header = 'Contact: ' .$codeName;
        $title =  $lastName .' '. $firstName;
        $text = '<p>né(e) le: '.date("d/m/Y", strtotime($birthDate)).'</p>';
        $text.= '<p>nationalité: '.$nationality.'</p>';

        $class="text-white bg-secondary";
        include INC.'card.php';
    }

    public function mission_card($idMission) {
        $mission = new Missions();
        $datas = $mission->details($idMission);

        $header = $datas[0]->title;
        $desc = $datas[0]->description;
        $title = $datas[0]->code_name;
        $statut = $datas[0]->statut;
        $type = $datas[0]->type;
        $startDate = $datas[0]->start_date;
        $endDate = $datas[0]->end_date;
        $idSpec = $datas[0]->id_speciality;
        $idGeo = $datas[0]->id_geo;


        $speciality = new Specialities();
        $speData = $speciality->speciality($idSpec);
        $speName = $speData[0]->name;

        $geo = new Geo();
        $data = $geo->country($idGeo);
        $countryName = $data[0]->country;

        $text = '<b>statut:</b> '.$statut.'<br>';
        $text .= '<p><b>description:</b> '.$desc.' <br></p>';
        $text .= '<p><b>type:</b> '.$type.' <br>';
        $text .= '<b>pays:</b> '.$countryName.' <br>';
        $text .= '<b>spécialité requise:</b> '.$speName.' <br></p>';
        $text .= '<p><b>date de début:</b> '.date("d/m/Y", strtotime($startDate)).'<br>';
        $text .= '<b>date de fin:</b> '.date("d/m/Y", strtotime($endDate)).'<br></p>';

        $class="text-dark bg-info"; 
        include INC.'card.php';

    }

    public function target_card($codeName, $idCivil){
        $civil = new Civils();
        $res = $civil->civil($idCivil);

        $lastName = $res[0]->last_name;
        $firstName = $res[0]->first_name;
        $birthDate = $res[0]->birth_date;

        $idGeo = $res[0]->id_geo;

      // go for nationality
        $geo = new Geo();
        $data = $geo->nationality($idGeo);
        $nationality = $data[0]->nationality;

        $header = 'Cible: ' .$codeName;
        $title =  $lastName .' '. $firstName;
        $text = '<p>né(e) le: '.date("d/m/Y", strtotime($birthDate)).'</p>';
        $text.= '<p>nationalité: '.$nationality.'</p>';

        $class="text-dark bg-warning";
        include INC.'card.php';
    }

    public function fallback_card($code){
      $hideout = new Hideouts();
      $datas = $hideout->info($code);

      $address = $datas[0]->address;
      $type = $datas[0]->type;
      $idGeo = $datas[0]->id_geo;

    // go for nationality
      $geo = new Geo();
      $data = $geo->country($idGeo);
      $country = $data[0]->country;

      $header = 'Planque: ' .$type;
      $title = 'Code: ' .$code;

      $text = '<p>adresse: '.$address.'</p>';
      $text.= '<p>pays: '.$country.'</p>';

      $class="text-dark bg-light";
      include INC.'card.php';
  }
}

