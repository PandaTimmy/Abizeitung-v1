function benutzerLaden(user_login) {



    $.ajax({
        type: "POST",
        url: "../php/benutzerLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {

            document.getElementById("benutzer-alle").innerHTML = "";
            document.getElementById("benutzer-admins").innerHTML = "";

            

            var antworten = response.split("☾");
            antworten = antworten.slice(1);
            
            var result = [];

            for (var i = 0; i < antworten.length; i++) {
                
                result.push(antworten[i].split("✩"));

                nachname = antworten[i].split("✩")[0];
                vorname = antworten[i].split("✩")[1];
                benutzername = antworten[i].split("✩")[2];
                hash = antworten[i].split("✩")[3];
                admin = antworten[i].split("✩")[4];

                console.log(nachname+", "+vorname+", "+benutzername+", "+admin);
                


                benutzerKachelHinzufügen(nachname, vorname, benutzername, admin);
            }

            document.getElementById("admin-load").style.display = "none";   // Loading elemente verschwinden lassen
            document.getElementById("students-load").style.display = "none";

            //console.log(result);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });


}


function benutzerKachelHinzufügen(nachname, vorname, benutzername, admin) {

    if(benutzername == "KlimkeTim") {

        document.getElementById("benutzer-admins").innerHTML += "<select id='a-"+benutzername+"' onchange=\"personAction('a-"+benutzername+"')\"> <option value=\"none\" selected disabled hidden>"+vorname+" "+nachname+"</option> <option value=\"info\">Info</option></select>"
    
        document.getElementById("benutzer-alle").innerHTML += "<select id='s-"+benutzername+"' onchange=\"personAction('s-"+benutzername+"')\"> <option value=\"none\" selected disabled hidden>"+vorname+" "+nachname+"</option> <option value=\"info\">Info</option></select>"
    }
    else {
        if (admin == 1) {

            document.getElementById("benutzer-admins").innerHTML += "<select id='a-"+benutzername+"' onchange=\"personAction('a-"+benutzername+"')\"> <option value=\"none\" selected disabled hidden>"+vorname+" "+nachname+"</option> <option value=\"info\">Info</option> <option value=\"remove-admin\">Admin entfernen</option> <option disabled hidden value=\"reset-password\">Passwort Zurücksetzen</option> <option disabled hidden value=\"delete\">Konto löschen</option> </select>"
    
            document.getElementById("benutzer-alle").innerHTML += "<select id='s-"+benutzername+"' onchange=\"personAction('s-"+benutzername+"')\"> <option value=\"none\" selected disabled hidden>"+vorname+" "+nachname+"</option> <option value=\"info\">Info</option> <option value=\"remove-admin\">Admin entfernen</option> <option disabled hidden value=\"reset-password\">Passwort Zurücksetzen</option> <option disabled hidden value=\"delete\">Konto löschen</option> </select>"
    
            
        }
    
        else {
    
            //document.getElementById("benutzer-alle").innerHTML += "<div class='benutzerKachel'><input type='checkbox' onchange='moderierenBenutzerBefödern(\""+benutzername+"\")' id='u"+benutzername+"'><p id='un"+benutzername+"'>"+vorname+" "+nachname+"</p></div>";

            document.getElementById("benutzer-alle").innerHTML += "<select id='s-"+benutzername+"' onchange=\"personAction('s-"+benutzername+"')\"> <option value=\"none\" selected disabled hidden>"+vorname+" "+nachname+"</option> <option value=\"info\">Info</option> <option value=\"make-admin\">Zum Admin machen</option> <option value=\"reset-password\">Passwort Zurücksetzen</option> <option disabled hidden value=\"delete\">Konto löschen</option> </select>"
    
        }
    }

    
}

function personAction(id) {

    if(document.getElementById(id).value == "info") {

        var user_login = getCookie("login");
        var user = id.substring(2);
        
        $.ajax({
            type: "POST",
            url: "../php/infoUser.php", // Hier den Pfad zu deinem PHP-Skript angeben
            data: { user_login: user_login, user: user },
            success: function(response) {
    

                    
                nachname = response.split("✩")[0];
                vorname = response.split("✩")[1];
                benutzername = response.split("✩")[2];
                hash = response.split("✩")[3];
                rechte = response.split("✩")[4];
                sex = response.split("✩")[5];

                if(rechte == 1) {
                    var rolle = "Admin";
                }
                else {
                    var rolle = "Schüler";
                }
                if(sex == "f") {
                    var sex = "F";
                }
                else {
                    var sex = "M";
                }

                alert("Benutzername: "+benutzername+"\n\nVorname: "+vorname+"\nNachname: "+nachname+"\n\nRolle: "+rolle+"\nGeschlecht: "+sex+"\n\nHash: "+hash);
            },
            error: function(error) {
                // Hier kannst du Fehler bei der Anfrage behandeln
                console.log(error);
            }
        });

        document.getElementById(id).value = "none";
    }

    if(document.getElementById(id).value == "make-admin") {
        if (confirm(id.substring(2)+" zum Admin machen?") == true) {

            benutzerBefördern(getCookie("login"), id.substring(2), true);
    
            benutzerLaden(getCookie("login"));
        }
        else {
            document.getElementById(id).value = "none";
        }
    }

    if(document.getElementById(id).value == "remove-admin") {
        if (confirm(id.substring(2)+" Admin entfernen?") == true) {

            benutzerDegradieren(getCookie("login"), id.substring(2), true);
    
            benutzerLaden(getCookie("login"));
        }
        else {
            document.getElementById(id).value = "none";
        }
    }

    if(document.getElementById(id).value == "reset-password") {
        setCookie("resetPassUserSelected", id.substring(2), 0.001);
        benutzerLaden(getCookie("login"));
        weiterleiten("passwort");
    }

    if(document.getElementById(id).value == "delete") {
        alert("Du Dummkopf, wieso willst du das löschen?");
        benutzerLaden(getCookie("login"));
    }
}