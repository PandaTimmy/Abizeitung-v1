<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');

$user_login =  $_POST["user_login"];
$user       =  $_POST["user"];

infoUser($user_login, $user);

function infoUser($user_login, $user) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT nachname, vorname, benutzername, hash, rechte, sex FROM benutzerkonten WHERE benutzername = '$user'";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            
    
            while ($row = $sql->fetch_assoc()) {
    
                echo $row["nachname"]."✩".$row["vorname"]."✩".$row["benutzername"]."✩".$row["hash"]."✩".$row["rechte"]."✩".$row["sex"];
                
            }
        }
    }

    
}