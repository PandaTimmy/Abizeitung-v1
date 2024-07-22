<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');
include('steckbriefeFormatieren.php');
include('baum.php');

$user_login =  $_POST["user_login"];

steckbriefFrageHinzu($user_login);

function steckbriefFrageHinzu($user_login) {

    if (adminÜberprüfen($user_login)) {

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

        $randomID = uniqid();


        $command = "SELECT COUNT(*) AS zeilen_anzahl FROM steckbriefefragen";
        $sql = sqlCommand($command);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $zeilen_anzahl = $row["zeilen_anzahl"];
        }

        $id = $zeilen_anzahl + 1;

        $command = "INSERT INTO steckbriefefragen (frage, id, randomId) VALUES ('', '$id', '$randomID');";
        $sql = sqlCommand($command);

        baum("SBQQ".hashZuBenutzername($hash)."✩".hashZuBenutzername($hash)." hat eine Frage hinzugefügt.");
    

    }

    steckbriefeAntwortenFormatieren();
}