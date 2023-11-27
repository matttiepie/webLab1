<?php
// Assuming you have a database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the item data from the AJAX request
$itemName = $_POST['name'];
$itemPrice = $_POST['price'];

// Insert the item into the database
$sql = "INSERT INTO cart_items (name, price) VALUES ('$itemName', '$itemPrice')";

$result = mysqli_query($connection, $sql);
$conn->close();
?>
