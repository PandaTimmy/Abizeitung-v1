<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');

$tabelle =    $_POST["tabelle"];

zeilenZählen($tabelle);

function zeilenZählen($tabelle) {

    $command = "SELECT COUNT(*) AS AnzahlDerZeilen FROM " . $tabelle;
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        echo $row["AnzahlDerZeilen"];
    } else {
        echo 0;
    }
}