<?php
	session_start();
	
	include("./config/config.requeteSQL.php");

	affichageErreur();

	$bdd=connexionBDD();
	$resultatLOL=limiteLOL($bdd);
	$resultatCS=limiteCS($bdd);
	$resultatHS=limiteHS($bdd);

	while($temp = $resultatLOL->fetch_assoc())
	{
		$limiteLOL=$temp["nombre"];
	}
	$resultatLOL->free();

	while($temp = $resultatCS->fetch_assoc())
	{
		$limiteCS=$temp["nombre"];
	}
	$resultatCS->free();

	while($temp = $resultatHS->fetch_assoc())
	{
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
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<?php
		include("./config/config.navbar.php");
	?>

	<div id="tournoi">
		<h3>Slots disponibles</h3>

		<p>League of Legends : <?php if($lol == 0) echo 'Complet'; else echo $lol ?></p>
		<p>Counter-Strike : <?php if($cs == 0) echo 'Complet'; else echo $cs ?></p>
		<p>Hearthstone : <?php if($hs == 0) echo 'Complet'; else echo $hs ?></p>
	</div>

	<?php
		//include("./config/config.footer.php");
	?>

</body>
</html>