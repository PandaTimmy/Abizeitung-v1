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

zitatLöschen($user_login, $zitatID);

function zitatLöschen($user_login, $zitatID) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT zitat FROM zitate WHERE id = $zitatID";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {

            $row = $sql->fetch_assoc();
            $zitat = $row["zitat"];

            $command = "DELETE FROM zitate WHERE id = '$zitatID'";
            $sql = sqlCommand($command);

            echo "1 Zitat '$zitat' wurde gelöscht.";
            baum("DELZ✩".hashZuBenutzername(hash("sha512", $user_login))."✩🗑️ ".hashZuBenutzername(hash("sha512", $user_login))." hat das Zitat '$zitat' gelöscht.");

        }
        else {
            echo "1 Kein abgespeichertes Zitat mit der ID '$zitatID'.";
        }
    }
    else {
        echo "0 Ungültiger Login: '$user_login'.";
    }
}