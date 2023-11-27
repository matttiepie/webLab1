
<?php

session_start();
echo '<script type="text/javascript" src="cartScript.js"></script>';
    $db_host="partygoer.mysql.database.azure.com";        
    $db_user="matthewmartinez";        
    $db_pass="1qaz2wsx!QAZ@WSX";        
    $db_name="herewego";  
    $server = "localhost";
    $user = "root";
    $port = 3307;
    $password = "";
    $db = "plants";
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $sql = "UPDATE `plant_data` SET plant_quantity_available = (plant_quantity_available - plant_quantity)";
    $statement = $pdo->prepare($sql);
    $statement->execute();  
    $user_id = $_SESSION['user_id'];
    echo $user_id;
    $sql = "INSERT INTO orderhistory (order_username, num_items, order_price, order_date)
    VALUES  (?,?,?,?)";
    $statement = $pdo->prepare($sql);
    $date = date('Y-m-d H:i:s');
    $statement->execute([$user_id, $_COOKIE["items"], $_COOKIE["price"], $date]);
     

    $sql = "UPDATE plant_data SET plant_quantity = 0 WHERE plant_quantity > 0";
     $statement = $pdo->prepare($sql);
     $statement->execute();

// if (isset($_SESSION['user_id'])) {
    
//     $user_id = $_SESSION['user_id'];

//     echo '<script type="text/javascript" src="cartScript.js"></script>';
//     $db_host="partygoer.mysql.database.azure.com";        
//     $db_user="matthewmartinez";        
//     $db_pass="1qaz2wsx!QAZ@WSX";        
//     $db_name="herewego";  
//     $server = "localhost";
//     $user = "root";
//     $port = 3307;
//     $password = "";
//     $db = "plants";
//     $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
// //     echo'
// //     <html>
// //     <head>
// //         <meta charset="utf-8">
// //         <title>Botanical Buddies</title>
// //         <link rel="stylesheet" href="assets/css/style.css">
// //     </head>
// //             <div>
// //             <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700" rel="stylesheet" type="text/css">
// // 	<style>
// // 		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
// // 		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
// // 	</style>
// // 	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
// // 	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
// // 	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
// // </head>
// // <body>
// // 	<header class="site-header" id="header">
// // 		<h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
// // 	</header>

// // 	<div class="main-content">
// // 		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
// // 		<p class="main-content__body" data-lead-id="main-content-body">
// //             Thank you for your order! We will get everything packaged and sent to you in no time!</p>
// //             <a href="index.html">Click here to continue Shopping</a>
// // 	</div>
// //             </div>
// //             <div id="container" class="carousel"></div>
// //         </main>
// //     </body>
// // </html>';

//     $sql = "UPDATE `plant_data` SET plant_quantity_available = (plant_quantity_available - plant_quantity)";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();  

//     $sql = "INSERT INTO orderhistory (order_username, num_items, order_price, order_date)
//     VALUES  (?,?,?,?)";
//     $statement = $pdo->prepare($sql);
//     $date = date('Y-m-d H:i:s');
//     $statement->execute([$user_id, $_COOKIE["items"], $_COOKIE["price"], $date]);
     

//     $sql = "UPDATE plant_data SET plant_quantity = 0 WHERE plant_quantity > 0";
//      $statement = $pdo->prepare($sql);
//      $statement->execute();

// } else {
//     // Handle the case when the user is not logged in
//     echo 'User is not logged in.';
//     header('refresh: 5; url=login.html');

// }
?>
    
