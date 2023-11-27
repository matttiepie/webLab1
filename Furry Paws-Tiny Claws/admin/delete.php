<!-- PHP code to establish connection with the localserver -->
<?php
 
$db_host="partygoer.mysql.database.azure.com";        //Change this
$db_user="matthewmartinez";        //Change this
$db_pass="1qaz2wsx!QAZ@WSX";        //Change this
$db_name="herewego";     //Do not change

$mysqli = new mysqli("$db_host", "$db_user", "$db_pass", "$db_name");
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = " SELECT * FROM login";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>GFG User Details</title>
    <!-- CSS FOR STYLING THE PAGE -->
</head>
<style>
    table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
    
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
</style>
 
<body>

        <header>
        <h1>User Names</h1>
        </header>
        <nav>
                <a href="homepage.html">Admin Home Page</a>
                <a href="delete.php">Delete Account</a>
                <a href="logout.php">Log out</a>
        </nav>
    <div class="container">
    <section>
        

        <table>
            <tr>
                <th>Users</th>
                <th>Password</th>
                
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $rows['USERNAME'];?></td>
                <td><?php echo $rows['PASSWORD'];?></td>
                
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    
    <form action="deleter.php" form method="post">
        <br><br>
                Username: <input type="text" name="username" id="username"><br><br>
               
                <input type="submit" id="ajaxCall" value="Delete">
                
    </form>
    </div>
    <link rel="stylesheet" href="styler.css">
</body>
 
</html>
