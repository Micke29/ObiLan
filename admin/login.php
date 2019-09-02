<?php

	session_start();

	include("../config/config.requeteSQL.php");

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

	$requete=$bdd->query("SELECT `adm_pseudo`, `adm_mdp` FROM `t_admin_adm` WHERE `adm_pseudo`=\"$username\" AND `adm_mdp`=\"$password\";");

	$login=$requete->num_rows;

    if($login==0)
	{
		header("Location: alerte.php");
		exit();	
	}
	else
	{

		$_SESSION['pseudo']=$username;
		$_SESSION['admin']=TRUE;
						
		$username="";
		$password="";
		$bdd->close();

		header("Location: accueil.php");
		
		exit();
	}
?>