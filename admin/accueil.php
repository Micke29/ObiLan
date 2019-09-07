<?php
	session_start();

	include("../config/config.requeteSQL.php");

	affichageErreur();

	if(!isset($_SESSION['admin']))
	{
		header("Location: ./");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Accueil</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="icon/png" href="../images/icone.png" />
	<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
	<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
</head>

<body>
	<div class="header">
		<a href="../" target="blank"><img src="../images/logo.png" class="logo"/></a>
		<ul style="float:right;">
			<li><a href="./verifPizza.php">Contrôle Pizza</a></li>
			<li><a href="./logout.php">Déconnexion</a></li>
		</ul>
	</div>

	<div id="equipes">
		<h1>Equipes</h1>
		<?php
			$bdd=connexionBDD();
			$equipesIncomplete=equipesIncompletesAdmin($bdd);
			$equipesComplete=equipesCompletesAdmin($bdd);
		?>
		<h3>Incomplètes</h3>
		<table>
			<thead>
				<tr>
					<th>Equipe</th>
					<th>Jeu</th>
					<th>Membre(s)</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
		<?php
		while($donnees = $equipesIncomplete->fetch_assoc())
		{
		?>			
				<tr>
					<td><?php echo $donnees['equ_nom'] ?></td>
					<td><?php echo $donnees['jeu_nom'] ?></td>
					<td><?php echo $donnees['nombre'] ?></td>
					<td><?php echo '<a href="supprimer.php?equ='.$donnees['equ_id'].'"><i class="fas fa-times-circle"></i></a>' ?></td>
				</tr>			
		<?php
		}
		?>
			</tbody>
		</table>

		<h3>Complètes</h3>
		<table>
			<thead>
				<tr>
					<th>Equipe</th>
					<th>Jeu</th>
					<th>Membres</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
		<?php
		while($donnees = $equipesComplete->fetch_assoc())
		{
		?>			
				<tr>
					<td><?php echo $donnees['equ_nom'] ?></td>
					<td><?php echo $donnees['jeu_nom'] ?></td>
					<td><?php echo $donnees['nombre'] ?></td>
					<td><?php echo '<a href="supprimer.php?equ='.$donnees['equ_id'].'"><i class="fas fa-times-circle"></i></a>' ?></td>
				</tr>			
		<?php
		}
		?>
			</tbody>
		</table>
		<h2>Export</h2>
		<div class="submit">
			<a href="./export.php?joueurs"><input type="submit" value="Tableau joueurs/équipes"></a>
		</div>
	</div>
	
	<div id="joueurs">
		<h1>Joueurs</h1>
		<?php
			$joueurs=joueurAdmin($bdd);
		?>
		<table>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prenom</th>
					<th>Télephone</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
		<?php
		while($donnees = $joueurs->fetch_assoc())
		{
			if($donnees['equ_id'] == 1)
			{
			?>			
				<tr>
					<td style="color: #B0232C"><?php echo $donnees['jou_nom'] ?></td>
					<td style="color: #B0232C"><?php echo $donnees['jou_prenom'] ?></td>
					<td style="color: #B0232C"><?php echo $donnees['jou_telephone'] ?></td>
					<td style="color: #B0232C"><?php echo $donnees['cpt_mail'] ?></td>
					<td><?php echo '<a href="supprimer.php?jou='.$donnees['jou_id'].'"><i class="fas fa-times-circle"></i></a>' ?></td>
				</tr>			
			<?php
			}
			else
			{
			?>			
				<tr>
					<td><?php echo $donnees['jou_nom'] ?></td>
					<td><?php echo $donnees['jou_prenom'] ?></td>
					<td><?php echo $donnees['jou_telephone'] ?></td>
					<td><?php echo $donnees['cpt_mail'] ?></td>
					<td><?php echo '<a href="supprimer.php?jou='.$donnees['jou_id'].'"><i class="fas fa-times-circle"></i></a>' ?></td>
				</tr>			
			<?php
			}
		}
		?>
			</tbody>
		</table>
	</div>
	
	<div id="pizza">
		<h1>Pizza</h1>
		<?php
			pizzaAdmin($bdd);	//affichage du total de chaque pizza par jour
		?>
		<h2>Export</h2>
		<div class="submit">
			<a href="./export.php?pizza=VS"><input type="submit" value="Vendredi Soir"></a>
		</div>
		<?php
			$bdd->close();
		?>
	</div>
	<br>
	
</body>

</html>