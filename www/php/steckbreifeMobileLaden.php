<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');


$freigeschalteteBenutzerBenutzername = array();
$freigeschalteteBenutzerVorname = array();
$freigeschalteteBenutzerSex = array();
$freigeschalteteBenutzerBild = array();
$freigeschalteteBenutzerZeigen = array();

$command = "SELECT * FROM benutzerkonten WHERE steckbriefFrei != 0 ORDER BY RAND() LIMIT 10";
$sql = sqlCommand($command);

if ($sql->num_rows > 0) {
    while ($row = $sql->fetch_assoc()) {

        array_push($freigeschalteteBenutzerBenutzername, $row["benutzername"]);
        array_push($freigeschalteteBenutzerVorname, $row["vorname"]);
        array_push($freigeschalteteBenutzerSex, $row["sex"]);
    }
}


for ($i = 0; $i < count($freigeschalteteBenutzerBenutzername); $i++) { //Einzelne Titelbilder Laden

    $command = "SELECT * FROM dateien WHERE name = 'titelbild' AND pfad = 'steckbrief_".$freigeschalteteBenutzerBenutzername[$i]."_titelbild' LIMIT 1";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {

        $row = $sql->fetch_assoc();
        $bild_inhalt = $row['datei']; // BILD LADEN
        $bild_typ = $row['dateityp'];

        $base64_image = 'data:' . $bild_typ . ';base64,' . base64_encode($bild_inhalt);
        
        array_push($freigeschalteteBenutzerZeigen, true);


    } else {

        if ( $freigeschalteteBenutzerSex[$i] == "m" ){
            $base64_image = '../steckbriefe/Bilder/male-default.jpeg';
        } else {
            $base64_image = '../steckbriefe/Bilder/female-default.jpeg';
        }

        array_push($freigeschalteteBenutzerZeigen, true);
    
    }

    array_push($freigeschalteteBenutzerBild, $base64_image);

    //echo $base64_image;
}

$benutzerInsg = count($freigeschalteteBenutzerBenutzername);


echo '
<div id="steckbriefeMobileClip" style="margin-top: 15px; height: 495px; width: 100%; overflow: hidden;">
    <div id="Tranform" style="height: 495px; width: '.(289*$benutzerInsg).'px; transform: translateX(calc(50vw - 137px));">
        <div id="TranformUser" class="TranformUser" style="height: 495px; width: 10000px; transform: translateX(calc(-289px * 0));">
            <div style="height: 495px; width: '.(289*$benutzerInsg).'px;">';

$id = 0;

for ($i = 0; $i < $benutzerInsg; $i++) { 

    if ( $freigeschalteteBenutzerZeigen[$i] ) {


    echo'

<div id="SM'.$id.'" class="steckbriefeMobileContainer" style="background-image: url(\''.$freigeschalteteBenutzerBild[$i].'\')">
    <div class="SM-overlay">
        <div class="SM-name">'.(strtoupper($freigeschalteteBenutzerVorname[$i])).'</div>
        <div id="SM'.$id.'-CTA" class="SM-CTA">
            <div class="SM-subtitle">Steckbriefe</div>
            <button class="SM-cta-button" onclick="weiterleiten(\'../steckbriefe\')">Jetzt mitmachen</button>
        </div>
    </div>
</div>

    ';

    $id = $id + 1;

    }
}


echo'

            </div>
        </div>
    </div>
</div>

';


echo '<div class="steckbriefeMobileDotsContainer">';

$id = 0;

for ($i = 0; $i < $benutzerInsg; $i++) { 

    if ( $freigeschalteteBenutzerZeigen[$i] ) {

    echo'<div id="SM'.$id.'-dots" class="steckbriefeMobileDots"></div>';

    $id = $id + 1;

    }
}


echo '</div>';

?>