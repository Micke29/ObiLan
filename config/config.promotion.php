<?php
	
	session_start();

	include("../config/config.requeteSQL.php");
	affichageErreur();

	if(isset($_GET['cpt']))
	{
		$pseudoOldCapt=$_SESSION['pseudo'];
		$pseudoNewCapt=$_GET['cpt'];

		$bdd=connexionBDD();
		$requeteOld=$bdd->query("SELECT `jou_id` FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` LIKE \"$pseudoOldCapt\";");
		$requeteNew=$bdd->query("SELECT `jou_id` FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` LIKE \"$pseudoNewCapt\";");

		while($resultatRequeteOld=$requeteOld->fetch_assoc())
		{
			$idJoueurOld=$resultatRequeteOld['jou_id'];
		}

		while($resultatRequeteNew=$requeteNew->fetch_assoc())
		{
			$idJoueurNew=$resultatRequeteNew['jou_id'];
		}

		$requeteOld->free();
		$requeteNew->free();

		$bdd->query("UPDATE `t_joueur_jou` SET `jou_capitaine` = \"1\" WHERE `jou_id` = \"$idJoueurNew\";");
		$bdd->query("UPDATE `t_joueur_jou` SET `jou_capitaine` = \"0\" WHERE `jou_id` = \"$idJoueurOld\";");

		unset($_SESSION['poste']);
		header("Location: ../compte.php");
	}
	else header("Location: ./");
?>