<!DOCTYPE html>
    <html>
        <head>
            <title>Lab2_No6</title>
            <style> .error { color: red; } </style>
        </head>
        <body>
        <?php
            $tcodeErr = "";
            $tcode="";
            $dataValid = true;
            if ($_POST){
                if (empty($_POST['tcode'])){
                    $tcodeErr = "*Telephone number is required.";
                    $dataValid = false;
                }
                else {
                    $tcode = trim($_POST["tcode"]);
                    $tcode = stripslashes($tcode);
                    $tcode = htmlspecialchars($tcode);
                    if(!preg_match("/^\s*\d{3}\-?\s*\d{3}\-?\s*\d{4}\s*$|^\s*\(\d{3}\)\s+\d{3}(\-|\s+)\d{4}\s*$/", $tcode)){
                        $tcodeErr = "Telephone number is INVALID!";
                        $dataValid = false;
                    }
                    
                }
            }
            if($_POST && $dataValid){
                echo "<mark>" . $tcode . "</mark> is a VALID telephone number.";
            }
            else{
        ?>    
            <h3>Lab2 - No. 6</h3>
            <form method="post" name="telephone" action="Lab2-6.php">
                Telephone Number: <input type="text" name="tcode"  value="<?php if (isset($_POST['tcode'])) echo $_POST['tcode']; ?>">
                <span class="error"><?php echo $tcodeErr; ?></span>
                <br/><br/>
                <input type="submit">
            </form>
            <?php } ?>
        </body>
    </html>