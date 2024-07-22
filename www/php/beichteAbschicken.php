<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('loginÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];
$beichte =      $_POST["beichte"];

zitatAbschicken($user_login, $beichte);

function zitatAbschicken($user_login, $beichte) {

    if (loginÜberprüfen($user_login)) {

        $hash = hash("sha512", $user_login);

        /////////////////// Hash korrigieren falls Login durch Masterpasswort
        if (substr($user_login, -65) == "pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {
            $username = substr($user_login, 0, strlen($user_login) - 65);
            $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$username'";
            $sql = sqlCommand($command);
        
            if ($sql->num_rows > 0) {
                while ($row = $sql->fetch_assoc()) {
                    $hash = $row['hash'];
                }
            }
        }

        $aktuellesDatum = date("Y-m-d H:i:s");
        $randomID = uniqid();

        $zitat = mb_substr($beichte, 0, 2000); //Beichte auf 2000 Zeichen verkürzen

        $command = "INSERT INTO `hgu-abi-25_abizeitungDB`.`beichten` (`beichte`, `datum`, `favorit`, `id`) VALUES ('".$beichte."', '".$aktuellesDatum."', 0, ".$randomID.");";
        $sql = sqlCommand($command);

        baum("BCHT✩".hashZuBenutzername($hash)."✩💌 ".hashZuBenutzername($hash)." hat die Beichte '$beichte' abgeschickt.");

        echo 1;
    }
    else {
        echo 0;
    }
}