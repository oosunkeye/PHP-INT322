<?php
if (!isset($_COOKIE['count'])){
        $cookie = 1;
        setcookie("count", $cookie);
    }
    else {
        $cookie = ++$_COOKIE['count'];
        setcookie("count", $cookie);
    }
if(isset($_POST['submit'])){
    setcookie($_POST['cookieName'],$_POST['cookieValue'], time()+3600, "/", ".zenit.senecac.on.ca");
   }
?>

<!doctype html>
    <html>
        <head>
            <title>lab5_cookies</title>
        </head>
     <body>
        <h2>Lab5 - Part1 Cookies</h2>
        <form method="post" action="lab5_cookies.php">
            <p>Name: <input type="text" name="cookieName"></p>
            <p>Value: &nbsp<input type="text" name="cookieValue"></p>
            <input type="submit" name="submit">
        </form>
        <br><br>
        <?php 
            //if (isset($_POST['submit'])){
            foreach ($_COOKIE as $key => $value){
                if($key != 'count' && $key != 'PHPSESSID'){
                    echo "<p>$key&nbsp&nbsp&nbsp$value</p>";
                }
            }
             //}   
        ?>
        <br/><br/>
        <?php
            if(isset($_COOKIE['count']) && $_COOKIE['count'] > 1){
        ?>
                <h3>Welcome back - you visited this page <?php echo $_COOKIE['count'] ?> times.</h3>
        <?php } ?>        
     </body>   
    </html>
