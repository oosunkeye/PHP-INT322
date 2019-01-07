<?php
    if(isset($_POST['submit'])){
        include "../../assign1/a1.lib";
        $connect = connectionDB();
        $username = cleanInput($_POST['username']);
        $password = cleanInput($_POST['password']);
        if($connect){
            $result = mysqli_query($connect, "SELECT * from users");
            $loginOk = false;
            while($row=mysqli_fetch_assoc($result)){
                if($username == $row['username'] && $password == $row['password']){
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: lab5_session_protected.php");
                    $loginOk = true;
                }
            }
        }    
        else{
            die("Cannot connect to database");
        }
        mysqli_free_result($result);
        mysqli_close($connect);
    }
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>lab5_login</title>
        </head>
        <body>
            <h2>Login</h2>
            <?php if(isset($_POST['submit']) && !$loginOk) echo "<mark>Invalid username or password.</mark>" ?>
            <form name="login" method="post" action="lab5_session_login.php">
                <p><label for="username">Username:</label>&nbsp<input type="text" name="username"></p>
                <p><label for="password">Password:</label>&nbsp&nbsp<input type="password" name="password"></p>
                <p><input type="submit" name="submit" value="Login"></p>
            </form>
        </body>
    </html>
