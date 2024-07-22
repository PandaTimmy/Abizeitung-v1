// function zitateLaden(user_login) {

//     $.ajax({
//         type: "POST",
//         url: "../php/zitateLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
//         data: { user_login: user_login },
//         success: function(response) {

//             var antworten = response.split("☾");
//             antworten = antworten.slice(1);
            
//             var result = [];

//             for (var i = 0; i < antworten.length; i++) {

//                 result.push(antworten[i].split("✩"));
//             }

//             console.log(result);
//         },
//         error: function(error) {
//             // Hier kannst du Fehler bei der Anfrage behandeln
//             console.log(error);
//         }
//     });
// }


function zitateLaden(user_login, nurFavs) {



    $.ajax({
        type: "POST",
        url: "../php/zitateLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {

            if(nurFavs) {
                document.getElementById("zitate-favoriten").innerHTML = "";
                document.getElementById("zitate-favs").style.display = "none";
            }

            var antworten = response.split("☾");
            antworten = antworten.slice(1);
            
            var result = [];

            for (var i = 0; i < antworten.length; i++) {
                
                result.push(antworten[i].split("✩"));

                datum = antworten[i].split("✩")[1].split(" ")[0];
                zitat = antworten[i].split("✩")[0];
                id = antworten[i].split("✩")[2];
                fav = antworten[i].split("✩")[3];

                console.log(datum);
                console.log(zitat);
                console.log(id);
                console.log(fav);

                if (zitat == " ") {
                    zitat = "<div style='font-style: italic;'>Kein Titel</div>";
                }

                zitatKachelHinzufügen(datum, zitat, id, fav, nurFavs);
            }

            console.log(result);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });


}


function zitatKachelHinzufügen(datum, zitat, ID, favorit, nurFavs) {
    if (favorit == 1) {

        document.getElementById("zitate-favoriten").innerHTML += "<div id='kf"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img src='../images/stern-fav.svg' onclick='moderierenZitatFavorisieren("+ID+")'></div><h3 id='kft"+ID+"'>"+zitat+"</h3><div class='story-text'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenZitatLöschen("+ID+")'></div></div</div>";

        document.getElementById("kft"+ID).innerText = zitat;

        document.getElementById("zitate-favs").style.display = "block";

        if(!nurFavs) {

            document.getElementById("zitate-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-fav.svg' onclick='moderierenZitatFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'></h3><div class='story-text'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenZitatLöschen("+ID+")'></div></div</div>";

            document.getElementById("kt"+ID).innerText = zitat;
        }
        
    }

    else {
        if(!nurFavs) {

            document.getElementById("zitate-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-leer.svg' onclick='moderierenZitatFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'></h3><div class='story-text'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenZitatLöschen("+ID+")'></div></div</div>";

            document.getElementById("kt"+ID).innerText = zitat;
        }

    }
}


function moderierenZitatLöschen(ID) {

    if (confirm("Willst du wirklich dieses Zitat löschen? \n\n"+document.getElementById("kt"+ID).textContent) == true) {

        zitatLöschen(getCookie("login"), ID);

    

        document.getElementById("zitate-count").textContent = parseInt(document.getElementById("zitate-count").textContent)-1;

        document.getElementById("k"+ID).style.display = "none";

        document.getElementById("kf"+ID).style.display = "none";



        alert("Das Zitat wurde gelöscht.")
      }

    console.log(ID);
}


function moderierenZitatFavorisieren(ID) {

    zitatFavorisieren(getCookie("login"), ID);

    setTimeout(function(){
        zitateLaden(getCookie("login"), true)

        if(document.getElementById("ks"+ID).src.substr(-5) == "v.svg") {
            document.getElementById("ks"+ID).src = "../images/stern-leer.svg";

            alert("Folgendes Zitat wurde aus den Favoriten entfernt: \n\n"+document.getElementById("kt"+ID).textContent);

        }
        else {
            document.getElementById("ks"+ID).src = "../images/stern-fav.svg";

            alert("Folgendes Zitat wurde favorisiert: \n\n"+document.getElementById("kt"+ID).textContent);

        }

        console.log(document.getElementById("ks"+ID).src.substr(-5));
        console.log("----------")


    }, 100);

    zitateLaden(getCookie("login"), true)

    console.log(ID);
}