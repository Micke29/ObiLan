<?php
	
	function affichageErreur()
	{
		//error_reporting(0); 	//LE COMMENTER EN PROD
	}

	function connexionBDD()
	{
		$bdd = new mysqli('localhost', 'obi1', 'gEstionnaire_OBI1', 'obilan');

		if ($bdd->connect_errno) 
		{
    	// Affichage d'un message d'erreur
    	echo "Error: Problème de connexion à la BDD \n";
    	echo "Errno: " . $bdd->connect_errno . "\n";
   		echo "Error: " . $bdd->connect_error . "\n";
    	// Arrêt du chargement de la page
    	exit();
		}

		// Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
		if (!$bdd->set_charset("utf8"))
		{
	   		printf("Pb de chargement du jeu de car. utf8: %s\n", $bdd->error);
	   		exit();
		}

		return $bdd;
	}

	function jeux($bdd)
	{
		return $bdd->query("SELECT * FROM `t_jeu_jeu`;");
	}

	function limiteLOL($bdd)
	{
		return $bdd->query("SELECT COUNT(`equ_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` WHERE `jeu_nom` = \"League of Legends\";");
	}

	function limiteCS($bdd)
	{
		return $bdd->query("SELECT COUNT(`equ_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` WHERE `jeu_nom` = \"Counter-Strike\";");
	}

	function limiteHS($bdd)
	{
		return $bdd->query("SELECT COUNT(`equ_id`) AS nombre FROM `t_joueur_jou` NATURAL JOIN `t_equipe_equ` WHERE `equ_nom` = \"Hearthstone\";");
	}

	function pizza($bdd)
	{
		return $bdd->query("SELECT * FROM `t_pizza_piz`;");
	}

	function equipes($bdd)
	{
		return $bdd->query("SELECT * FROM `t_equipe_equ` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` ORDER BY `jeu_id`;");
	}

	function joueurs($bdd)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou`;");
	}

	function existeJoueur($bdd, $nom, $prenom, $pseudo)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `jou_nom` = \"$nom\" AND `jou_prenom` = \"$prenom\" OR `cpt_pseudo` = \"$pseudo\";");
	}

	function compteInfo($bdd,$pseudo)
	{
		return $bdd->query("SELECT `jou_id`, `cpt_mail`, `equ_nom`, `jou_telephone` FROM `t_compte_cpt` NATURAL JOIN `t_equipe_equ` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` = \"$pseudo\";");
	}

	function comptePizza($bdd,$pseudo)
	{
		return $bdd->query("SELECT `jou_id`, `piz_nom`, `piz_date`, `piz_prix` FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` NATURAL JOIN `t_pizza_piz` WHERE `cpt_pseudo` = \"$pseudo\";");
	}

	function ajoutEquipe($bdd, $equipe, $acronyme, $jeu)
	{
		$resultat=1;

		$requete=$bdd->query("SELECT * FROM `t_equipe_equ` WHERE `equ_nom` = \"$equipe\" OR `equ_acronyme` = \"$acronyme\";");
		$existe=$requete->num_rows;

		if($existe != 0)
		{
			$resultat=2;
		}
		else
		{
			if($ajoutEquipe=$bdd->query("INSERT INTO `t_equipe_equ` (equ_nom,equ_acronyme) VALUES (\"$equipe\",\"$acronyme\");"))
			{
				$idEquipeResult=$bdd->query("SELECT `equ_id` FROM `t_equipe_equ` WHERE `equ_nom` = \"$equipe\";");
				
				while ($row = $idEquipeResult->fetch_assoc()) 
				{
					$idEquipe = $row["equ_id"];
				}
				$idEquipeResult->free();

				if($bdd->query("INSERT INTO `t_joint_equ_jeu` (jeu_id,equ_id) VALUES (\"$jeu\",\"$idEquipe\");"))
				{
					$resultat=0;
				}
				else
				{
					$bdd->query("DELETE FROM `t_equipe_equ` WHERE `equ_id` = \"$idEquipe\";");
				}
			}
		}

		return $resultat;
	}

	function suppressionEquipe($bdd, $idEquipe)
	{		
		$bdd->query("DELETE FROM `t_joint_equ_jeu` WHERE `equ_id` = \"$idEquipe\";");
		$bdd->query("DELETE FROM `t_equipe_equ` WHERE `equ_id` = \"$idEquipe\";");
	}

	function ajoutJoueur($bdd, $pseudo, $mdp, $mail, $equipe, $nom, $prenom, $tel, $poste)
	{
		$resultat=1;

		if($ajoutCompte=$bdd->query("INSERT INTO `t_compte_cpt` (cpt_pseudo,cpt_mdp,cpt_mail,cpt_date) VALUES (\"$pseudo\",\"$mdp\",\"$mail\",now());"))
		{
			if($_SESSION['poste'] == "capitaine")
			{
				$idEquipeResult=$bdd->query("SELECT `equ_id` FROM `t_equipe_equ` WHERE `equ_nom` = \"$equipe\";");
			
				while ($row = $idEquipeResult->fetch_assoc()) 
				{
					$idEquipe = $row["equ_id"];
				}
				$idEquipeResult->free();
			}
			else $idEquipe = $equipe;

			$idCompteResult=$bdd->query("SELECT `cpt_id` FROM `t_compte_cpt` WHERE `cpt_pseudo` = \"$pseudo\";");
				
			while ($row = $idCompteResult->fetch_assoc())
			{
				$idCompte = $row["cpt_id"];
			}
			$idCompteResult->free();			

			if($ajoutJoueur=$bdd->query("INSERT INTO `t_joueur_jou` (jou_nom,jou_prenom,jou_telephone,jou_capitaine,equ_id,cpt_id) VALUES (\"$nom\",\"$prenom\",\"$tel\",\"$poste\",\"$idEquipe\",\"$idCompte\");"))	//1 = capitaine		0 = joueur
			{
				$resultat=0;
			}
			else
			{
				$bdd->query("DELETE FROM `t_compte_cpt` WHERE `cpt_id` = \"$idCompte\";");
			}
		}

		return $resultat;
	}
	
	function modificationCompteJoueur($bdd, $pseudo, $id, $mail, $tel, $equipe)
	{
		$bdd->query("UPDATE `t_compte_cpt` SET `cpt_mail` = \"$mail\" WHERE `cpt_pseudo` = \"$pseudo\";");
		$bdd->query("UPDATE `t_joueur_jou` SET `jou_telephone` = \"$tel\", `equ_id` = \"$equipe\" WHERE `jou_id` = \"$id\";");
	}

	function modificationMdp($bdd, $pseudo, $mdp)
	{
		$bdd->query("UPDATE `t_compte_cpt` SET `cpt_mdp` = \"$mdp\" WHERE `cpt_pseudo` = \"$pseudo\";");
	}

	function suppressionJoueur($bdd, $pseudo)
	{
		if($_SESSION['poste'] == "capitaine")
		{
			$idEquipeResult=$bdd->query("SELECT `equ_id` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `cpt_pseudo` = \"$pseudo\";");
			while ($row = $idEquipeResult->fetch_assoc()) 
			{
				$idEquipe = $row["equ_id"];
			}
			$idEquipeResult->free();
		}

		$idCompteResult=$bdd->query("SELECT * FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `cpt_pseudo` = \"$pseudo\";");
		while ($row = $idCompteResult->fetch_assoc()) 
		{
			$idCompte = $row["cpt_id"];
			$idJoueur = $row["jou_id"];
		}
		$idCompteResult->free();		

		Norvegienne($bdd,$idJoueur);
		$bdd->query("DELETE FROM `t_joueur_jou` WHERE `cpt_id` = \"$idCompte\";");
		$bdd->query("DELETE FROM `t_compte_cpt` WHERE `cpt_id` = \"$idCompte\";");

		if($_SESSION['poste'] == "capitaine")
		{
			suppressionEquipe($bdd,$idEquipe);
		}

	}

	function ajoutPizza($bdd, $idJoueur, $idPizza_VS1, $idPizza_VS2, $idPizza_SM1)
	{
		$compt=0;
		$resultat=0;	

		while($resultat != 1 && $compt < 3)
		{

			if($idPizza_VS1 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VS1\",'VS1');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_VS2 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VS2\",'VS2');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_SM1 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_SM1\",'SM1');")) $compt++;
				else $resultat=1;
			}
		}
		return $resultat;
	}

	function Norvegienne($bdd, $idJoueur)	//Supprimer selection pizza
	{
		$bdd->query("DELETE FROM `t_joint_piz_jou` WHERE `jou_id` = \"$idJoueur\";");
	}

	function equipeCapitaine($bdd, $pseudo)
	{
		$idEquipeResult=$bdd->query("SELECT `equ_id` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `cpt_pseudo` = \"$pseudo\";");
		while ($row = $idEquipeResult->fetch_assoc()) 
		{
			$idEquipe = $row["equ_id"];
		}
		$idEquipeResult->free();

		return $bdd->query("SELECT * FROM `t_compte_cpt` NATURAL JOIN `t_joueur_jou` WHERE `equ_id` = \"$idEquipe\";");
	}

	function joueurAdmin($bdd)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` ORDER BY `jou_nom` ASC;");
	}

	function equipesIncompletesAdmin($bdd)
	{
		return $bdd->query("SELECT `equ_id`, `equ_nom`, `jeu_nom`, COUNT(`jou_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joueur_jou` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` GROUP BY `equ_id` HAVING COUNT(`jou_id`) < 5;");
	}

	function equipesCompletesAdmin($bdd)
	{
		return $bdd->query("SELECT `equ_id`, `equ_nom`, `jeu_nom`, COUNT(`jou_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joueur_jou` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` GROUP BY `equ_id` HAVING COUNT(`jou_id`) >= 5;");
	}

	function suppressionEquipeAdmin($bdd, $idEquipe)
	{

		$select=$bdd->query("SELECT `jou_id` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `equ_id` = \"$idEquipe\";");
		while($donnees = $select->fetch_assoc())
		{
			$id=$donnees["jou_id"];

			$bdd->query("DELETE FROM `t_joint_piz_jou` WHERE `jou_id` = \"$id\";");
			$bdd->query("DELETE FROM `t_joueur_jou` WHERE `jou_id` = \"$id\";");
			$bdd->query("DELETE FROM `t_compte_cpt` WHERE `cpt_id` = \"$id\";");
		}
		$select->free();

		$bdd->query("DELETE FROM `t_joint_equ_jeu` WHERE `equ_id` = \"$idEquipe\";");
		$bdd->query("DELETE FROM `t_equipe_equ` WHERE `equ_id` = \"$idEquipe\";");
    }

    function suppressionJoueurAdmin($bdd,$idJoueur)
    {
    	$bdd->query("DELETE FROM `t_joint_piz_jou` WHERE `jou_id` = \"$idJoueur\";");
		$bdd->query("DELETE FROM `t_joueur_jou` WHERE `jou_id` = \"$idJoueur\";");
		$bdd->query("DELETE FROM `t_compte_cpt` WHERE `cpt_id` = \"$idJoueur\";");
    }

	function pizzaAdmin($bdd)
	{
		$pizzaVS=selectionPizzaAdmin($bdd,"VS%");
		$pizzaSM=selectionPizzaAdmin($bdd,"SM%");

		echo "<h2>Vendredi Soir :</h2>";
		while($donnees = $pizzaVS->fetch_assoc())
		{
			echo $donnees["piz_nom"]." : ".$donnees["total"]."<br />";
		}
		echo "<h2>Samedi Midi :</h2>";
		while($donnees = $pizzaSM->fetch_assoc())
		{
			echo $donnees["piz_nom"]." : ".$donnees["total"]."<br />";
		}
	}

	function selectionPizzaAdmin($bdd,$date)
	{
		return $bdd->query("SELECT `piz_nom`, COUNT(`piz_id`) total FROM `t_pizza_piz` NATURAL JOIN `t_joint_piz_jou` WHERE `piz_date` LIKE \"$date\" GROUP BY `piz_id`;");
	}

	function verifPizzaAdmin($bdd,$nom)
	{
		return $bdd->query("SELECT `jou_id`, `piz_nom`, `piz_date`, `piz_prix` FROM `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` NATURAL JOIN `t_pizza_piz` WHERE `jou_nom` LIKE \"$nom\";");
	}

	/*
	function exportPizza($bdd,$date)
	{
		return $bdd->query("SELECT `jou_nom`, `jou_prenom`, `piz_nom` FROM `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` NATURAL JOIN `t_pizza_piz` WHERE `piz_date` LIKE \"$date\" ORDER BY `jou_nom` ASC;");
	}
	*/
	
	function exportJoueur($bdd)
	{
		return $bdd->query("SELECT `jou_nom`, `jou_prenom`, `jeu_nom`, `cpt_pseudo`, `equ_nom`, `jou_capitaine` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` NATURAL JOIN `t_jeu_jeu` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_equipe_equ` ORDER BY `jou_nom` ASC;");
	}
?>