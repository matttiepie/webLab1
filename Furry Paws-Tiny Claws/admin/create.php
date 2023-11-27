<?php
$USERNAME=$_POST['username'];
$PASSWORD=$_POST['password'];
$db_host="partygoer.mysql.database.azure.com";        //Change this
$db_user="matthewmartinez";        //Change this
$db_pass="1qaz2wsx!QAZ@WSX";        //Change this
$db_name="herewego";   
$connection = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");

if (!$connection) {
    die("Error: " . mysqli_connect_error());
}
$query = "SELECT * FROM login WHERE username = '$USERNAME'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {

    echo 'Account exist<br>';
    header("refresh: 3, url=create.html");
}
else{
$query = "INSERT INTO login (username, password) VALUES ('$USERNAME', '$PASSWORD')";
$stmt=mysqli_query($connection, $query);
echo 'Account Created';
header("refresh: 1, url=create.html");
}

?>