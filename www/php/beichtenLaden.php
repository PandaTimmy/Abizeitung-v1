<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login =  $_POST["user_login"];

beichtenLaden($user_login);

function beichtenLaden($user_login) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT beichte, datum, favorit, id FROM beichten";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            
    
            while ($row = $sql->fetch_assoc()) {
    
                echo "☾".$row["beichte"]."✩".$row["datum"]."✩".$row["id"]."✩".$row["favorit"];
                
            }
        }
    }

    
}