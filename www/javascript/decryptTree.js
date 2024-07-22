function bananaTree(privateKey) {

    $.ajax({
        type: "POST",
        url: "../php/decryptTree.php", // Hier den Pfad zu deinem PHP-Skript angeben
        data: { privateKey: privateKey },
        success: function(response) {
            // Hier kannst du den Erfolg der Anfrage behandeln
            console.log(response);
            var newLink = document.createElement("div");
            newLink.innerHTML = response;
            document.getElementById("TreeOutLayer").appendChild(newLink);
            console.log(newLink);
        },
        error: function(error) {
            // Hier kannst du Fehler bei der Anfrage behandeln
            console.log(error);
        }
    });
}


function loadIntoDocument(data1, data2, data3, data4, data5, URL, destinationID) { //1: Data;   2: PHP URL;   3: DIV Destination ID

    $.ajax({
        type: "POST",
        url: URL,
        data: { data1: data1, data2: data2, data3: data3, data4: data4, data5: data5 },
        success: function(response) {
            console.log(response);
            var newLink = document.createElement("div");
            newLink.innerHTML = response;
            document.getElementById(destinationID).innerHTML = "";
            document.getElementById(destinationID).appendChild(newLink);
            console.log(newLink);
        },
        error: function(error) {
            console.log(error);
        }
    });
}