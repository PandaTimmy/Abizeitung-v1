// Dateiinputfeld auswählen
var dateiInput = document.getElementById("fileInput").files[0];

// FormData-Objekt erstellen und Datei hinzufügen
var formData = new FormData();
formData.append('datei', dateiInput);

// Ajax-Anfrage senden
$.ajax({
    type: "POST",
    url: "../php/phpSkript.php",
    processData: false, // Wichtig, damit jQuery die FormData nicht in eine Zeichenfolge konvertiert
    contentType: false, // Wichtig, damit jQuery den richtigen Content-Type setzt
    data: formData,
    success: function(response) {
        console.log(response);
    },
    error: function(error) {
        console.log(error);
    }
});