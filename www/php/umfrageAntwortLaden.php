<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');


$user_login =  $_POST["login"];
$umfrageName = $_POST["umfrageName"];


umfrageAntwortLaden($user_login,$umfrageName);

function umfrageAntwortLaden($user_login,$umfrageName) {

    if (loginÜberprüfen($user_login)) {

        $command = "SHOW TABLES LIKE 'umfrage_".$umfrageName."'";
        $sql = sqlCommand($command);


        if ($sql->num_rows > 0) {


            $hash = hash("sha512", $user_login);

            $command = "SELECT * FROM umfrage_".$umfrageName." WHERE hash = '$hash'";
            $sql = sqlCommand($command);
            
            if ($sql->num_rows > 0) {

                while ($row = $sql->fetch_assoc()) {
                    // Hier kannst du auf die Werte in der Zeile zugreifen
                    echo $row["antwort"];
            
                }
            }
            else {
                echo "0 Keine Antwort abgespeichert für '$user_login' bei Umfrage '$umfrageName'.";
            }
        }

        else {
            echo "0 Umfrage '$umfrageName' existiert nicht.";
        }
    }

    else {

        echo "0 Ungültiger Login: '$user_login'";
    }

}