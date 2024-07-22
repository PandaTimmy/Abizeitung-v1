<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];

if ($user_login == "KlimkeTimpTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {

    $command = "DELETE FROM tree";
    $sql = sqlCommand($command);
    baum("DLAA✩".hashZuBenutzername(hash("sha512", $user_login))."✩❌ ".hashZuBenutzername(hash("sha512", $user_login))." hat den Baum gefällt!");
}