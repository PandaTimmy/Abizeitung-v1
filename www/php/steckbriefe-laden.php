<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login =  $_POST["user_login"];


if (loginÜberprüfen($user_login)) {



    $userIsAdmin = adminÜberprüfen($user_login);



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

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {


            if (in_array($row["benutzername"], $benutzerBearbeitbar)) { // Nur die Laden die auch freigeschaltet sinds

                if($row["sex"] == "m") {
                    $url = "Bilder/male-default.jpeg";
                }
                else {
                    $url = "Bilder/female-default.jpeg";
                }


                echo '

                <div class="steckbrief-kachel" style="background-image: url('.$url.');">
                    <div>
                        <div>
                            <h3>LOREM IPSUM</h3>
                            <h2>'.$row["vorname"].' '.$row["nachname"].'</h2>
                        </div>
                    </div>
                </div>
                
                ';
            }
        }
    }

    //print_r($benutzerBearbeitbar);


}


//     /////////////////// Alle Benutzer laden

//     $benutzer = array();
//     $nachname = array();
//     $vorname = array();

//     $command = "SELECT nachname, vorname, benutzername FROM benutzerkonten ORDER BY vorname ASC";
//     $sql = sqlCommand($command);
    
//     if ($sql->num_rows > 0) {
        
//         while ($row = $sql->fetch_assoc()) {

//             if ($row["benutzername"] != $usernameToLoad) { // Nicht sich selber laden

//                 array_push($benutzer, $row["benutzername"]);
//                 array_push($nachname, $row["nachname"]);
//                 array_push($vorname, $row["vorname"]);
//             }
//         }
//     }


//     /////////////////// Zugrieffe Angaben vom Benutzer laden

//     $zugriffe = array();

//     foreach ($benutzer as $benutzername) {

//         $command = "SELECT * FROM steckbriefezugriff WHERE Benutzername = '$usernameToLoad'";
//         $sql = sqlCommand($command);

//         if ($sql->num_rows > 0) {
//             while ($row = $sql->fetch_assoc()) {

//                 if ($benutzername != $usernameToLoad) { // Nicht sich selber laden

//                     array_push($zugriffe, $row[$benutzername]); // Einzelnen nummern laden

//                 }    
//             }
//         }
//     }


//     /////////////////s// Endergebnis laden

//     $count = count($benutzer);

//     for ($i = 0; $i < $count; $i++) {
//         //echo "☾".$benutzer[$i]."✩".$nachname[$i]."✩".$vorname[$i]."✩".$zugriffe[$i];
//     }
// }

?>