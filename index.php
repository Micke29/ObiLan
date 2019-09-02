<?php
	session_start();

	if(isset($_SESSION['inscription']))
	{
		if($_SESSION['inscription'] == "ok")
 		{
 			echo '<script type="text/javascript">window.alert("Bienvenu(e) parmis nous, votre inscription est validée");</script>';

 			unset($_SESSION['inscription']);
 		}
		elseif($_SESSION['inscription'] == "erreur")
 		{
 			echo '<script type="text/javascript">window.alert("Une erreur est survenue, merci de reessayer ulterieurement");</script>';

 			unset($_SESSION['inscription']);
 		}
 	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Obilan</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="icon/png" href="images/icone.png">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./css/style2.css">

	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		?>

		<br>

<p><h1>Vous l'attendiez tous et enfin le voilà, le retour de l'OBILan</h1><p>
<div class="row">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <p class="card-text">
        	<p>
			 	Suite aux différents problèmes rencontrés qui nous a valu le report de la Lan, nous avons le plaisir de vous annoncez le retour de notre évenement phare !<br>
				L’OBILan revient donc pour sa cinquième édition les 12 et 13 octobre à la fac des sciences de l’UBO.
			 </p>
			 
			 <p>
			 	Venez donc jouer à vos jeux préférés sur PC et consoles pendant 24h non-stop, à partir vendredi soir à 19h.<br>
				Les inscriptions pourront se faire sur ce site, vous pourrez y choisir votre jeu, votre équipe mais également vos pizzas.
			</p>

			<p>Cette année venez affronter d'autres joueurs sur 5 tournois majeurs :</p>
			<p>
				- LEAGUE OF LEGENDS<br>
					16 équipes de 5 joueurs
			</p>
			<p>
				- COUNTER STRIKE : GLOBAL OFFENSIVE<br>
					8 équipes de 5 joueurs <br>
					Ce tournois est organisé avec la participation de GGLan
			</p>
			<p>
				- HEARTHSTONE<br>
					16 joueurs
			</p>
			<p>
				- TRACKMANIA NATION FOREVER<br>
					Ce tournois est ouvert à tous les participants de l’OBILan
			</p>
			<p>- Un tournois gratuit organisé par l'association Guard Impact</p>

			<p>Slots disponible accessible via l'onglet "tournois".</p>

			<p>
				En plus de ces tournois, des consoles en accès libre seront mises à disposition de tous, tandis que Guard Impact organisera une Nocturne autour de plusieurs jeux.
			</p>

			<p>
				Pour plus de renseignements, ainsi que des informations sur les tournois, n'hésitez pas à nous contacter sur Facebook : <br>
				- <a href="https://www.facebook.com/assoOBI1/" target="blank">Association OBI1</a><br>
				- <a href="https://www.facebook.com/GuardImpactVS/" target="blank">Association Guard Impact</a><br>
			</p>

			<p>
				- Par mail via l'onglet "contact" <br>
				- À notre local : N-048, Bâtiment N à l'UFR de Sciences
			</p>

			<p>
			 	Tarifs d'entrée : <br>
				- 8€ pour les adhérents <br>
				- 10€ pour les non-adhérents <br>
				- Gratuit pour les spectateurs (non participants aux tournois) 
			</p>

			<p>
				Les matchs sont streamés sur notre page <a href="https://player.twitch.tv/?channel=obi_lan" target="blank">Twitch</a>, ou <a href="#live">ici</a>.
			</p>

			<p>Les places des tournois sont limitées donc n'hésitez pas ! VENEZ NOMBREUX !</p>
		</p>

      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Suivez-nous sur Facebook.</h5>
        <p class="card-text">
        	<div id="facebook">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FassoOBI1%2F&tabs=timeline%2C%20events&width=350&height=870&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="350" height="870" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe><!--Indiquer qu'il faut désactiver le blocage contre le pistage pour voir les infos facebook-->
		</div>
		</div>
		</p>
        <a href="https://www.facebook.com/assoOBI1/" class="btn btn-primary" target="blank">Accéder à Facebook</a>
      </div>
    </div>
  </div>
</div>

<h2>Bla bla bla inutile parce que je sais pas quoi mettre</h2>

<div class="row">
  <div class="col-sm-8">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Suivez nos différents lives</h4>
        <p class="card-text"><iframe src="https://player.twitch.tv/?channel=obi_lan" frameborder="0" allowfullscreen="true" scrolling="no" id="live" width=" 100%" height="500px"></iframe><!--Live--></p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tchat du live</h4>
        <p class="card-text"><iframe src="https://www.twitch.tv/embed/obi_lan/chat" frameborder="0" scrolling="no" height="500" width="350" id="tchat"></iframe><!--Tchat--></p>
      </div>
    </div>
  </div>
</div>

<?php
	include("./config/config.footer.php");
?>
	
	</body>
</html>