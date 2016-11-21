<!-- Javascript -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<?php
//==================================================================
//INITIALISATION DES VARIABLES
//==================================================================
$mois_lettres = array(1 => 'JANV','FEVR','MARS','AVRIL','MAI','JUIN','JUIL','AOUT','SEPT','OCT','NOV','DEC');
$pasdetitre_actu = false;
$pasdemessage_actu = false;
$pasdemessage_concert = false;
$erreur_actu = 'ok';

if ($admin) { ?>

<script type="text/javascript">
	$(function() {
		$('#p1form_datepicker').datepicker({ dateFormat: "dd/mm/yy" });
	});
</script>


<?php
	//==================================================================
	//SUPPRESSION DE DONNEES ACTUS ET CONCERTS
	//==================================================================
	//Supprimer une actu de la bdd
	if (isset($_GET['numactu'])) {
		$num_actu = (int) $_GET['numactu'];
		
		//Vérifier que l'actu est dans la bdd en comptant le nombre d'entrées
		$reponse = $bdd->prepare('SELECT COUNT(*) AS actusidentiques FROM p1actus WHERE i=:i');
		$reponse->execute(array(
				'i'=>$num_actu
		));
		while($donnees = $reponse->fetch()) {
			$actusidentiques = $donnees['actusidentiques'];
		}
		
		if ($actusidentiques!=0) {
		//Supprimer le fichier de l'image de l'actu
		$reponse = $bdd->prepare('SELECT * FROM p1actus WHERE i=:numactu');
		$reponse->execute(array(
			'numactu'=>$num_actu
			));

		while($donnees = $reponse->fetch()) {
			$nom_suppr_image_actu = $donnees['image'];
		}
		unlink ('images/actus/' . $nom_suppr_image_actu);
		unlink ('images/actus/minis/' . $nom_suppr_image_actu);
		
		$reponse = $bdd->prepare('DELETE FROM p1actus WHERE i=:numactu');
		$reponse->execute(array(
			'numactu'=>$num_actu
			));
		}
	}
	
	//Supprimer un concert de la bdd
	if (isset($_GET['numconcert'])) {
		$num_concert = (int) $_GET['numconcert'];
		$reponse = $bdd->prepare('DELETE FROM p1concerts WHERE i=:numconcert');
			$reponse->execute(array(
				'numconcert'=>$num_concert
			));
	}
	
	//==================================================================
	//INSERTION ACTUALITE
	//==================================================================
	//S'il y a une actu créé avec les variables titre et message
	if (isset($_POST['titre_actu']) AND isset($_POST['message_actu'])) {

		$nouveau_titre_actu = htmlspecialchars($_POST['titre_actu']);
		$nouveau_message_actu = htmlspecialchars($_POST['message_actu']);
		
		//Vérifier que l'actu n'est pas déjà postée en comptant le nombre d'entrées identiques
		$reponse = $bdd->prepare('SELECT COUNT(*) AS actusidentiques FROM p1actus WHERE titre=:titre AND message=:message');
		$reponse->execute(array(
				'titre'=>$nouveau_titre_actu,
				'message'=>$nouveau_message_actu
		));
		while($donnees = $reponse->fetch()) {
			$actusidentiques = $donnees['actusidentiques'];
		}
	
		//Si le message n'est pas déjà dans la bdd
		if ($actusidentiques==0) {
			if (isset($_FILES['img_actu']) AND $_FILES['img_actu']['size']!=0) {
				$extensiona = strtolower(substr(strrchr($_FILES['img_actu']['name'],'.'),1));
				$nouveau_img_actu = md5(uniqid(rand(), true)) . '.' . $extensiona;
				$upload_img = upload('img_actu','images/actus/' . $nouveau_img_actu,10485760, array('png','gif','jpg','jpeg') );
				list($widtha, $heighta) = getimagesize('images/actus/' . $nouveau_img_actu);
				if ($widtha<$heighta) {
					$newwidtha = 120;
					$newheighta = $heighta * (120 / $widtha);
				} else {
					$newheighta = 120;
					$newwidtha = $widtha * (120 / $heighta);
				}
				$thumba = imagecreatetruecolor($newwidtha, $newheighta);
				if ($extensiona == 'jpg' OR $extensiona == 'jpeg') {
					$sourcea = imagecreatefromjpeg('images/actus/' . $nouveau_img_actu);
				} elseif ($extensiona == 'gif') {
					$sourcea = imagecreatefromgif('images/actus/' . $nouveau_img_actu);
				} elseif ($extensiona == 'png') {
					$sourcea = imagecreatefrompng('images/actus/' . $nouveau_img_actu);
				}
				imagecopyresampled($thumba, $sourcea, 0, 0, 0, 0, $newwidtha, $newheighta, $widtha, $heighta);
				
				if ($extensiona == 'jpg' OR $extensiona == 'jpeg') {
					$minia = imagejpeg($thumba,'images/actus/minis/' . $nouveau_img_actu,100);
				} elseif ($extensiona == 'gif') {
					$minia = imagegif($thumba,'images/actus/minis/' . $nouveau_img_actu,100);
				} elseif ($extensiona == 'png') {
					$minia = imagepng($thumba,'images/actus/minis/' . $nouveau_img_actu,100);
				}
				imagedestroy($thumba);
				
				if ($upload_img AND $minia) {
					$affichage_alert = "Ajout d\'actualité réussi.";
				} else {
					$affichage_alert = "Erreur : problème d\'upload de l\'image.";
				}
			} else { 
				$affichage_alert = "Ajout d'actualité sans image.";
				$nouveau_img_actu = "pasdimage";
			}
			//Insérer une actu dans la bdd
			$reponse = $bdd->prepare('INSERT INTO p1actus(titre, message, image) VALUES(:titre, :message, :image)');
			$reponse->execute(array(
				'titre'=>$nouveau_titre_actu,
				'message'=>$nouveau_message_actu,
				'image'=>$nouveau_img_actu
			));
		}	
	}
	//==================================================================
	//MODIFICATION ACTUALITÉ
	//==================================================================
	//S'il y a une actu modifié avec les variables titre et message
	if (isset($_POST['titre_modifactu']) AND isset($_POST['message_modifactu'])) {
		
		$titre_modifactu = htmlspecialchars($_POST['titre_modifactu']);
		$message_modifactu = htmlspecialchars($_POST['message_modifactu']);
		$i_modifactu = htmlspecialchars($_POST['i_modifactu']);
		
		//Vérifier que l'actu n'est pas déjà postée en comptant le nombre d'entrées identiques
		$reponse = $bdd->prepare('SELECT COUNT(*) AS actusidentiques FROM p1actus WHERE titre=:titre AND message=:message');
		$reponse->execute(array(
				'titre'=>$titre_modifactu,
				'message'=>$message_modifactu
		));
		while($donnees = $reponse->fetch()) {
			$actusidentiques = $donnees['actusidentiques'];
		}
		if (isset($_FILES['img_modifactu']) AND $_FILES['img_modifactu']['size']!=0) {
			//Récupérer le titre de l'image
			$reponse = $bdd->prepare('SELECT * FROM p1actus WHERE i=:i');
			$reponse->execute(array(
				'i'=>$i_modifactu
			));
			while($donnees = $reponse->fetch()) {
				$titre_fichierimg = $donnees['image'];
			}
			$affichage_alert = "Modification d\'image.";
			if ($titre_fichierimg=='pasdimage') {
				$titre_fichierimg = md5(uniqid(rand(), true)) . '.' . substr(strrchr($_FILES['img_modifactu']['name'],'.'),1);
			}
			$upload_img = upload('img_modifactu','images/actus/' . $titre_fichierimg,10485760, array('png','gif','jpg','jpeg') );
			
			$extensiona = strtolower(substr(strrchr($titre_fichierimg,'.'),1));
			list($widtha, $heighta) = getimagesize('images/actus/' . $titre_fichierimg);
			if ($widtha<$heighta) {
				$newwidtha = 120;
				$newheighta = $heighta * (120 / $widtha);
			} else {
				$newheighta = 120;
				$newwidtha = $widtha * (120 / $heighta);
			}
			$thumba = imagecreatetruecolor($newwidtha, $newheighta);
			if ($extensiona == 'jpg' OR $extensiona == 'jpeg') {
				$sourcea = imagecreatefromjpeg('images/actus/' . $titre_fichierimg);
			} elseif ($extensiona == 'gif') {
				$sourcea = imagecreatefromgif('images/actus/' . $titre_fichierimg);
			} elseif ($extensiona == 'png') {
				$sourcea = imagecreatefrompng('images/actus/' . $titre_fichierimg);
			}
			imagecopyresampled($thumba, $sourcea, 0, 0, 0, 0, $newwidtha, $newheighta, $widtha, $heighta);
			
			if ($extensiona == 'jpg' OR $extensiona == 'jpeg') {
				$minia = imagejpeg($thumba,'images/actus/minis/' . $titre_fichierimg,100);
			} elseif ($extensiona == 'gif') {
				$minia = imagegif($thumba,'images/actus/minis/' . $titre_fichierimg,100);
			} elseif ($extensiona == 'png') {
				$minia = imagepng($thumba,'images/actus/minis/' . $titre_fichierimg,100);
			}
			imagedestroy($thumba);			
		
			if ($upload_img AND $minia) {
				$affichage_alert = "Modification d\'image réussie.";
				//Modification d'une actu dans la bdd
				$reponse = $bdd->prepare('UPDATE p1actus SET image=:image WHERE i=:i');
				$reponse->execute(array(
					'image'=>$titre_fichierimg,
					'i'=>$i_modifactu
				));
			}
			else $affichage_alert = "Erreur : problème d\'upload de l\'image.";
		}

		//Si le message n'est pas déjà dans la bdd
		if ($actusidentiques==0) {
			//Modification d'une actu dans la bdd
			$reponse = $bdd->prepare('UPDATE p1actus SET titre=:titre, message=:message WHERE i=:i');
			$reponse->execute(array(
				'titre'=>$titre_modifactu,
				'message'=>$message_modifactu,
				'i'=>$i_modifactu
			));
			$affichage_alert = "Modification d\'actualité réussie.";
		}
	}	
	
	//==================================================================
	//INSERTION CONCERT
	//==================================================================
	//S'il y a un concert créé avec la variable message_concert
	if (isset($_POST['message_concert'])) {
		$nouveau_message_concert = htmlspecialchars($_POST['message_concert']);
		$nouveau_date_concert = htmlspecialchars($_POST['date_concert']);
							
		//Régler format date
		$form_date_jour = (int) substr($nouveau_date_concert, 0, 2);
		$form_date_mois = (int) substr($nouveau_date_concert, 3, 2);
		$form_date_annee = (int) substr($nouveau_date_concert, 6, 4);
		if ($form_date_jour>=1 AND $form_date_jour<=31 AND $form_date_mois>=1 AND $form_date_mois<=12) {
			if ($form_date_jour<=9) {
				$form_date_jour = '0' . $form_date_jour;
			}
			if ($form_date_mois<=9) {
				$form_date_mois = '0' . $form_date_mois;
			}
			
			$nouveau_date_concert  = $form_date_annee . $form_date_mois . $form_date_jour;
			
			//Vérifier que l'actu n'est pas déjà postée en comptant le nombre d'entrées identiques
			$reponse = $bdd->prepare('SELECT COUNT(*) AS concertsidentiques FROM p1concerts WHERE message=:message AND date=:date');
			$reponse->execute(array(
					'message'=>$nouveau_message_concert,
					'date'=>$nouveau_date_concert
			));
			while($donnees = $reponse->fetch()) {
				$concertsidentiques = $donnees['concertsidentiques'];
			}
		
			//Si le message n'est pas déjà dans la bdd
			if ($concertsidentiques==0) {
				//Insérer le nouveau message du livre d'or dans la bdd
				$reponse = $bdd->prepare('INSERT INTO p1concerts(message, date) VALUES(:message, :date)');
				$reponse->execute(array(
					'message'=>$nouveau_message_concert,
					'date'=>$nouveau_date_concert
				));
			}	
		}
	}
	
	//==================================================================
	//MODIFICATION CONCERT
	//==================================================================
	if (isset($_POST['message_modifconcert'])) {
		$message_modifconcert = htmlspecialchars($_POST['message_modifconcert']);
		$date_modifconcert = htmlspecialchars($_POST['date_modifconcert']);
		$i_modifconcert = htmlspecialchars($_POST['i_modifconcert']);
		if ($date_modifconcert!="") {		
			//Régler format date
			$form_date_jour = (int) substr($date_modifconcert, 0, 2);
			$form_date_mois = (int) substr($date_modifconcert, 3, 2);
			$form_date_annee = (int) substr($date_modifconcert, 6, 4);
			if ($form_date_jour>=1 AND $form_date_jour<=31 AND $form_date_mois>=1 AND $form_date_mois<=12) {
				if ($form_date_jour<=9) {
					$form_date_jour = '0' . $form_date_jour;
				}
				if ($form_date_mois<=9) {
					$form_date_mois = '0' . $form_date_mois;
				}
				
				$date_modifconcert  = $form_date_annee . $form_date_mois . $form_date_jour;
				
				//Vérifier que l'actu n'est pas déjà postée en comptant le nombre d'entrées identiques
				$reponse = $bdd->prepare('SELECT COUNT(*) AS concertsidentiques FROM p1concerts WHERE message=:message AND date=:date');
				$reponse->execute(array(
						'message'=>$message_modifconcert,
						'date'=>$date_modifconcert
				));
				while($donnees = $reponse->fetch()) {
					$concertsidentiques = $donnees['concertsidentiques'];
				}
			
				//Si le message n'est pas déjà dans la bdd
				if ($concertsidentiques==0) {
					//Insérer le nouveau message du livre d'or dans la bdd
					$reponse = $bdd->prepare('UPDATE p1concerts SET message=:message, date=:date WHERE i=:i');
					$reponse->execute(array(
						'message'=>$message_modifconcert,
						'date'=>$date_modifconcert,
						'i'=>$i_modifconcert
					));
				}	
			}
		}
	}
	
} ?>
<div id="p1">

	<h1>ACTUALITÉ</h1>
		
	<div id="p1gauche" class="content-dtk">

		<?php
		if ($admin) {
			?>
			<!--==============================================
			FORMULAIRE D'INSERTION D'ACTUALITÉ
			===============================================-->
			<p class="p1gajoutnews"><a class="fancybox p1gajoutnewslien" href="#inlineformactu" title="AJOUTER UNE ACTUALITÉ">Ajouter une actualité</a></p>
			<div id="inlineformactu" class="divfancyactu">
				<h2 class="titreajout">AJOUTER UNE ACTUALITÉ</h3>
				<form id="p1form_actu" method="post" action="index.php#page1" enctype="multipart/form-data">
					<p id="p1pform">
						<span class="titre_ajout_actu_form">Image :</span>
						<input type="file" name="img_actu" id="p1form_img_actu" /><br/><br/>
						<span class="titre_ajout_actu_form">Titre :</span>
						<input type="text" name="titre_actu" id="p1form_titre_actu" /><br /><br/>
						<span class="titre_ajout_actu_form">Texte :</span>
						<textarea name="message_actu" id="p1form_message_actu"></textarea>
						<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
					</p>
				</form>
			</div>
			<!--------------------------------------------->
		<?php	
		}

		//Récupérer le contenu des actualités
		$reponse = $bdd->prepare('SELECT * FROM p1actus ORDER BY i DESC');
		$reponse->execute();

		//Mettre le contenu de la page de la bdd en html
		while($donnees = $reponse->fetch()) {
			$i = $donnees['i'];
			$p1_image_actus = $donnees['image'];
			$p1_titre_actus = $donnees['titre'];
			
			//Remplacer les sauts de lignes par le code html <br /> 
			$p1_message_actus = preg_replace('#\n#', '<br />', $donnees['message']);
			
			if ($p1_image_actus!='pasdimage') {
				//Déterminer le format de la photo, horizontale ou verticale
				$taille = getimagesize('images/actus/' . $p1_image_actus);
				if ($taille[0]>$taille[1]) {
					$taille_sup = 'p1minis_width_sup';
				}
				else {
					$taille_sup = 'p1minis_height_sup';
				}
			}
			?>
			<!--==============================================
			AFFICHAGE DES ACTUALITÉS
			===============================================-->
			<p class="pimgactu"><?php 
			//Mettre la corbeille en haut à droite
			if($admin) { ?>
				<a href="<?php echo 'index.php?numactu=' . $i . '#page1';?>" onclick="return(confirm('Voulez-vous supprimer cette actualité ?'));"><img src="images/admin/poubelle.png" alt="Corbeille" class="p1gimgcorbeille" /></a><a class="fancybox" href="#inlinemodifactu<?php echo $i;?>"><img src="images/admin/modifier.png" alt="Modifier" class="p1gimgmodif" /></a>
			<?php } 
			if ($p1_image_actus=='pasdimage') echo '<br /><br />PAS D\'IMAGE';
			else {?><img src="images/actus/minis/<?php echo $p1_image_actus;?>" alt="Image actu" class="imgactu <?php echo $taille_sup;?>"/><?php } ?></p>
			<h2 class="p1titreactu"><?php echo $p1_titre_actus;?> :</h2>
			
			<p class="pactu"><?php 
			$stop_caractere = 240;
			$long_message = strlen($p1_message_actus);
			if($stop_caractere<$long_message) {
				while((substr($p1_message_actus, $stop_caractere, 1)!=" ") AND ($stop_caractere!=$long_message)) {
					$stop_caractere++;
				}
				if ($stop_caractere!=$long_message) {
				$lestroispoints = ' [...]';
				$lirelasuite = "(lire la suite)";
				} else {
					$lestroispoints = '';
					$lirelasuite = "(agrandir)";
				}
			} else {
				$lestroispoints = '';
				$lirelasuite = "(agrandir)";
			}
			echo substr($p1_message_actus, 0, $stop_caractere) . $lestroispoints;
			?> <a class="fancybox p1_lire_la_suite" href="#inlineactu<?php echo $i;?>" title="<?php echo $p1_titre_actus;?>"><?php echo $lirelasuite;?></a></p>
			
			<div id="inlineactu<?php echo $i;?>" class="divfancyactu">
				<p class="pfancyimgactu"><?php
				if ($p1_image_actus=='pasdimage') echo 'PAS<br />D\'IMAGE';
				else {?><img src="images/actus/<?php echo $p1_image_actus;?>" alt="Image actu" class="fancyimgactu"/><?php } ?></p>
				<h2 class="p1fancytitreactu"><?php echo $p1_titre_actus;?> :</h2>
				<p class="fancypactu">
					<?php echo $p1_message_actus;?>
				</p>
			</div>
			<!------------------------------------------------>
			<!--==============================================
			MODIFIER ACTUALITÉ
			===============================================-->
			<div id="inlinemodifactu<?php echo $i;?>" class="divfancyactu650">
				<h2 class="titreajout">MODIFIER UNE ACTUALITÉ</h3>
				<form id="p1form_modifactu" method="post" action="index.php#page1" enctype="multipart/form-data">
					<p id="p1pform">
						<input type="hidden" name="i_modifactu" value="<?php echo $i;?>" />
						<span class="titre_ajout_actu_form">Image :</span>
						<input type="file" name="img_modifactu" id="p1form_img_modifactu" /><br /><br />
						<span class="titre_ajout_actu_form">Titre :</span>
						<input type="text" name="titre_modifactu" id="p1form_titre_modifactu" value="<?php echo $p1_titre_actus;?>" /><br /><br />
						<span class="titre_ajout_actu_form">Texte :</span>
						<textarea name="message_modifactu" id="p1form_message_modifactu"><?php echo $donnees['message'];?></textarea>
						<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
					</p>
				</form>
			</div>
		<?php } ?>
	</div>
	
	<div id="p1droite">
		<h2>LES PROCHAINS<br />CONCERTS</h2>
		<div id="prochainsconcerts" class="content-dtk">
			<?php
			if ($admin) { ?>
				<!--==============================================
				INSERTION D'UN CONCERT
				===============================================-->
				<p class="p1gajoutnews"><a class="fancybox p1gajoutnewslien" href="#inlineformconcert" title="AJOUTER UN CONCERT">Ajouter un concert</a></p>
				<div id="inlineformconcert" class="divfancyactu650">
					<h2 class="titreajout">AJOUTER UN CONCERT</h2>
					<form id="p1form_concerts" method="post" action="index.php#page1">				
						<p>
							<!-- Calendrier -->
							<span class="titre_ajout_concert_form">Calendrier :</span>
							<input name="date_concert" type="text" id="p1form_datepicker"><br /><br />
							<span class="titre_ajout_concert_form">Texte :</span>
							<textarea name="message_concert" id="p1form_message_concert"></textarea>
							<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
						</p>
					</form>
				</div>
				<!----------------------------------------------->
				<!--==============================================
					AFFICHAGE CONCERTS
				===============================================-->
			<?php }
			
			//Récupérer le contenu des actualités
			$reponse = $bdd->prepare('SELECT * FROM p1concerts ORDER BY date ASC');
			$reponse->execute();
			
			//Mettre le contenu de la page de la bdd en html
			while($donnees = $reponse->fetch()) {
				$i = $donnees['i'];
				$p1_message_concerts = preg_replace('#\n#', '<br />', $donnees['message']);
				$dconcertformat = $donnees['date'];
				
				//Mettre la date du jour au format AAAAMMJJ
				$datejour = date('d/m/Y');
				$djour = explode("/", $datejour);
				$aujformat = $djour[2].$djour[1].$djour[0];
				
				if ($aujformat<=$dconcertformat) {
					$p1_jour_concerts = substr($dconcertformat, 6, 2);
					$p1_mois_concerts = (int) substr($dconcertformat, 4, 2);
					$p1_annee_concerts = (int) substr($dconcertformat, 0, 4);
					
					$p1_mois_concerts = $mois_lettres[$p1_mois_concerts];
				?>
					<!-- Calendrier -->
					<div class="divcalendrier">
					<?php 
					//Mettre la corbeille en haut à droite
					if($admin) { ?>
						<a href="<?php echo 'index.php?numconcert=' . $i . '#page1';?>" onclick="return(confirm('Voulez-vous supprimer ce concert ?'));"><img src="images/admin/poubelle.png" alt="Corbeille" class="p1dimgcorbeille" /></a><a class="fancybox" href="#inlineformmodifconcert<?php echo $i;?>"><img src="images/admin/modifier.png" alt="Modifier" class="p1gimgmodif" /></a>
					<?php } ?>
					<p class="moiscalendrier"><?php echo $p1_mois_concerts; ?></p><p class="jourcalendrier"><?php echo $p1_jour_concerts; ?></p>
					</div>
						
					<!-- Textes concerts -->
					<p class="pconcerts"><?php echo $p1_message_concerts;?></p>
				
					<!----------------------------------------------->
					<!--==============================================
					MODIFIER CONCERTS
					===============================================-->
					<script type="text/javascript">
						$(function() {
							$('#p1form_modifdatepicker<?php echo $i;?>').datepicker({ dateFormat: "dd/mm/yy" });
						});
					</script>
					<div id="inlineformmodifconcert<?php echo $i;?>" class="divfancyactu650">
						<h2 class="titreajout">AJOUTER UN CONCERT</h2>
						<form id="p1form_modifconcerts" method="post" action="index.php#page1">				
							<p>
								<!-- Calendrier -->
								<input type="hidden" name="i_modifconcert" value="<?php echo $i;?>" />
								<span class="titre_ajout_concert_form">Calendrier :</span>
								<input name="date_modifconcert" type="text" class="p1form_modifdatepicker" value="<?php echo $donnees['date'];?>" id="p1form_modifdatepicker<?php echo $i;?>"><br /><br />
								<span class="titre_ajout_concert_form">Texte :</span>
								<textarea name="message_modifconcert" id="p1form_modifmessage_concert"><?php echo $donnees['message'];?></textarea>
								<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
							</p>
						</form>
					</div>
			<?php 
				}
			} ?>
		</div>
	</div>
	
