// function zitatAbschicken(user_login, zitat) {

//     $.ajax({
//         type: "POST",
//         url: "../php/zitatAbschicken.php", // Hier den Pfad zu deinem PHP-Skript angeben
//         data: { user_login: user_login, zitat: zitat },
//         success: function(response) {
//             // Hier kannst du den Erfolg der Anfrage behandeln
//             console.log(response);
//         },
//         error: function(error) {
//             // Hier kannst du Fehler bei der Anfrage behandeln
//             console.log(error);
//         }
//     });
// }



function zitatAbschicken(user_login, zitat) {

    if(document.querySelector("#inputZitat")) {
        document.getElementById("inputZitat").readOnly = true;
        document.getElementById("inputKontext").readOnly = true;
    }

    if (zitat == " ☼") {

        if(document.querySelector("#zitatAbschickenKnopf")) {
            document.getElementById("zitatAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Kein leeres Zitat abschicken!</div>";
        }
        setTimeout(() => {
            if(document.querySelector("#zitatAbschickenKnopf")) {
                document.getElementById("zitatAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"zitatAbschicken(getCookie('login'),document.getElementById('inputZitat').value+' ☼'+document.getElementById('inputKontext').value)\">Zitat senden</button>";
            }
        }, 2000);

        if(document.querySelector("#inputZitat")) {
            document.getElementById("inputZitat").readOnly = false;
            document.getElementById("inputKontext").readOnly = false;
        }
        
    }
    else {

        if(document.querySelector("#zitatAbschickenKnopf")) {
            document.getElementById("zitatAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"zitatAbschicken(getCookie('login'),document.getElementById('inputZitat').value+' ☼'+document.getElementById('inputKontext').value)\">Zitat senden</button>";
        }
        setTimeout(() => {


            $.ajax({
                type: "POST",
                url: "../php/zitatAbschicken.php", // Hier den Pfad zu deinem PHP-Skript angeben
                data: { user_login: user_login, zitat: zitat },
                success: function(response) {
                    // Hier kannst du den Erfolg der Anfrage behandeln
                    console.log(response);
        
                    if (response = "1") {
        
                        if(document.querySelector("#zitatAbschickenKnopf")) {
                            document.getElementById("zitatAbschickenKnopf").innerHTML = "<div style='background-color: #F5F5F5; border: 1px solid rgb(194, 194, 199); color: #A4A4A4; padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Zitat erfolgreich abgeschickt!</div>";
                            zeilenTabelleZählenUndDivAktualisieren("infobox-zitate-counter", "zitate", true);
                        }
                        

                    }
                    else {
                        if(document.querySelector("#zitatAbschickenKnopf")) {
                        document.getElementById("zitatAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                        }

                        setTimeout(() => {
                            if(document.querySelector("#zitatAbschickenKnopf")) {
                            document.getElementById("zitatAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"zitatAbschicken(getCookie('login'),document.getElementById('inputZitat').value+' ☼'+document.getElementById('inputKontext').value)\">Zitat senden</button>";
                            }
                            if(document.querySelector("#inputZitat")) {
                                document.getElementById("inputZitat").readOnly = false;
                                document.getElementById("inputKontext").readOnly = false;
                            }
                            
                        }, 2000);
                    }    
                },
                error: function(error) {
                    // Hier kannst du Fehler bei der Anfrage behandeln
                    console.log(error);
        
                    if(document.querySelector("#zitatAbschickenKnopf")) {
                    document.getElementById("zitatAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                    }

                    setTimeout(() => {
                        if(document.querySelector("#zitatAbschickenKnopf")) {
                        document.getElementById("zitatAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"storyAbschicken(getCookie('login'),document.getElementById('inputTitle').value+' ☼'+document.getElementById('inputStory').value)\">Story senden</button>";
                        }
                    }, 2000);

                    if(document.querySelector("#inputZitat")) {
                        document.getElementById("inputZitat").readOnly = false;
                        document.getElementById("inputKontext").readOnly = false;
                    }
                    
                }
            });

        }, 500);


    }


    
}