<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');
include('baum.php');


$user_login =   $_POST["login"];
$umfrageName =  $_POST["umfrageName"];
$hashOfAuthor = $_POST["autorHash"];

umfrageAntwortFavorisieren($user_login,$umfrageName,$hashOfAuthor);

function umfrageAntwortFavorisieren($user_login,$umfrageName,$hashOfAuthor) {

    if (adminÜberprüfen($user_login)) {

        $command = "SHOW TABLES LIKE 'umfrage_".$umfrageName."'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $command = "SELECT * FROM umfrage_".$umfrageName." WHERE hash = '$hashOfAuthor'";
            $sql = sqlCommand($command);

            if ($sql->num_rows > 0) {

                $command = "SELECT favorit FROM umfrage_".$umfrageName." WHERE hash = '$hashOfAuthor'";
                $favorit = sqlCommand($command);

                if ($favorit->num_rows > 0) {
                    
                    $row2 = $favorit->fetch_assoc();
                    $favorit = $row2["favorit"];
                }

                if ($favorit == 0) {

                    $command = "UPDATE umfrage_".$umfrageName." SET favorit = 1 WHERE hash = '$hashOfAuthor'";
                    $sql = sqlCommand($command);
    
                    echo "1 Die Umfrage Antwort von '$hashOfAuthor' wurde favorisiert.";
                    baum("UAFV✩".hashZuBenutzername(hash("sha512", $user_login))."✩⭐️ Die Umfrage Antwort bei der Umfrage '$umfrageName' von ".hashZuBenutzername($hashOfAuthor)." wurde favorisiert.");
                }
                else {

                    $command = "UPDATE umfrage_".$umfrageName." SET favorit = 0 WHERE hash = '$hashOfAuthor'";
                    $sql = sqlCommand($command);

                    echo "1 Die Umfrage Antwort von '$hashOfAuthor' wurde aus den Favoriten entfernt.";
                    baum("UAFV✩".hashZuBenutzername(hash("sha512", $user_login))."✩🌟 Die Umfrage Antwort bei der Umfrage '$umfrageName' von ".hashZuBenutzername($hashOfAuthor)." wurde aus den Favoriten entfernt.");
                }
                
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