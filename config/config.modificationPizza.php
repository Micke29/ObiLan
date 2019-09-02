<?php
	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	if(isset($_SESSION['id']))
	{
		$_POST['pizza_VM']=$idPizza_VM;
		$_POST['pizza_VS']=$idPizza_VS;
		$_POST['pizza_SM']=$idPizza_SM;
		$_SESSION['id']=$idJoueur;

		unset($_SESSION['id']);

		$bdd=connexionBDD();

		Norvegienne($bdd,$idJoueur);
		$resultat=ajoutPizza($bdd,$idJoueur,$idPizza_VM,$idPizza_VS,$idPizza_SM);

		$bdd->close();
	}

	header("Location: ../compte.php");
?>