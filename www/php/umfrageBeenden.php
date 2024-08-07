<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$umfrageName = $_POST["umfrageName"];
$user_login = $_POST["user_login"];

umfrageBeenden($user_login,$umfrageName);


function umfrageBeenden($user_login,$name) {
    
    if (adminÜberprüfen($user_login)) {

        $command = "SELECT * FROM umfragen WHERE name = '$name'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            $command = "UPDATE umfragen SET status = 0 WHERE name = '".$name."'";
            $sql = sqlCommand($command);

            echo "1 Umfrage '$name' beendet.";

            baum("UMFR✩".hashZuBenutzername(hash("sha512", $user_login))."✩📊 ".hashZuBenutzername(hash("sha512", $user_login))." hat die Umfrage '$name' beendet.");

        } else {
            echo "0 Umfrage '$name' existiert nicht oder wurde gelöscht.";
        }
    }  

    else {
        echo "0 Ungültiger Login oder kein Admin.";
    }

}

?>