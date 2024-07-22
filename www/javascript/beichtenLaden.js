function beichtenLaden(user_login, nurFavs) {



    $.ajax({
        type: "POST",
        url: "../php/beichtenLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {

            if(nurFavs) {
                document.getElementById("beichten-favoriten").innerHTML = "";
                document.getElementById("beichten-favs").style.display = "none";
            }

            var antworten = response.split("☾");
            antworten = antworten.slice(1);
            
            var result = [];

            for (var i = 0; i < antworten.length; i++) {
                
                result.push(antworten[i].split("✩"));

                datum = antworten[i].split("✩")[1].split(" ")[0];
                beichte = antworten[i].split("✩")[0].split("☼")[1];
                author = antworten[i].split("✩")[0].split("☼")[0];
                id = antworten[i].split("✩")[2];
                fav = antworten[i].split("✩")[3];

                console.log(datum);
                console.log(beichte);
                console.log(author);
                console.log(id);
                console.log(fav);

                if (author == " ") {
                    author = "Anonym";
                }

                beichteKachelHinzufügen(datum, beichte, author, id, fav, nurFavs);
            }

            console.log(result);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });


}


function beichteKachelHinzufügen(datum, beichte, name, ID, favorit, nurFavs) {
    if (favorit == 1) {

        document.getElementById("beichten-favoriten").innerHTML += "<div id='kf"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img src='../images/stern-fav.svg' onclick='moderierenBeichteFavorisieren("+ID+")'></div><h3>"+beichte+"</h3><div class='bottom'><div><span class='datum'>"+name+"</span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenBeichteLöschen("+ID+")'></div></div</div>";

        document.getElementById("beichten-favs").style.display = "block";

        if(!nurFavs) {
            document.getElementById("beichten-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-fav.svg' onclick='moderierenBeichteFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'>"+beichte+"</h3><div class='bottom'><div><span class='datum'>"+name+"</span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenBeichteLöschen("+ID+")'></div></div</div>";
        }
        
    }

    else {
        if(!nurFavs) {

            document.getElementById("beichten-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-leer.svg' onclick='moderierenBeichteFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'>"+beichte+"</h3><div class='bottom'><div><span class='datum'>"+name+"</span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenBeichteLöschen("+ID+")'></div></div</div>";
        }

    }
}


function moderierenBeichteLöschen(ID) {

    if (confirm("Willst du wirklich diese Beichte löschen? \n\n"+document.getElementById("kt"+ID).textContent) == true) {

        beichteLöschen(getCookie("login"), ID);

    

        document.getElementById("beichten-count").textContent = parseInt(document.getElementById("beichten-count").textContent)-1;

        document.getElementById("k"+ID).style.display = "none";

        document.getElementById("kf"+ID).style.display = "none";



        alert("Die Beichte wurde gelöscht.")
      }

    console.log(ID);
}


function moderierenBeichteFavorisieren(ID) {

    //    if (confirm("Willst du wirklich diese Beichte favorisieren? \n\n"+document.getElementById("kt"+ID).textContent) == true) {


    if (true) {

        beichteFavorisieren(getCookie("login"), ID);




        setTimeout(function(){
            beichtenLaden(getCookie("login"), true)

            if(document.getElementById("ks"+ID).src.substr(-5) == "v.svg") {
                document.getElementById("ks"+ID).src = "../images/stern-leer.svg";

                alert("Folgende Beichte wurde aus den Favoriten entfernt: \n\n"+document.getElementById("kt"+ID).textContent);

            }
            else {
                document.getElementById("ks"+ID).src = "../images/stern-fav.svg";

                alert("Folgende Beichte wurde favorisiert: \n\n"+document.getElementById("kt"+ID).textContent);

            }

            console.log(document.getElementById("ks"+ID).src.substr(-5));
            console.log("----------")


        }, 100);

        beichtenLaden(getCookie("login"), true)
      }

    console.log(ID);
}