<?php
  session_start();
  if(isset($_SESSION['inscription'])) {
    if($_SESSION['inscription'] == "ok") {
      echo '<script type="text/javascript">window.alert("Bienvenu(e) parmis nous, votre inscription est validée");</script>';
      unset($_SESSION['inscription']);
    }
    elseif($_SESSION['inscription'] == "erreur") {
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
  <link rel="stylesheet" type="text/css" href="./css/style2.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
  <?php
    include("./config/config.navbar.php");
  ?>

<div class="row">
<div class="col-sm-8">

    <div class="card">
      <div class="card-body">
        
        <h5 class="card-title">Obilan</h5>
        
        <p class="card-text">

          <p>
L'OBILan revient pour sa sixième édition, les 27 et 28 Septembre !

L'OBILan est une LAN-Party se déroulant à l'UBO durant 24H, où des joueurs s'affrontent sur plusieurs jeux PC et consoles.

Cette année, les tournois proposés sont :

- League of Legends :
*16 équipes de 5 joueurs

- Counter Strike : Global Offensive
*8 équipes de 5 joueurs

- Tekken 7
*Ce tournoi est organisé par l'association Guard Impact

- Super Smash Bros. Ultimate
*X joueurs

En plus de ces tournois, des consoles en accès libre seront mises à disposition de tous, et ce toute la nuit !

Inscriptions à venir, gardez l'oeil ouvert !

Pour plus de renseignements, ainsi que des informations sur les tournois, n'hésitez pas à nous contacter :
- Sur Facebook : https://www.facebook.com/assoOBI1
- Par mail : association.obi1@gmail.com
- A notre local : N-048, Bâtiment N à l'UFR de Sciences

Tarifs d'entrée :
- 8€ pour les adhérents
- 10€ pour les non-adhérents
- Gratuit pour les spectateurs (non participants aux tournois)

Les matchs sont streamés ! => twitch.tv/obi_lan

Les places des tournois sont limitées donc n'hésitez pas ! VENEZ NOMBREUX !
          </p>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Suivez-nous sur Facebook</h5>
        <div id="facebook">

      </div>
    </div>
  </div>
</div>

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
