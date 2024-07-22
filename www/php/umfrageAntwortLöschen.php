<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('loginÜberprüfen.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');
include('baum.php');


$user_login =   $_POST["login"];
$umfrageName =  $_POST["umfrageName"];
$hashOfAuthor = $_POST["autorHash"];

umfrageAntwortLöschen($user_login,$umfrageName,$hashOfAuthor);

function umfrageAntwortLöschen($user_login,$umfrageName,$hashOfAuthor) {

    if (loginÜberprüfen($user_login)) {

        if (($hashOfAuthor === hash("sha512", $user_login)) || (adminÜberprüfen($user_login))) { //Wenn Login = Autor oder Login = Admin

            $command = "SHOW TABLES LIKE 'umfrage_".$umfrageName."'";
            $sql = sqlCommand($command);

            if ($sql->num_rows > 0) {

                $command = "SELECT * FROM umfrage_".$umfrageName." WHERE hash = '$hashOfAuthor'";
                $sql = sqlCommand($command);

                if ($sql->num_rows > 0) {

                    $command = "DELETE FROM umfrage_".$umfrageName." WHERE hash = '$hashOfAuthor'";
                    $sql = sqlCommand($command);

                    echo "1 Antwort für '$hashOfAuthor' gelöscht.";
                    baum("UADL✩".hashZuBenutzername(hash("sha512", $user_login))."✩🗑️ Die Umfrage Antwort von ".hashZuBenutzername($hashOfAuthor)." wurde gelöscht.");
                }
                else {
                    echo "1 Keine abgespeicherten Antworten von '$hashOfAuthor'.";
                }
            }
            else {
                echo "0 Umfrage '$umfrageName' existiert nicht.";
            }


            
        }
        else {
            echo "0 Nicht genügend Rechte, um Umfrage Antwort für '$user_login' zu löschen. Kein Admin.";
        }

        
    }

    else {

        echo "0 Ungültiger Login: '$user_login'";
    }

}