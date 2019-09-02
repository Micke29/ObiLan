<?php
	include("../config/config.requeteSQL.php");

	affichageErreur();
	$bdd=connexionBDD();

	if(isset($_GET["pizza"]))
	{
		header("Content-type: application/force-download");
		if ($_GET["pizza"]=="VS") header("Content-Disposition: attachment; filename=pizza_VendrediSoir.ods");
		elseif ($_GET["pizza"]=="SM") header("Content-Disposition: attachment; filename=pizza_SamediMidi.ods");

		print ("Nom	"."Prénom	"."Pizza\n");

		$date=htmlspecialchars($_GET["pizza"]);
		$requete=exportPizza($bdd,$date);

		while($donnees=$requete->fetch_assoc())
		{
			print ($donnees["jou_nom"]."	".$donnees["jou_prenom"]."	".$donnees["piz_nom"]."\n");
		}

		exit();
	}
	elseif(isset($_GET['joueurs']))
	{

		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=tableau_joueurs/equipes.ods");

		print ("Nom	"."Prénom	"."Jeu	"."Pseudo	"."Equipe	"."Capitaine\n");

		$requete=exportJoueur($bdd);

		while($donnees=$requete->fetch_assoc())
		{
			print ($donnees['jou_nom']."	".$donnees['jou_prenom']."	".$donnees['jeu_nom']."	".$donnees['cpt_pseudo']."	".$donnees['equ_nom']."	".$donnees['jou_capitaine']."\n");
		}

		exit();
	}
	else
	{
		header("Location: accueil.php");
		exit();
	}
?>