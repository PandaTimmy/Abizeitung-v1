<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');

$user_login =  $_POST["user_login"];

umfrageAntwortenLaden($user_login);

function umfrageAntwortenLaden($user_login) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT story, datum, favorit, id FROM storys";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            
    
            while ($row = $sql->fetch_assoc()) {
    
                echo "☾".$row["story"]."✩".$row["datum"]."✩".$row["id"]."✩".$row["favorit"];
                
            }
        }
    }

    
}