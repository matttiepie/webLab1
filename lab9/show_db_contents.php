<?php
echo 'hello world'
$conn = mysqli_connect("partygoer.mysql.database.azure.com","matthewmartinez","","z_url_set_1");
if(!$conn)
{
    die("Error". mysqli_connect_error());
}
else
{
    echo "connection established".'<br>';
}

?>
