<?php
    if(isset($_POST['submit'])){
        include "../../assign1/a1.lib";
        $connect = connectionDB();
        $email = cleanInput($_POST['email']);
        if($connect){
            $result = mysqli_query($connect, "SELECT passwordHint from users where username = '$email'");
            
            if( mysqli_num_rows($result)){
                $row = mysqli_fetch_assoc($result);
                //echo $row['passwordHint'];
                $subject = "Password hint requested";
                $message = "Your password hint: " . $row['passwordHint'];
                $headers = "From: int322_162a02@zenit.senecac.on.ca" . "\r\n" .
                           "Reply-To: int322_162a02@zenit.senecac.on.ca" . "\r\n" .
                           "X-Mailer: PHP/" . phpversion();
                if(mail($email, $subject, $message, $headers)){
                     header("Refresh: 3; url=lab5_email.php");
                     echo "<h4>Password hint was sent to your email.</h4>";
                }    
                mysqli_free_result($result);
                mysqli_close($connect);
            }
            else{
                 mysqli_close($connect);
                 header("Location: lab5_email.php");
            }
        
        }    
        else{
            die("Cannot connect to database");
        }
    }
    else{
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>lab5_email_forgot</title>
        </head>
        <body>
            <h2>Forgot password</h2>
            <form name="email" method="post" action="lab5_email_forgot.php">
                <p><label for="email">Enter email address:</label>&nbsp<input type="text" name="email"></p>
                <p><input type="submit" name="submit"></p>
            </form>
        </body>
    <?php
        }
    ?>
    </html>
