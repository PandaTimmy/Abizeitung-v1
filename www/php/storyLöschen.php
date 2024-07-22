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

storyLöschen($user_login, $storyID);

function storyLöschen($user_login, $storyID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT story FROM storys WHERE id = $storyID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $story = $row["story"];

            $command = "DELETE FROM storys WHERE id = '$storyID'";
            $sql = sqlCommand($command);

            echo "1 Story '$story' wurde gelöscht.";
            baum("DELS✩".hashZuBenutzername(hash("sha512", $user_login))."✩🗑️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Story '$story' gelöscht.");

        }
        else {
            echo "1 Keine abgespeicherte Story mit der ID '$storyID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}