<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('loginÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$story =      $_POST["story"];

storyAbschicken($user_login, $story);

function storyAbschicken($user_login, $story) {

    if (loginÜberprüfen($user_login)) {

        $aktuellesDatum = date("Y-m-d H:i:s");
        $randomID = uniqid(); // Verwendung von uniqid() für eine eindeutige ID
        $story = mb_substr($story, 0, 2000); //Story auf 2000 Zeichen verkürzen

        $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`storys` (`story`, `datum`, `favorit`, `id`) VALUES ('".$story."', '".$aktuellesDatum."', 0, '".$randomID."');";
        $sql = sqlCommand($command);

        baum("STRY✩".hashZuBenutzername(hash("sha512", $user_login))."✩✉️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Story '$story' abgeschickt.");

        echo "1 Story erfolgreich abgeschickt.";
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}