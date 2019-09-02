<?php
	session_start();

	if(isset($_SESSION['inscription']))
	{
		if($_SESSION['inscription'] == "ok")
 		{
 			echo '<script type="text/javascript">window.alert("Bienvenu(e) parmis nous, un mail de confirmation vous à été envoyé (pensez à consulter vos indésirables si le mail n\'apparaît pas.");</script>';

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
	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		?>

		<br>

		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FassoOBI1%2F&tabs=timeline%2C%20events&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe><!--Indiquer qu'il faut désactiver le blocage contre le pistage pour voir les infos facebook-->

		<iframe src="https://player.twitch.tv/?channel=obi_lan" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="620"></iframe><!--Live-->
		<iframe src="https://www.twitch.tv/embed/obi_lan/chat" frameborder="0" scrolling="no" height="500" width="350"></iframe><!--Tchat-->
	</body>
</html>