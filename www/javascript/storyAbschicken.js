function storyAbschicken(user_login, story) {

    if(document.querySelector("#inputStory")) {
        document.getElementById("inputStory").readOnly = true;
        document.getElementById("inputTitle").readOnly = true;
    }

    if (story == " ☼") {

        if(document.querySelector("#storyAbschickenKnopf")) {
            document.getElementById("storyAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Keine leere Story abschicken!</div>";
        }
        setTimeout(() => {
            if(document.querySelector("#storyAbschickenKnopf")) {
                document.getElementById("storyAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"storyAbschicken(getCookie('login'),document.getElementById('inputTitle').value+' ☼'+document.getElementById('inputStory').value)\">Story senden</button>";
            }
        }, 2000);

        if(document.querySelector("#inputStory")) {
            document.getElementById("inputStory").readOnly = false;
            document.getElementById("inputTitle").readOnly = false;
        }
        
    }
    else {

        if(document.querySelector("#storyAbschickenKnopf")) {
            document.getElementById("storyAbschickenKnopf").innerHTML = "<div style='background-color: #F5F5F5; border: 1px solid #A4A4A4; color: #A4A4A4; padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Lädt...</div>";
        }
        setTimeout(() => {


            $.ajax({
                type: "POST",
                url: "../php/storyAbschicken.php", // Hier den Pfad zu deinem PHP-Skript angeben
                data: { user_login: user_login, story: story },
                success: function(response) {
                    // Hier kannst du den Erfolg der Anfrage behandeln
                    console.log(response);
        
                    if (response = "1") {
        
                        if(document.querySelector("#storyAbschickenKnopf")) {
                            document.getElementById("storyAbschickenKnopf").innerHTML = "<div style='background-color: #F5F5F5; border: 1px solid rgb(194, 194, 199); color: #A4A4A4; padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Story erfolgreich abgeschickt!</div>";
                            zeilenTabelleZählenUndDivAktualisieren("infobox-story-counter", "storys", true);
                        }
                    }
                    else {
                        if(document.querySelector("#storyAbschickenKnopf")) {
                        document.getElementById("storyAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                        }

                        setTimeout(() => {
                            if(document.querySelector("#storyAbschickenKnopf")) {
                            document.getElementById("storyAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"storyAbschicken(getCookie('login'),document.getElementById('inputTitle').value+' ☼'+document.getElementById('inputStory').value)\">Story senden</button>";
                            }
                            if(document.querySelector("#inputStory")) {
                                document.getElementById("inputStory").readOnly = false;
                                document.getElementById("inputTitle").readOnly = false;
                            }
                            
                        }, 2000);
                    }    
                },
                error: function(error) {
                    // Hier kannst du Fehler bei der Anfrage behandeln
                    console.log(error);
        
                    if(document.querySelector("#storyAbschickenKnopf")) {
                    document.getElementById("storyAbschickenKnopf").innerHTML = "<div style='background-color: rgb(255, 242, 244); border: 1px solid rgb(227, 0, 0); color: rgb(227, 0, 0); padding: 17px; margin-top: 64px; border-radius: 10px; font-size: 17px; text-align: center;' >Etwas ist schiefgelaufen</div>";
                    }

                    setTimeout(() => {
                        if(document.querySelector("#storyAbschickenKnopf")) {
                        document.getElementById("storyAbschickenKnopf").innerHTML = "<button style=\"margin-top: 64px;\" onclick=\"storyAbschicken(getCookie('login'),document.getElementById('inputTitle').value+' ☼'+document.getElementById('inputStory').value)\">Story senden</button>";
                        }
                    }, 2000);

                    if(document.querySelector("#inputStory")) {
                        document.getElementById("inputStory").readOnly = false;
                        document.getElementById("inputTitle").readOnly = false;
                    }
                    
                }
            });

        }, 500);


    }


    
}