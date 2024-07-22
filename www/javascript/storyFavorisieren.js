function storyFavorisieren(user_login, storyID) {

    $.ajax({
        type: "POST",
        url: "../php/storyFavorisieren.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, storyID: storyID },
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