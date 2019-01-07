<!DOCTYPE html>
    <html>
        <head>
            <title>Lab2_No3</title>
            <style> .error { color: red; } </style>
        </head>
        <body>
        <?php
            $pcodeErr = "";
            $pcode="";
            $dataValid = true;
            if ($_POST){
                if (empty($_POST['pcode'])){
                    $pcodeErr = "*Postal code is required.";
                    $dataValid = false;
                }
                else {
                    $pcode = trim($_POST["pcode"]);
                    $pcode = stripslashes($pcode);
                    $pcode = htmlspecialchars($pcode);
                    if(!preg_match("/^\s*[a-zA-Z]\d[a-zA-Z]\s?\d[a-zA-Z]\d\s*$/", $pcode)){
                        $pcodeErr = "Postal code is INVALID!";
                        $dataValid = false;
                    }
                    
                }
            }
            if($_POST && $dataValid){
                echo "<mark>" . $pcode . "</mark> is a VALID postal code.";
            }
            else{
        ?>    
            <h3>Lab2 - No. 3</h3>
            <form method="post" name="postal" action="Lab2-3.php">
                Postal Code: <input type="text" name="pcode"  value="<?php if (isset($_POST['pcode'])) echo $_POST['pcode']; ?>">
                <span class="error"><?php echo $pcodeErr; ?></span>
                <br/><br/>
                <input type="submit">
            </form>
            <?php } ?>
        </body>
    </html>