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
	$compte=compte($bdd,$_SESSION['pseudo']);
	$total=0;

	while($resultatCompte=$compte->fetch_assoc())
	{
		$id=$resultatCompte['jou_id'];
		$email=$resultatCompte['cpt_mail'];
		$equipe=$resultatCompte['equ_nom'];
		$telephone=$resultatCompte['jou_telephone'];

		if($resultatCompte['piz_date']=="VM1") $pizzaVM1=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="VM2") $pizzaVM2=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="VM3") $pizzaVM3=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="VS1") $pizzaVS1=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="VS2") $pizzaVS2=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="VS3") $pizzaVS3=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="SM1") $pizzaSM1=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="SM2") $pizzaSM2=$resultatCompte['piz_nom'];
		if($resultatCompte['piz_date']=="SM3") $pizzaSM3=$resultatCompte['piz_nom'];

		$total=$total+$resultatCompte['piz_prix'];
	}



	if(isset($_GET['modif']))
	{
		if($_GET['modif']=="oui")
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
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<?php
		include("./config/config.navbar.php");

		if(isset($_GET['modif']))
		{
			if($_GET['modif']=="oui")
			{
				$pizza1=pizza($bdd);
				$pizza2=pizza($bdd);
				$pizza3=pizza($bdd);
				$pizza4=pizza($bdd);
				$pizza5=pizza($bdd);
				$pizza6=pizza($bdd);
				$pizza7=pizza($bdd);
				$pizza8=pizza($bdd);
				$pizza9=pizza($bdd);
				?>
				<br>
				<center>
					<form method="post" action="./config/config.modificationPizza.php">
						<label>Choisissez vos pizza (optionnel)</label><br />
						<label>Pour le vendredi Midi :</label>
							<select name="pizza_VM1">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza1->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVM1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza1->free();
							?>
							</select><br />
						<label>Pour le vendredi Midi :</label>
							<select name="pizza_VM2">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza2->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVM2)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza2->free();
							?>
							</select><br />
						<label>Pour le vendredi Midi :</label>
							<select name="pizza_VM3">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza3->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVM3)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza3->free();
							?>
							</select><br />

						<label>Pour le vendredi Soir :</label>
							<select name="pizza_VS1">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza4->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza4->free();
							?>
							</select><br />
						<label>Pour le vendredi Soir :</label>
							<select name="pizza_VS2">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza5->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS2)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza5->free();
							?>
							</select><br />
						<label>Pour le vendredi Soir :</label>
							<select name="pizza_VS3">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza6->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaVS3)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza6->free();
							?>
							</select><br />

						<label>Pour le samedi :</label>
							<select name="pizza_SM1">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza7->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaSM1)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza7->free();
							?>
							</select><br>
						<label>Pour le samedi :</label>
							<select name="pizza_SM2">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza8->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaSM2)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza8->free();
							?>
							</select><br>
						<label>Pour le samedi :</label>
							<select name="pizza_SM3">
								<option value=""""></option>
							<?php
								while($resultatPizza = $pizza9->fetch_assoc())
								{
									if($resultatPizza['piz_nom']==$pizzaSM3)	echo '<option value="'.$resultatPizza['piz_id'].'" selected>'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
									else echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
								}
								$pizza9->free();
							?>
							</select><br><br>

						<label><input type="submit" value="Valider"></label><br />
					</form>
				</center>
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
		<p>Equipe : <?php echo $equipe ?></p>
		<p>Email : <?php echo $email ?></p>
		<p>Téléphone : <?php echo $telephone ?></p>

		<h2>Pizza :</h2>
		<h3>Vendredi Midi :</h3>
			<?php 
			if($pizzaVM1 != "") echo $pizzaVM1.'<br>';
			if($pizzaVM2 != "") echo $pizzaVM2.'<br>'; 
			if($pizzaVM3 != "") echo $pizzaVM3.'<br>';
			?>
		<h3>Vendredi Soir :</h3>
			<?php
			if($pizzaVS1 != "") echo $pizzaVS1.'<br>'; 
			if($pizzaVS2 != "") echo $pizzaVS2.'<br>'; 
			if($pizzaVS3 != "") echo $pizzaVS3.'<br>';
			?>
		<h3>Samedi Midi :</h3>
			<?php
			if($pizzaSM1 != "") echo $pizzaSM1.'<br>';
			if($pizzaSM2 != "") echo $pizzaSM2.'<br>';
			if($pizzaSM3 != "") echo $pizzaSM3.'<br>';
			?>

		<h2>Total (pizza + inscription) :</h2>
		<p>&euro; <?php echo $total+5.00 ?></p>

		<a class="button" href="./compte.php?modif=oui"><input type="submit" value="Modification pizza"></a>
	</center>
	<?php
		}
	?>
</body>
</html>