showNavbarMobile = false;
    
function toggleNavbarMobile() {
    if(showNavbarMobile) {
        document.getElementById("navbar-mobile").style.height = "50px";

        var farbeWerte = window.getComputedStyle(document.getElementById("navbar-mobile")).backgroundColor.match(/[\d.]+/g);
        farbeWerte[3] = 0.8;
        var aktualisierteFarbe = 'rgba(' + farbeWerte.join(',') + ')';
        document.getElementById("navbar-mobile").style.backgroundColor = aktualisierteFarbe;
        
        document.getElementById("navbar-mobile-close").style.opacity = 0;


        setTimeout(() => {
            document.getElementById("navbar-mobile-open").style.opacity = 1;
            showNavbarMobile = false;
        }, 200);

        for (let i = 0; i < 8; i++) {

            document.getElementById("navbar-mobile-element-" + (i+1)).style.opacity = 0;
            document.getElementById("navbar-mobile-element-" + (i+1)).style.paddingLeft = "24px";

        }

    }
    else {
        document.getElementById("navbar-mobile").style.height = "100vh";

        var farbeWerte = window.getComputedStyle(document.getElementById("navbar-mobile")).backgroundColor.match(/[\d.]+/g);
        farbeWerte[3] = 1;
        var aktualisierteFarbe = 'rgba(' + farbeWerte.join(',') + ')';
        document.getElementById("navbar-mobile").style.backgroundColor = aktualisierteFarbe;

        document.getElementById("navbar-mobile-open").style.opacity = 0;

        setTimeout(() => {
            document.getElementById("navbar-mobile-close").style.opacity = 1;
            showNavbarMobile = true;
        }, 200);

        


        for (let i = 0; i < 8; i++) {

        setTimeout(() => {
            document.getElementById("navbar-mobile-element-" + (i+1)).style.opacity = 1;
            document.getElementById("navbar-mobile-element-" + (i+1)).style.paddingLeft = "48px";

        }, i*30+40);


        }
    }


    
}

window.addEventListener('resize', handleBildschirmgroesse);

var letzteBildschirmAnpassung = 0;

function handleBildschirmgroesse() {


    if (window.innerWidth > 800) {

        if(showNavbarMobile) {
            document.getElementById("navbar-mobile").style.height = "50px";

            var farbeWerte = window.getComputedStyle(document.getElementById("navbar-mobile")).backgroundColor.match(/[\d.]+/g);
            farbeWerte[3] = 0.8;
            var aktualisierteFarbe = 'rgba(' + farbeWerte.join(',') + ')';
            document.getElementById("navbar-mobile").style.backgroundColor = aktualisierteFarbe;
            
            document.getElementById("navbar-mobile-close").style.opacity = 0;

            document.getElementById("navbar-mobile-open").style.opacity = 1;
            showNavbarMobile = false;

            for (let i = 0; i < 8; i++) {

                document.getElementById("navbar-mobile-element-" + (i+1)).style.opacity = 0;
                document.getElementById("navbar-mobile-element-" + (i+1)).style.paddingLeft = "24px";

            }
    
        }

    }

    letzteBildschirmAnpassung = window.innerWidth;

}


