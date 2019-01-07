<!doctype html>
<html>
  <head>
    <title>FSOSS Registration</title>
	<style> .error { color: red; }
			.result{ border: 1px solid black; border-collapse:collapse; width: 100%}
			.result th{ border: 1px solid black; background-color: limegreen }
			.result tr td{ border: 1px solid black;}
	</style>
  </head>
  <body>
  <?php
  include "../userDetails.php";
  $connect = mysqli_connect($serverDB, $userName, $userPwd, $nameDB);
  if (isset($_GET['id'])) {
		  $id = $_GET['id'];
		  $qry2 = "UPDATE lab3 SET Attend1 = 'XX', Attend2 = 'XX' where Phone = $id";
		  mysqli_query($connect, $qry2);
	}  
  $titleErr="";
  $firstNameErr ="";
  $lastNameErr ="";
  $organizationErr="";
  $emailErr="";
  $phoneErr="";
  $dayAttendErr="";
  $tShirtErr="";
  $dataValid=true;
  // If submit with POST
  if ($_POST) { 
        // Test for nothing entered in field
     if (!isset($_POST['dayAttend'])) {
        $_POST['dayAttend'] = [];
    }		
	
	if(empty($_POST['title'])){
	  $titleErr = "*Title is required.";
	  $dataValid = false;
	}
	
	if(empty($_POST['dayAttend'])){
	  $dayAttendErr = "*Day(s) attending is required.";
	  $dataValid = false;
	}
	
	if($_POST['t-shirt'] == ""){
		$tShirtErr = "*T-shirt size is required.";
		$dataValid = false;
	}
	
	if (empty($_POST['firstName'])) {  
		$firstNameErr = "*Firstname is required.";
		$dataValid = false;
	}
	
	if (empty($_POST['lastName'])) {
		$lastNameErr = "*Lastname is required.";
		$dataValid = false;		
	}
	
	if (empty($_POST['organization'])) {  
		$organizationErr = "*Organization is required.";
		$dataValid = false;		
	}
	
	if (empty($_POST['email'])) {  
		$emailErr= "*Email address is required.";
		$dataValid = false;		
	}
	
	if (empty($_POST['phone'])) {  
		$phoneErr = "*Phone number is required.";
		$dataValid = false;		
	}
  }
  
  function cleanInput($var){
	  $var = trim($var);
      $var = stripslashes($var);
      $var = htmlspecialchars($var);
	  return $var;
  }				
if ($_POST && $dataValid) {
	  $title = cleanInput($_POST['title']);
	  $firstName = cleanInput($_POST['firstName']);
	  $lastName = cleanInput($_POST['lastName']);
	  $organization = cleanInput($_POST['organization']);
	  $email = cleanInput($_POST['email']);
	  /*foreach($_POST['dayAttend'] as $key => $value){
		echo "key= ". $key . ": value= " .$value . "<br/>";
	  }*/
	  $monday= isset($_POST['dayAttend'][0]) ? cleanInput($_POST['dayAttend'][0]) : "";
	  $tuesday = isset($_POST['dayAttend'][1]) ? cleanInput($_POST['dayAttend'][1]) : "";
	  //echo $monday .",". $tuesday;
	  $tShirt = cleanInput($_POST['t-shirt']);
	  $phone = cleanInput($_POST['phone']);
	  
	
	
	
	if($connect){
	  $qry = "INSERT INTO lab3 (Title, Firstname, Lastname, Organization, Email, Phone, Attend1, Attend2,Tshirt)
	          Values('$title','$firstName','$lastName','$organization','$email','$phone','$monday','$tuesday','$tShirt')";
	  mysqli_query($connect, $qry);
	  $result = mysqli_query($connect, "SELECT * from lab3");
	  ?>
	  <table class='result'>
		<tr>
		  <th>Title</th>
		  <th>Firstname</th>
		  <th>Lastname</th>
		  <th>Organization</th>
		  <th>Email</th>
		  <th>Phone</th>
		  <th>Day/s Attending</th>
		  <th>Tshirt Size</th>
		  <th>Action</th>
		</tr>
	  <?php
	  while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		  echo "<td>". $row['Title'] ."</td>";
		  echo "<td>". $row['Firstname'] ."</td>";
		  echo "<td>". $row['Lastname'] ."</td>";
		  echo "<td>". $row['Organization'] ."</td>";
		  echo "<td>". $row['Email'] ."</td>";
		  echo "<td>". $row['Phone']. "</td>";
		  echo "<td>". $row['Attend1'] . " " . $row['Attend2']."</td>";
		  echo "<td>". $row['Tshirt'] ."</td>";
		  echo "<td><a href=\"fsoss-register.php?id={$row['Phone']}\">Cancel</a>";
		echo "</tr>";
		
	  }
	  
	  ?>
	  </table>
	  <p><a href=fsoss-register.php>Add another record</a></p>
	  <?php
	}
	else{
	  die ("ERROR: Could not connect to the database: " . mysqli_connect_error($connect));
	}
	
	
	
	mysqli_close($connect);
	
  }
