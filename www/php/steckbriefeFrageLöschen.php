<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');
include('steckbriefeFormatieren.php');

$user_login =  $_POST["user_login"];
$id =  $_POST["id"];


$command = "SELECT COUNT(*) AS zeilen_anzahl FROM steckbriefefragen";
$sql = sqlCommand($command);
if ($sql->num_rows > 0) {
    $row = $sql->fetch_assoc();
    $zeilen_anzahl = $row["zeilen_anzahl"];
}

if (adminÜberprüfen($user_login) && $id > 0 && $id <= $zeilen_anzahl) {

    $command = "DELETE FROM steckbriefefragen WHERE id = $id;";
    $sql = sqlCommand($command);


    while ( $id < $zeilen_anzahl ) {
        $id = $id + 1;
        $newID = $id - 1;
        $command = "UPDATE steckbriefefragen SET id = '$newID' WHERE id = $id;";
        $sql = sqlCommand($command);
    }


    steckbriefeAntwortenFormatieren();


//     $command = "SELECT COUNT(*) AS zeilen_anzahl FROM steckbriefefragen";
//     $sql = sqlCommand($command);
//     if ($sql->num_rows > 0) {
//         $row = $sql->fetch_assoc();
//         $zeilen_anzahl = $row["zeilen_anzahl"];
//     }

//     $id = $zeilen_anzahl + 1;

//     $command = "INSERT INTO steckbriefefragen (frage, id) VALUES ('', '$id');";
//     $sql = sqlCommand($command);


}

    
