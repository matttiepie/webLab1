const loginForm = document.getElementById("login-form");

function getDataFromForm() {
    var user = loginForm.user.value;
    //var pass = loginForm.pass.value; // Change 'second' to 'pass'
    runAjax(user); // Change 'second' to 'pass'
}

function runAjax(user, pass) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const stringResponse = xhttp.responseText;
        
        document.getElementById("responseString").innerHTML = stringResponse;
    };
    xhttp.open("GET", `./delete.php?fname=${user}`, true);
    xhttp.send();
}