else{
?>  
  <h1>FSOS Registration</h1>
  <form method="post" name ="fsoss" action= "fsoss-register.php">
	<table>
	<tr>
    	<td valign="top">Title:</td>
	<td>
		<table>
		  <tr>
			<td><input type="radio" name="title" value="Mr"
			<?php if (isset($_POST['title']) && ($_POST['title'] == "Mr"))
			       echo "CHECKED";
			?>>Mr</td>
		  </tr>
		  <tr>
			<td><input type="radio" name="title" value="Mrs"
			<?php if (isset($_POST['title']) && ($_POST['title'] == "Mrs"))
			      echo "CHECKED";
			?>>Mrs</td>
		  </tr>
		  <tr>
		   <td><input type="radio" name="title" value="Ms"
		   <?php if (isset($_POST['title']) && ($_POST['title'] == "Ms"))
					  echo "CHECKED";
		   ?>>Ms</td>
		  </tr>
		  <tr>
			<td><span class="error"><?php echo $titleErr;?></span></td>
		  </tr>
		</table>
	</td>
	</tr>
	<tr>
      <td>First name:</td>
	  <td><input name="firstName" type="text" value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
	  <span class="error"><?php echo $firstNameErr;?></span></td>
	</tr>
	<tr>
      <td>Last name:</td>
	  <td><input name="lastName" type="text" value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>">
	  <span class="error"><?php echo $lastNameErr;?></span></td>
	</tr>
	<tr>
      <td>Organization:</td>
	  <td><input name="organization" type="text" value="<?php if (isset($_POST['organization'])) echo $_POST['organization']; ?>">
	  <span class="error"><?php echo $organizationErr;?></span></td>
	</tr>
	<tr>
      <td>Email address:</td>
	  <td><input name="email" type="text" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
	  <span class="error"><?php echo $emailErr;?></span></td>
	</tr>
	<tr>
      <td>Phone number:</td>
	  <td><input name="phone" type="text" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
	  <span class="error"><?php echo $phoneErr;?></span></td>
	</tr>
	<tr>
      <td>Days attending:</td>
	  <td>
		<input name="dayAttend[]" type="checkbox" value="Monday"
		<?php
		  if ($_POST && in_array('Monday', $_POST['dayAttend']))
		          echo "CHECKED";
		?>>Monday
		<input name="dayAttend[]" type="checkbox" value="Tuesday"
		<?php if ($_POST && in_array('Tuesday', $_POST['dayAttend']))
		          echo "CHECKED";
		?>>Tuesday			  
		<span class="error"><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $dayAttendErr;?></span>
	  <td/>
	</tr>
	<tr>
	  <td>T-shirt size:</td>
	  <td>
	    <select name="t-shirt">
		  <option value="" <?php if ($_POST && ($_POST['t-shirt']=="")) echo "SELECTED"; ?>>--Please choose--</option>
		  <option value="S" <?php if ($_POST && ($_POST['t-shirt']=="S")) echo "SELECTED"; ?>>Small</option>
		  <option value="M" <?php if ($_POST && ($_POST['t-shirt'] == "M")) echo "SELECTED"; ?>>Medium</option>
		  <option value="L" <?php if ($_POST && ($_POST['t-shirt'] == "L")) echo "SELECTED"; ?>>Large</option>
		  <option value="XL" <?php if ($_POST && ($_POST['t-shirt'] == "XL")) echo "SELECTED"; ?>>X-Large</option>
		</select>
		<span class="error"><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp". $tShirtErr;?></span>
	  </td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	  <td></td>
	  <td><input name="submit" type="submit"></td>
	</tr>
	</table>
  </form>
<?php
  }
?>	  
 </body>
</html>
