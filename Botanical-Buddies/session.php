<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Access and use the session data in session.php
    //echo "User ID from session: " . $user_id;
    if($user_id=='222'){
        echo 'welcome admin';
        header('refresh: 2, url=admin.html');
    }
    else{
        header('refresh: 2; url=accountinfo.php');
    }
    
    // You can add more code here to work with the session data
    // Don't forget to close the PHP session
    session_write_close();
} else {
    // Handle the case when the user is not logged in
    echo 'User is not logged in.';
    header('refresh: 2; url=/Botanical-Buddies/login.html');

}
?>
