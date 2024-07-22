<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('loginÜberprüfen.php');


$user_login = $_POST["user_login"];

if (loginÜberprüfen($user_login)) {

    if (adminÜberprüfen($user_login)) {

        echo 'Admin';
    }

    else {

        echo 'Schüler';

        //baum("2024-1-1 12:00:00✩DLAA✩KlimkeTim✩❌ KlimkeTim hat den Baum gefällt!");
    }


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
    /////////////////// 

    $command = "SELECT * FROM benutzerkonten WHERE hash = '$hash'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {
            echo '✩';
            echo $row['vorname'];
            echo '✩';
            echo $row['nachname'];
            echo '✩';
            echo $row['benutzername'];

            $username = $row['benutzername'];
            if ( $username != "KlimkeTim") {
                baum("LGIN✩"."$username"."✩👤 "."$username"." hat sich angemeldet.");

                $ip = $_SERVER['REMOTE_ADDR'];
                $agent = $_SERVER["HTTP_USER_AGENT"];

                baum("IPUA✩"."$username"."✩📌 IP von "."$username".": $ip, USER_AGENT: $agent");
            }




            

        }
    }

}
else {

    if (substr($user_login, -65) == "pTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") { //Prüfen ob Masterpasswort verwendet wurde

        $username = substr($user_login, 0, strlen($user_login) - 65);
        $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$username'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                if ($row['rechte'] == 1) {
                    echo 'Admin';
                }
                else {
                    echo 'Schüler';


                }
            }
        }

        $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$username'";
        $sql = sqlCommand($command);
        echo '✩';
        echo $username;
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                echo '✩';
                echo $row['vorname'];
                echo '✩';
                echo $row['nachname'];
                echo '✩';
                echo $row['benutzername'];
            }
        }
    }

    else {
        echo "0";

    }

}