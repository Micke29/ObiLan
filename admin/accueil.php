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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<div>
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
					<th>Membre(s)</th>
					<th>Action</th>
				</tr>
			</thead>

		<?php
		while($donnees = $equipesIncomplete->fetch_assoc())
		{
		?>
			<tbody>
				<tr>
					<td><?php echo $donnees['equ_nom'] ?></td>
					<td><?php echo $donnees['nombre'] ?></td>
					<td><?php echo '<a href="supprimer.php?equ='.$donnees['equ_id'].'"><img src="../images/supprimer.ico" height="25" width="25" title="supprimer"/></a>' ?></td>
				</tr>
			</tbody>
		<?php
		}
		?>
		</table>

		<h3>Complètes</h3>
		<table>
			<thead>
				<tr>
					<th>Equipe</th>
					<th>Membre(s)</th>
				</tr>
			</thead>

		<?php
		while($donnees = $equipesComplete->fetch_assoc())
		{
		?>
			<tbody>
				<tr>
					<td><?php echo $donnees['equ_nom'] ?></td>
					<td><?php echo $donnees['nombre'] ?></td>
				</tr>
			</tbody>
		<?php
		}
		?>
		</table>
		<h2>Export</h2>
		<a class="button" href="./export.php?joueurs"><input type="submit" value="Tableau joueurs/équipes"></a>
	</div>
	
	<div>
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
				</tr>
			</thead>

		<?php
		while($donnees = $joueurs->fetch_assoc())
		{
		?>
			<tbody>
				<tr>
					<td><?php echo $donnees['jou_nom'] ?></td>
					<td><?php echo $donnees['jou_prenom'] ?></td>
					<td><?php echo $donnees['jou_telephone'] ?></td>
					<td><?php echo $donnees['cpt_mail'] ?></td>
				</tr>
			</tbody>
		<?php
		}
		?>
		</table>
	</div>
	
	<div>
		<h1>Pizza</h1>
		<?php
			pizzaAdmin($bdd);	//affichage du total de chaque pizza par jour
		?>
		<h2>Export</h2>
		<a class="button" href="./export.php?pizza=VM"><input type="submit" value="Vendredi Midi"></a>
		<a class="button" href="./export.php?pizza=VS"><input type="submit" value="Vendredi Soir"></a>
		<a class="button" href="./export.php?pizza=SM"><input type="submit" value="Samedi Midi"></a>
		<?php
			$bdd->close();
		?>
	</div>

	<br>
	<br>

	<a href="./logout.php">Déconnexion</a>
</body>

</html>