function umfrageAntwortAbschicken(login, umfrageName, antwort) {

    $.ajax({
        type: "POST",
        url: "../php/umfrageAntwortAbschicken.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { login: login, umfrageName: umfrageName, antwort: antwort },
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