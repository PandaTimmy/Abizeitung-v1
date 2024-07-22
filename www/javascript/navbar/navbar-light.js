///////////////////  NAVBAR LIGHT  ///////////////////

function loadNav(forceAdmin, forceNonAdmin) {

    var addGap = false;

    if ( getCookie("rolle") == "Admin") {
        var url = "../html/navbar-light-admin.html";
        addGap = true;
    }
    else {
        var url = "../html/navbar-light.html";
    }

    if(forceAdmin) {
        var url = "../html/navbar-light-admin.html";
        addGap = true;
    }
    if(forceNonAdmin) {
        var url = "../html/navbar-light.html";
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
            document.getElementById("navbar").style.marginBottom = "86px";
        }

        // You can then use the htmlContent variable as needed
        // For example, if you want to inject the HTML content into an element with id 'content':
        // document.getElementById('content').innerHTML = htmlContent;
    })
    .catch(error => {
        console.error('There was a problem fetching the file:', error);
    });


}


