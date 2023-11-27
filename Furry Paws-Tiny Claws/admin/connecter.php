<?php
$connection = mysqli_connect("localhost:3307", "root", "", "test");

if (!$connection) {
    die("Error: " . mysqli_connect_error());
}

$USERNAME = mysqli_real_escape_string($connection, $_GET['fname']); // Sanitize input
$PASSWORD = mysqli_real_escape_string($connection, $_GET['lname']); // Sanitize input

$query = "SELECT * FROM administrator WHERE username = '$USERNAME' AND password = '$PASSWORD'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
    echo 'Logged in successfully<br>';
    echo "<a href='homepage.html'>Admin Side</a>";
    
    
} else {
    echo 'Login unsuccessful';
}

mysqli_close($connection);
?>
