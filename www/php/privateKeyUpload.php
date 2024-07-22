<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');

$user_login = $_POST["data1"];


if ($user_login == "KlimkeTimpTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {

    echo '<h2>Protokoll</h2>';

    echo '<div style="background-color: rgba(194, 194, 199, 0.157); border: .5px solid rgb(194, 194, 199); border-radius: 12px; padding: 10px 16px 16px 16px;">';

    echo '<h2 class="article-eyebrow">PRIVATE KEY HOCHLADEN</h2>';

    echo '<input id="keyUpload" type="file" accept=".pem" onchange="
    
    var dateiInput = document.getElementById(\'keyUpload\');
    var datei = dateiInput.files[0];

    if (datei) {
        var reader = new FileReader();

        reader.onload = function(event) {
            var dateiInhalt = event.target.result;

            // Hier kannst du den Inhalt der Datei weiterverarbeiten
            console.log(dateiInhalt);

            var key = dateiInhalt;
            loadIntoDocument(key, \'false\', \'true\', \'Kategorie\', \'div.filterObjects\', \'../php/decryptTree.php\', \'OutputLayer2\');
            loadIntoDocument(key, \'true\', \'false\', \'\', \'\', \'../php/decryptTree.php\', \'OutputLayer3\');

        };

        // Lese den Inhalt der Datei ein
        reader.readAsText(datei);
    }

    
    
    
    ">';

    echo '</div>';

    echo '<div style="height: 50px;"></div>';

    echo '<h2 class="article-eyebrow">FILTER</h2>';


    echo '

        <select id="filter" style="max-width: 300px; margin-left: 0;" onchange="

            document.getElementById(\'filterUsers\').value = \'div.filterObjects\';

            var alles = document.querySelectorAll(\'.filterObjects\');
            alles.forEach(function(element) {
                element.style.display = \'none\';
            });

            var alles = document.querySelectorAll(document.getElementById(\'filter\').value);
            alles.forEach(function(element) {
                element.style.display = \'block\';
            });
            

            var dateiInput = document.getElementById(\'keyUpload\');
            var datei = dateiInput.files[0];

            if (datei) {
                var reader = new FileReader();
        
                reader.onload = function(event) {
                    var dateiInhalt = event.target.result;
                    var key = dateiInhalt;
        
                    var filter =  document.getElementById(\'filter\').value
                    setCookie(\'filter\', filter, 0.01);
                    loadIntoDocument(key, \'false\', \'true\', \'Kategorie\', filter, \'../php/decryptTree.php\', \'OutputLayer2\');
        
                };
        
                // Lese den Inhalt der Datei ein
                reader.readAsText(datei);
            }

            


        ">
            <option value="div.filterObjects">Alle Einblenden</option>
            <option value="div.IPUA">📌 IP Adressen / User Agents</option>
            <option value="div.PASS">🔐 Passwort Änderungen</option>
            <option value="div.LGIN">👤 Anmeldungen</option>
            <option value="div.BCHT, div.FAVB, div.DELB, div.DLAB">💌 Beichten</option>
            <option value="div.ZTAT, div.FAVZ, div.DELZ, div.DLAZ">✉️ Zitate</option>
            <option value="div.STRY, div.FAVS, div.DELS, div.DLAS">✉️ Storys</option>
            <option value="div.UMFR, div.UAFV, div.UADL, div.UAAB">📊 Umfragen</option>
            <option value="div.RANK">📊 Rankings</option>
            <option value="div.ABST">📊 Abstimmungen</option>
        </select>
    ';

    echo '<div style="height: 10px;"></div>';


    echo '
        <select id="filterUsers" style="max-width: 300px; margin-left: 0;" onchange="

            document.getElementById(\'filter\').value = \'div.filterObjects\';

            var alles = document.querySelectorAll(\'.filterObjects\');
            alles.forEach(function(element) {
                element.style.display = \'none\';
            });

            var alles = document.querySelectorAll(document.getElementById(\'filterUsers\').value);
            alles.forEach(function(element) {
                element.style.display = \'block\';
            });


            var dateiInput = document.getElementById(\'keyUpload\');
            var datei = dateiInput.files[0];

            if (datei) {
                var reader = new FileReader();
        
                reader.onload = function(event) {
                    var dateiInhalt = event.target.result;
                    var key = dateiInhalt;
        
                    var filter =  document.getElementById(\'filterUsers\').value
                    setCookie(\'filter\', filter, 0.01);
                    loadIntoDocument(key, \'false\', \'true\', \'Benutzer\', filter, \'../php/decryptTree.php\', \'OutputLayer2\');
        
                };
        
                // Lese den Inhalt der Datei ein
                reader.readAsText(datei);
            }
            
        ">
            <option value="div.filterObjects">Alle Benutzer</option>';

    
    $command = "SELECT nachname, vorname, benutzername, hash, rechte FROM benutzerkonten ORDER BY vorname ASC";
    $sql = sqlCommand($command);

    if ($sql->num_rows > 0) {
        

        while ($row = $sql->fetch_assoc()) {
            
            echo '<option value="div.'.$row["benutzername"].'">'.$row["vorname"].' '.$row["nachname"].'</option>';
            //echo "☾".$row["nachname"]."✩".$row["vorname"]."✩".$row["benutzername"]."✩".$row["hash"]."✩".$row["rechte"];
            
        }
    }

    echo '</select><div style="height: 50px;"></div>';


    // echo '
    //         <option value="div.IPUA">📌 IP Adressen / User Agents</option>
    //         <option value="div.PASS">🔐 Passwort Änderungen</option>
    //         <option value="div.LGIN">👤 Anmeldungen</option>
    //         <option value="div.BCHT, div.FAVB, div.DELB, div.DLAB">💌 Beichten</option>
    //         <option value="div.ZTAT, div.FAVZ, div.DELZ, div.DLAZ">✉️ Zitate</option>
    //         <option value="div.STRY, div.FAVS, div.DELS, div.DLAS">✉️ Storys</option>
    //         <option value="div.UMFR, div.UAFV, div.UADL, div.UAAB">📊 Umfragen</option>
    //         <option value="div.RANK">📊 Rankings</option>
    //         <option value="div.ABST">📊 Abstimmungen</option>
    //     </select>
    // ';

}

?>