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

umfrageLöschen($umfrageName,$user_login);


function umfrageLöschen($name,$user_login) {

    if (adminÜberprüfen($user_login)) {

        $command = "SELECT * FROM umfragen WHERE name = '$name'";
        $sql = sqlCommand($command);

        if ($sql->num_rows > 0) {
            $command = "DROP TABLE IF EXISTS umfrage_".$name;
            $sql = sqlCommand($command);

            $command = "DELETE FROM umfragen WHERE name ='".$name."'";
            $sql = sqlCommand($command);
        
            echo "1 Umfrage '$name' gelöscht.";
            baum("UMFR✩".hashZuBenutzername(hash("sha512", $user_login))."✩🗑️ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Umfrage '$name' gelöscht.");

        } else {
            echo "0 Umfrage '$name' existiert nicht oder wurde schon gelöscht.";
        }
    }
    else {
        echo "0 Ungültiger Login oder kein Admin.";
    }
}

?>