</div>

<?php
if ($admin) { ?>
<!-- Javascript pour insertion actualités -->
<script>	
        // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
        var checkactu = {}; // On met toutes nos fonctions dans un objet littéral
        checkactu['p1form_titre_actu'] = function(id) {
            var name = document.getElementById(id);
            if (name.value.length > 0) {
                name.style.background = 'white';
                return true;
            } else {
                name.style.background = '#ffa9a9';
                return false;
            }
		};
		
		checkactu['p1form_message_actu'] = function(id) {
            var name = document.getElementById(id);
            if (name.value.length > 0) {
                name.style.background = 'white';
                return true;
            } else {
                name.style.background = '#ffa9a9';
                return false;
            }
		};


        // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
        var checkconcert = {}; // On met toutes nos fonctions dans un objet littéral
        checkconcert['p1form_datepicker'] = function(id) {
            var name = document.getElementById(id);
            if (name.value.length > 0) {
                name.style.background = 'white';
                return true;
            } else {
                name.style.background = '#ffa9a9';
                return false;
            }
		};
		
		checkconcert['p1form_message_concert'] = function(id) {
            var name = document.getElementById(id);
            if (name.value.length > 0) {
                name.style.background = 'white';
                return true;
            } else {
                name.style.background = '#ffa9a9';
                return false;
            }
		};

        // Mise en place des événements
        (function() { // Utilisation d'une fonction anonyme pour éviter les variables globales.
            var myFormConcert = document.getElementById('p1form_concerts');
            myFormConcert.onsubmit = function() {       
                var result = true;
                for (var j in checkconcert) {
                    result = checkconcert[j](j) && result;
                }
                return result;
            };
			
			var myFormActu = document.getElementById('p1form_actu');
            myFormActu.onsubmit = function() {       
                var result = true;
                for (var i in checkactu) {
                    result = checkactu[i](i) && result;
                }
                return result;
            };
						
        })();

</script>
<?php } ?>