function crushLaden(user_login) {

    $.ajax({
        type: "POST",
        url: "../php/crush-auswahl-laden.php",

        data: { user_login: user_login },

        success: function(response) {

            var response = response.split("☾");
            response = response.slice(1);

            var result = [];

            for (var i = 0; i < response.length; i++) {
                
                result.push(response[i].split("✩"));

                benutzername = response[i].split("✩")[0];
                nachname = response[i].split("✩")[1];
                vorname = response[i].split("✩")[2];
                sex = response[i].split("✩")[3];
                love = response[i].split("✩")[4];

                // console.log(nachname+", "+vorname+", "+benutzername+", "+sex+", "+love);

                if (love == 1) {
                    document.getElementById("crush-auswahl").innerHTML += "<button class=\"name selected "+sex+"\" id=\""+benutzername+"\" onclick=\"crushSelect('"+benutzername+"')\">"+vorname+" "+nachname+"</button>" 
                }
                else {
                    document.getElementById("crush-auswahl").innerHTML += "<button class=\"name "+sex+"\" id=\""+benutzername+"\" onclick=\"crushSelect('"+benutzername+"')\">"+vorname+" "+nachname+"</button>" 
                }

            }

            console.log(result);
        },
        error: function(error) {

            console.log(error);
        }
    });

}


function crushSelect(username) {

    if (document.getElementById(username).classList.contains("selected")) {
        var setVal = 0;
    }
    else {
        var setVal = 1;
    }
    crushEintragen(getCookie("login"), username, setVal);

}


function crushEintragen(user_login, person, setVal) {

    $.ajax({
        type: "POST",
        url: "../php/crushEintragen.php",

        data: { user_login: user_login, person: person, setVal, setVal },

        success: function(response) {

            if(response == 1) {

                if(setVal == 1) {

                    document.getElementById(person).classList.add("selected");
                    document.getElementById(person).style.transform = "scale(1.1)";
                    document.getElementById(person).style.zIndex = 10;

                    setTimeout(function() {
                        document.getElementById(person).style.transform = "none";
                    }, 200);

                    setTimeout(function() {
                        document.getElementById(person).style.zIndex = 0;
                    }, 400);
                }
                else {

                    document.getElementById(person).classList.remove("selected");
                    document.getElementById(person).style.transform = "none";

                }

                bestenListeCC(getCookie("login"));
            }
            else {

                console.log(response);
                alert("Fehler");
            }


        },
        error: function(error) {

            console.log(error);
        }
    });
}