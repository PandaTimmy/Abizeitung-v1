///////////////////  NAVBAR LIGHT  ///////////////////

function loadNav(forceAdmin, forceNonAdmin, nonActivModView) {

    var addGap = false;

    if ( getCookie("rolle") == "Admin") {
        var url = "../html/navbar-dark-admin.html";
        addGap = true;
    }
    else {
        var url = "../html/navbar-dark.html";
        addGap = false;
    }

    if(forceAdmin) {
        var url = "../html/navbar-dark-admin.html";
        addGap = true;
    }
    if(forceNonAdmin) {
        var url = "../html/navbar-dark.html";
        addGap = false;
    }

    if(nonActivModView && getCookie("rolle") == "Admin") {
        var url = "../html/navbar-dark-admin-setActive.html";
        addGap = true;
    }

    fetch(url)
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // assuming the file is an HTML file
    })
    .then(htmlContent => {
        // Now you have the HTML content of the file in the htmlContent variable
        console.log('HTML content:', htmlContent);
        document.getElementById("navbar").innerHTML = htmlContent;

        if(addGap) {
            document.getElementById("navbar").innerHTML = "<div style='width: 100%; height: 86px; background-color: black;'></div>" + document.getElementById("navbar").innerHTML;
        }

        // You can then use the htmlContent variable as needed
        // For example, if you want to inject the HTML content into an element with id 'content':
        // document.getElementById('content').innerHTML = htmlContent;
    })
    .catch(error => {
        console.error('There was a problem fetching the file:', error);
    });
}