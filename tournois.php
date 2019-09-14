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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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