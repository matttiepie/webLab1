<?php
echo 'hello world'
$conn = mysqli_connect("partygoer.mysql.database.azure.com","matthewmartinez","1qaz2wsx!QAZ@WSX","herewego");
if(!$conn)
{
    die("Error". mysqli_connect_error());
}
else
{
    echo "connection established".'<br>';
}

?>
