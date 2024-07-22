function zeilenTabelleZählenUndDivAktualisieren(divID, tabelle, instant) {
    $.ajax({
        type: "POST",
        url: "../php/zeilenTabelleZählen.php",
        data: { tabelle: tabelle },
        success: function(response) {
            console.log(response);

            if (instant) {

                document.getElementById(divID).textContent = response;
            }
            else {

                countDivUp(divID, response)

                function countDivUp(divID, numberToCount) {
                    let t = 0;

                    for (let i = 0; Math.round(i) < numberToCount; i+=(numberToCount-i)/20) {

                        t++;
                        setTimeout(() => {
                            document.getElementById(divID).textContent = Math.round(i)+1;

                        }, t*30);
                    }
                }
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}