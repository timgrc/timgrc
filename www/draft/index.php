<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<?php
//==========================================================================
//ADMIN
//==========================================================================
if (isset($_COOKIE['admin_guypendu'])) {
	$admin = $_COOKIE['admin_guypendu'];
}
else {
	$admin = false;
}
if ($admin) {
	$affichage_alert = 'ok';
	function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE) {
	   //Test1: fichier correctement uploadé
		if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
	   //Test2: taille limite
		if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
	   //Test3: extension
		$ext = strtolower(substr(strrchr($_FILES[$index]['name'],'.'),1));
		if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
	   //Déplacement
		return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
	}
}
?>
    <head>
        <meta charset="utf-8" />
		<meta name="ROBOTS" CONTENT="INDEX, FOLLOW">
		<meta name="keywords" content="Guy Pen'du, artiste, musicien, il n'est jamais trop tard, album, soirée cabaret, concert, animateur, Bretagne" />
		<meta name="description" content="Guy Pen'du est un musicien breton, son album, il n'est jamais trop tard." />		
		<title>GUY PEN'DU</title>
		
		<!--==========================================================================
		STYLES CSS
		===========================================================================-->
		<link rel="stylesheet" href="styles/normalize.css" />
		<link rel="stylesheet" href="styles/main.css" />
		<link rel="stylesheet" href="styles/p0.css" />
		<link rel="stylesheet" href="styles/p1.css" />
		<link rel="stylesheet" href="styles/p2.css" />
		<link rel="stylesheet" href="styles/p3.css" />
		<link rel="stylesheet" href="styles/p4.css" />
		<link rel="stylesheet" href="styles/p5.css" />
		<link rel="stylesheet" href="styles/p6.css" />
		
		<!--==========================================================================
		FANCYBOX
		===========================================================================-->
		<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
		<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
		<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
		<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
       	      	
		<!--==========================================================================
		NICEDIT
		===========================================================================-->
		<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
		
		<!--==========================================================================
		JQUERY UI
		===========================================================================-->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		
		<!--==========================================================================
		SCROLLBAR ET HTML5 POUR IE
		===========================================================================-->
		<!--[if (gt IE 7)|(!IE)]><!-->
		<link rel="stylesheet" href="styles/jquery.mCustomScrollbar.css">
		<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<script>
			(function($){
				$(window).load(function(){
					
					$.mCustomScrollbar.defaults.scrollButtons.enable=true; //enable scrolling buttons by default
					$.mCustomScrollbar.defaults.axis="y"; //enable 2 axis scrollbars by default
					
					$(".content-dtk").mCustomScrollbar({theme:"dark-thick"});
					
					$(".all-themes-switch a").click(function(e){
						e.preventDefault();
						var $this=$(this),
							rel=$this.attr("rel"),
							el=$(".content");
						switch(rel){
							case "toggle-content":
								el.toggleClass("expanded-content");
								break;
						}
					});
					
				});
			})(jQuery);
		</script>
		<!--<![endif]-->
		
		<!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
		
		<!--[if IE 6]><link rel="stylesheet" href="styles/ie6.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="styles/ie.css" /><![endif]-->
		<!--[if (gte IE 7)|(!IE)]><!--><link rel="stylesheet" href="styles/sansie6.css" /><!--<![endif]-->
        <script type="text/javascript">
            $(function() {
				$('#footer_demande').bind('click',function(event){
					var position_scroll;
					position_scroll = $('#framegroscontenu').scrollLeft()/1000;
					$('#framegroscontenu').stop().animate({
						scrollLeft: 5000
					}, 1000);
					event.preventDefault();
					$('#menup' + position_scroll + ' a').removeClass('backgroundtriangle');
					$('#menup5 a').addClass('backgroundtriangle');
				});
				$('#lienesp').bind('click',function(event){
					var position_scroll;
					position_scroll = $('#framegroscontenu').scrollLeft()/1000;
					$('#framegroscontenu').stop().animate({
						scrollLeft: 2000
					}, 1000);
					event.preventDefault();
					$('#menup' + position_scroll + ' a').removeClass('backgroundtriangle');
					$('#menup2 a').addClass('backgroundtriangle');
				});
				$('#p3gauchelienbouton').bind('click',function(event){
					var position_scroll;
					position_scroll = $('#framegroscontenu').scrollLeft()/1000;
					$('#framegroscontenu').stop().animate({
						scrollLeft: 5000
					}, 1000);
					event.preventDefault();
					$('#menup' + position_scroll + ' a').removeClass('backgroundtriangle');
					$('#menup5 a').addClass('backgroundtriangle');
				});
				$('#logo a').bind('click',function(event){
					var position_scroll;
					position_scroll = $('#framegroscontenu').scrollLeft()/1000;
					$('#framegroscontenu').stop().animate({
                        scrollLeft: 0
                    }, 1000);
                    event.preventDefault();
					$('#menup' + position_scroll + ' a').removeClass('backgroundtriangle');
                });
				<?php
				$i=1;
				while ($i<=6) { ?>
					$('#menup<?php echo $i; ?> a').bind('click',function(event){
						var position_scroll;
						position_scroll = $('#framegroscontenu').scrollLeft()/1000;
						$('#framegroscontenu').stop().animate({
							scrollLeft: <?php echo $i*1000;?>
						}, 1000);
						event.preventDefault();
						$('#menup' + position_scroll + ' a').removeClass('backgroundtriangle');
						$('#menup<?php echo $i; ?> a').addClass('backgroundtriangle');
					});
				<?php 
					$i++;
				} ?>
            });
        </script>
    </head>

    <body>
		<?php
		//==========================================================================
		//CONNEXION BDD
		//==========================================================================
		try {
			include('./pages/bdd.php');
			$bdd->exec('SET CHARACTER SET utf8');
		}
		catch(Exception $e) {
			die('Erreur : '.$e->getMessage());
		}
		
		//==========================================================================
		//LIRE VARIABLE NUMERO DE PAGE
		//==========================================================================
		$pages = 6;
		$page = 0;
		if (isset($_GET['page'])) {
			if ($_GET['page']<=$pages AND 1<=$_GET['page']) {
				$page = $_GET['page'];
			}
		} ?>
		<div id="fond">
			<div id="corps">
				<!--==========================================================================
				MENU
				===========================================================================-->
				
				<div>
					<div id="navbar">
						<ul>
							<?php 
							$reponse = $bdd->prepare('SELECT * FROM menu');
							$reponse->execute();
							$i = 1;
							while($donnees = $reponse->fetch()) {
								$menu = $donnees['nom']; 
							?>
							<li id="menup<?php echo $i; ?>"><a href="<?php echo '#page' . $i;?>"><?php echo $menu;?></a></li>
							<?php 
							$i++;
							}
							?>
						</ul>
					</div>
				</div>
				
				<!--==========================================================================
				LOGO
				===========================================================================-->
				<div id="logo">
					<a href="index.php#page0"  alt="GUY PEN'DU"  title="GUY PEN'DU">
						<p id="logoimage"></p>
						<p id="logosoustitre">
							<?php if ($admin) echo '<span id="zoneadmin">ZONE ADMINISTRATEUR</span>';
							else echo 'CHANTEUR - ANIMATEUR'; ?>
						</p>
					</a>
				</div>
				
				<!--==========================================================================
				FENETRE PRINCIPALE
				===========================================================================-->
				<div id="framegroscontenu">
					<div id="legroscontenu">
						<div id="page0" class="contenu" style="clear: both;"><?php include "./pages/p0.php"; ?></div>
						<div id="page1" class="contenu transparent_diffp0"><?php include "./pages/p1.php"; ?></div>					
						<div id="page2" class="contenu transparent_diffp0"><?php include "./pages/p2.php"; ?></div>					
						<div id="page3" class="contenu transparent_diffp0"><?php include "./pages/p3.php"; ?></div>					
						<div id="page4" class="contenu transparent_diffp0"><?php include "./pages/p4.php"; ?></div>					
						<div id="page5" class="contenu transparent_diffp0"><?php include "./pages/p5.php"; ?></div>					
						<div id="page6" class="contenu transparent_diffp0"><?php include "./pages/p6.php"; ?></div>					
					</div>
				</div>
				<!--==========================================================================
				LECTEUR MUSIQUE
				===========================================================================-->
				<div id="lecteur">
					<object type="application/x-shockwave-flash" data="musique/dewplayer-rect.swf" width="240" height="20" id="dewplayer" name="dewplayer"> 
					<param name="wmode" value="transparent" />
					<param name="movie" value="musique/dewplayer-rect.swf" /> 
					<param name="flashvars" value="mp3=musique/BronsonMemory.mp3|musique/IlNEstJamaisTropTard.mp3|musique/Kenavo.mp3|musique/LePenitencier.mp3|musique/Clair.mp3|musique/JeTeSensPresDeMoi.mp3&amp;autostart=1&amp;autoreplay=1" /> </object>
				</div>
				
			</div>
		</div>
		<div id="bigfoot" class="gclaire">
			<!--==========================================================================
			FOOTER GAUCHE
			===========================================================================-->
			<div id="f1">
				<h3>>> TOUTE L'<strong>ACTUALITÉ</strong> DE GUY PEN'DU :</h3>
				<p>
					Tenez vous informé des dernières news<br />
					concernant Guy en le suivant sur les réseaux sociaux !<br />
				</p>
				<p id="reseauxsociaux">
					<a href="https://www.facebook.com/guy.pendu" id="footer_facebook"><img src="images/footer/fb.gif" alt="facebook" /></a> <a href="http://www.youtube.com/user/gpendu/videos" id="footer_youtube"><img src="images/footer/yt.gif" alt="youtube" /></a>
				</p>
			</div>

			<!--==========================================================================
			FOOTER CENTRE
			===========================================================================-->
			<div id="f2">
				<h3>>> VOUS AVEZ BESOIN D'UN <strong>ANIMATEUR</strong> :</h3>
				<p>
					N'hésitez pas à me contacter.<br/>
					<strong><a id="footer_demande" href="index.php?page=5">Demande de devis gratuit !</a></strong>
				</p>
			</div>

			<!--==========================================================================
			FOOTER DROITE
			===========================================================================-->
			<div id="f3">
				<h3>>> COORDONNÉES DE GUY PEN'DU</h3>
				<p>
					<strong id="footer_tel">06 74 80 69 79</strong><br />
					<a href="mailto:guy.pendu@yahoo.fr" id="footer_mail">guy.pendu@yahoo.fr</a><br />
					SIRET : 80185954700011
				</p>
			</div>
			
			<!--==========================================================================
			COPYRIGHT
			===========================================================================-->
			<div id="copyright" class="gclaire">
				<p>COPYRIGHT 2014. TOUS DROITS RÉSERVÉS. WWW.NCHIPS.FR <?php if ($admin) { ?>(<a href="logout.php" onclick="return(confirm('Voulez-vous vous déconnecter ?'));" id="logout">Déconnexion</a>)<?php }?></p>
			</div>
		</div>
		
		<?php 
		//Fermer les requêtes SQL
		$reponse->closeCursor();	
		if ($admin) {
			if ($affichage_alert != 'ok') { ?>
			<script type="text/javascript">
				alert('<?php echo $affichage_alert; ?>');
			</script>
		<?php }
		} ?>
		<!-- Code Analytics -->
		<script type="text/javascript">
			function clearNom(CaseForm){
			document.getElementById(CaseForm).value="";
			}
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-44669612-1']);
			_gaq.push(['_trackPageview']);

			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>		
    </body>
</html>