<!DOCTYPE HTML>

<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="icon/png" href="images/icone.png">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
	</head>

	<body id="login-body">
		
		<header>
		<?php
			include("./config/config.navbar.php");
		?>
		</header>

		<div id="login-box">
			<h1>Identification</h1>
			<form method="post" action="login.php">
	
			<p>Identifiant :</p>
			<input type="text" name="pseudo" placeholder="pseudo" required="required" />
	
			<p>Mot de passe :</p>
			<input type="password" name="mdp" placeholder="mot de passe" required="required" />

			<input type="submit" value="Connexion">

			</form>
		</div>
	</body>

</html>