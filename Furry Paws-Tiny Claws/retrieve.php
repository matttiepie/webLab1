<?php
$USERNAME=$_POST['username'];

$connection = mysqli_connect("localhost:3307", "root", "", "test");
    if (!$connection) 
    die("Error: " . mysqli_connect_error());
    
    $query = "SELECT * FROM ENTRY WHERE username = '$USERNAME'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Error in query: " . mysqli_error($connection));
    }
    
    if (mysqli_num_rows($result) > 0) {
        header("Location: newPassword.html");
    } else {
        echo 'Username does not exist';
        header('refresh: 5; url=passwordRecovery.html');
    }
?>