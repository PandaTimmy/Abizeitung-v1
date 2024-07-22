function benutzerDegradieren(user_login, benutzername, reload) {

    $.ajax({
        type: "POST",
        url: "../php/benutzerDegradierenBefördern.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, benutzername: benutzername, degradieren: 1 },
        success: function(response) {
            // Hier kannst du den Erfolg der Anfrage behandeln
            console.log(response);
            console.log("ERFOLG");

            if(reload) {
                setTimeout(() => {
                    benutzerLaden(getCookie("login"));
                    console.log("test");
                }, 0);
            }
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });
}

function benutzerBefördern(user_login, benutzername, reload) {

    $.ajax({
        type: "POST",
        url: "../php/benutzerDegradierenBefördern.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, benutzername: benutzername, degradieren: 0 },
        success: function(response) {
            // Hier kannst du den Erfolg der Anfrage behandeln
            console.log(response);
            console.log("ERFOLG");

            if(reload) {
                setTimeout(() => {
                    benutzerLaden(getCookie("login"));
                    console.log("test");
                }, 0);
            }
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });
}