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
		<link rel="stylesheet" type="text/css" href="./css/style_contact.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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


<div class="offset-md-4">

<h4>Nous contacter par mail</h4>

<p><form method="post" action="./config/config.mail.php">

<div class="form-group">
	<label for="exampleInputEmail1">Votre Email</label>
	<input name="email" type="email" class="form-control col-md-4" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre Email" required="required">
</div>

<div class="form-group">
<label for="exampleInputEmail1">Sujet de votre message</label>
<select id="inputState" class="form-control col-md-4" name="jeu">
	<?php
		while($resultatJeux = $jeux->fetch_assoc()) {
			echo '<option value="'.$resultatJeux['jeu_nom'].'">'.$resultatJeux['jeu_nom'].'</option>';
		}
		$jeux->free();
	?>
	<option value="Divers" selected>Questions diverses</option>
</select>
</div>

<p>
<div class="form-group">
	<label for="exampleInputEmail1">Sujet de votre message</label>
	<input name="sujet" type="text" class="form-control col-md-4" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Sujet" required="required">
</div>
</p>

<p>
<div class="form-group">
	<label for="exampleFormControlTextarea1">Votre message</label>
	<textarea type="text" name="message" class="form-control col-md-4" id="exampleFormControlTextarea1" rows="3" placeholder="Votre message" required="required"></textarea>
</p>
</div>

<button type="submit" value="Envoyer" class="btn btn-danger">Envoyer</button>

</form></p>
</div>

<div class="offset-md-4">
	<address>
		<h4>Nous contacter par courrier</h4>
		Département Informatique<br>
		U.F.R Sciences et Techniques<br>
		Université de Bretagne Occidentale UBO 20, av Le Gorgeu C.S 93837<br>
		29238 BREST Cedex 3
	</address>
</div>


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