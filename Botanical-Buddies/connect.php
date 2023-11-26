<?php
session_start();
$USERNAME = $_POST['email'];
$PASSWORD = $_POST['password'];
$db_host="partygoer.mysql.database.azure.com";        //Change this
$db_user="matthewmartinez";        //Change this
$db_pass="1qaz2wsx!QAZ@WSX";        //Change this
$db_name="herewego";     //Do not change

$connection = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
if (!$connection) {
    die("Error: " . mysqli_connect_error());
}

$query = "SELECT * FROM LOGIN WHERE username = '$USERNAME' AND password = '$PASSWORD'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($connection));
}

if (mysqli_num_rows($result) > 0) {
    // Store data in session variables
    $_SESSION['user_id'] = $USERNAME; // You can replace 123 with the actual user ID
    if($USERNAME=='ADMIN'){
        $_SESSION['user_id'] = 222; 
    }
    
    // Redirect to session.php
    header("Location: session.php");
} else {
    echo 'Login unsuccessful';
    header('refresh: 5; url=login.html');
}

mysqli_close($connection);
?>
