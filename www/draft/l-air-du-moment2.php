<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>Sylvaine Hélary - L'Air du Moment</title>
<meta name="description" content="Sylvaine Hélary">
<meta name="author" content="Sylvaine Hélary">
      
<!-- Favicons
    ================================================== -->
<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->

<link href="css/jplayer.css" rel="stylesheet" type="text/css" />

<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/modif.css" rel="stylesheet">
<link href="css/fonts.css" rel="stylesheet">
<link href="css/l-air-du-moment.css" rel="stylesheet">

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery-ui.js"></script>

<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<!--Musique -->

<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="js/jplayer.playlist.js"></script>
<script type="text/javascript" src="js/musique.js"></script>


<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	
</head>
<body>
<?php
//==========================================================================
//ADMIN
//==========================================================================
include('pages/admin.php');
include('pages/bdd.php');
include('pages/lang.php');
include('pages/menu.php');
?>

	<div class="container-resp" id="test"></div>
	<div class="container-resp">
		<div class="container-title">
			<div class="title">
				<h2>L'air du <span class="titre-colore">moment</span></h2>
			</div>
		</div>
		<div class="container-resp">
			<div class="l-air-du-moment-une container-resp">
			<div class="bouton-ecouter"><i class="fa fa-play-circle-o"></i> écouter</div>
			<img src="img/glowing.jpg" class="l-air-du-moment-img" alt="Sylvaine Hélary"/>
				<h2>Titre</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies dictum gravida. Nunc eu sagittis nunc. Vivamus iaculis auctor lacinia. Donec feugiat fringilla rutrum. Integer nec risus eu metus lobortis pharetra at at dui. Maecenas lacinia velit ut auctor malesuada. Nulla nec ipsum viverra, feugiat purus vel, venenatis nisi. Vivamus est eros, pulvinar a quam eu, consectetur convallis tellus. Nullam sed justo pharetra, rutrum ipsum id, vestibulum diam. Nulla nec ipsum viverra, feugiat purus vel, venenatis nisi. Vivamus est eros, pulvinar a quam eu, consectetur convallis tellus. Nullam sed justo pharetra, rutrum ipsum id, vestibulum diam. Nulla nec ipsum viverra, feugiat purus vel, venenatis nisi. Vivamus est eros, pulvinar a quam eu, consectetur convallis tellus. Nullam sed justo pharetra, rutrum ipsum id, vestibulum diam.</p>
			</div>			
		</div>
	</div>
	<div class="container-resp l-air-du-moment-description gap-bottom">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies dictum gravida. Nunc eu sagittis nunc.</p>
	</div>

	<div class="container-resp gap-bottom">
		<div class="container-title">
			<div class="title">
				<h2>Les prochains <span class="titre-colore">concerts</span></h2>
			</div>
			<div class="">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
			</div>
		</div>

		<div class="container-resp container-bandeau" style="background-image: url('img/bandeau170.jpg');">
			<div class="nom-bandeau">GLOWING LIFE</div>
		</div>
		
		<div class="container-resp container-bandeau" style="background-image: url('img/bandeau170.jpg');">
		</div>

		<div class="container-resp container-bandeau" style="background-image: url('img/bandeau170.jpg'); 
		border: 1px solid black; 
		margin-bottom: 50px;">
		</div>

		<?php for ($i = 1; $i <= 4; $i++){ ?>
			<div class="dates-concerts container-resp">
				<div class="dates-concerts-gauche">
					<h3 class="dates-concerts-jour">10</h3>
					<p class="dates-concerts-mois-annee">Juin 2016</p>	
				</div>
				<div class="dates-concerts-droite">
					<h3 class="dates-concerts-titre">SPRING ROLL LIFE NG ROLL LIFE NG ROLL LIFE</h3>
					<div class="dates-concerts-p">
						<div class="dates-concerts-heure"><i class="fa fa-clock-o"></i>&nbsp;21h30</div>
						<div class="dates-concerts-adresse"><i class="fa fa-map-marker"></i>&nbsp;Au Théâtre Théâtre Mathurins Au Théâtre des Mathurins, 75008 Paris, entrée libre</div>
					</div>
				</div>
				<div class="bouton-reserver">Réserver</div>
			</div>
		<?php } ?>
		
	</div>

	<div class="container-resp gap-bottom">
		<div class="container-title">
			<div class="title">
				<h2>Actualité</h2>
			</div>
			<div class="">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
			</div>
		</div>
		<div class="vignettes3-resp vignettes-resp">
			<div class="vignette3-resp vignette-resp">
				<div class="vignette-hover vignette3-hover jp-type-playlist jp-audio" id="jp_container_1" role="application" aria-label="media player">
					<div id="jquery_jplayer_1" class="jp-jplayer"></div>
					<div class="vignette3-hover-haut invisible-mode jp-playlist">
						<h2 class="titre-album">TITRE ALBUM</h2>
						<p class="sous-titre-album">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer blandit nec quam id consectetur.</p>
						<ol>
							<li>&nbsp;</li>
						</ol>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
					<div class="vignette3-hover-bas invisible-mode">
						<div class="jp-gui jp-interface">
							<div class="nom-titre">Cro Magnon Man</div> 
							<div class="jp-controls">
								<div class="jp-previous bouton-controle" role="button" tabindex="0"></div>
								<div class="jp-play bouton-controle" role="button" tabindex="0"></div>
								<div class="jp-next bouton-controle" role="button" tabindex="0"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="vignette-front vignette3-front" style="background-image: url('img/cover_springroll.jpg');">
					<h2>Musique</h2>
					<p></p>
				</div>
			</div>
		<?php 
		for ($i = 1; $i <= 9; $i++){ 
		?>
			<div class="vignette3-resp vignette-resp">
				<div class="vignette-hover vignette3-hover">
					<div class="vignette3-hover-haut invisible-mode">HOVER HAUT</div>
					<div class="vignette3-hover-bas invisible-mode"><i class="fa fa-backward"></i><i class="fa fa-play"></i><i class="fa fa-pause"></i><i class="fa fa-forward"></i></div>
				</div>
				<div class="vignette-front vignette3-front">
					<h2><?php 
						$tmp = "dossiers_de_presse_titre_" . $i;	
						$tmp = "dossiers_de_presse_titre_1";	
						echo $$tmp; ?></h2>
					<p><?php
						$tmp = "dossiers_de_presse_contenu_" . $i;
						$tmp = "dossiers_de_presse_contenu_1";
						echo $$tmp; ?></p>
				</div>
			</div>
		<?php } ?>
			<div id="popup-dossiers-de-presse1" class="popup-vignette-resp">
				<div class="popup-vignette-resp-content">
					<div class="close"><i></i><i></i></div>
					<h2>LE TITRE</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>

	<?php include('pages/footer.php'); ?>
<script src="js/main.js"></script>
<script src="js/l-air-du-moment.js"></script>
<script src="js/lang.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>