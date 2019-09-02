<?php

	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	if($_POST['mdp'] && $_POST['mdp_verif'])
	{
		$mdp=sha1(htmlspecialchars(addslashes($_POST['mdp'])));
		$mdp_verif=sha1(htmlspecialchars(addslashes($_POST['mdp_verif'])));
	}
	else
	{
		$_SESSION['formulaire']=1;
		header("Location: ../compte.php");
		exit;
	}

	if(strcmp($mdp, $mdp_verif) == 0)
	{
		$bdd=connexionBDD();
		modificationMdp($bdd,$_SESSION['pseudo'],$mdp);

		$mdp="";
		$mdp_verif="";
		$_SESSION['modif']="ok";

		header("Location: ../compte.php");
		exit();
	}
	else
	{
		$mdp="";
		$mdp_verif="";
		$_SESSION['modif']="mdp";

		header("Location: ../compte.php?modif=mdp");
	}
?>