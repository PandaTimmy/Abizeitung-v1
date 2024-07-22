<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login =       $_POST["user_login"];
$benutzername =     $_POST["benutzername"];

function random_string($length) {
    $str = random_bytes($length);
    $str = base64_encode($str);
    $str = str_replace(["+", "/", "="], "", $str);
    $str = substr($str, 0, $length);
    return $str;
}


if (adminÜberprüfen($user_login)) {

    if ( $benutzername != "KlimkeTim") {

        $command = "SELECT * FROM benutzerkonten WHERE benutzername = '$benutzername'";
        $sql = sqlCommand($command);


        if ($sql->num_rows > 0) {
            $newPass = random_string(8);
            $newLogin = $benutzername.$newPass;
            $newHash = hash("sha512", $newLogin);

            $command = "UPDATE benutzerkonten SET hash = '$newHash' WHERE benutzername = '$benutzername'";
            $sql = sqlCommand($command);

            baum("PASS✩".hashZuBenutzername(hash("sha512", $user_login))."✩🔐❌ ".hashZuBenutzername(hash("sha512", $user_login))." hat das Passwort von $benutzername zu <span style='font-family: \”courier-new\”; background-color: rgba(194, 194, 199, 0.635); padding: 5px;'>$newPass</span> zurückgesetzt.");

            echo "$newPass";
            echo "✩";
            echo "$benutzername";
        }
        else {
            echo "0";
        }
    }
    else {
        echo "0";
    }

    

                
}
