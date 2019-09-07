<?php
	session_start();

	include("./config/config.requeteSQL.php");
	affichageErreur();

	if(!isset($_SESSION['pseudo']))
	{
		header("Location: connexion.php");
		exit();
	}

	if(isset($_SESSION['formulaire']))
	{
		echo '<script type="text/javascript">window.alert("Merci de remplir le formulaire");</script>';

 		unset($_SESSION['formulaire']);
	}

	if(isset($_SESSION['modif']))
	{
		if($_SESSION['modif']=="mdp")
		{
			echo '<script type="text/javascript">window.alert("Les 2 mots de passe sont différents");</script>';

 			unset($_SESSION['modif']);
		}

		if($_SESSION['modif']=="ok")
		{
			echo '<script type="text/javascript">window.alert("Modifiaction(s) effectuée(s) avec succès");</script>';

 			unset($_SESSION['modif']);
		}
	}

	$bdd=connexionBDD();
	$compteInfo=compteInfo($bdd,$_SESSION['pseudo']);
	$comptePizza=comptePizza($bdd,$_SESSION['pseudo']);
	$total=0.00;

	while($resultatCompteInfo=$compteInfo->fetch_assoc())
	{
		$id=$resultatCompteInfo['jou_id'];
		$email=$resultatCompteInfo['cpt_mail'];
		$equipe=$resultatCompteInfo['equ_nom'];
		$telephone=$resultatCompteInfo['jou_telephone'];

		while($resultatComptePizza=$comptePizza->fetch_assoc())
		{
			if($resultatComptePizza['piz_date']=="VS1") $pizzaVS1=$resultatComptePizza['piz_nom'];
			if($resultatComptePizza['piz_date']=="VS2") $pizzaVS2=$resultatComptePizza['piz_nom'];

			$total=$total+$resultatComptePizza['piz_prix'];
		}
	}

	if(isset($_GET['modif']))
	{
		if($_GET['modif']=="compte" || $_GET['modif']=="pizza" || $_GET['modif']=="mdp")
		{
			$_SESSION['id']=$id;
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Compte</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="icon/png" href="images/icone.png">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<script type="text/javascript">
		function supprimerEquipe(){
			var r = confirm("Voulez-vous supprimer l'équipe ?");
			if (r == true){
				document.location.href="./config/config.supprimer.php?equ";
			}
		}
	</script>
</head>
<body>
	<?php
		include("./config/config.navbar.php");

		if(isset($_GET['modif']))
		{
			if($_GET['modif']=="pizza")
			{
				$pizza1=pizza($bdd);
				$pizza2=pizza($bdd);

				?>
				<br>
				<center>
					<form method="post" action="./config/config.modificationPizza.php">
						<label>Choisissez vos pizza</label><br><br>

					<table>
						<tr>
							<td>
								<label>Pour le vendredi Soir :</label>
							</td>
							<td>	
								<select name="pizza_VS1">
								<option value="NULL">Aucune</option>
							<?php
								while($resultatPizza = $pizza1->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza1->free();
							?>
							</select><br/>
						</td>
						</tr>
						<tr>
							<td>
								<label>Pour le vendredi Soir :</label>
							</td>
							<td>
								<select name="pizza_VS2">
									<option value="NULL">Aucune</option>
								<?php
									while($resultatPizza = $pizza2->fetch_assoc())
									{
										if($resultatPizza['piz_nom']==$pizzaVS2)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
										else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									}
									$pizza2->free();
								?>
								</select><br/>
							</td>
						</tr>
					</table>
					<br>
						<label class="submit"><input type="submit" value="Valider"></label><br />
					</form>
				</center>
				<?php
			}
			elseif($_GET['modif']=="compte")
			{
				?>

				<form method="post" action="config/config.modificationCompte.php">
				<br>
					<table>
						<tr>
							<td>
								<label>Equipe</label>
							</td>
							<td>
					<select name="equipe">
					<?php
						$limiteHS=limiteHS($bdd);
						$jeux=jeux($bdd);

						while($resultatJeux = $jeux->fetch_assoc())
						{
							if($resultatJeux['jeu_nom'] == "Hearthstone" && $limiteHS < 16 || $resultatJeux['jeu_nom'] != "Hearthstone")
							{
								echo '<optgroup label="'.$resultatJeux['jeu_nom'].'">';
								$equipes=equipes($bdd);

								while($resultatEquipes = $equipes->fetch_assoc())
								{
									if($resultatJeux['jeu_id'] == $resultatEquipes['jeu_id'])
									{
										if($resultatEquipes['equ_nom'] == $equipe) echo '<option value="'.$resultatEquipes['equ_id'].'" selected>'.$resultatEquipes['equ_nom'].'</option>';
										else echo '<option value="'.$resultatEquipes['equ_id'].'">'.$resultatEquipes['equ_nom'].'</option>';
									}
								}

								$equipes->free();
								echo '</optgroup>';
							}
						}
						$jeux->free();
					?>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<label>Email</label>
				</td>
				<td>	
					<?php echo '<input type="email" name="email" value="'.$email.'" required="required">'; ?>
				</td>
			</tr>
			<tr>
				<td>		
					<label>Téléphone</label>
				</td>
				<td>
					<?php echo '<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" placeholder="0601020304" value="'.$telephone.'" title="votre numéro de téléphone" required="required">'; ?>
				</td>
			</tr>
		</table>

				<div class="submit">
					<input type="submit" value="Valider">
				</div>
			</form>
				<?php
			}
			elseif($_GET['modif']=="mdp")
			{
				?>
				<form method="post" action="config/config.modificationMdp.php">
					<table>
						<tr>
							<td>
								<label>Nouveau Mot de Passe</label>
							</td>
							<td>
								<input type="password" name="mdp" title="Nouveau Mot de Passe">
							</td>
						</tr>
						<tr>
							<td>
								<label>Répétez votre Mot de Passe</label>
							</td>
							<td>	
								<input type="password" name="mdp_verif" title="Nouveau Mot de Passe">
							</td>
						</tr>
					</table>
				<div class="submit">
					<input type="submit" value="Valider">
				</div>
				</form>
				<?php
			}
			else
			{
				header("Location: compte.php");
				exit();
			}
		}
		else
		{
			?>
	<center>
		<h2>Info :</h2>
		<?php
			if(isset($_SESSION['poste']))
			{
				if($_SESSION['poste']=="capitaine")
				{
					?>
					<table id="compte">
						<thead>
							<tr>
								<th class="info">Pseudo</th>
								<th class="info">Date d'inscription</th>
								<th class="info" colspan="2">Action</th>
							</tr>
						</thead>
						
						<tbody>
					<?php
					$equipeCapitaine=equipeCapitaine($bdd,$_SESSION['pseudo']);
					while($donnees=$equipeCapitaine->fetch_assoc())
					{
					?>
						<tr>
							<td class="info"><?php echo $donnees['cpt_pseudo'] ?></td>
							<td class="info"><?php echo $donnees['cpt_date'] ?></td>
							<?php
							if($donnees['jou_capitaine']=="0")
							{
								?>
								<td><a href="./config/config.promotion.php?cpt=<?php echo $donnees['cpt_pseudo'] ?>" title="promouvoir capitaine"><i class="fas fa-edit"></i></a></td>
								<?php
							}
							if($donnees['cpt_pseudo'] != $_SESSION['pseudo'])
							{
								?>
									<td><a href="./config/config.supprimer.php?jou=<?php echo $donnees['cpt_pseudo'] ?>" title="exclure"><i class="fas fa-times-circle"></i></a></td>
								<?php
							}
							?>
						</tr>
					<?php
					}
					?>
						</tbody>
					</table>

					<div class="submit">
						<input type="submit" value="Supprimer Equipe" onclick="supprimerEquipe()">
					</div>
					<?php				
				}
			}
		?>
		<p>Equipe : <?php echo $equipe ?></p>
		<p>Email : <?php echo $email ?></p>
		<p>Téléphone : <?php echo $telephone ?></p>
		
		<a class="submit" href="./compte.php?modif=compte"><input type="submit" value="Modification Compte"></a>
		<a class="submit" href="./compte.php?modif=mdp"><input type="submit" value="Modification Mot de Passe"></a>
		<?php
			if(!isset($_SESSION['poste']))
			{
				?>
					<a class="submit" href="./config/config.supprimer.php?cpt=<?php echo $_SESSION['pseudo'] ?>"><input type="submit" value="Suppression Compte"></a>
				<?php
			}
		?>

		<h2>Pizza :</h2>
		<h3>Vendredi Soir :</h3>
			<?php
			if($pizzaVS1 != "") echo $pizzaVS1.'<br>'; 
			if($pizzaVS2 != "") echo $pizzaVS2.'<br>'; 
			?>

		<h2>Total (sans l'inscription) :</h2>
		<p>&euro; <?php echo $total ?></p>

		<a class="submit" href="./compte.php?modif=pizza"><input type="submit" value="Modification pizza" style="margin-bottom: 15px"></a>
	</center>
	<?php
		}
	?>
</body>
</html>