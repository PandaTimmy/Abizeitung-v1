<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login   = $_POST["user_login"];
$benutzername = $_POST["benutzername"];
$degradieren  = $_POST["degradieren"];


benutzerDegradierenBefördern($user_login, $benutzername, $degradieren);

function benutzerDegradierenBefördern($user_login, $benutzername, $degradieren) {

    if ($degradieren == 1) {
        if (adminÜberprüfen($user_login)) {

            if ($benutzername != "KlimkeTim") {
                $command = "UPDATE benutzerkonten SET rechte = 0 WHERE benutzername = '$benutzername'";
                $sql = sqlCommand($command);
            }
            else {
                $command = "UPDATE benutzerkonten SET rechte = 0 WHERE benutzername = '".hashZuBenutzername(hash("sha512", $user_login))."'";
                $sql = sqlCommand($command);
            }

            
    
            echo "1 ".$benutzername." wurde degradiert.";
            baum("UDEG✩".hashZuBenutzername(hash("sha512", $user_login))."✩👤 ".hashZuBenutzername(hash("sha512", $user_login))." hat ".$benutzername." degradiert.");
        }
        else {
            echo "0 Ungültiger Login: '$user_login'.";
        }
    }
    else {
        if (adminÜberprüfen($user_login)) {


            $command = "UPDATE benutzerkonten SET rechte = 1 WHERE benutzername = '$benutzername'";
            $sql = sqlCommand($command);
    
            echo "1 ".$benutzername." wurde degradiert.";
            baum("UADM✩".hashZuBenutzername(hash("sha512", $user_login))."✩👤 ".hashZuBenutzername(hash("sha512", $user_login))." hat ".$benutzername." befördert.");
        }
        else {
            echo "0 Ungültiger Login: '$user_login'.";
        }
    }

    
}