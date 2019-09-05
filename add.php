<?php
	include "./db/dbaccess.php";
	include "./db/credentials.php";
	session_start();
	if (!isset($_SESSION['username'])){
		header("Location: ./index.php");
	}
	if ($_SESSION['guild_check'] == false){
		header("Location: ../index.php?authorization=failed");
	}
	
	#Checking for Existence 
	
	$chkstmt = $link->prepare("SELECT discordid FROM mcuserlink WHERE discordid = '".$_SESSION['id']."'");
	
	if (!($chkstmt->execute())){
		header("Location: ../index.php?mysqli_failure");
	}
	
	
	if ($chkstmt->fetch()){
		header("Location: ../index.php?authorization=already_registered");
		session_destroy();
		
	}
	else {
		$_SESSION['first_time'] = true;
	
	}
	
	
	
	
	
?>

<html>

<head>
<title>Submission Form</title>
</head>

<body>
<h2 align='center'>Minecraft Username Submission Form</h2>
<hr>

<p>Welcome <?php echo $_SESSION['username']."#".$_SESSION['discriminator'];?> to the Submission Form.</p>
<br>
<br>
<form action="./verification.php" method='post'>
<fieldset>
<legend>Username Submission</legend>
Insert Username Below
<input type="text" name="mcusername"><br>
<input type="submit" name="submit" value="Submit">


</fieldset>

</form>



</body>

</html>
