<?php
session_start();
$db_host = "partygoer.mysql.database.azure.com"; // Change this
$db_user = "matthewmartinez"; // Change this
$db_pass = "1qaz2wsx!QAZ@WSX"; // Change this
$db_name = "herewego"; // Do not change

$connection = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
if (!$connection) {
    die("Error: " . mysqli_connect_error());
}
$USERNAME = $_POST['username'];

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM login WHERE username = '$USERNAME'";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
$delete="DELETE FROM LOGIN WHERE username = '$USERNAME'";

$stmt1 = mysqli_query($connection, $delete);
    // Redirect to session.php
    echo 'Account Deleted';
    header('refresh: 2; url=delete.php');
} else {
    echo 'unsuccessful';
    header('refresh: 2; url=delete.php');
}


mysqli_close($connection);
?>
