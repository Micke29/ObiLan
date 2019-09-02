<!DOCTYPE HTML>

<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		?>
		
		<center>
			<form method="post" action="login.php">
				<label>Identifiant :</label><input type="text" name="pseudo" placeholder="pseudo" required="required" /><br />
				<label>Mot de passe :</label><input type="password" name="mdp" placeholder="mot de passe" required="required" /><br />
				<p><input type="submit" value="Valider"></p>
			</form>
		</center>

	</body>

</html>