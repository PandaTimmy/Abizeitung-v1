function anmelden() {

    var benutzername = document.getElementById("inputUsername").value;
    var passwort = document.getElementById("inputPassword").value;

    var user_login = benutzername + passwort;
    
    console.log(user_login);

    document.getElementById("error").innerHTML = "<div style='position: absolute; color: rgb(194, 194, 199); margin-top: 15px; border-radius: 10px; font-size: 12px; ' >Lädt...</div>";

    $.ajax({
        type: "POST",
        url: "../php/anmelden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {

            console.log(response);
            
            if (response == 0) {
                document.getElementById("error").innerHTML = "<div style='position: absolute; color: rgb(227, 0, 0); margin-top: 15px; border-radius: 10px; font-size: 12px; ' >Gib gültige Anmeldedaten an.</div>";
                console.log("test");

                document.getElementById("inputUsername").style.borderColor = "rgb(227, 0, 0)";
                document.getElementById("inputUsername").style.backgroundColor = "rgb(255, 242, 244)";
                document.getElementById("inputUsernameLabel").style.color = "rgb(227, 0, 0)";

                document.getElementById("inputPassword").style.borderColor = "rgb(227, 0, 0)";
                document.getElementById("inputPassword").style.backgroundColor = "rgb(255, 242, 244)";
                document.getElementById("inputPasswordLabel").style.color = "rgb(227, 0, 0)";

            }
            else {
                console.log(response);
                data = response.split("✩");              
                console.log(data);

                document.getElementById("error").innerHTML = "<div style='position: absolute; color: rgb(194, 194, 199); margin-top: 15px; border-radius: 10px; font-size: 12px; ' >Anmeldung erfolgreich. Du wirst gleich weitergeleitet.</div>";

                setCookie("login", user_login, 7);
                setCookie("rolle", data[0], 7);
                setCookie("anzeigename", data[1] + " " + data[2], 7);
                setCookie("benutzername", data[3], 7);
                setCookie("initialien", data[1][0] + data[2][0], 7);

                document.getElementById("inputUsername").style.borderColor = "rgb(194, 194, 199)";
                document.getElementById("inputUsername").style.backgroundColor = "rgb(255, 255, 255)";
                document.getElementById("inputUsernameLabel").style.color = "rgb(194, 194, 199)";

                document.getElementById("inputPassword").style.borderColor = "rgb(194, 194, 199)";
                document.getElementById("inputPassword").style.backgroundColor = "rgb(255, 255, 255)";
                document.getElementById("inputPasswordLabel").style.color = "rgb(194, 194, 199)";

                weiterleiten("../konto");

            }
        },
        error: function(error) {
            
            console.log(error);
        }
    });

}