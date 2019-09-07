<?php
	include("./config/config.requeteSQL.php");

	affichageErreur();

	$bdd=connexionBDD();
	$resultatLOL=limiteLOL($bdd);
	$resultatCS=limiteCS($bdd);
	$resultatHS=limiteHS($bdd);

	while($temp = $resultatLOL->fetch_assoc()) {
		$limiteLOL=$temp["nombre"];
	}

	$resultatLOL->free();
	while($temp = $resultatCS->fetch_assoc()) {
		$limiteCS=$temp["nombre"];
	}

	$resultatCS->free();
	while($temp = $resultatHS->fetch_assoc()) {
		$limiteHS=$temp["nombre"];
	}

	$resultatHS->free();
	$lol=16-$limiteLOL;
	$cs=8-$limiteCS;
	$hs=16-$limiteHS;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tournois</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" type="icon/png" href="images/icone.png">
	<link rel="stylesheet" type="text/css" href="./css/style_tournois.css">
</head>
<body>

	<?php
		include("./config/config.navbar.php");
	?>

	<div id="tournoi">
		<h3></h3>

		<p></p>
		<p></p>
		<p></p>
	</div>


<div class="card" style="width: 18rem;">
	<div class="card-header">
	<h5>Slots disponibles</h5>
	</div>
	<ul class="list-group list-group-flush">
		<li class="list-group-item">League of Legends : <?php if($lol == 0) echo 'Complet'; else echo $lol ?></li>
		<li class="list-group-item">Counter-Strike : <?php if($cs == 0) echo 'Complet'; else echo $cs ?></li>
		<li class="list-group-item">Hearthstone : <?php if($hs == 0) echo 'Complet'; else echo $hs ?></li>
	</ul>
</div>

<div id="footer">	
	<?php
		include("./config/config.footer.php");
	?>
</div>

</body>
</html>