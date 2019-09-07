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

<!-- ------------------------------------------------------------------- -->
<!-- -------------------- CHOIX CAPITAINE OU JOUEUR -------------------- -->

<!DOCTYPE HTML>
<html>

<head>
	<title>Inscription</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="icon/png" href="images/icone.png">
	<link rel="stylesheet" type="text/css" href="./css/style_inscription.css">		
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body >
<?php
	include("./config/config.navbar.php");
	if(!isset($_GET['poste'])) {	
?>

<br><h5><p class="text-center text-light"><i class="fas fa-exclamation-triangle mx-auto"></i> Inscription possible jusqu'au 12/10 <i class="fas fa-exclamation-triangle"></i></p></h5><br>
<p class="text-center text-light"> Vous êtes : </p>

<?php
	echo '<div class="row">';
	echo '<a class="btn btn-danger btn-lg col-md-3 offset-md-2" href="./inscription.php?poste='.crypt('capitaine','cp').'" role="button">Je suis capitaine</a>';
	echo '<a class="btn btn-danger btn-lg col-md-3 offset-md-2" href="./inscription.php?poste='.crypt('joueur','jo').'" role="button">Je suis joueur</a>';
	echo '</div>';
	}
			
	elseif($_GET['poste']==crypt('capitaine','cp') || $_GET['poste']==crypt('joueur','jo')) {
		$bdd=connexionBDD();
		$jeux1=jeux($bdd);
		$jeux2=jeux($bdd);
		$pizza1=pizza($bdd);
		$pizza2=pizza($bdd);
		if($_GET['poste']==crypt('capitaine','cp')) {
?>


<!-- --------------------------------------------------------------------------- -->
<!-- -------------------- INSCRIPTION CAPITAINES ET JOUEURS -------------------- -->
<div>
	<h4><p class="text-light offset-4">Inscription Capitaine</p></h4><br>
	<?php
		}
		elseif($_GET['poste']==crypt('joueur','jo')) {
	?>

	<h4><p class="text-light offset-4">Inscription Joueur</p></h4><br>
	<?php
		}
	?>

<div class="inscription">
	<form class="offset-4" method="post" action="./config/config.ajout.php">

	<div class="form-group">
		<label>Votre nom</label>
		<input type="text" name="nom" class="form-control col-md-4" placeholder="Dupont" required="required">
	</div>

	<div class="form-group">
		<label>Votre prénom</label>
		<input type="text" name="prenom" class="form-control col-md-4" placeholder="Roger" required="required">
	</div>

	<div class="form-group">
		<label>Pseudo</label>
		<input type="text" name="pseudo" class="form-control col-md-4" placeholder="XxDarkSasukeDuBledxX" required="required">
	</div>

	<div class="form-group">
		<label>Mot de passe</label>
		<input type="password" name="mdp" class="form-control col-md-4" placeholder="mot de passe" required="required">
	</div>

	<div class="form-group">
		<label>Vérification mot de passe</label>
		<input type="password" name="mdp_verif" class="form-control col-md-4" placeholder="mot de passe" title="votre mot de passe" required="required">
	</div><br><br>

	<div class="form-group">
		<label>Mail</label>
		<input type="email" name="mail" class="form-control col-md-4" placeholder="adresse@mail.com" title="votre mail" required="required">
	</div>
						
	<div class="form-group">
		<label>Vérification mail</label>
		<input type="email" name="mail_verif" class="form-control col-md-4" placeholder="adresse@mail.com" title="votre mail" required="required">
	</div>

	<div class="form-group">
		<label>Téléphone</label>
		<input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="tel" class="form-control col-md-4" placeholder="0601020304" title="votre numéro de téléphone" required="required">
	</div><br><br>

	<?php
		if($_GET['poste']==crypt('capitaine','cp')) {
	?>

<div class="inscription-jeu form-group">
		<label>Choisissez votre jeu</label>
		<select class="form-control col-md-4" name="jeu">	
 			<?php
 				$limiteLOL=limiteLOL($bdd);
				$limiteCS=limiteCS($bdd);
				while($resultatJeux = $jeux1->fetch_assoc()) {
					if($resultatJeux['jeu_nom'] != "Hearthstone") {
						if($resultatJeux['jeu_nom'] == "League of Legends" && $limiteLOL < 16 || $resultatJeux['jeu_nom'] == "Counter-Strike" && $limiteCS < 8) echo '<option value="'.$resultatJeux['jeu_id'].'">'.$resultatJeux['jeu_nom'].'</option>';
					}
				}
				$jeux1->free();
			?>
		</select>				

	<div class="form-group">
		<label>Créez votre équipe</label>
		<input type="text" name="equipe" class="form-control col-md-4" placeholder="Les Hamsters Superbes" title="le nom de votre équipe" required="required">
	</div>

	<div class="form-group">
		<label>L'acronyme de votre équipe</label>
		<input type="text" name="acronyme" class="form-control col-md-4" placeholder="L-HS" title="le nom de votre équipe" required="required">
	</div>

	<?php
		}
		elseif($_GET['poste']==crypt('joueur','jo')) {
	?>	

	<div class="form-group">
		<label>Choisissez votre équipe</label>
		<select name="equipe" class="form-control col-md-4">
			<?php
				$limiteHS=limiteHS($bdd);
				while($resultatJeux = $jeux2->fetch_assoc()) {
					if($resultatJeux['jeu_nom'] == "Hearthstone" && $limiteHS < 16 || $resultatJeux['jeu_nom'] != "Hearthstone") {
						echo '<optgroup label="'.$resultatJeux['jeu_nom'].'">';
						$equipes=equipes($bdd);
						while($resultatEquipes = $equipes->fetch_assoc()) {
							if($resultatJeux['jeu_id'] == $resultatEquipes['jeu_id']) {
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
	</div>					
								
	<?php
		}
	?>	
</div>
</div><br><br>


<!-- ------------------------------------------------------------ -->
<!-- -------------------- INSCRIPTION PIZZAS -------------------- -->

<div class="offset-4 col-md-3">
<label><h4>Choisissez vos pizzas (optionnel)</h4></label><br>
	<label>Pour le vendredi soir</label>
	<select class="form-control" name="pizza_VS1">
		<?php
			while($resultatPizza = $pizza1->fetch_assoc()) {
				echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
			}	
			$pizza1->free();	
		?>
		<option value="NULL" selected>Aucune</option>
	</select>

	<label>Une deuxième ?</label>
	<select class="form-control" name="pizza_VS2">
		<option value="NULL" selected>Aucune</option>
		<?php
			while($resultatPizza = $pizza2->fetch_assoc()) {
				echo '<option value="'.$resultatPizza['piz_id'].'">'.$resultatPizza['piz_nom'].' (&euro; '.$resultatPizza['piz_prix'].')</option>';
			}
			$pizza2->free();
		?>
	</select>

											
<?php
	if($_GET['poste']==crypt('capitaine','cp')) {
		$_SESSION['poste']="capitaine";
	}

	elseif($_GET['poste']==crypt('joueur','jo')) {
		$_SESSION['poste']="joueur";
	}							 
?>



<p><div class="submit">
	<input class="btn btn-danger" type="submit" value="Valider">
</div></p>
</div>

</form>


					
<?php
$bdd->close();
}
else header("Location: ./");
include("./config/config.footer.php");
?>
			
</body>

</html>