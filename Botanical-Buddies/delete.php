<?php
$db_host="partygoer.mysql.database.azure.com";        
$db_user="matthewmartinez";        
$db_pass="1qaz2wsx!QAZ@WSX";        
$db_name="herewego"; 
$USERNAME=$_POST['name'];
    
$connection = mysqli_connect("$db_host", "$db_user", "$db_pass", "$db_name");
if (!$connection) {
    die("Error: " . mysqli_connect_error());
}
$query = "SELECT * FROM LOGIN WHERE username = '$USERNAME'";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) > 0){
    $delete = "DELETE FROM LOGIN WHERE username = '$USERNAME'";
    mysqli_query($connection, $delete);
    echo "Account Deleted";
    header('refresh: 5, url=deleteAccount.php');
}
else{
    echo "Account does not exist";
    header('refresh: 5; url=deleteAccount.php');
}
?>
