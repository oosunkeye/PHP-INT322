<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: lab5_session_login.php");
    }
    else{
        print_r($_SESSION['username']);
        
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>lab5_page2</title>
        </head>
        <body>
            <h2>You are logged in!</h2>
        </body>
    </html>
 <?php
    }
 ?> 
