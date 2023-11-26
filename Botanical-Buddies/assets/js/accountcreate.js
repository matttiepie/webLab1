function getUserData(num) {
    if (typeof jQuery == 'undefined')
    {alert("Not Here")}
    
    switch(num) {
        case 0:
            var fname = $('input[name=fname]').val();
            var lname = $('input[name=lname]').val();
            var email = $('input[name=email]').val();
            var pass = $('input[name=createdpass]').val();
            var confirmpass = $('input[name=checkpass]').val();

            createAccount(fname,lname,email,confirmpass);

            break;
        case 1:
            var email = $('input[name=signinemail]').val();
            var pass = $('input[name=confirmpass]').val();

            login(email,pass);

            break;
        case 2:
            var newpass = $('input[name=createdpass]').val();
            var confirmpass = $('input[name=checkpass]').val();

            newpass(newpass,confirmpass);

            break;
    }

    
}

function createAccount(fname, lname, email, pass, confirmpass) {   
    const xhttp = new XMLHttpRequest();

    if ( fname != "" && lname != "" && email != "" && pass != "") {

        if (pass.localeCompare(confirmpass) == 0)
            {
                xhttp.open("POST", 'create.php?fname=' + fname + '&lname=' + lname + '&email=' + email+ '&pass=' + pass, true);
                xhttp.send();
            }
    }
}

function login(email, pass) {
    if ( email != "" && pass != "") {

                xhttp.open("POST", 'login.php?email=' + email+ '&pass=' + pass, true);
                xhttp.send();
    }
}

function newpass (pass, confirmpass) {
    if ( pass != "" && confirmpass != "") {

        if (pass.localeCompare(confirmpass) == 0)
            {
                xhttp.open("POST", 'create.php?pass=' + pass, true);
                xhttp.send();
            }
    }
}