<?php
	include("../config/config.requeteSQL.php");
	affichageErreur();

	if(!isset($_GET['equ']))
	{
		if(!isset($_GET['jou']))
		{
			header("Location: ./accueil.php");
			exit();
		}
		else
		{
			$bdd=connexionBDD();
			suppressionJoueurAdmin($bdd,$_GET['jou']);

			header("Location: ./accueil.php");
		}
	}
	else
	{
		$bdd=connexionBDD();			
		suppressionEquipeAdmin($bdd,$_GET['equ']);

		header("Location: ./accueil.php");
	}
?>