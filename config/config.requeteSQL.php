<?php
	
	function affichageErreur()
	{
		//error_reporting(0); 	//LE DECOMMENTER UNE FOIS EN LIGNE
	}

	function connexionBDD()
	{
		$bdd = new mysqli('localhost', 'root', 'root', 'obilan');

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

	function pizza($bdd)
	{
		return $bdd->query("SELECT * FROM `t_pizza_piz`;");
	}

	function equipes($bdd)
	{
		return $bdd->query("SELECT * FROM `t_equipe_equ` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_jeu_jeu` ORDER BY `jeu_nom`;");
	}

	function joueurs($bdd)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou`;");
	}

	function existeJoueur($bdd, $nom, $prenom, $pseudo)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `jou_nom` = \"$nom\" AND `jou_prenom` = \"$prenom\" OR `cpt_pseudo` = \"$pseudo\";");
	}

	function compte($bdd,$pseudo)
	{
		return $bdd->query("SELECT `jou_id`, `cpt_mail`, `equ_nom`, `jou_telephone`, `piz_nom`, `piz_date`, `piz_prix` FROM `t_compte_cpt` NATURAL JOIN `t_equipe_equ` NATURAL JOIN `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` NATURAL JOIN `t_pizza_piz` WHERE `cpt_pseudo` = \"$pseudo\";");
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

	function ajoutPizza($bdd, $idJoueur, $idPizza_VM1, $idPizza_VM2, $idPizza_VM3, $idPizza_VS1, $idPizza_VS2, $idPizza_VS3, $idPizza_SM1, $idPizza_SM2, $idPizza_SM3)
	{
		$compt=0;
		$resultat=0;	

		while($resultat != 1 && $compt < 9)
		{
			if($idPizza_VM1 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VM1\",'VM1');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_VM2 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VM2\",'VM2');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_VM3 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VM3\",'VM3');")) $compt++;
				else $resultat=1;
			}

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
			if($idPizza_VS3 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_VS3\",'VS3');")) $compt++;
				else $resultat=1;
			}

			if($idPizza_SM1 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_SM1\",'SM1');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_SM2 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_SM2\",'SM2');")) $compt++;
				else $resultat=1;
			}
			if($idPizza_SM3 == "NULL") $compt++;
			else
			{
				if($ajout=$bdd->query("INSERT INTO `t_joint_piz_jou` (jou_id,piz_id,piz_date) VALUES (\"$idJoueur\",\"$idPizza_SM3\",'SM3');")) $compt++;
				else $resultat=1;
			}
		}
		return $resultat;
	}

	function Norvegienne($bdd, $idJoueur)	//Supprimer selection pizza
	{
		$bdd->query("DELETE FROM `t_joint_piz_jou` WHERE `jou_id` = \"$idJoueur\";");
	}

	function joueurAdmin($bdd)
	{
		return $bdd->query("SELECT * FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt`;");
	}

	function equipesIncompletesAdmin($bdd)
	{
		return $bdd->query("SELECT `equ_id`, `equ_nom`, COUNT(`jou_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joueur_jou` GROUP BY `equ_id` HAVING COUNT(`jou_id`) < 5;");
	}

	function equipesCompletesAdmin($bdd)
	{
		return $bdd->query("SELECT `equ_id`, `equ_nom`, COUNT(`jou_id`) AS nombre FROM `t_equipe_equ` NATURAL JOIN `t_joueur_jou` GROUP BY `equ_id` HAVING COUNT(`jou_id`) > 5;");
	}

	function suppressionEquipeAdmin($bdd, $idEquipe)
	{
		$bdd->query("DELETE
					    `t_joueur_jou`,
					    `t_compte_cpt`,
					    `t_joint_piz_jou`,
					    `t_joint_equ_jeu`,
					    `t_equipe_equ`
					FROM
					    `t_joueur_jou`
					INNER JOIN `t_compte_cpt` ON `t_joueur_jou`.`cpt_id` = `t_compte_cpt`.`cpt_id`
					INNER JOIN `t_joint_piz_jou` ON `t_joueur_jou`.`jou_id` = `t_joint_piz_jou`.`jou_id`
					INNER JOIN `t_joint_equ_jeu` ON `t_joueur_jou`.`equ_id` = `t_joint_equ_jeu`.`equ_id`
					INNER JOIN `t_equipe_equ` ON `t_joueur_jou`.`equ_id` = `t_equipe_equ`.`equ_id`
					WHERE
					    `t_joueur_jou`.`equ_id` = \"$idEquipe\";");
    }

	function pizzaAdmin($bdd)
	{
		$pizzaVM=selectionPizzaAdmin($bdd,"VM%");
		$pizzaVS=selectionPizzaAdmin($bdd,"VS%");
		$pizzaSM=selectionPizzaAdmin($bdd,"SM%");

		echo "<h2>Vendredi Midi :</h2>";
		while($donnees = $pizzaVM->fetch_assoc())
		{
			echo $donnees["piz_nom"]." : ".$donnees["total"]."<br />";
		}
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

	function exportPizza($bdd,$date)
	{
		return $bdd->query("SELECT `jou_nom`, `jou_prenom`, `piz_nom` FROM `t_joueur_jou` NATURAL JOIN `t_joint_piz_jou` NATURAL JOIN `t_pizza_piz` WHERE `piz_date` LIKE \"$date\" ORDER BY `jou_nom` ASC;");
	}

	function exportJoueur($bdd)
	{
		return $bdd->query("SELECT `jou_nom`, `jou_prenom`, `jeu_nom`, `cpt_pseudo`, `equ_nom`, `jou_capitaine` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` NATURAL JOIN `t_jeu_jeu` NATURAL JOIN `t_joint_equ_jeu` NATURAL JOIN `t_equipe_equ` GROUP BY `equ_nom` ORDER BY `jeu_nom` ASC;");
	}
?>