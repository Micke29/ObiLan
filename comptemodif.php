<?php
	session_start();

	include("./config/config.requeteSQL.php");
	affichageErreur();

	if(!isset($_SESSION['pseudo']))
	{
		header("Location: connexion.php");
		exit();
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
			if($resultatComptePizza['piz_date']=="SM1") $pizzaSM1=$resultatComptePizza['piz_nom'];

			$total=$total+$resultatComptePizza['piz_prix'];
		}
	}



	if(isset($_GET['modif']))
	{
		if($_GET['modif']=="compte" || $_GET['modif']=="pizza")
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
				$pizza3=pizza($bdd);

				?>
				<br>
				<center>
					<form method="post" action="./config/config.modificationPizza.php">
						<label>Choisissez vos pizza (optionnel)</label><br />

						<label>Pour le vendredi Soir :</label>
							<select name="pizza_VS1">
								<option value="NULL"></option>
							<?php
								while($resultatPizza = $pizza1->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza1->free();
							?>
							</select><br />
						<label>Pour le vendredi Soir :</label>
							<select name="pizza_VS2">
								<option value="NULL"></option>
							<?php
								while($resultatPizza = $pizza2->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS2)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza2->free();
							?>
							</select><br />

						<label>Pour le samedi :</label>
							<select name="pizza_SM1">
								<option value="NULL"></option>
							<?php
								while($resultatPizza = $pizza3->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaSM1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza3->free();
							?>
							</select><br><br>

						<label><input type="submit" value="Valider"></label><br />
					</form>
				</center>
				<?php
			}
			elseif($_GET['modif']=="compte")
			{
				$modifMailJoueur=modifMailJoueur($bdd,$pseudo);
				?><p>Equipe : <?php echo $equipe ?></p><?
				
				
				?><p>Email : <?php echo $email ?></p>
				<input type="text" name="email" placeholder="<? $mail ?>"
				
				?><p>Téléphone : <?php echo $telephone ?></p><?
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
					$equipeCapitaine=equipeCapitaine($bdd,$_SESSION['pseudo']);
					?>
					<table>
						<thead>
							<tr>
								<th>Pseudo</th>
								<th>Date d'inscription</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>

					<?php
					while($donnees=$equipeCapitaine->fetch_assoc())
					{
					?>
						<tbody>
							<td><?php echo $donnees['cpt_pseudo'] ?></td>
							<td><?php echo $donnees['cpt_date'] ?></td>
							<?php
							if($donnees['jou_capitaine']=="0")
							{
							echo "<td><a href=\"./config/config.promotion.php?cpt=".$donnees['cpt_pseudo']."><img src=\"./images/modifier.png\" height=\"25\" width=\"25\" title=\"promouvoir capitaine\"</a></td>";
							}
							?>
							<td><a href="./config/config.supprimer.php?cpt=<?php echo $donnees['cpt_pseudo']?>"><img src="./images/supprimer.ico" height="25" width="25" title="supprimer"</a></td>
						</tbody>
					<?php
					}
					?>
					</table>
					<?php
				}
			}
		?>
		<p>Equipe : <?php echo $equipe ?></p>
		<p>Email : <?php echo $email ?></p>
		<p>Téléphone : <?php echo $telephone ?></p>
		
		<a class="button" href="./compte.php?modif=compte"><input type="submit" value="Modification compte"></a>

		<h2>Pizza :</h2>
		<h3>Vendredi Soir :</h3>
			<?php
			if($pizzaVS1 != "") echo $pizzaVS1.'<br>'; 
			if($pizzaVS2 != "") echo $pizzaVS2.'<br>'; 
			?>
		<h3>Samedi Midi :</h3>
			<?php
			if($pizzaSM1 != "") echo $pizzaSM1.'<br>';
			?>

		<h2>Total (sans l'inscription) :</h2>
		<p>&euro; <?php echo $total ?></p>

		<a class="button" href="./compte.php?modif=pizza"><input type="submit" value="Modification pizza"></a>
	</center>
	<?php
		}
	?>
</body>
</html>