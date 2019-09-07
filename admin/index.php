<!DOCTYPE HTML>

<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="../images/login/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
	</head>

	<body id="login-body">
		<div id="login-box">
		<img src="http://www.playtimeparis.com/images/exposer/logo-login.png" id="avatar">
		    <h1>Identification</h1>
				<form method="post" action="login.php">
					<p>Identifiant :</p><input type="text" name="pseudo" placeholder="pseudo" required="required" />
					<p>Mot de passe :</p><input type="password" name="mdp" placeholder="mot de passe" required="required" />
					<input type="submit" value="Connexion">
				</form>		
		</div>
	</body>

</html>