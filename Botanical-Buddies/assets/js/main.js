const loginForm = document.getElementById("login-form");

function getDataFromForm() {
    var user = loginForm.user.value;
    var pass = loginForm.pass.value; // Change 'second' to 'pass'
    runAjax(user, pass); // Change 'second' to 'pass'
}

function runAjax(user, pass) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const stringResponse = xhttp.responseText;
        var string = user + " " + pass;
        document.getElementById("responseString").innerHTML = stringResponse;
    };
    xhttp.open("GET", `./connect.php?fname=${user}&lname=${pass}`, true);
    xhttp.send();
}




