<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
// $serverUsername = "hgu-abi-25";
// $serverPassword = "hgu-sql-bplaced";
$dbname = "hgu-abi-25_abizeitungDB";

$serverUsername = "root";
$serverPassword = "";

if (!function_exists("sqlCommand")) {

    function sqlCommand($sqlcommand) {
        global $servername, $serverUsername, $serverPassword, $dbname;

        //echo "Ausgeführtes SQL-Statement: " . $sqlcommand . "<br>";

    
        $conn = new mysqli($servername, $serverUsername, $serverPassword, $dbname);
        $conn->set_charset("utf8mb4");
    
        if ($conn->connect_error) {
            die("Verbindung fehlgeschlagen: " . $conn->connect_error);
        }
        
        $result = $conn->query($sqlcommand);
    
        $conn->close();





    
        // $empfaenger = "timothyklimke@icloud.com";
        // $betreff = "SQL Befehl";
        // $nachricht = $sqlcommand;

        // // Zusätzliche Header
        // $header = "From: absender@example.com\r\n";
        // $header .= "Reply-To: absender@example.com\r\n";
        // $header .= "Content-Type: text/plain; charset=utf-8\r\n";

        // // E-Mail senden
        // mail($empfaenger, $betreff, $nachricht, $header);
    





        return $result;
    
    }
}




?>
