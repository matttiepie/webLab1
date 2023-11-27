<?php
$USERNAME = $_POST['username'];
$PASSWORD = $_POST['password'];
$connection = mysqli_connect("localhost:3307", "root", "", "test");

if (!$connection) {
    die("". mysqli_connect_error());
}

// Check if the username and password exist before attempting to delete
$queryCheck = "SELECT * FROM ENTRY WHERE `username` = '$USERNAME'";
$resultCheck = mysqli_query($connection, $queryCheck);

if (mysqli_num_rows($resultCheck) > 0) {
    // Entry with the provided username and password exists, proceed to delete it
    $delete = "DELETE FROM ENTRY WHERE `username` = '$USERNAME'";
    $query1 = "INSERT INTO ENTRY (`username`, `password`) VALUES ('$USERNAME', '$PASSWORD')";

    $stmt1 = mysqli_query($connection, $delete);
    $stmt = mysqli_query($connection, $query1);
    echo "Success";
    header('refresh: 5; url=login.html');
} else {
    // Entry does not exist, provide an error message or redirect as needed
    echo "Entry with the provided username, does not exist.";
    header('refresh: 5; url=newPassword.html');
}

// Close the database connection
mysqli_close($connection);

// Redirect to login.html after 5 seconds

?>
