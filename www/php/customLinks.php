<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sql.php');
include('baum.php');

$user_login = $_POST["user_login"];

customLinks($user_login);

function customLinks($user_login) {

    if ($user_login == "KlimkeTimpTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa") {

        //bananaTree(key);

    echo '<div class="link" onclick="
    
    var command = prompt(\'Befehl eingeben\');
    if (command == \'Logs\') {
        //var key = prompt(\'Wie lautet der RSA 4096-Bit Private Key?\');
    

        loadIntoDocument(\'KlimkeTimpTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa\', \'\', \'\', \'\', \'\', \'../php/privateKeyUpload.php\', \'OutputLayer1\');
    }
    else if (command == \'Clear Log\') {
        treeZurücksetzen(\'KlimkeTimpTg1f-b2zDh-3uQ4c-nI5oLa-6vYsGj-7hK8Fb-sH9tEw-0kVuNx-iZ1Py-lM2vJa\');
        alert(\'Du hast das Protokoll gelöscht.\');
    }
    else {
        alert(\'Ungültiger Befehl.\');

    }
    
    "><h3>Konsole</h3><div class="bottom">Befehle eingeben</div></div>';



    }

}