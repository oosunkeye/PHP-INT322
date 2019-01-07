<?php
    session_start();
    if(isset($_POST['submit'])){
        session_destroy();
        setcookie("PHPSESSID", "", time() - 61200,"/");
        header("Location: lab5_email.php");
    }
    
    if(!isset($_SESSION['username'])){
        header("Location: lab5_email.php");
    }
    else{    
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>lab5_your_logged_in</title>
        </head>
        <body>
            <h2>You are logged in!</h2>
            <form name="logout" method="post" action="lab5_session_protected.php">
                <input type="submit" name="submit" value="Logout">
            </form>
        </body>
    </html>
 <?php
    }
 ?> 
