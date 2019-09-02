<!DOCTYPE HTML>

<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="../images/login/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>

	<body>
		<div id="login">
			<fieldset>
				<legend><h1>Zone Admin</h1></legend>
				<center>
				<form method="post" action="login.php">
					<label>Identifiant :</label><input type="text" name="pseudo" placeholder="pseudo" required="required" /><br />
					<label>Mot de passe :</label><input type="password" name="mdp" placeholder="mot de passe" required="required" /><br />
					<p><input type="submit" value="Valider"></p>
				</form>
				</center>
			</fieldset>
		</div>
	</body>

</html>