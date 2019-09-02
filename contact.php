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
			<div id="map"></div>
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
			<script async defer
			    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC918nn3n8RDumMDjcjxdZ2-5yjvuFJxis&callback=initMap">
			</script>

		<br>
		<br>

		<?php
			$bdd=connexionBDD();
			$jeux=jeux($bdd);

			$_SESSION['mail_contact'];
		?>

		<center>
			<h2>Par Mail</h2>
			<form method="post" action="./config/config.mail.php">
				<label>Votre Email :</label>
			    <input type="email" name="email" placeholder="Votre email" required="required"><br>
			    <label>Choisissez votre jeu :</label>
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
				<label>Sujet :</label>
			    <input type="text" name="sujet" placeholder="Sujet" required="required"><br>
			    <label>Votre message :</label>
			    <textarea name="message" type="text" placeholder="Message" required="required"></textarea><br>
			    <input type="submit" value="Envoyer">
			</form>

			<h2>Par courrier</h2>
			<address>
				Département Informatique<br>
				U.F.R Sciences et Techniques<br>
				Université de Bretagne Occidentale UBO 20, av Le Gorgeu C.S 93837<br>
				29238 BREST Cedex 3
			</address>
		</center>
		<?php
			$bdd->close();
		?>
	</body>
</html>