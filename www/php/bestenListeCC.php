<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');
include('adminÜberprüfen.php');

$user_login =  $_POST["user_login"];


if (loginÜberprüfen($user_login)) {

    
    /////////////////// Alle Benutzer laden

    $benutzer = array();
    $nachname = array();
    $vorname = array();
    $sex = array();

    $command = "SELECT nachname, vorname, benutzername, sex FROM benutzerkonten ORDER BY vorname ASC";
    $sql = sqlCommand($command);
    
    if ($sql->num_rows > 0) {
        
        while ($row = $sql->fetch_assoc()) {

            array_push($benutzer, $row["benutzername"]);
            array_push($nachname, $row["nachname"]);
            array_push($vorname, $row["vorname"]);
            array_push($sex, $row["sex"]);
        }
    }


    $love = array();

    foreach ($benutzer as $benutzername) {

        $command = "SELECT SUM(".$benutzername.") AS total FROM crushcount";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();

            array_push($love, $row["total"]);
        }

    }
    //print_r($benutzer);
    //print_r($love);

    $indexes = $love;
    arsort($indexes);

    $keys = array_keys($indexes); // Die Schlüssel des sortierten Arrays erhalten

    $newLove = array();
    foreach ($keys as $key) {
        $newLove[] = $benutzer[$key];
    }

    $loveVorname = array();
    foreach ($keys as $key) {
        $loveVorname[] = $vorname[$key];
    }

    $loveNachname = array();
    foreach ($keys as $key) {
        $loveNachname[] = $nachname[$key];
    }

    //print_r($indexes);
    //print_r($newLove);

    $newLove = array_slice($newLove, 0, 25);
    $loveVorname = array_slice($loveVorname, 0, 25);
    $loveNachname = array_slice($loveNachname, 0, 25);
    $indexes = array_slice($indexes, 0, 25);


    

    $total = 0;
    $spaltenString = implode(" + ", $benutzer);

    foreach ($benutzer as $benutzername) {

        $command = "SELECT SUM($spaltenString) AS summe FROM crushcount WHERE Benutzername = '$benutzername'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();

            if ($row["summe"] > 0) {
                $total = $total + 1;

            }
        }

    }

    if ($total > 41) {
        foreach ($newLove as $value) {
            echo "✩".$value;
        }
        
        echo "☾";
    
        foreach ($indexes as $value) {
            echo "✩".$value;
        }
        echo "☾";
    
        foreach ($loveVorname as $value) {
            echo "✩".$value;
        }
        echo "☾";
    
        foreach ($loveNachname as $value) {
            echo "✩".$value;
        }
    }
    else {
        echo "ne✩".$total+8;
    }

    
}

