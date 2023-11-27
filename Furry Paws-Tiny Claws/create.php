<?php
$USERNAME=$_POST['username'];
$PASSWORD=$_POST['password'];
$connection = mysqli_connect("localhost:3307", "root", "", "test");

if (!$connection) {
    die("Error: " . mysqli_connect_error());
}
$query = "INSERT INTO ENTRY (username, password) VALUES ('$USERNAME', '$PASSWORD')";
$search="SELECT * FROM ENTRY WHERE username='$USERNAME'";
$result = mysqli_query($connection, $search);
if(mysqli_num_rows($result) > 0){
echo 'Login Already Exist';
header('refresh: 5; url=login.html');
}
else{
$stmt=mysqli_query($connection, $query);
echo 'Account Created';
header('refresh: 5; url=login.html');
}

?>