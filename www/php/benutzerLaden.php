<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');

$user_login =  $_POST["user_login"];

benutzerLaden($user_login);

function benutzerLaden($user_login) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT nachname, vorname, benutzername, hash, rechte FROM benutzerkonten ORDER BY vorname ASC";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            
    
            while ($row = $sql->fetch_assoc()) {
    
                echo "☾".$row["nachname"]."✩".$row["vorname"]."✩".$row["benutzername"]."✩".$row["hash"]."✩".$row["rechte"];
                
            }
        }
    }

    
}