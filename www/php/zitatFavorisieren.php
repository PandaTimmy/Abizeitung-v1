<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$zitatID =    $_POST["zitatID"];

zitatFavorisieren($user_login, $zitatID);

function zitatFavorisieren($user_login, $zitatID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT zitat FROM zitate WHERE id = $zitatID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $zitat = $row["zitat"];

            $command = "SELECT favorit FROM zitate WHERE id = $zitatID";
            $favorit = sqlCommand($command);

            if ($favorit->num_rows > 0) {
                
                $row2 = $favorit->fetch_assoc();
                $favorit = $row2["favorit"];
            }
            

            if ($favorit == 0) {

                $command = "UPDATE zitate SET favorit = 1 WHERE id = '$zitatID'";
                $sql = sqlCommand($command);

                echo "1 Das Zitat '$zitat' wurde favorisiert.";
                baum("FAVZ✩".hashZuBenutzername(hash("sha512", $user_login))."✩⭐️ ".hashZuBenutzername(hash("sha512", $user_login))." hat das Zitat '$zitat' favorisiert.");

            }
            else {

                $command = "UPDATE zitate SET favorit = 0 WHERE id = '$zitatID'";
                $sql = sqlCommand($command);

                echo "1 Das Zitat '$zitat' wurde aus den Favoriten entfernt.";
                baum("FAVZ✩".hashZuBenutzername(hash("sha512", $user_login))."✩🌟 ".hashZuBenutzername(hash("sha512", $user_login))." hat das Zitat '$zitat' aus den Favoriten entfernt.");

            }

        }
        else {
            echo "0 Keine abgespeichertes Zitat mit der ID '$zitatID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}