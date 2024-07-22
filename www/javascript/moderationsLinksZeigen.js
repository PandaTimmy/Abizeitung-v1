function moderationsLinksZeigen(user_login, divID) {

    $.ajax({
        type: "POST",
        url: "../php/checkAdmin.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {
            // Hier kannst du den Erfolg der Anfrage behandeln
            console.log(response);

            if(response) {
                document.getElementById(divID).style.display = "block";
            }
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });
}