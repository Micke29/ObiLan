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
        
        <h5 class="card-title">Lorem Ipsum</h5>
        
        <p class="card-text">

        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce feugiat urna a metus gravida, in gravida sem dapibus. Sed pellentesque risus eu sagittis suscipit. Nullam vitae commodo elit, nec tempor nunc. Nullam in diam ullamcorper nulla pellentesque dictum. Maecenas vitae felis eu ligula pulvinar efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Morbi ornare sem a viverra dignissim.
        	</p>

        	<p>
        		Praesent convallis sem et mauris ultricies viverra. Nulla a ullamcorper mi, ac elementum lacus. Vestibulum in neque eu diam fringilla venenatis. Nullam eu erat ac erat ultricies accumsan. Suspendisse fermentum elit sed posuere efficitur. Quisque lacus urna, interdum quis ligula sed, tincidunt ultricies tortor. <br>Fusce mollis interdum dui et consectetur. Pellentesque condimentum vulputate nisl id sagittis.
        	</p>

					<p>
						Nullam id lacinia tellus. Integer est ligula, ornare quis elit ut, sagittis molestie lorem. Proin id tellus mauris. Mauris luctus sed nisl et commodo. Ut iaculis felis ut leo tempor gravida. Phasellus in magna nunc. Mauris cursus congue lorem, vel iaculis augue laoreet in. Fusce vitae gravida nisl, quis pretium ligula. Nam varius congue diam sit amet blandit. Quisque placerat nisl non fermentum commodo. Nulla a magna eu purus laoreet molestie. Duis consequat, nibh sit amet rhoncus mollis, est metus volutpat leo, a tempus tellus leo ut mauris. Cras convallis congue bibendum.
					</p>

					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce feugiat urna a metus gravida, in gravida sem dapibus. Sed pellentesque risus eu sagittis suscipit. Nullam vitae commodo elit, nec tempor nunc. Nullam in diam ullamcorper nulla pellentesque dictum. Maecenas vitae felis eu ligula pulvinar efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Morbi ornare sem a viverra dignissim.
        	</p>

        	<p>
        		Praesent convallis sem et mauris ultricies viverra. Nulla a ullamcorper mi, ac elementum lacus. Vestibulum in neque eu diam fringilla venenatis. Nullam eu erat ac erat ultricies accumsan. Suspendisse fermentum elit sed posuere efficitur. Quisque lacus urna, interdum quis ligula sed, tincidunt ultricies tortor. <br>Fusce mollis interdum dui et consectetur. Pellentesque condimentum vulputate nisl id sagittis.
        	</p>

					<p>
						Nullam id lacinia tellus. Integer est ligula, ornare quis elit ut, sagittis molestie lorem. Proin id tellus mauris. Mauris luctus sed nisl et commodo. Ut iaculis felis ut leo tempor gravida. Phasellus in magna nunc. Mauris cursus congue lorem, vel iaculis augue laoreet in. Fusce vitae gravida nisl, quis pretium ligula. Nam varius congue diam sit amet blandit. Quisque placerat nisl non fermentum commodo. Nulla a magna eu purus laoreet molestie. Duis consequat, nibh sit amet rhoncus mollis, est metus volutpat leo, a tempus tellus leo ut mauris. Cras convallis congue bibendum.
					</p>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Suivez-nous sur Facebook</h5>
        <div id="facebook">
			<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FassoOBI1%2F&tabs=timeline%2C%20events&width=350&height=650&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="350" height="650" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe><!--Indiquer qu'il faut désactiver le blocage contre le pistage pour voir les infos facebook-->
		</div>
        <a href="https://www.facebook.com/assoOBI1/" target="_blank" class="btn btn-primary">Accéder à Facebook</a>
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