///////////////////  NAVBAR LIGHT  ///////////////////

function loadFoot() {

    fetch("../html/footer-light.html")
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // assuming the file is an HTML file
    })
    .then(htmlContent => {
        // Now you have the HTML content of the file in the htmlContent variable
        console.log('HTML content:', htmlContent);
        document.getElementById("footer").innerHTML = htmlContent;

        // You can then use the htmlContent variable as needed
        // For example, if you want to inject the HTML content into an element with id 'content':
        // document.getElementById('content').innerHTML = htmlContent;
    })
    .catch(error => {
        console.error('There was a problem fetching the file:', error);
    });
}