<?php
	include("./config/config.requeteSQL.php");

	affichageErreur();
	session_start();

	$date1=date("d.m.Y");
	$date2="31.08.2018";
	if(strtotime($date1)<strtotime($date2))
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
 				console.log("erreur = NORVEGIENNE");
 				window.alert("Une erreur est survenue");
 			</script>
 			<?php

 			unset($_SESSION['inscription']);
 		}
 		elseif($_SESSION['inscription'] == "erreur2")
 		{
 			?>
 			<script type="text/javascript">
 				console.log("erreur = création joueur");
 				window.alert("Une erreur est survenue");
 			</script>
 			<?php

 			unset($_SESSION['inscription']);
 		}
		elseif($_SESSION['inscription'] == "erreur3")
 		{
 			?>
 			<script type="text/javascript">
 				console.log("erreur = création équipe");
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		?>
		<br/>
		<br/>
		
		<?php
			if(!isset($_GET['poste']))
			{	
				echo('<a href="./inscription.php?poste='.crypt('capitaine','cp').'">Je suis capitaine</a><br>');
				echo('<a href="./inscription.php?poste='.crypt('joueur','jo').'">Je suis joueur</a>');		
			}
			else
			{
				$bdd=connexionBDD();
				$jeux=jeux($bdd);
				$pizza1=pizza($bdd);
				$pizza2=pizza($bdd);
				$pizza3=pizza($bdd);
				$pizza4=pizza($bdd);
				$pizza5=pizza($bdd);
				$pizza6=pizza($bdd);
				$pizza7=pizza($bdd);
				$pizza8=pizza($bdd);
				$pizza9=pizza($bdd);

				if($_GET['poste']==crypt('capitaine','cp'))
				{
					?>
						<center>
							<p>Inscription Capitaine</p>
							<form method="post" action="./config/config.ajout.php">
								<label>Nom :</label><input type="text" name="nom" placeholder="nom" title="votre nom" required="required" /><br />
								<label>Prénom :</label><input type="text" name="prenom" placeholder="prenom" title="votre prénom" required="required" /><br />
								<label>Pseudo :</label><input type="text" name="pseudo" placeholder="pseudo" title="votre pseudo" required="required" /><br />
								<label>Mot de passe :</label><input type="password" name="mdp" placeholder="mot de passe" title="votre mot de passe" required="required" /><br />
								<label>Vérifcation mot de passe :</label><input type="password" name="mdp_verif" placeholder="mot de passe" title="votre mot de passe" required="required" /><br />
								<label>Mail :</label><input type="email" name="mail" placeholder="mail" title="votre mail" required="required" /><br />
								<label>Vérification mail :</label><input type="email" name="mail_verif" placeholder="mail" title="votre mail" required="required" /><br />
								<label>Téléphone :</label><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" placeholder="0601020304" title="votre numéro de téléphone" required="required" /><br /><br />
								<label>Choisissez votre jeu :</label>
									<select name="jeu">
									<?php
										while($resultatJeux = $jeux->fetch_assoc())
										{
											echo '<option value="'.$resultatJeux['jeu_id'].'">'.$resultatJeux['jeu_nom'].'</option>';
										}
										$jeux->free();
									?>
									</select><br />

								<label>Créez votre équipe :</label><input type="text" name="equipe" placeholder="equipe" title="le nom de votre équipe" required="required" /><br />
								<label>L'acronyme de votre équipe :</label><input type="text" name="acronyme" placeholder="acronyme" title="l'acronyme de votre équipe" required="required" /><br /><br />

								<label>Choisissez vos pizza (optionnel)</label><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza1->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza1->free();
									?>
									</select><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza2->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza2->free();
									?>
									</select><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza3->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza3->free();
									?>
									</select><br />

								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza4->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza4->free();
									?>
									</select><br />
								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza5->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza5->free();
									?>
									</select><br />
								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza6->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza6->free();
									?>
									</select><br />

								<label>Pour le samedi :</label>
									<select name="pizza_SM1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza7->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza7->free();
									?>
									</select><br />
								<label>Pour le samedi :</label>
									<select name="pizza_SM2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza8->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza8->free();
									?>
									</select><br />
								<label>Pour le samedi :</label>
									<select name="pizza_SM3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza9->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza9->free();
									?>
									</select><br /><br>

								<?php $_SESSION['poste']="capitaine"; ?>

								<label><input type="submit" value="Valider"></label><br />
							</form>
						</center>
					<?php
				}
				elseif($_GET['poste']==crypt('joueur','jo'))
				{
					$equipes=equipes($bdd);
					?>
						<center>
							<p>Inscription Joueur</p>
							<form method="post" action="./config/config.ajout.php">
								<label>Nom :</label><input type="text" name="nom" placeholder="nom" title="votre nom" required="required" /><br />
								<label>Prénom :</label><input type="text" name="prenom" placeholder="prenom" title="votre prénom" required="required" /><br />
								<label>Pseudo :</label><input type="text" name="pseudo" placeholder="pseudo" title="votre pseudo" required="required" /><br />
								<label>Mot de passe :</label><input type="password" name="mdp" placeholder="mot de passe" title="votre mot de passe" required="required" /><br />
								<label>Vérifcation mot de passe :</label><input type="password" name="mdp_verif" placeholder="mot de passe" title="votre mot de passe" required="required" /><br />
								<label>Mail :</label><input type="email" name="mail" placeholder="mail" title="votre mail" required="required" /><br />
								<label>Vérification mail :</label><input type="email" name="mail_verif" placeholder="mail" title="votre mail" required="required" /><br />
								<label>Téléphone :</label><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" placeholder="0601020304" title="votre numéro de téléphone" required="required" /><br /><br />
								<label>Choisissez votre jeu :</label>
									<select id="jeu" name="jeu" content-type="choices" trigger="true" target="equipe">
									<?php
										while($resultatJeux = $jeux->fetch_assoc())
										{
											echo '<option value="'.$resultatJeux['jeu_id'].'">'.$resultatJeux['jeu_nom'].'</option>';
										}
										$jeux->free();
									?>
									</select><br />

								<label>Choisissez votre équipe :</label>
									<select id="equipe" name="equipe">
									<?php
										while($resultatEquipes = $equipes->fetch_assoc())
										{
											//$id=$resultatEquipes['jeu_id'];
											//echo '<optgroup reference="'.$id.'">';
											//while($id == $resultatEquipes['jeu_id'])
											//{
												echo '<option value="'.$resultatEquipes['equ_id'].'">'.$resultatEquipes['equ_nom'].'</option>';
											//}
										}
										$equipes->free();
									?>
									</select><br /><br />

								<label>Choisissez vos pizza (optionnel)</label><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza1->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza1->free();
									?>
									</select><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza2->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza2->free();
									?>
									</select><br />
								<label>Pour le vendredi Midi :</label>
									<select name="pizza_VM3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza3->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza3->free();
									?>
									</select><br />

								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza4->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza4->free();
									?>
									</select><br />
								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza5->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza5->free();
									?>
									</select><br />
								<label>Pour le vendredi Soir :</label>
									<select name="pizza_VS3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza6->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza6->free();
									?>
									</select><br />

								<label>Pour le samedi :</label>
									<select name="pizza_SM1">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza7->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza7->free();
									?>
									</select><br />
								<label>Pour le samedi :</label>
									<select name="pizza_SM2">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza8->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza8->free();
									?>
									</select><br />
								<label>Pour le samedi :</label>
									<select name="pizza_SM3">
										<option value="NULL" selected></option>
									<?php
										while($resultatPizza = $pizza9->fetch_assoc())
										{
											echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										}
										$pizza9->free();
									?>
									</select><br /><br>

								<?php $_SESSION['poste']="joueur"; ?>

								<label><input type="submit" value="Valider"></label><br />
							</form>
						</center>

						<script type="text/javascript">
							/* 
							  * trigger="true" permet de dire que c'est l'élément le plus haut qui fait varier toutes les autres listes 
							  * target=[id_cible] permet de spécifier la liste qui doit varier au changement de la sélection 
							  * reference=[id_reference] est l'id de l'élément parent qui déclenche la mise à jour de la liste 
							*/ 
							  
							//Fonction qui s'occupe de la mise à jour des listes 
							function updateSelectBox(object){ 
							    // Object correspond au input qui déclenche l'action (jeu dans notre cas) 
							    // On récupère le select (equipe) qui doit être mise à jour suite au changement du parent (jeu) 
							    var target = $("#"+object.attr('target')); 
							  
							    // On récupère tous les optgroup du select cible spécifié avec target (les optgroup du select equipe) 
							    var listGroups = target.find("optgroup"); 
							  
							    // On récupère le optgroup qui correspond à la valeur courante du select parent (jeu) 
							    var validGroup = target.find("optgroup[reference='"+object.find(':selected').val()+"']"); 
							  
							    //On modifie la valeur courante du select cible (equipe) 
							    target.val(validGroup.find("option").val()); 
							  
							    //On cache tous les optgroup de equipe 
							    listGroups.hide(); 
							  
							    //On affiche uniquement le optgroup de equipe qui correspond à la valeur courante de jeu 
							    validGroup.show(); 
							  
							    //On vérifie si la cible (equipe) doit déclencher une mise à jour d'une autre liste 
							    if(target.attr('content-type')=='choices') 
							        target.change(); 
							} 
							  
							//On associe la fonction updateSelectBox à l'événement onchange des listes qui doivent déclencher des mises à jour d'autres listes 
							$("select[content-type='choices']").on('change',function(){ 
							    updateSelectBox($(this)); 
							}); 
							  
							//On fait la première mise à jour des 
							$(document).ready(function(){ 
							    updateSelectBox($("select[trigger='true']")); 
							});
						</script>
					<?php
				}
				else header("Location: ./");
			$bdd->close();
			}
		?>
		
	</body>

</html>