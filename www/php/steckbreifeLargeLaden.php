<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');


$command = "SELECT * FROM dateien WHERE name = 'titelbild' ORDER BY RAND() LIMIT 10";
$sql = sqlCommand($command);


if ($sql->num_rows > 0) {

    while ($row = $sql->fetch_assoc()) {

    $bild_inhalt = $row['datei']; // BILD LADEN
    $bild_typ = $row['dateityp'];

    $base64_image = 'data:' . $bild_typ . ';base64,' . base64_encode($bild_inhalt);
    //$base64_image = '../steckbriefe/Bilder/male-default.jpeg';

    echo '<div class="steckbriefeKontainer" style="background-image: url(\''.$base64_image.'\'")></div>';
    }


} 

echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/female-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/male-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/female-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/male-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/female-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/male-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/female-default.jpeg\'")></div>';
echo '<div class="steckbriefeKontainer" style="background-image: url(\'../steckbriefe/Bilder/male-default.jpeg\'")></div>';

?>