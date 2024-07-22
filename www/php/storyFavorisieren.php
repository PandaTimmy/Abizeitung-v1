<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$storyID =    $_POST["storyID"];

storyFavorisieren($user_login, $storyID);

function storyFavorisieren($user_login, $storyID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT story FROM storys WHERE id = $storyID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $story = $row["story"];

            $command = "SELECT favorit FROM storys WHERE id = $storyID";
            $favorit = sqlCommand($command);

            if ($favorit->num_rows > 0) {
                
                $row2 = $favorit->fetch_assoc();
                $favorit = $row2["favorit"];
            }
            

            if ($favorit == 0) {

                $command = "UPDATE storys SET favorit = 1 WHERE id = '$storyID'";
                $sql = sqlCommand($command);

                echo "1 Die Story '$story' wurde favorisiert.";
                baum("FAVS✩".hashZuBenutzername(hash("sha512", $user_login))."✩⭐️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Story '$story' favorisiert.");

            }
            else {

                $command = "UPDATE storys SET favorit = 0 WHERE id = '$storyID'";
                $sql = sqlCommand($command);

                echo "1 Die Story '$story' wurde aus den Favoriten entfernt.";
                baum("FAVS✩".hashZuBenutzername(hash("sha512", $user_login))."✩🌟 ".hashZuBenutzername(hash("sha512", $user_login))." hat die Story '$story' aus den Favoriten entfernt.");

            }

        }
        else {
            echo "0 Keine abgespeicherte Story mit der ID '$storyID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}