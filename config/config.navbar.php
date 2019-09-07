<header>
	<div class="header">
		<img src="./images/logo.png" class="logo"/>
	       	<ul style="float:right;">

	       		<?php
		       	if(isset($_SESSION["pseudo"]))
				{
					echo '<li><a href="./compte.php">Mon Compte</a></li>';
					echo '<li><a href="./logout.php">Déconnexion</a></li>';
				}
				else
				{	
						date_default_timezone_set('Europe/Paris');
						$current_date=date("d.m.Y");
						$current_hour=date("H:i");
						$open_date="16.09.2018";
						$close_date="12.10.2018";
						$close_hour="12:00";
						if(strtotime($current_date) < strtotime($open_date) && strtotime($current_date) > strtotime($close_date) || 
							strtotime($current_date) == strtotime($close_date) && strtotime($current_hour) >= strtotime($close_hour)) echo '<li><a href="inscription.php">Inscription</a></li>';
					echo '<li style="margin-left: 10px;"><a href="connexion.php">Connexion</a></li>';
				}
			?>
			</ul>
	</div>

	<div class="header-link">
	    <ul>
	        <li><a href="./">Accueil</a></li>
	        <li><a href="reglement.php">Réglement</a></li>
	        <li><a href="tournois.php">Tournois</a></li>
	        <li><a href="contact.php">Contact</a></li>
	    </ul>
	</div>
</header>