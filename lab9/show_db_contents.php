<?php
echo 'hello world'
$conn = mysqli_connect("127.0.0.2","root","","test");
if(!$conn)
{
    die("Error". mysqli_connect_error());
}
else
{
    echo "connection established".'<br>';
}

?>
