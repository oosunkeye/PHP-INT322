<!DOCTYPE html>
    <html>
        <head>
            <title>Lab2_No4</title>
            <style> .error { color: red; } </style>
        </head>
        <body>
        <?php
            $scodeErr = "";
            $scode="";
            $dataValid = true;
            if ($_POST){
                if (empty($_POST['scode'])){
                    $scodeErr = "*Subject code is required.";
                    $dataValid = false;
                }
                else {
                    $scode = trim($_POST["scode"]);
                    $scode = stripslashes($scode);
                    $scode = htmlspecialchars($scode);
                    if(!preg_match("/^\s*[A-Z]{3}\d{3}[A-Z]{1,3}\s*$/", $scode)){
                        $scodeErr = "Subject code is INVALID!";
                        $dataValid = false;
                    }
                    
                }
            }
            if($_POST && $dataValid){
                echo "<mark>" . $scode . "</mark> is a VALID subject code.";
            }
            else{
        ?>    
            <h3>Lab2 - No. 4</h3>
            <form method="post" name="subject" action="Lab2-4.php">
                Subject Code: <input type="text" name="scode"  value="<?php if (isset($_POST['scode'])) echo $_POST['scode']; ?>">
                <span class="error"><?php echo $scodeErr; ?></span>
                <br/><br/>
                <input type="submit">
            </form>
            <?php } ?>
        </body>
    </html>