<?php
	include("../config/config.requeteSQL.php");
	affichageErreur();

	if(!isset($_GET['equ']))
	{
		header("Location: ./accueil.php");
		exit();
	}
	else
	{
		$bdd=connexionBDD();
		suppressionEquipeAdmin($bdd,$_GET['equ']);

		header("Location: ./accueil.php");
	}
?>