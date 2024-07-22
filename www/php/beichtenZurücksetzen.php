<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');

$user_login = $_POST["user_login"];

if (adminÜberprüfen($user_login)) {

    $command = "DELETE FROM beichten";
    $sql = sqlCommand($command);

    baum("DLAB✩".hashZuBenutzername(hash("sha512", $user_login))."✩❌ ".hashZuBenutzername(hash("sha512", $user_login))." hat die Beichten zurückgesetzt.");
}