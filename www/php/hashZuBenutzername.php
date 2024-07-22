<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');

//$hash = $_POST["hash"];
//hashZuBenutzername($hash);

function hashZuBenutzername($hash) {

    $command = "SELECT * FROM benutzerkonten WHERE hash = '$hash'";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        while ($row = $sql->fetch_assoc()) {
            return $row['benutzername'];
        }
    }

}

?>