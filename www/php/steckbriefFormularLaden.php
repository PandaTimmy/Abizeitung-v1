<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login =  $_POST["user_login"];
$benutzerFormular =  $_POST["benutzer"];


if (loginÜberprüfen($user_login)) {


    $userIsAdmin = adminÜberprüfen($user_login);



    $command = "SELECT * FROM steckbriefeeinstellungen ORDER BY name ASC";
    $sql = sqlCommand($command);

    $i = 0;

    if ($sql->num_rows > 0) {
    
        while ($row = $sql->fetch_assoc()) {
    
            $i = $i + 1;
    
            if ($i == 1) {
                $formular_ansehbar = $row["wert"];
            }
            if ($i == 2) {
                $formular_bearbeitbar = $row["wert"];
            }
            if ($i == 3) { // Korrigierte Bedingung für den dritten Wert
                $formular_formatTitelBild = $row["wert"];
            }
            if ($i == 4) { // Korrigierte Bedingung für den vierten Wert
                $formular_formatWeitereBilder = $row["wert"];
            }
            if ($i == 5) { // Korrigierte Bedingung für den fünften Wert
                $formular_maxWeitereBilder = $row["wert"];
            }
        }
    }



    /////////////////// User Login zu Benutzername umwandeln

    $hash = hash("sha512", $user_login);

    /////////////////// Hash korrigieren falls Login durch Masterpasswort
    if (substr($user_login, -65) == "pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {
        $username = substr($user_login, 0, strlen($user_login) - 65);
        $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$username'";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $hash = $row['hash'];
            }
        }
    }
    else {
        $username = hashZuBenutzername($hash);
    }
    /////////////////// 

    // echo "Diese Personen haben Steckbriefe freigeschaltet";

    /////////////////// Alle Freigeschaltete Benutzer Laden
    $freigeschalteteBenutzer = array();

    $command = "SELECT * FROM benutzerkonten WHERE steckbriefFrei != 0 ORDER BY benutzername ASC";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {

            if ($row["benutzername"] != $username) { // Nicht sich selber laden

                array_push($freigeschalteteBenutzer, $row["benutzername"]);
            }

            if ($username == "KlimkeTim" && "KlimkeTim" == $row["benutzername"]) {
                array_push($freigeschalteteBenutzer, $row["benutzername"]);

            }
        }
    }


    // echo '<br><br>';

    // print_r($freigeschalteteBenutzer);

    // echo '<br><br>';
    // echo "Du darfst diese bearbeiten:";
    // echo '<br><br>';


    /////////////////// Benutzer Laden die mich bearbeiten lassen
    $benutzerBearbeitbar = array();

    $command = "SELECT * FROM steckbriefezugriff WHERE $username = 1";

    if($userIsAdmin) {  // SQL Befehl anpassen, wenn benutzer = Admin, weil dann alle aktivierten Steckbriefe anzeigen statt nur die, die einen freigeschaltet haben
        $command = "SELECT * FROM steckbriefezugriff";
    }

    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {


            if (in_array($row["Benutzername"], $freigeschalteteBenutzer)) { // Nur die Laden die auch freigeschaltet sinds

                array_push($benutzerBearbeitbar, $row["Benutzername"]);



            }
        }
    }



$command = "SELECT * FROM benutzerkonten ORDER BY vorname ASC";
$sql = sqlCommand($command);


$formular_anschauen_trueFalse = true;

if ($formular_ansehbar == 0 && $userIsAdmin != 1) {
    $formular_anschauen_trueFalse = false;
}


