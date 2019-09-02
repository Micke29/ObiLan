<?php

	session_start();

	include("./config/config.requeteSQL.php");

	affichageErreur();

	if($_POST['pseudo'] && $_POST['mdp'])
	{
		$username=htmlspecialchars(addslashes($_POST['pseudo']));
		$password=sha1(htmlspecialchars(addslashes($_POST['mdp'])));
	}
	else
	{
		header("Location: alerte.php");
		exit;
	}

	$bdd=connexionBDD();

	$requete=$bdd->query("SELECT `cpt_pseudo`, `cpt_mdp` FROM `t_compte_cpt` WHERE `cpt_pseudo`=\"$username\" AND `cpt_mdp`=\"$password\";");

	$login=$requete->num_rows;

    if($login==0)
	{
		$bdd->close();
		
		header("Location: alerte.php");
		exit();	
	}
	else
	{
		$_SESSION['pseudo']=$username;
						
		$username="";
		$password="";
		$bdd->close();

		header("Location: compte.php");
		
		exit();
	}
?>