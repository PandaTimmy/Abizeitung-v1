function umfrageAntwortLöschen(login, umfrageName, autorHash) {

    $.ajax({
        type: "POST",
        url: "../php/umfrageAntwortLöschen.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { login: login, umfrageName: umfrageName, autorHash: autorHash },
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