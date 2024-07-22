<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function steckbriefeAntwortenFormatieren() {

$command = "SELECT * FROM steckbriefefragen ORDER BY id ASC";
$sql = sqlCommand($command);

$fragenIDs = array();

$zeilen = 0;

if ($sql->num_rows > 0) {
    
    while ($row = $sql->fetch_assoc()) {

        array_push($fragenIDs, $row["randomId"]);
        $zeilen = $zeilen + 1;
            
    }
}



for ($i = 0; $i < $zeilen; $i++) {
    $questionID = $fragenIDs[$i];
    $questionID = preg_replace("/[^a-zA-Z0-9]+/", "", $questionID);

    $command = "SELECT COUNT(*) AS count
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'steckbriefeantworten' AND COLUMN_NAME = '".$questionID."'";
    $sql = sqlCommand($command);




    if ($sql) {

        $row = $sql->fetch_assoc();


        if(($row['count'] == 0)) {
            echo "Spalte hinzugefügt";

            $command = "ALTER TABLE steckbriefeantworten 
            ADD COLUMN `".$questionID."` TEXT;";
            $sql = sqlCommand($command);


        }

    }

}}
