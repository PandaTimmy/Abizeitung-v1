function ausloggen() {

    if (confirm("Möchtest du dich wirklich abmelden?") == true) {
        
        deleteCookie("login");
        deleteCookie("rolle");
        deleteCookie("anzeigename");
        deleteCookie("benutzername");
        deleteCookie("initialien");

        weiterleiten("../anmelden");
    } else {
    
    }
    
}