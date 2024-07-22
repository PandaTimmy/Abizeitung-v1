<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');

$user_login =  $_POST["user_login"];


if (loginÜberprüfen($user_login)) {


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
    /////////////////// 

    $command = "SELECT * FROM benutzerkonten WHERE hash = '$hash'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {

            $usernameToLoad = $row['benutzername'];

        }
    }


    /////////////////// Alle Benutzer laden

    $benutzer = array();
    $nachname = array();
    $vorname = array();

    $command = "SELECT nachname, vorname, benutzername FROM benutzerkonten ORDER BY vorname ASC";
    $sql = sqlCommand($command);
    
    if ($sql->num_rows > 0) {
        
        while ($row = $sql->fetch_assoc()) {

            if ($row["benutzername"] != $usernameToLoad) { // Nicht sich selber laden

                array_push($benutzer, $row["benutzername"]);
                array_push($nachname, $row["nachname"]);
                array_push($vorname, $row["vorname"]);
            }
        }
    }


    /////////////////// Zugrieffe Angaben vom Benutzer laden

    $zugriffe = array();

    foreach ($benutzer as $benutzername) {

        $command = "SELECT * FROM steckbriefezugriff WHERE Benutzername = '$usernameToLoad'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {

                if ($benutzername != $usernameToLoad) { // Nicht sich selber laden

                    array_push($zugriffe, $row[$benutzername]); // Einzelnen nummern laden

                }    
            }
        }
    }


    /////////////////s// Endergebnis laden

    $count = count($benutzer);

    for ($i = 0; $i < $count; $i++) {
        echo "☾".$benutzer[$i]."✩".$nachname[$i]."✩".$vorname[$i]."✩".$zugriffe[$i];
    }
}

?>