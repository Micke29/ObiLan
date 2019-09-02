<?php
	
	session_start();

	include("./config.requeteSQL.php");

	affichageErreur();

	function Error($bdd,$codeErreur)
	{
		$nom="";
		$prenom="";
		$pseudo="";
		$mdp="";
		$mdp_verif="";
		$mail="";
		$mail_verif="";
		$equipe="";
		$acronyme="";

		unset($_SESSION['poste']);
		$bdd->close();

		$_SESSION['inscription'] = $codeErreur;		

		header("Location: ../inscription.php");
		exit;
	}

	if($_POST['nom'] && $_POST['prenom'] && $_POST['pseudo'] && $_POST['mdp'] && $_POST['mdp_verif'] && $_POST['mail'] && $_POST['mail_verif'])
	{
		$nom=htmlspecialchars(addslashes($_POST['nom']));
		$prenom=htmlspecialchars(addslashes($_POST['prenom']));
		$pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
		$mdp=sha1(htmlspecialchars(addslashes($_POST['mdp'])));
		$mdp_verif=sha1(htmlspecialchars(addslashes($_POST['mdp_verif'])));
		$mail=htmlspecialchars(addslashes($_POST['mail']));
		$mail_verif=htmlspecialchars(addslashes($_POST['mail_verif']));
		$jeu=htmlspecialchars(addslashes($_POST['jeu']));
	}
	else
	{
		$_SESSION['formulaire']=1;
		header("Location: ../inscription.php");
		exit;
	}

	if($_SESSION['poste']=="capitaine")
	{
		if($_POST['equipe'] && $_POST['acronyme'])
		{
			$equipe=htmlspecialchars(addslashes($_POST['equipe']));
			$acronyme=htmlspecialchars(addslashes($_POST['acronyme']));
		}
		else
		{
			$_SESSION['formulaire']=1;
			header("Location: ../inscription.php");
			exit;
		}

		$bdd=connexionBDD();
		$requete=existeJoueur($bdd,$nom,$prenom,$pseudo);

		$existe=$requete->num_rows;

		if($existe != 0)
		{
			Error($bdd,"existe");
		}

		$requete=$bdd->query("SELECT `cpt_pseudo` FROM `t_compte_cpt` WHERE `cpt_mail` = \"$mail\"");
		$existe=$requete->num_rows;

		if($existe != 0)
		{
			Error($bdd,"email");
		}
		else
		{
			if(strcmp($mail, $mail_verif) == 0)
			{
				if(strcmp($mdp, $mdp_verif) == 0)
				{
					$ajout=ajoutEquipe($bdd,$equipe,$acronyme,$jeu);
					if($ajout == 0)
					{
						if($_POST['tel']) $tel=htmlspecialchars(addslashes($_POST['tel']));
						else $tel=NULL;

						$cpt=1;

						$ajout=ajoutJoueur($bdd,$pseudo,$mdp,$mail,$equipe,$nom,$prenom,$tel,$cpt);
						if($ajout == 0)
						{
							$idJoueurResult=$bdd->query("SELECT `jou_id` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `cpt_pseudo` = \"$pseudo\";");
							while ($row = $idJoueurResult->fetch_assoc()) 
							{
								$idJoueur = $row["jou_id"];
							}
							$idJoueurResult->free();

							$ajout=ajoutPizza($bdd,$idJoueur,$_POST['pizza_VM1'],$_POST['pizza_VM2'],$_POST['pizza_VM3'],$_POST['pizza_VS1'],$_POST['pizza_VS2'],$_POST['pizza_VS3'],$_POST['pizza_SM1'],$_POST['pizza_SM2'],$_POST['pizza_SM3']);
							if($ajout == 0)
							{
								//$_SESSION['mail_inscription'];
								//include("./config.mail.php");
								//unset($_SESSION['mail_inscription']);
								$_SESSION['pseudo']=$pseudo;

								$nom="";
								$prenom="";
								$pseudo="";
								$mdp="";
								$mdp_verif="";
								$mail="";
								$mail_verif="";
								$tel="";
								$equipe="";
								$acronyme="";

								unset($_SESSION['poste']);
								$_SESSION['inscription']="ok";
								$bdd->close();

								header("Location: ../index.php");
								exit;
							}
							else
							{
								suppressionJoueur($bdd,$pseudo);
								Error($bdd,"erreur1");
							}		
						}
						else
						{
							$idEquipeResult=$bdd->query("SELECT `equ_id` FROM `t_equipe_equ` WHERE `equ_nom` = \"$equipe\";");
							while ($row = $idEquipeResult->fetch_assoc()) 
							{
								$idEquipe = $row["equ_id"];
							}
							$idEquipeResult->free();

							suppressionEquipe($bdd,$idEquipe);
							Error($bdd,"erreur2");
						}
					}
					elseif($ajout == 2)
					{
						Error($bdd,"equipe");
					}
					else
					{
						Error($bdd,"erreur3");
					}	
				}
				else
				{
					Error($bdd,"mdp");
				}
			}
			else
			{
				Error($bdd,"email");
			}
		}
	}
	else 		//inscription joueur
	{
		$bdd=connexionBDD();
		$requete=existeJoueur($bdd,$nom,$prenom,$pseudo);

		$existe=$requete->num_rows;

		if($existe != 0)
		{
			Error($bdd,"existe");
		}

		$requete=$bdd->query("SELECT `cpt_pseudo` FROM `t_compte_cpt` WHERE `cpt_mail` = \"$mail\"");
		$existe=$requete->num_rows;

		if($existe != 0)
		{
			Error($bdd,"email");
		}
		else
		{
			if(strcmp($mail, $mail_verif) == 0)
			{
				if(strcmp($mdp, $mdp_verif) == 0)
				{
					if($_POST['tel']) $tel=htmlspecialchars(addslashes($_POST['tel']));
					else $tel=NULL;

					$equipe=htmlspecialchars(addslashes($_POST['equipe']));

					$joueur=0;

					$ajout=ajoutJoueur($bdd,$pseudo,$mdp,$mail,$equipe,$nom,$prenom,$tel,$joueur);
					if($ajout == 0)
					{
						$idJoueurResult=$bdd->query("SELECT `jou_id` FROM `t_joueur_jou` NATURAL JOIN `t_compte_cpt` WHERE `cpt_pseudo` = \"$pseudo\";");
						while ($row = $idJoueurResult->fetch_assoc()) 
						{
							$idJoueur = $row["jou_id"];
						}
						$idJoueurResult->free();

						$ajout=ajoutPizza($bdd,$idJoueur,$_POST['pizza_VM1'],$_POST['pizza_VM2'],$_POST['pizza_VM3'],$_POST['pizza_VS1'],$_POST['pizza_VS2'],$_POST['pizza_VS3'],$_POST['pizza_SM1'],$_POST['pizza_SM2'],$_POST['pizza_SM3']);
						if($ajout == 0)
						{
							//$_SESSION['mail_inscription'];
							//include("./config.mail.php");
							//unset($_SESSION['mail_inscription']);
							$_SESSION['pseudo']=$pseudo;

							$nom="";
							$prenom="";
							$pseudo="";
							$mdp="";
							$mdp_verif="";
							$mail="";
							$mail_verif="";
							$tel="";
							$equipe="";
							$acronyme="";

							unset($_SESSION['poste']);
							$_SESSION['inscription']="ok";
							$bdd->close();

							header("Location: ../index.php");
							exit;
						}
						else
						{
							suppressionJoueur($bdd,$pseudo);
							Error($bdd,"erreur1");
						}
					}
					else
					{
						Error($bdd,"erreur2");
					}
				}
				else
				{
					Error($bdd,"mdp");
				}
			}
			else
			{
				Error($bdd,"email");
			}
		}
	}

?>