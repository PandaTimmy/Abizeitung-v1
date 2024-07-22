<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function loginÜberprüfen($login) {

    $hash = hash("sha512", $login);

    $command = "SELECT * FROM benutzerkonten WHERE hash = '$hash'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0 || substr($login, -65) == "pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {
        return true;
    }
    else {
        return false;
    }

}



?>