<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$beichteID =    $_POST["beichteID"];

beichteFavorisieren($user_login, $beichteID);

function beichteFavorisieren($user_login, $beichteID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT beichte FROM beichten WHERE id = $beichteID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $beichte = $row["beichte"];

            $command = "SELECT favorit FROM beichten WHERE id = $beichteID";
            $favorit = sqlCommand($command);

            if ($favorit->num_rows > 0) {
                
                $row2 = $favorit->fetch_assoc();
                $favorit = $row2["favorit"];
            }
            

            if ($favorit == 0) {

                $command = "UPDATE beichten SET favorit = 1 WHERE id = '$beichteID'";
                $sql = sqlCommand($command);

                echo "1 Die Beichte '$beichte' wurde favorisiert.";
                baum("FAVB✩".hashZuBenutzername(hash("sha512", $user_login))."✩⭐️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Beichte '$beichte' favorisiert.");

            }
            else {

                $command = "UPDATE beichten SET favorit = 0 WHERE id = '$beichteID'";
                $sql = sqlCommand($command);

                echo "1 Die Beichte '$beichte' wurde aus den Favoriten entfernt.";
                baum("FAVB✩".hashZuBenutzername(hash("sha512", $user_login))."✩🌟 ".hashZuBenutzername(hash("sha512", $user_login))." hat die Beichte '$beichte' aus den Favoriten entfernt.");

            }

        }
        else {
            echo "0 Keine abgespeicherte Beichte mit der ID '$beichteID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}