<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db_host="partygoer.mysql.database.azure.com";        //Change this
$db_user="matthewmartinez";        //Change this
$db_pass="1qaz2wsx!QAZ@WSX";        //Change this
$db_name="herewego";     //Do not change

$connection = mysqli_connect("partygoer.mysql.database.azure.com","matthewmartinez","1qaz2wsx!QAZ@WSX","herewego");
if (mysqli_connect_errno())
{
    echo 'Connection to database failed:'.mysqli_connect_error();
    exit();
}

echo "database connection success<br>";
echo "<strong>now showing results from a database query...</strong>";

?>

