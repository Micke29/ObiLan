<?php
	session_start();

	include("../config/config.requeteSQL.php");

	affichageErreur();

	if(!isset($_SESSION['admin']))
	{
		header("Location: ./");
		exit();
	}

	if($_POST['nom'] && $_POST['nom'] != "snake")
	{
		$bdd=connexionBDD();
		$comptePizza=verifPizzaAdmin($bdd,$_POST['nom']);
		$verifPizza=$comptePizza->num_rows;

		if($verifPizza != 0)
		{
			$total=0.00;

			while($resultatComptePizza=$comptePizza->fetch_assoc())
			{
				if($resultatComptePizza['piz_date']=="VS1") $pizzaVS1=$resultatComptePizza['piz_nom'];
				if($resultatComptePizza['piz_date']=="VS2") $pizzaVS2=$resultatComptePizza['piz_nom'];
				if($resultatComptePizza['piz_date']=="SM1") $pizzaSM1=$resultatComptePizza['piz_nom'];

				$total=$total+$resultatComptePizza['piz_prix'];
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vérification pizza</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="icon/png" href="../images/icone.png" />
	<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
</head>
<body>
	<div class="header">
		<a href="../"><img src="../images/logo.png" class="logo"/></a>
		<ul style="float:right;">
			<li><a href="./accueil.php">Accueil</a></li>
			<li><a href="./logout.php">Déconnexion</a></li>
		</ul>
	</div>

	<div class="verif">
		<form method="post">
			<table>
				<tr>
					<td><label>Nom</label></td>
					<td><input type="search" name="nom" placeholder="nom" title="nom à vérifier" required="required"></td>
				</tr>
			</table>

			<div class="submit">
				<input type="submit" value="Valider">
			</div>
		</form>
	</div>

	<?php
	if($_POST["nom"])
	{
		if($_POST['nom'] == "snake")
		{
			echo '<div class="verif">';
			include("./game/snake.html");
			echo '</div>';
		}
		elseif($verifPizza != 0)
		{
			?>
			<div id="result">
				<h2>Pizza :</h2>
				<h3>Vendredi Soir :</h3>
					<?php
					if($pizzaVS1 != "") echo $pizzaVS1.'<br>'; 
					if($pizzaVS2 != "") echo $pizzaVS2.'<br>'; 
					?>

				<h2>Total (sans l'inscription) :</h2>
				<p>&euro; <?php echo $total ?></p>
			</div>
			<?php
		}
		else
		{
			?>
			<div id="result">
					<h1>AUCUN RESULTAT</h1>
			</div>
			<?php
		}		
	}
	?>

</body>
</html>