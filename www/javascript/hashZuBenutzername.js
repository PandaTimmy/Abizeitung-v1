function hashZuBenutzername(hash) {

    $.ajax({
        type: "POST",
        url: "../php/hashZuBenutzername.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { hash: hash },
        success: function(response) {
            // Hier kannst du den Erfolg der Anfrage behandeln
            console.log(response);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);

        }
    });
}