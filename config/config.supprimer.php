<?php
	
	session_start();

	include("../config/config.requeteSQL.php");
	affichageErreur();

	if(isset($_GET['equ']))
	{
		$pseudo=$_SESSION['pseudo'];

		$bdd=connexionBDD();
		$requete=$bdd->query("SELECT `equ_id` FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` LIKE \"$pseudo\";");

		while($resultatRequete=$requete->fetch_assoc())
		{
			$idEquipe=$resultatRequete['equ_id'];
		}

		suppressionEquipeAdmin($bdd,$idEquipe);

		session_destroy();
		header("Location: ../");
	}
	elseif(isset($_GET['jou']))
	{
		$pseudo=$_GET['jou'];

		$bdd=connexionBDD();
		$requete=$bdd->query("SELECT `jou_id` FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` LIKE \"$pseudo\";");

		while($resultatRequete=$requete->fetch_assoc())
		{
			$idJoueur=$resultatRequete['jou_id'];
		}
		$requete->free();
		
		$bdd->query("UPDATE `t_joueur_jou` SET `equ_id` = \"1\" WHERE `jou_id` = \"$idJoueur\";");

		header("Location: ../compte.php");
	}
	elseif(isset($_GET['cpt']))
	{
		$pseudo=$_GET['cpt'];

		$bdd=connexionBDD();
		suppressionJoueur($bdd,$pseudo);

		session_destroy();
		header("Location: ../");
	}
	else header("Location: ./");
?>