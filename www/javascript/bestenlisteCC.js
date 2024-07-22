function bestenListeCC(user_login) {


    $.ajax({
        type: "POST",
        url: "../php/bestenListeCC.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { user_login: user_login },
        success: function(response) {
  
            if(response.split("✩")[0] == "ne") {
                document.getElementById("rank").innerHTML = "<div class=\"crushcounttitle\"><h1>"+response.split("✩")[1]+"/50</h1><h3 style='max-width: 600px;'>Nur "+response.split("✩")[1]+" von mindestens 50 Leute haben abgestimmt. Mehr Leute müssen abstimmen, um die Ergebnisse anzeigen zu lassen.</h3></div>";
            }
            else {
                var response = response.split("☾");

                var top25UN = response[0].split("✩").slice(1);
                var top25I = response[1].split("✩").slice(1);
                var top25VN = response[2].split("✩").slice(1);
                var top25NN = response[3].split("✩").slice(1);


                console.log(top25UN);
                console.log(top25I);
                console.log(top25VN);
                console.log(top25NN);

                document.getElementById("rank").innerHTML = "";

                var fade = .7;
                var opacity = 0.5;

                for (var i = 0; i < top25UN.length; i++) {
                    
                    if(top25I[i]>0) {

                        let name = top25VN[i]+" "+top25NN[i];
                        //document.getElementById("rank").innerHTML += "<div class=\"rank\"> <div class=\"rank-zahl\"> #"+(i+1)+" </div> <div class=\"rank-rechts\"> <h3>"+top25VN[i]+" "+top25NN[i]+"</h3> <h4>"+top25I[i]+" Verliebte</h4> </div> </div>";
                        document.getElementById("rank").innerHTML += "<div class='kachel-top25'> <h2>#"+(i+1)+"</h2> <div> <h3>"+name+"</h3> <h4>"+top25I[i]+" Verliebte</h4> </div> </div>";
                    }
                    else {
                        if(opacity > 0) {
                            //document.getElementById("rank").innerHTML += "<div class=\"rank\" style=\"opacity: "+opacity+"; zoom: "+fade+";\"> <div class=\"rank-zahl\"> #"+(i+1)+" </div> <div class=\"rank-rechts\"> <h3>-- --</h3> <h4>-- Verliebte</h4> </div> </div>";
                            document.getElementById("rank").innerHTML += "<div class='kachel-top25' style=\"opacity: "+opacity+"; zoom: "+fade+";\"> <h2>#"+(i+1)+"</h2> <div> <h3>--</h3> <h4>-- Verliebte</h4> </div> </div>";

                        }
                        fade += -0.1;
                        opacity += -0.1;
                        
                    }
                    
                    

                }
            }
            

        },
        error: function(error) {
            console.log(response);

        }
    });

}