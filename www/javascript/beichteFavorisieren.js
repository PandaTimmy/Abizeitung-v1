function beichteFavorisieren(user_login, beichteID) {

    $.ajax({
        type: "POST",
        url: "../php/beichteFavorisieren.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, beichteID: beichteID },
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