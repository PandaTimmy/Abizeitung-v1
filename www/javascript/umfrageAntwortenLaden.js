function umfrageAntwortenLaden(user_login, name) {

    $.ajax({
        type: "POST",
        url: "../php/umfrageAntwortenLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login, umfrageName: name },
        success: function(response) {

            var antworten = response.split("☾");
            antworten = antworten.slice(1);
            
            var result = [];

            for (var i = 0; i < antworten.length; i++) {

                result.push(antworten[i].split("✩"));
            }

            console.log(result);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });
}