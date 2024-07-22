function zugriffLaden(user_login) {

    $.ajax({
        type: "POST",
        url: "../php/steckbrief-zugriff-laden.php",

        data: { user_login: user_login },


        success: function(response) {

            document.getElementById("zugriffePersonenAuswählen").innerHTML = "<option disabled hidden selected>+ Person Hinzufügen</option>";

            document.getElementById("personenAusgewählt").innerHTML = "";

            var response = response.split("☾");
            response = response.slice(1);

            var result = [];

            var zugriffFürAlle = true;

            for (var i = 0; i < response.length; i++) {

                zugriff = response[i].split("✩")[3];

                if ( zugriff == 0 ) {
                    var zugriffFürAlle = false;
                }

            }
            
            
            if (zugriffFürAlle) {
                document.getElementById("zugriffJederKnopf").style.fontWeight = 700;
                document.getElementById("zugriffBegrenztKnopf").style.fontWeight = 400;
                document.getElementById("zugriffBegrenztKnopf").style.backgroundColor = "rgba(194, 194, 199, 0.457)";
                document.getElementById("zugriffJederKnopf").style.backgroundColor = "rgba(194, 194, 199, 0.157)";

                document.getElementById("personenHinzufügenKontainer").style.display = "none";


            }
            else {

                document.getElementById("zugriffJederKnopf").style.fontWeight = 400;
                document.getElementById("zugriffBegrenztKnopf").style.fontWeight = 700;
                document.getElementById("zugriffJederKnopf").style.backgroundColor = "rgba(194, 194, 199, 0.457)";
                document.getElementById("zugriffBegrenztKnopf").style.backgroundColor = "rgba(194, 194, 199, 0.157)";

                document.getElementById("personenHinzufügenKontainer").style.display = "block";

                for (var i = 0; i < response.length; i++) {
                
                    result.push(response[i].split("✩"));
    
                    benutzername = response[i].split("✩")[0];
                    nachname = response[i].split("✩")[1];
                    vorname = response[i].split("✩")[2];
                    zugriff = response[i].split("✩")[3];
    
                    // console.log(nachname+", "+vorname+", "+benutzername+", "+sex+", "+love);
    
                    if (zugriff == 1) {
                        document.getElementById("zugriffePersonenAuswählen").innerHTML += "<option disabled hidden>"+vorname+" "+nachname+" (Hinzugefügt)</option>";
                        document.getElementById("personenAusgewählt").innerHTML += "<div class='person'><span class='name'>"+vorname+" "+nachname+"</span><span class='entfernen' onclick='zugriffPersonHinzufügen(getCookie(\"login\"), \""+benutzername+"\", 0)'>Entfernen</span></div>"; 
                    }
                    else {
                        document.getElementById("zugriffePersonenAuswählen").innerHTML += "<option value='"+benutzername+"'>"+vorname+" "+nachname+"</option>";
                    }
    
                }
            }
            

            console.log(result);
        },
        error: function(error) {

            console.log(error);
        }
    });

}
