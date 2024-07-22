<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');
include('baum.php');
include('hashZuBenutzername.php');

$user_login =  $_POST["login"];
$umfrageName = $_POST["umfrageName"];
$antwort =     $_POST["antwort"];


umfrageAntwortAbschicken($user_login,$umfrageName,$antwort);

function umfrageAntwortAbschicken($user_login,$umfrageName,$antwort) {

    if (loginÜberprüfen($user_login)) {

        $hash = hash("sha512", $user_login);
        $aktuellesDatum = date("Y-m-d H:i:s");
        $antwort = mb_substr($antwort, 0, 2000); //Antwort auf 2000 Zeichen verkürzen.
    
        $command = "SELECT * FROM umfrage_".$umfrageName." WHERE hash = '$hash'";
        $sql = sqlCommand($command);
        
        if ($sql->num_rows > 0) {
            $command = "DELETE FROM umfrage_".$umfrageName." WHERE hash = '$hash'";
            $sql = sqlCommand($command);
        }
        
        $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`umfrage_".$umfrageName."` (`hash`, `antwort`, `datum`, `favorit`) VALUES ('".$hash."', '".$antwort."', '".$aktuellesDatum."', 0);";
        $sql = sqlCommand($command);

        echo "1 Umfrage Antwort \"$antwort\" bei Umfrage '$umfrageName' abgespeichert.";

        baum("UAAB✩".hashZuBenutzername($hash)."✩📊 ".hashZuBenutzername($hash)." hat \"$antwort\" auf die Umfrage \"$umfrageName\" geantwortet.");
    }

    else {

        echo "0 Ungültiger Login: '$user_login'.";
    }
}


?>