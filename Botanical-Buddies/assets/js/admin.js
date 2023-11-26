function alterProductLine() {
    var title = $('input[name=title]').val();
    var price = $('[name=price]').val();
    var desc = $('textarea').val();
    var pic = $('input[name=pic]').val();

    const xhttp = new XMLHttpRequest();

    if ( title != "" && price >= 0 && quantity >= 0 && desc != "" && pic > 0) {

        xhttp.open("POST", 'create.php?fname=' + fname + '&lname=' + lname + '&email=' + email+ '&pass=' + pass, true);
        xhttp.send(pic[0]);
    }

    
}