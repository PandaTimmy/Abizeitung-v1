function umfrageErstellen(user_login, name, titel, beschreibung) {

    $.ajax({
        type: "POST",
        url: "../php/umfrageErstellen.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, umfrageName: name, umfrageTitel: titel, umfrageBeschreibung: beschreibung },
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