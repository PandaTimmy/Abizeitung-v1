<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$umfrageName = $_POST["umfrageName"];
$umfrageTitel = $_POST["umfrageTitel"];
$umfrageBeschreibung = $_POST["umfrageBeschreibung"];
$user_login = $_POST["user_login"];

umfrageErstellen($umfrageName,$umfrageTitel,$umfrageBeschreibung,$user_login);

function umfrageErstellen($name,$titel,$beschreibung,$user_login) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT * FROM umfragen WHERE name = '$name'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            echo "0 Tabelle '$name' schon vorhanden. Wähle einen anderen Namen.";
        } else {
            $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`umfragen` (`titel`, `beschreibung`, `name`, `status`) VALUES ('".$titel."', '".$beschreibung."', '".$name."', 1);";
            $sql = sqlCommand($command);

            $command = "CREATE TABLE IF NOT EXISTS umfrage_".$name." (`hash` TEXT, `antwort` TEXT, `datum` DATETIME, favorit BOOLEAN);";
            $sql = sqlCommand($command);
            echo "1 Umfrage '$name' wurde erstellt.";

            baum("UMFR✩".hashZuBenutzername(hash("sha512", $user_login))."✩📊 ".hashZuBenutzername(hash("sha512", $user_login))." hat die Umfrage '$name' mit dem Titel '$titel' und der Beschreibung '$beschreibung' erstellt.");
        }
    }
    else {
        echo "0 Ungültiger Login oder kein Admin.";
    }
}

?>