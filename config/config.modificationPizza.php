<?php
	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	if(isset($_SESSION['id']))
	{
		$idPizza_VS1=$_POST['pizza_VS1'];
		$idPizza_VS2=$_POST['pizza_VS2'];
		$idJoueur=$_SESSION['id'];

		unset($_SESSION['id']);

		$bdd=connexionBDD();

		Norvegienne($bdd,$idJoueur);
		$resultat=ajoutPizza($bdd,$idJoueur,$idPizza_VS1,$idPizza_VS2);

		if($resultat == 0) $_SESSION['modif']="ok";

		$bdd->close();
	}

	header("Location: ../compte.php");
?>