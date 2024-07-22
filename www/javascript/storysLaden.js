function storysLaden(user_login, nurFavs) {



    $.ajax({
        type: "POST",
        url: "../php/storysLaden.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {

            if(nurFavs) {
                document.getElementById("storys-favoriten").innerHTML = "";
                document.getElementById("storys-favs").style.display = "none";
            }

            var antworten = response.split("☾");
            antworten = antworten.slice(1);
            
            var result = [];

            for (var i = 0; i < antworten.length; i++) {
                
                result.push(antworten[i].split("✩"));

                datum = antworten[i].split("✩")[1].split(" ")[0];
                story = antworten[i].split("✩")[0].split("☼")[1];
                title = antworten[i].split("✩")[0].split("☼")[0];
                id = antworten[i].split("✩")[2];
                fav = antworten[i].split("✩")[3];

                console.log(datum);
                console.log(story);
                console.log(title);
                console.log(id);
                console.log(fav);

                if (title == " ") {
                    title = "<div style='font-style: italic;'>Kein Titel</div>";
                }

                storyKachelHinzufügen(datum, story, title, id, fav, nurFavs);
            }

            console.log(result);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });


}


function storyKachelHinzufügen(datum, story, title, ID, favorit, nurFavs) {
    if (favorit == 1) {

        // document.getElementById("storys-favoriten").innerHTML += "<div id='kf"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img src='../images/stern-fav.svg' onclick='moderierenBeichteFavorisieren("+ID+")'></div><h3>"+title+"</h3><div class='bottom'><div><span class='datum'>"+story+"</span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenBeichteLöschen("+ID+")'></div></div</div>";

        document.getElementById("storys-favoriten").innerHTML += "<div id='kf"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img src='../images/stern-fav.svg' onclick='moderierenStoryFavorisieren("+ID+")'></div><h3>"+title+"</h3><div class='story-text' id='kftext"+ID+"'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenStoryLöschen("+ID+")'></div></div</div>";

        document.getElementById("kftext"+ID).innerText = story;

        document.getElementById("storys-favs").style.display = "block";

        if(!nurFavs) {

            document.getElementById("storys-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-fav.svg' onclick='moderierenStoryFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'>"+title+"</h3><div class='story-text' id='ktext"+ID+"'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenStoryLöschen("+ID+")'></div></div</div>";

            document.getElementById("ktext"+ID).innerText = story;
        }
        
    }

    else {
        if(!nurFavs) {

            document.getElementById("storys-alle").innerHTML += "<div id='k"+ID+"' class='kachel-beichte'><div class='top'><span class='datum'>"+datum+"</span><img id='ks"+ID+"' src='../images/stern-leer.svg' onclick='moderierenStoryFavorisieren("+ID+")'></div><h3 id='kt"+ID+"'>"+title+"</h3><div class='story-text' id='ktext"+ID+"'></div><div class='bottom'><div><span class='datum'></span><img src='../images/navbar-mobile-close-light.svg' onclick='moderierenStoryLöschen("+ID+")'></div></div</div>";

            document.getElementById("ktext"+ID).innerText = story;
        }

    }
}


function moderierenStoryLöschen(ID) {

    if (confirm("Willst du wirklich diese Story löschen? \n\n"+document.getElementById("kt"+ID).textContent) == true) {

        storyLöschen(getCookie("login"), ID);

    

        document.getElementById("storys-count").textContent = parseInt(document.getElementById("storys-count").textContent)-1;

        document.getElementById("k"+ID).style.display = "none";

        document.getElementById("kf"+ID).style.display = "none";



        alert("Die Story wurde gelöscht.")
      }

    console.log(ID);
}


function moderierenStoryFavorisieren(ID) {

    storyFavorisieren(getCookie("login"), ID);

    setTimeout(function(){
        storysLaden(getCookie("login"), true)

        if(document.getElementById("ks"+ID).src.substr(-5) == "v.svg") {
            document.getElementById("ks"+ID).src = "../images/stern-leer.svg";

            alert("Folgende Story wurde aus den Favoriten entfernt: \n\n"+document.getElementById("kt"+ID).textContent);

        }
        else {
            document.getElementById("ks"+ID).src = "../images/stern-fav.svg";

            alert("Folgende Story wurde favorisiert: \n\n"+document.getElementById("kt"+ID).textContent);

        }

        console.log(document.getElementById("ks"+ID).src.substr(-5));
        console.log("----------")


    }, 100);

    storysLaden(getCookie("login"), true)

    console.log(ID);
}