if (in_array($benutzerFormular, $benutzerBearbeitbar) && $formular_anschauen_trueFalse) { // BESTIMMT, OB FORMULAR ANGEZEIGT WERDEN SOLL



    $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$benutzerFormular'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {
            
            $formular_vorname = $row['vorname'];
            $formular_nachname = $row['nachname'];
            $formular_sex = $row['sex'];
            $formular_rechte = $row['rechte'];
        }
    }

    $formular_benutzername = $benutzerFormular;


    echo "<div class='main' style='background-color: rgb(243, 243, 246); border-radius: 18px; padding: 30px; margin: 100px;'>";

    echo '<p class="img-eyebrow" style="margin-top: -5px; margin-bottom: 30px;">STECKBRIEF DATA</p>';

    echo 'Steckbrief Zugriff: TRUE';
    echo "<br>Benutzername: ".$formular_benutzername;
    echo "<br>Vorname: ".$formular_vorname;
    echo "<br>Nachname: ".$formular_nachname;
    echo "<br>Geschlecht: ".$formular_sex;
    echo "<br>Rechte: ".$formular_rechte;

    echo "<br><br>Ansehbar: ".$formular_ansehbar;
    echo "<br>Format Titelbild: ".$formular_formatTitelBild;
    echo "<br>Format Weitere Bilder: ".$formular_formatWeitereBilder;
    echo "<br>Max Weitere bilder: ".$formular_maxWeitereBilder;



    





    $command = "SELECT * FROM steckbriefefragen ORDER BY id ASC";
    $sql = sqlCommand($command);

    $formular_fragen = array();
    $formular_fragen_ids = array();
    $formular_fragen_random_ids = array();

    if ($sql->num_rows > 0) {

        while ($row = $sql->fetch_assoc()) {

            array_push($formular_fragen, $row["frage"]);
            array_push($formular_fragen_ids, $row["id"]);
            array_push($formular_fragen_random_ids, $row["randomId"]);

            
        }
    }

    echo "<br>Fragen: ";
    print_r($formular_fragen);

    echo "<br>Fragen IDs: ";
    print_r($formular_fragen_ids);

    echo "<br>Fragen Random IDs: ";
    print_r($formular_fragen_random_ids);


    $command = "DESCRIBE steckbriefezugriff";
    $sql = sqlCommand($command);

    $formular_mitarbeiter = array();
    $formular_alle_benutzer = array();


    if ($sql->num_rows > 0) {
        // Ausgabe der Spaltennamen
        while ($row = $sql->fetch_assoc()) {
            array_push($formular_alle_benutzer, $row["Field"]);
        }

    }

    $formular_DARFSTDUWIRKLICHBEARBEITENODERNURADMIN_wennAdminUndKeinBearbeiterSetTRUE = true;


    for ($i = 0; $i < count($formular_alle_benutzer); $i++) { // Jetzt zeilen Zählen, wo jetzt pro benutzer nur die zeilen sind wo = 1 sind und auch noch der name wo die 1 steht auch bei mir sind also bei formular benutzername
        $benutzer = $formular_alle_benutzer[$i];
    
        $command = "SELECT COUNT(*) AS count FROM steckbriefezugriff WHERE $benutzer != 0 AND Benutzername = '$formular_benutzername'";
        $sql = sqlCommand($command);
        
        $row = $sql->fetch_assoc();
        if(($row['count'] != 0)) {
            //array_push($formular_mitarbeiter, $benutzer);


            $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$benutzer'"; // Vorname vom benutzernamen bekommen
            $sql = sqlCommand($command);
            $row = $sql->fetch_assoc();
            $vorname = $row['vorname'];

            if($benutzer != $username) { // NICHT SICH SELBER ANZEIGEN ALS MITARBEITER
                array_push($formular_mitarbeiter, $vorname);

            }
            else { //Du kommst also vor, du bist also auch bearbeiter und nicht nur admin
                $formular_DARFSTDUWIRKLICHBEARBEITENODERNURADMIN_wennAdminUndKeinBearbeiterSetTRUE = false;

            }


        }

    }

    echo "<br><br>Wirklich mitarbeiter oder nur admin (Wenn nur Admin = True):";
    if($formular_DARFSTDUWIRKLICHBEARBEITENODERNURADMIN_wennAdminUndKeinBearbeiterSetTRUE) {
        echo " TRUE";

        $formular_bearbeitbar = 0; //Admins dürfen nicht von anderen bearbeiten nur weil sie es anschauen können
    }
    else
    {
        echo " FALSE";
    }

    echo "<br><br>Bearbeitbar: ".$formular_bearbeitbar;

    if($formular_bearbeitbar == 1) {
        $formular_bearbeitbar = true;
    }
    else {
        $formular_bearbeitbar = false;
    }


    echo "<br><br>Alle Mitarbeiter: ";
    print_r($formular_mitarbeiter);

    $formular_mitarbeiter_str = "";





    for ($i = 1; $i < count($formular_mitarbeiter); $i++) {
        $formular_mitarbeiter_str = $formular_mitarbeiter_str.$formular_mitarbeiter[$i-1].", ";
    }
    if(count($formular_mitarbeiter)>0) {
        $formular_mitarbeiter_str = $formular_mitarbeiter_str.$formular_mitarbeiter[(count($formular_mitarbeiter)-1)]." ";
    }
    else {
        $formular_mitarbeiter_str = "Niemand";
    }

    echo "<br><br>Mitarbeiter STR: $formular_mitarbeiter_str";


    echo "</div>";


    //////////////////////////////////////////////////////////////////
    ////////////////////// ERSTER ABSATZ /////////////////////////////
    //////////////////////////////////////////////////////////////////



    echo '

    <div class="main">
    
    <h5 class="article-eyebrow">STECKBRIEF FÜR</h5>
    
    <h1>'.$formular_vorname.' '.$formular_nachname.'</h1>

    
    <p><span class="thick">Bearbeite hier den Steckbrief von '.$formular_vorname.'.
    
    <br></span>Diese Personen dürfen auch noch an diesem Steckbrief arbeiten: '.$formular_mitarbeiter_str.'</p>

    <div style="height: 50px;"></div>
    <p><span class="thick">Steckbriefe unterstützen keine Live-Mitarbeit. <br></span>Wechselt euch beim schreiben ab.</p>
    
    <div style="height: 100px;"></div>

    </div>

    
    ';

    if (!$formular_bearbeitbar && $formular_DARFSTDUWIRKLICHBEARBEITENODERNURADMIN_wennAdminUndKeinBearbeiterSetTRUE) { // ERROR NACHRICHT ZEIGEN DASS MAN NCIHT BEARBEITEN DARF EIGENTLICH
        echo '<div style="background-color: rgb(255, 58, 58); font-size: 15px; font-weight: 700; padding: 13px; text-align: center; color: white;">Du hast eigentlich keine Zugriffsrechte auf diesen Steckbrief! Du kannst diesen Steckbrief nur sehen, da du ein Admin bist!</div>';
    }
    else {
        if (!$formular_bearbeitbar) { // ERROR NACHRICHT ZEIGEN DASS MAN NCIHT BEARBEITEN DARF EIGENTLICH
            echo '<div style="background-color: rgb(255, 58, 58); font-size: 15px; font-weight: 700; padding: 13px; text-align: center; color: white;">Steckbriefe darf man nicht mehr Bearbeiten!</div>';
        }
    }


    //////////////////////////////////////////////////////////////////
    ////////////////////// ZWEITER ABSATZ ////////////////////////////
    //////////////////////////////////////////////////////////////////

    echo '

    <div style="background-color: rgb(243, 243, 246); padding-top: 100px; padding-bottom: 100px;">

    <div class="main">
    

    
    <div class="zweiterAbsatzFormularGrid"">
    <div class="questions">


    ';


    //////////////////////////////////////////////////////////////////
    ////////////////////// FRAGEN ////////////////////////////////////
    //////////////////////////////////////////////////////////////////


    for ($i = 0; $i < count($formular_fragen_ids); $i++) { //Einzelne Fragen Laden

        
        $current_randomID = $formular_fragen_random_ids[$i];

        $command = "SELECT * FROM steckbriefefragen WHERE randomId = '$current_randomID'"; // Vorname vom benutzernamen bekommen
        $sql = sqlCommand($command);
        $row = $sql->fetch_assoc();
        
        $currentQ = $row['frage'];

        $command = "SELECT * FROM steckbriefeantworten WHERE benutzername = '$formular_benutzername'"; // Vorname vom benutzernamen bekommen
        $sql = sqlCommand($command);
        $row = $sql->fetch_assoc();

        $currentQans = $row[$current_randomID];


        if ($formular_bearbeitbar) {
            echo '
            <p class="inputTitle">'.$currentQ.'</p>
            <textarea oninput="autoSize(this)">'.$currentQans.'</textarea>'; //___________________________USER INPUT
        }
        else {
            echo '
            <p class="inputTitle">'.$currentQ.'</p>
            <textarea disabled oninput="autoSize(this)">'.$currentQans.'</textarea>';
        }
        


    }

        echo '

        </div>

        ';

    



    //////////////////////////////////////////////////////////////////
    ////////////////////// BILDER ////////////////////////////////////
    //////////////////////////////////////////////////////////////////


    //////////////////////////////////////////////////////////////////
    ////////////////////// TITELBILD LADEN ///////////////////////////
    //////////////////////////////////////////////////////////////////


    echo '
    
    <div class="steckbriefBilder">
        <p style="color: black; margin-top: 0; margin-bottom: 10px;">TITELBILD</span></p>

    ';

    $formular_titelbildpfad = "steckbrief_".$formular_benutzername."_titelbild"; // Titelbild Pfad

    $command = "SELECT * FROM dateien WHERE name = 'titelbild' AND pfad = '".$formular_titelbildpfad."' ";
    $sql = sqlCommand($command);



    if ($sql->num_rows > 0) { // Wenn mehr als eine Zeile existiert, wo pfad = steckbrief_USERNAME und der name = titel ist, dann gibt es ein titelbild. dieses titelbild wird heir geladen


        ////////////////////////////////////////// TITELBILD EXISTIERT


        while ($row = $sql->fetch_assoc()) {


            $bild_inhalt = $row['datei']; // BILD LADEN
            $bild_typ = $row['dateityp'];

            $base64_image = 'data:' . $bild_typ . ';base64,' . base64_encode($bild_inhalt);
            
            echo "<img src='$base64_image' style='width: 100%; border-radius: 18px;'><br>";
            echo '<p style="cursor: pointer;" class="img-eyebrow">BILD ENTFERNEN</p>'; //___________________________USER INPUT
            echo '<div style="height: 50px;"></div>';
        }

    }
    else {
        echo '
        
        <div style="background-color: rgba(228, 228, 234, 0.605); border: 1px solid #C2C2C7; width: 100%; border-radius: 18px; padding: 15px; padding-top: 5px; box-sizing: border-box; overflow: hidden;">
        <p class="img-eyebrow">BILD HOCHLADEN</p>
        <p class="img-eyebrow" style="font-size: 12px; line-height: 16px;">Empfohlenes Seitenverhätnis:<br><span style="font-weight: 700;">3 zu 4</span></p>
        <input style="margin-top: 15px;" type="file" accept="image/png, image/gif, image/jpeg, image/jpg, image/tiff, image/bmp, image/svg+xml, image/heif, image/heic, image/jp2, image/x-macpaint, image/x-cmu-raster, image/x-portable-anymap, image/x-portable-bitmap, image/x-portable-graymap, image/x-portable-pixmap, image/x-rgb, image/x-xbitmap, image/x-xpixmap, image/x-xwindowdump, image/quicktime, image/x-cmx, image/x-icon, image/x-pcx, image/x-pict, image/x-xbm, image/webp, image/vnd.adobe.photoshop, image/vnd.dwg, image/vnd.djvu, image/vnd.microsoft.icon, image/vnd.ms-photo, image/vnd.wap.wbmp, image/vnd.google-earth.kml+xml, image/x-3ds, image/x-cmu-raster, image/x-eps, image/x-jng, image/x-ms-bmp, image/x-pict, image/x-xpixmap, image/x-cad, image/x-dwg, image/x-niff, image/x-pcx, image/x-tga, image/x-xbitmap, image/x-xpm" /></div><div style="height: 100px;"></div>';
    }



    //////////////////////////////////////////////////////////////////
    ////////////////////// WEITERE BILDER ////////////////////////////
    //////////////////////////////////////////////////////////////////


    echo '
    
        <p style="color: black; margin-top: 0; margin-bottom: 10px;">WEITERE BILDER</span></p>

    ';


    $formular_weiterebilderpfad = "steckbrief_".$formular_benutzername."_weiteresbild"; // Titelbild Pfad

    $command = "SELECT * FROM dateien WHERE pfad = '".$formular_weiterebilderpfad."' ";
    $sql = sqlCommand($command);



    if ($sql->num_rows > 0) {  //WEITERE BILDER LADEN

        while ($row = $sql->fetch_assoc()) {


            $bild_inhalt = $row['datei']; // BILD LADEN
            $bild_typ = $row['dateityp'];

            $base64_image = 'data:' . $bild_typ . ';base64,' . base64_encode($bild_inhalt);
            
            echo "<img src='$base64_image' style='width: 100%; border-radius: 18px;'><br>";
            echo '<p style="cursor: pointer;" class="img-eyebrow">BILD ENTFERNEN</p>'; //___________________________USER INPUT
            echo '<div style="height: 50px;"></div>';
        }

    }
    if ($sql->num_rows < $formular_maxWeitereBilder) {
        echo '
        
        <div style="background-color: rgba(228, 228, 234, 0.605); border: 1px solid #C2C2C7; width: 100%; border-radius: 18px; padding: 15px; padding-top: 5px; box-sizing: border-box; overflow: hidden;">
        <p class="img-eyebrow">BILD HOCHLADEN</p>
        <p class="img-eyebrow" style="font-size: 12px; line-height: 16px;">Empfohlenes Seitenverhätnis:<br><span style="font-weight: 700;">3 zu 4</span></p>
        <p class="img-eyebrow" style="font-size: 12px; line-height: 16px; font-weight: 700; margin-top: 10px;">Insgesamt '.$sql->num_rows.' von maximal '.$formular_maxWeitereBilder.' Bildern</p>
        <input style="margin-top: 15px;" type="file" accept="image/png, image/gif, image/jpeg, image/jpg, image/tiff, image/bmp, image/svg+xml, image/heif, image/heic, image/jp2, image/x-macpaint, image/x-cmu-raster, image/x-portable-anymap, image/x-portable-bitmap, image/x-portable-graymap, image/x-portable-pixmap, image/x-rgb, image/x-xbitmap, image/x-xpixmap, image/x-xwindowdump, image/quicktime, image/x-cmx, image/x-icon, image/x-pcx, image/x-pict, image/x-xbm, image/webp, image/vnd.adobe.photoshop, image/vnd.dwg, image/vnd.djvu, image/vnd.microsoft.icon, image/vnd.ms-photo, image/vnd.wap.wbmp, image/vnd.google-earth.kml+xml, image/x-3ds, image/x-cmu-raster, image/x-eps, image/x-jng, image/x-ms-bmp, image/x-pict, image/x-xpixmap, image/x-cad, image/x-dwg, image/x-niff, image/x-pcx, image/x-tga, image/x-xbitmap, image/x-xpm" /></div>';
    }

    



}





else {
    echo '

    <div class="main">
    
    <h5 class="article-eyebrow">ZUGRIFF AUF DEN STECKBRIEF VON '.strtoupper($benutzerFormular).' VERWEIGERT!</h5>
    
    ';

}



}
?>