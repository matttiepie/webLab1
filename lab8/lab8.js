
function getDataFromForm() {
  
  var firstname=document.getElementById('fname').value;
  var lastname=document.getElementById('lname').value;
  runAjax(firstname,lastname);
}

function runAjax(fname ,lname) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    //Edit this
  const stringResponse=xhttp.responseText;
  var string = fname+" "+lname;
   document.getElementById("responseString").innerHTML = stringResponse;

    //console.log(this.responseText);
    }
    xhttp.open("GET", `./ajax.php?fname=${fname}&lname=${lname}`, true);
    xhttp.send();
}

