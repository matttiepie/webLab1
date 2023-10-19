<?php
$conn = mysqli_connect("127.0.0.2","root","HELLOTHERE345","test");
if(!$conn)
{
    die("Error". mysqli_connect_error());
}
else
{
    echo "connection established".'<br>';
}

?>
