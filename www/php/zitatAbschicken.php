<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('loginÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$zitat =      $_POST["zitat"];

zitatAbschicken($user_login, $zitat);

function zitatAbschicken($user_login, $zitat) {

    if (loginÜberprüfen($user_login)) {

        $aktuellesDatum = date("Y-m-d H:i:s");
        $randomID = uniqid();
        $zitat = mb_substr($zitat, 0, 2000); //Zitat auf 2000 Zeichen verkürzen

        $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`zitate` (`zitat`, `datum`, `favorit`, `id`) VALUES ('".$zitat."', '".$aktuellesDatum."', 0, '".$randomID."');";
        $sql = sqlCommand($command);

        baum("ZTAT✩".hashZuBenutzername(hash("sha512", $user_login))."✩✉️ ".hashZuBenutzername(hash("sha512", $user_login))." hat das Zitat '$zitat' abgeschickt.");

        echo "1 Zitat erfolgreich abgeschickt.";
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}