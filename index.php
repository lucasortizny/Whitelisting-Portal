<?php
	session_start();
	
	if (isset($_SESSION['username'])){
		header("Location: ./add.php");
	}
	?>
	
<!DOCTYPE HTML>
<html>

	<head>
	
		<title> Minecraft Whitelist </title>
		
		<!--Custom CSS-->
		<link href="styles.css" type="text/css" rel="stylesheet"/>
		
		<!--BS CSS-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-dark justify-content-center">
		  <span id = 'heading'>Minecraft Whitelisting Portal</span>
		</nav>

		<div class = 'container' id = 'welcome'> 

			<span class = 'word' align = 'center'> Welcome </span>

			<div class = 'info'> 
				<p align="center"> This is the portal to whitelist your Minecraft account.</p>
				<p align="center">Please note: <br> This action may be done <b>ONLY</b> <span style="text-decoration-line: underline">once</span>. If you input the wrong username, message Lucas.</p>

				<p align="center">This portal will link your Discord account to your Minecraft account so only one account per person will be possible.</p>
			</div>
		</div>
		
		<div class = 'button' align = 'center'> 
			<a class="btn btn-dark" href = "https://discordapp.com/api/oauth2/authorize?client_id=435326675199197186&redirect_uri=http%3A%2F%2Flucasortizny.com%2Fwhitelist%2Fauthorize.php&response_type=code&scope=identify%20guilds" role="button">Authorize Your Discord Account</a>
		</div>
		
	</body>
</html>