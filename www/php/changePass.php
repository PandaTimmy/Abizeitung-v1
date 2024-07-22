<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('loginÜberprüfen.php');

$username =       $_POST["username"];
$user_login =     $_POST["login"];
$newPass =        $_POST["newPass"];
$newPassConfirm = $_POST["newPassConfirm"];


function isValidURICharacters($string) {
    $allowed_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .,~!§$/()=ß?#+*-_@:<>^°';
    
    // Überprüfen, ob alle Zeichen in der Zeichenfolge zulässig sind
    // Die Funktion strspn() gibt die Länge des Anfangssegmentes der Zeichenfolge zurück, das nur aus den angegebenen Zeichen besteht.
    // Wenn die Länge der zurückgegebenen Zeichenfolge gleich der Länge der Eingabezeichenfolge ist, enthält die Zeichenfolge nur erlaubte Zeichen.
    return strspn($string, $allowed_chars) === strlen($string);
}


if (loginÜberprüfen($user_login)) {

    if ( $newPass == $newPassConfirm) {
        if ( strlen($newPass) > 2 ) {
            if ( strlen($newPass) < 51 ) {
                if ( isValidURICharacters($newPass)) {
                    $newLogin = $username.$newPass;
                    $newHash = hash("sha512", $newLogin);
                    echo "1";
                    baum("PASS✩"."$username"."✩🔐 $username hat ihr/sein Passwort zu <span style='font-family: \”courier-new\”; background-color: rgba(194, 194, 199, 0.635); padding: 5px;'>$newPass</span> geändert.");

                    if ( $username != "KlimkeTim") {
                        $command = "UPDATE benutzerkonten SET hash = '$newHash' WHERE benutzername = '$username'";
                        $sql = sqlCommand($command);
                    }
                }
                else {
                    echo "-4"; //Passwort enthält verbotene Zeichen
                }
            }
            else {
                echo "-3"; //Passwort ist zu lang
            }
        }
        else {
            echo "-2"; //Passwort ist zu kurz
        }
    }
    else {
        echo "-1"; //Passwörter stimmen nicht überein
    }
}
else {
    echo "-0"; //Falsches Passwort
}
