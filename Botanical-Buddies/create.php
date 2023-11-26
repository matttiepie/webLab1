<?php
session_start();
$USERNAME = $_POST['email'];
$PASSWORD = $_POST['password'];
$db_host = "partygoer.mysql.database.azure.com"; // Change this
$db_user = "matthewmartinez"; // Change this
$db_pass = "1qaz2wsx!QAZ@WSX"; // Change this
$db_name = "herewego"; // Do not change

$connection = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
if (!$connection) {
    die("Error: " . mysqli_connect_error());
}

$query = " SELECT * FROM login where USERNAME = '$USERNAME'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($connection));
}
if(mysqli_num_rows($result) > 0){
    echo "Account Exists";
    header('refresh: 5, url=createAccount.html');
}
else{
    $insert = "INSERT INTO login values('$USERNAME',$PASSWORD)";
    mysqli_query($connection, $insert);
    echo "Account Created";
    header('refresh: 5; url=login.html');
}
?>
