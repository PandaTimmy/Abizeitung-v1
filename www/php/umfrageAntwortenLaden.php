<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');

$user_login =  $_POST["login"];
$umfrageName = $_POST["umfrageName"];

umfrageAntwortenLaden($user_login, $umfrageName);

function umfrageAntwortenLaden($user_login, $umfrageName) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT hash, antwort, datum, favorit FROM umfrage_".$umfrageName;
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            
    
            while ($row = $sql->fetch_assoc()) {
    
                echo "☾".$row["antwort"]."✩".$row["datum"]."✩".$row["hash"]."✩".$row["favorit"];
                
            }
        }
    }
}