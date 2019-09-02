<?php
	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	if($_POST['equipe'] && $_POST['email'] && $_POST['tel'])
	{
		$equipe=htmlspecialchars(addslashes($_POST['equipe']));
		$email=htmlspecialchars(addslashes($_POST['email']));
		$tel=htmlspecialchars(addslashes($_POST['tel']));

		$bdd=connexionBDD();
		modificationCompteJoueur($bdd,$_SESSION['pseudo'],$_SESSION['id'],$email,$tel,$equipe);
		$_SESSION['modif']="ok";
		unset($_SESSION['id']);

		header("Location: ../compte.php");
		exit();
	}
	else
	{
		$_SESSION['formulaire']=1;
		header("Location: ../compte.php");
		exit;
	}
?>