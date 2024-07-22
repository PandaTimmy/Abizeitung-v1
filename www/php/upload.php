<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');
include('adminÜberprüfen.php');
include('hashZuBenutzername.php');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hgu-abi-25_abizeitungDB";

// Verbindung herstellen
$connection = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($connection->connect_error) {
    die("Verbindung fehlgeschlagen: " . $connection->connect_error);
}



// Maximal erlaubte Dateigröße (in Bytes)
$max_file_size = 10 * 1024 * 1024; // 10 MB


if ($_FILES['datei']['size'] > $max_file_size) {
    // Dateigröße überschreitet das Limit
    echo "0 Die Dateigröße darf maximal 10 MB betragen";


} elseif ($_FILES['datei']['size'] > 0) {
    // Dateiinformationen erhalten
    $datei_tmp_name = $_FILES['datei']['tmp_name'];
    $datei_inhalt = file_get_contents($datei_tmp_name);
    $datei_typ = pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION);

    // Aktuelles Datum und Uhrzeit erhalten
    $datum = date("Y-m-d H:i:s");

    // Benutzerdaten aus dem Formular erhalten
    $name = $_POST['name'];
    $benutzer = $_POST['benutzer'];
    $pfad = $_POST['pfad'];

    // SQL-Anweisung vorbereiten
    $sql = "INSERT INTO dateien (name, benutzer, datum, pfad, dateityp, datei) VALUES (?, ?, ?, ?, ?, ?)";

    // Vorbereitete Anweisung vorbereiten und Parameter binden
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssss", $name, $benutzer, $datum, $pfad, $datei_typ, $datei_inhalt);

    // Vorbereitete Anweisung ausführen
    $stmt->execute();

    // Überprüfen, ob das Einfügen erfolgreich war
    if ($stmt->affected_rows > 0) {
        echo "Datei erfolgreich in die Datenbank eingefügt";
    } else {
        echo "Fehler beim Einfügen der Datei in die Datenbank";
    }

    // Vorbereitete Anweisung schließen
    $stmt->close();
} else {
    echo "Fehler: Keine Datei hochgeladen";
}





$command = "SELECT datei, dateityp FROM dateien";
$sql = sqlCommand($command);

if ($sql->num_rows > 0) {
    // Daten des ersten Datensatzes abrufen
    while ($row = $sql->fetch_assoc()) {
        // Bilddaten und MIME-Typ aus der Datenbank abrufen
        $bild_inhalt = $row['datei'];
        $bild_typ = $row['dateityp'];

        // MIME-Typ des Bildes überprüfen und entsprechend das img-Tag erstellen
        $base64_image = 'data:' . $bild_typ . ';base64,' . base64_encode($bild_inhalt);
        echo "<img src='$base64_image' alt='Bild'><br>";
    }

} else {
    echo "Keine Bilddaten gefunden";
}



?>