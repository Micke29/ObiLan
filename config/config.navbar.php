<a href="./">Accueil</a>
<a href="./reglement.php">Réglement</a>
<a href="./contact.php">Contact</a>
<?php
	if(isset($_SESSION["pseudo"]))
	{
		echo '<a href="./compte.php">Mon Compte</a> ';
		echo '<a href="./logout.php">Déconnexion</a> ';
	}
	else
	{	$date1=date("d.m.Y");
		$date2="31.08.2018";
		if(strtotime($date1)<strtotime($date2)) echo '<a href="./inscription.php">Inscription</a> ';
		echo '<a href="./connexion.php">Connexion</a> ';
	}
?>