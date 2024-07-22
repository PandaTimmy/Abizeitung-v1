function beichteAbschicken(user_login, beichte) {

    if(document.querySelector("#inputBeichte")) {
        document.getElementById("inputBeichte").readOnly = true;
        document.getElementById("inputAuthor").readOnly = true;
    }

    if (beichte == " ☼") {

        if(document.querySelector("#beichteAbschickenKnopf")) {
            document.getElementById("beichteAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Keine leere Beichte abschicken!</div>";
        }
        setTimeout(() => {
            if(document.querySelector("#beichteAbschickenKnopf")) {
                document.getElementById("beichteAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"beichteAbschicken(getCookie('login'),'{'+document.getElementById('inputAuthor').value+'}'+document.getElementById('inputBeichte').value)\">Beichte senden</button>";
            }
        }, 2000);

        if(document.querySelector("#inputBeichte")) {
            document.getElementById("inputBeichte").readOnly = false;
            document.getElementById("inputAuthor").readOnly = false;
        }
        
    }
    else {

        if(document.querySelector("#beichteAbschickenKnopf")) {
            document.getElementById("beichteAbschickenKnopf").innerHTML = "<div style='background-color: #F5F5F5; border: 1px solid #A4A4A4; color: #A4A4A4; padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Lädt...</div>";
        }
        setTimeout(() => {


            $.ajax({
                type: "POST",
                url: "../php/beichteAbschicken.php", // Hier den Pfad zu deinem PHP-Skript angeben
                data: { user_login: user_login, beichte: beichte },
                success: function(response) {
                    // Hier kannst du den Erfolg der Anfrage behandeln
                    console.log(response);
        
                    if (response = "1") {
        
                        if(document.querySelector("#beichteAbschickenKnopf")) {
                            document.getElementById("beichteAbschickenKnopf").innerHTML = "<div style='background-color: #F5F5F5; border: 1px solid rgb(194, 194, 199); color: #A4A4A4; padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Beichte erfolgreich abgeschickt!</div>";
                            zeilenTabelleZählenUndDivAktualisieren("infobox-beichte-counter", "beichten", true);
                        }
                    }
                    else {
                        if(document.querySelector("#beichteAbschickenKnopf")) {
                        document.getElementById("beichteAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                        }

                        setTimeout(() => {
                            if(document.querySelector("#beichteAbschickenKnopf")) {
                                document.getElementById("beichteAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"beichteAbschicken(getCookie('login'),'{'+document.getElementById('inputAuthor').value+'}'+document.getElementById('inputBeichte').value)\">Beichte senden</button>";
                            }
                            if(document.querySelector("#inputBeichte")) {
                                document.getElementById("inputBeichte").readOnly = false;
                                document.getElementById("inputAuthor").readOnly = false;
                            }
                            
                        }, 2000);
                    }    
                },
                error: function(error) {
                    // Hier kannst du Fehler bei der Anfrage behandeln
                    console.log(error);
        
                    if(document.querySelector("#beichteAbschickenKnopf")) {
                    document.getElementById("beichteAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                    }

                    setTimeout(() => {
                        if(document.querySelector("#beichteAbschickenKnopf")) {
                        document.getElementById("beichteAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"beichteAbschicken(getCookie('login'),'{'+document.getElementById('inputAuthor').value+'}'+document.getElementById('inputBeichte').value)\">Beichte senden</button>";
                        }
                    }, 2000);

                    if(document.querySelector("#inputBeichte")) {
                        document.getElementById("inputBeichte").readOnly = false;
                        document.getElementById("inputAuthor").readOnly = false;
                    }
                    
                }
            });

        }, 500);


    }


    
}