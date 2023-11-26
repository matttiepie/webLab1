
<?php

$db_host="partygoer.mysql.database.azure.com";        
$db_user="matthewmartinez";        //Change this
$db_pass="1qaz2wsx!QAZ@WSX";        //Change this
$db_name="herewego";     //Do not change

$db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if (!$db_conn) {
    die("Error: " . mysqli_connect_error());
}

$USERNAME = mysqli_real_escape_string($db_conn, $_GET['fname']); // Sanitize input
$PASSWORD = mysqli_real_escape_string($db_conn, $_GET['lname']); // Sanitize input


$query = "SELECT * FROM login WHERE username = '$USERNAME' AND password = '$PASSWORD'";
$result = mysqli_query($db_conn, $query);
if (mysqli_num_rows($result) > 0) {
  echo 'Login Successful';

   // header("Location: index.html");
    // possible JS script method if Header doesn't work
    //<script type="text/javascript"> 
    //window.location.href="Index.html" 
    //</script> 
  
}


?>
