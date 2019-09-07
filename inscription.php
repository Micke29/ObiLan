<?php
	include("./config/config.requeteSQL.php");

	affichageErreur();
	session_start();

	date_default_timezone_set('Europe/Paris');
	$current_date=date("d.m.Y");
	$current_hour=date("H:i");
	$open_date="16.09.2018";
	$close_date="12.10.2018";
	$close_hour="12:00";
	if(strtotime($current_date) < strtotime($open_date) && strtotime($current_date) > strtotime($close_date) || 
		strtotime($current_date) == strtotime($close_date) && strtotime($current_hour) >= strtotime($close_hour))
	{
		header("Location: ./");
		exit();
	}

	if(isset($_SESSION['formulaire']))
	{
		echo '<script type="text/javascript">window.alert("Merci de remplir le formulaire");</script>';

 		unset($_SESSION['formulaire']);
	}

	if(isset($_SESSION['inscription']))
 	{
 		if($_SESSION['inscription'] == "existe")
 		{
 			echo '<script type="text/javascript">window.alert("Ce joueur existe déjà");</script>';

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "email")
 		{
 			echo '<script type="text/javascript">window.alert("Cet email existe déjà ou n\'est pas bon");</script>';

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "mdp")
 		{
 			echo '<script type="text/javascript">window.alert("Erreur avec le mot de passe");</script>';

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "equipe")
 		{
 			echo '<script type="text/javascript">window.alert("L\'équipe ou l\'acronyme existe déjà");</script>';

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "erreur1")
 		{
 			?>
 			<script type="text/javascript">
 				console.error("erreur = NORVEGIENNE");
 				window.alert("Une erreur est survenue");
 			</script>
 			<?php

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "erreur2")
 		{
 			?>
 			<script type="text/javascript">
 				console.error("erreur = création joueur");
 				window.alert("Une erreur est survenue");
 			</script>
 			<?php

 			unset($_SESSION['inscription']);
 		}
		elseif($_SESSION['inscription'] == "erreur3")
 		{
 			?>
 			<script type="text/javascript">
 				console.error("erreur = création équipe");
 				window.alert("Une erreur est survenue");
 			</script>
 			<?php

 			unset($_SESSION['inscription']);
 		}
 	}
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Inscription</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="icon/png" href="images/icone.png">
		<link rel="stylesheet" type="text/css" href="./css/style.css">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		
			if(!isset($_GET['poste']))
			{	
				?>
				<div class="cont-conteneur">
					<div class="conteneur">
						<p>
							<i class="fas fa-exclamation-triangle"></i>
							Inscription possible jusqu'au 12/10
							<i class="fas fa-exclamation-triangle"></i>
						</p>
						<br>
						<p>
							Vous êtes :
						</p>
						<br>
					<?php
					echo '<div class="captain"><a href="./inscription.php?poste='.crypt('capitaine','cp').'">Je suis capitaine</a></div>';
					echo '<div class="player"><a href="./inscription.php?poste='.crypt('joueur','jo').'">Je suis joueur</a></div>';
					echo '</div></div>';
			}
			elseif($_GET['poste']==crypt('capitaine','cp') || $_GET['poste']==crypt('joueur','jo'))
			{
				$bdd=connexionBDD();
				$jeux1=jeux($bdd);
				$jeux2=jeux($bdd);
				$pizza1=pizza($bdd);
				$pizza2=pizza($bdd);

				if($_GET['poste']==crypt('capitaine','cp'))
				{
					?>
					<p><h3>Inscription Capitaine</h3></p>
					<?php
				}
				elseif($_GET['poste']==crypt('joueur','jo'))
				{
					?>
					<p><h3>Inscription Joueur</h3></p>
					<?php
				}
				?>
					<div class="inscription">

						<form method="post" action="./config/config.ajout.php">
							<table>
								<tr>
									<td><label>Nom</label></td>
									<td><input type="text" name="nom" placeholder="nom" title="votre nom" required="required" /></td>
								</tr>
								<tr>
									<td><label>Prénom</label></td>
									<td><input type="text" name="prenom" placeholder="prenom" title="votre prénom" required="required" /></td>
								</tr>
								<tr>
									<td><label>Pseudo</label></td>
									<td><input type="text" name="pseudo" placeholder="pseudo" title="votre pseudo" required="required" /></td>
								</tr>
								<tr>
									<td><label>Mot de passe</label></td>
									<td><input type="password" name="mdp" placeholder="mot de passe" title="votre mot de passe" required="required" /></td>
								</tr>
								<tr>
									<td><label>Vérifcation mot de passe</label></td>
									<td><input type="password" name="mdp_verif" placeholder="mot de passe" title="votre mot de passe" required="required" /></td>
								</tr>
								<tr>
									<td><label>Mail</label></td>
									<td><input type="email" name="mail" placeholder="mail" title="votre mail" required="required" /></td>
								</tr>
								<tr>
									<td><label>Vérification mail</label></td>
									<td><input type="email" name="mail_verif" placeholder="mail" title="votre mail" required="required" /></td>
								</tr>
								<tr>
									<td><label>Téléphone</label></td>
									<td><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" placeholder="0601020304" title="votre numéro de téléphone" required="required" /></td>
								</tr>
							</table>
					</div>

					<div class="inscription-jeu">
							<table>
							<?php
							if($_GET['poste']==crypt('capitaine','cp'))
							{
								?>
								<tr>
									<td><label>Choisissez votre jeu</label></td>
									<td><select name="jeu">
									<?php
										$limiteLOL=limiteLOL($bdd);
										$limiteCS=limiteCS($bdd);

										while($resultatJeux = $jeux1->fetch_assoc())
										{
											if($resultatJeux['jeu_nom'] != "Hearthstone") 
											{
												if($resultatJeux['jeu_nom'] == "League of Legends" && $limiteLOL < 16 || $resultatJeux['jeu_nom'] == "Counter-Strike" && $limiteCS < 8) echo '<option value="'.$resultatJeux['jeu_id'].'">'.$resultatJeux['jeu_nom'].'</option>';
											}
										}
										$jeux1->free();
									?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label>Créez votre équipe</label></td>
									<td><input type="text" name="equipe" placeholder="equipe" title="le nom de votre équipe" required="required" /></td>
								</tr>
								<tr>
									<td><label>L'acronyme de votre équipe</label></td>
									<td><input type="text" name="acronyme" placeholder="acronyme" title="l'acronyme de votre équipe" required="required" /></td>
								</tr>
								<?php
							}
							elseif($_GET['poste']==crypt('joueur','jo'))
							{
								?>
								<tr>
									<td><label>Choisissez votre équipe</label></td>
									<td><select name="equipe">
									<?php
										$limiteHS=limiteHS($bdd);

										while($resultatJeux = $jeux2->fetch_assoc())
										{
											if($resultatJeux['jeu_nom'] == "Hearthstone" && $limiteHS < 16 || $resultatJeux['jeu_nom'] != "Hearthstone")
											{
												echo '<optgroup label="'.$resultatJeux['jeu_nom'].'">';
												$equipes=equipes($bdd);

												while($resultatEquipes = $equipes->fetch_assoc())
												{
													if($resultatJeux['jeu_id'] == $resultatEquipes['jeu_id'])
													{
														echo '<option value="'.$resultatEquipes['equ_id'].'">'.$resultatEquipes['equ_nom'].'</option>';
													}
												}

												$equipes->free();
												echo '</optgroup>';
											}
										}
										$jeux2->free();
									?>
									</select>
									</td>
								</tr>
								<?php
							}
							?>
							</table>			
					</div>

					<div class="inscription-pizza">		
							<label><h4>Choisissez vos pizza (optionnel)</h4></label>
							<label><h4>Bientôt de retour, promis</h4></label>
							<table>	
								<tr>
									<td><label>Pour le vendredi Soir</label></td>
									<td><select name="pizza_VS1">
											<option value="NULL" selected>Aucune</option>
											<?php
												while($resultatPizza = $pizza1->fetch_assoc())
												{
													echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
												}
												$pizza1->free();
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td><label>Une deuxième ?</label></td>
									<td><select name="pizza_VS2">
											<option value="NULL" selected>Aucune</option>
											<?php
												while($resultatPizza = $pizza2->fetch_assoc())
												{
													echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
												}
												$pizza2->free();
											?>
										</select>
									</td>
								</tr>
							</table>
					</div>

						<?php
							if($_GET['poste']==crypt('capitaine','cp'))
							{
								$_SESSION['poste']="capitaine";
							}
							elseif($_GET['poste']==crypt('joueur','jo'))
							{
								$_SESSION['poste']="joueur";
							}							 
						?>
							<div class="submit">
								<input type="submit" value="Valider">
							</div>
						</form>
					<?php
			}
			else header("Location: ./");
			$bdd->close();
		
			include("./config/config.footer.php");
		?>		
	</body>

</html>