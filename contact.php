<?php
	session_start();
	
	include("./config/config.requeteSQL.php");

	affichageErreur();

	if(isset($_SESSION['formulaire']))
	{
		echo '<script type="text/javascript">window.alert("Merci de remplir le formulaire");</script>';

 		unset($_SESSION['formulaire']);
	}
	if(isset($_SESION['envoi']))
	{
		if($_SESSION['envoi']==0)
		{
			echo '<script type="text/javascript">window.alert("Votre mail à bien été envoyé");</script>';

 			unset($_SESSION['envoi']);
		}
		else
		{
			echo '<script type="text/javascript">window.alert("Une erreur est survenue, veuillez réessayer plus tard");</script>';

 			unset($_SESSION['envoi']);
		}
	}
	if(isset($_SESSION['email']))
	{
		echo '<script type="text/javascript">window.alert("Adresse mail inconnue");</script>';

 		unset($_SESSION['email']);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Contact</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" type="icon/png" href="images/icone.png">
		<link rel="stylesheet" type="text/css" href="./css/style2.css">
		<style>
		    #map {
		    	height: 400px;
		    	width: auto;
		    }
    	</style>
	</head>

	<body>
		<?php
			include("./config/config.navbar.php");
		?>
		<br>	
		<br>

		<?php
			$bdd=connexionBDD();
			$jeux=jeux($bdd);

			$_SESSION['mail_contact']="";
		?>
			<h1>Nous contacter</h1>
	<div id="contact_mail">
	<table>
		<tr>
			<td colspan="2" align="center"><h2>Par Mail</h2></td>
			<form method="post" action="./config/config.mail.php">
				<tr>
					<td>
						<label>Votre Email :</label>
					</td>
					<td>
			    		<input type="email" name="email" placeholder="Votre email" required="required"><br>
			    	</td>
			    </tr>

			    <tr>
			    	<td>
			    		<label>Choisissez votre jeu :</label>
			    	</td>
			    	<td>
						<select name="jeu">
						<?php
							while($resultatJeux = $jeux->fetch_assoc())
							{
								echo '<option value="'.$resultatJeux['jeu_nom'].'">'.$resultatJeux['jeu_nom'].'</option>';
							}
						$jeux->free();
						?>
						<option value="Divers">Question Diverse</option>
					</select><br>
					</td>
				</tr>
				
				<tr>
					<td>
						<label>Sujet :</label>
					</td>
					<td>
			    		<input type="text" name="sujet" placeholder="Sujet" required="required"><br>
			    	</td>
			    </tr>

			    <tr>
			    	<td>
			    		<label>Votre message :</label>
			    	</td>
			    	<td>
			    		<textarea name="message" type="text" placeholder="Message" style="width: 300px; height: 120px;" required="required"></textarea><br>
			    	</td>
			    </tr>	
			    <tr>
			    	<td class="submit" colspan="2" align="center">
			    		<input type="submit" value="Envoyer" style="width:20% !important;margin-top: 5px">
					</td>
				</tr>
			</form>
		</tr>
	</table>
	</div>

	<div id="contact_courrier">
		<table>
			<tr>
				<td align="center">
					<h2>Par courrier</h2>
				</td>
			</tr>
			<tr>
				<td>	
				<address>
					Département Informatique<br>
					U.F.R Sciences et Techniques<br>
					Université de Bretagne Occidentale UBO 20, av Le Gorgeu C.S 93837<br>
					29238 BREST Cedex 3
				</address>
				</td>
			</tr>
		</table>
	</div>

	<br>	

	<div id="map" style="padding-bottom: 50px;">
			<script>
				function initMap() {
			    var uluru = {lat: 48.3992686, lng: -4.4980519};
			    var map = new google.maps.Map(document.getElementById('map'), {
			        zoom: 12,
			        center: uluru,
			        styles: [
					  {"elementType": "geometry",
					   "stylers": [
					      {"color": "#212121"}
					    ]
					  },
					  {"elementType": "labels.icon",
					   "stylers": [
					      {"visibility": "off"}
					    ]
					  },
					  {"elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#757575"}
					    ]
					  },
					  {"elementType": "labels.text.stroke",
					   "stylers": [
					      {"color": "#212121"}
					    ]
					  },
					  {"featureType": "administrative",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#757575"}
					    ]
					  },
					  {"featureType": "administrative.country",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#9e9e9e"}
					    ]
					  },
					  {"featureType": "administrative.land_parcel",
					   "stylers": [
					      {"visibility": "off"}
					    ]
					  },
					  {"featureType": "administrative.locality",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#bdbdbd"}
					    ]
					  },
					  {"featureType": "poi",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#757575"}
					    ]
					  },
					  {"featureType": "poi.park",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#181818"}
					    ]
					  },
					  {"featureType": "poi.park",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#616161"}
					    ]
					  },
					  {"featureType": "poi.park",
					   "elementType": "labels.text.stroke",
					   "stylers": [
					      {"color": "#1b1b1b"}
					    ]
					  },
					  {"featureType": "road",
					   "elementType": "geometry.fill",
					   "stylers": [
					      {"color": "#2c2c2c"}
					    ]
					  },
					  {"featureType": "road",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#8a8a8a"}
					    ]
					  },
					  {"featureType": "road.arterial",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#373737"}
					    ]
					  },
					  {"featureType": "road.highway",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#3c3c3c"}
					    ]
					  },
					  {"featureType": "road.highway.controlled_access",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#4e4e4e"}
					    ]
					  },
					  {"featureType": "road.local",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#616161"}
					    ]
					  },
					  {"featureType": "transit",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#757575"}
					    ]
					  },
					  {"featureType": "water",
					   "elementType": "geometry",
					   "stylers": [
					      {"color": "#000000"}
					    ]
					  },
					  {"featureType": "water",
					   "elementType": "labels.text.fill",
					   "stylers": [
					      {"color": "#3d3d3d"}
					    ]
					  }
			        ]
			    });
			    var marker = new google.maps.Marker({
			        position: uluru,
			        map: map
			    });
			    }
			</script>
	</div>
	<script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC918nn3n8RDumMDjcjxdZ2-5yjvuFJxis&callback=initMap">
	</script>

	<?php
		include("./config/config.footer.php");

		$bdd->close();
	?>
	</body>
</html>