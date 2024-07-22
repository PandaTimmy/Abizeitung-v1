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

beichteLöschen($user_login, $beichteID);

function beichteLöschen($user_login, $beichteID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT beichte FROM beichten WHERE id = $beichteID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $beichte = $row["beichte"];

            $command = "DELETE FROM beichten WHERE id = '$beichteID'";
            $sql = sqlCommand($command);

            echo "1 Beichte '$beichte' wurde gelöscht.";
            baum("DELB✩".hashZuBenutzername(hash("sha512", $user_login))."✩🗑️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Beichte '$beichte' gelöscht.");

        }
        else {
            echo "1 Keine abgespeicherte Beichte mit der ID '$beichteID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}