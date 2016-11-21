<?php
if ($admin) {
	//==================================================================
	//SUPPRESSION DES MÉDIAS
	//==================================================================
	if (isset($_GET['nummedia'])) {
		$num_media = (int) $_GET['nummedia'];

		//Vérifier que le média est dans la bdd en comptant le nombre d'entrées
		$reponse = $bdd->prepare('SELECT COUNT(*) AS mediasidentiques FROM p4 WHERE i=:i');
		$reponse->execute(array(
				'i'=>$num_media
		));
		while($donnees = $reponse->fetch()) {
			$mediasidentiques = $donnees['mediasidentiques'];
		}
		
		if ($mediasidentiques != 0) {
		//Supprimer le fichier de l'image de l'actu
		$reponse = $bdd->prepare('SELECT * FROM p4 WHERE i=:nummedia');
		$reponse->execute(array(
			'nummedia'=>$num_media
			));
		while($donnees = $reponse->fetch()) {
			$nom_suppr_photo = $donnees['emplacement'];
			$photo_video = $donnees['photo'];
		}
		if ($photo_video==1) {
			unlink ('images/galerie/' . $nom_suppr_photo);
			unlink ('images/galerie/minis/' . $nom_suppr_photo);
		}
		$reponse = $bdd->prepare('DELETE FROM p4 WHERE i=:nummedia');
			$reponse->execute(array(
				'nummedia'=>$num_media
			));
		}
	}
	
	//==================================================================
	//INSERTION PHOTO
	//==================================================================
	if (isset($_POST['titre_photo'])) {
		if (isset($_FILES['img_photo']) AND $_FILES['img_photo']['size']!=0) {
			$nouveau_titre_photo = htmlspecialchars($_POST['titre_photo']);
			$nouveau_time_photo = $_POST['time_photo'];
			
			//Vérifier que la photo n'est pas déjà postée en comptant le nombre d'entrées identiques
			$reponse = $bdd->prepare('SELECT COUNT(*) AS photosidentiques FROM p4 WHERE titre=:titre AND timestamp=:timestamp AND photo=1');
			$reponse->execute(array(
					'titre'=>$nouveau_titre_photo,
					'timestamp'=>$nouveau_time_photo
			));
			while($donnees = $reponse->fetch()) {
				$photosidentiques = $donnees['photosidentiques'];
			}
		
			//Si la photo n'est pas déjà dans la bdd
			if ($photosidentiques==0) {
				$extensionu = strtolower(substr(strrchr($_FILES['img_photo']['name'],'.'),1));
				$nouvelle_photo = md5(uniqid(rand(), true)) . '.' . $extensionu ;
				$upload_img = upload('img_photo','images/galerie/' . $nouvelle_photo,10485760, array('png','gif','jpg','jpeg') );
				list($widthu, $heightu) = getimagesize('images/galerie/' . $nouvelle_photo);
				if ($widthu<$heightu) {
					$newwidthu = 170;
					$newheightu = $heightu * (170 / $widthu);
				} else {
					$newheightu = 170;
					$newwidthu = $widthu * (170 / $heightu);
				}
				$thumbu = imagecreatetruecolor($newwidthu, $newheightu);
				if ($extensionu == 'jpg' OR $extensionu == 'jpeg') {
					$sourceu = imagecreatefromjpeg('images/galerie/' . $nouvelle_photo);
				} elseif ($exxtensionu == 'gif') {
					$sourceu = imagecreatefromgif('images/galerie/' . $nouvelle_photo);
				} elseif ($extensionu == 'png') {
					$sourceu = imagecreatefrompng('images/galerie/' . $nouvelle_photo);
				}
				imagecopyresampled($thumbu, $sourceu, 0, 0, 0, 0, $newwidthu, $newheightu, $widthu, $heightu);
				
				if ($extensionu == 'jpg' OR $extensionu == 'jpeg') {
					$minicopie = imagejpeg($thumbu,'images/galerie/minis/' . $nouvelle_photo,100);
				} elseif ($extensionu == 'gif') {
					$minicopie = imagegif($thumbu,'images/galerie/minis/' . $nouvelle_photo);
				} elseif ($extensionu == 'png') {
					$minicopie = imagepng($thumbu,'images/galerie/minis/' . $nouvelle_photo,0);
				}
				imagedestroy($thumbu);
				
				if ($upload_img AND $minicopie) {
					$reponse = $bdd->prepare('INSERT INTO p4(timestamp, titre, emplacement, photo) VALUES(:timestamp, :titre, :emplacement, :photo)');
					$reponse->execute(array(
						'timestamp'=>$nouveau_time_photo,
						'titre'=>$nouveau_titre_photo,
						'emplacement'=>$nouvelle_photo,
						'photo'=>1
					));
					$affichage_alert = "Ajout de photo réussi.";
				} else {
					$affichage_alert = "Erreur : problème d\'upload de la photo.";
				}
			}
		} else { 
			$affichage_alert = "Erreur : pas de photo.";
		}
	}
	//==================================================================
	//MODIFIER PHOTO
	//==================================================================
	if (isset($_POST['i_photo'])) {
		$i = $_POST['i_photo'];
		$time_modifphoto = $_POST['time_modifphoto'];
		$titre_modifphoto = htmlspecialchars($_POST['titre_modifphoto']);
		
		$reponse = $bdd->prepare('SELECT COUNT(*) AS photosidentiques FROM p4 WHERE i=:i AND timestamp=:timestamp AND photo=1');
			$reponse->execute(array(
				'i'=>$i,
				'timestamp'=>$time_modifphoto
		));
		while($donnees = $reponse->fetch()) {
			$photosidentiques = $donnees['photosidentiques'];
		}
		
		if ($photosidentiques==0) {
			if (isset($_FILES['img_modifphoto']) AND $_FILES['img_modifphoto']['size']!=0) {
				$reponse = $bdd->prepare('SELECT * FROM p4 WHERE i=:i');
				$reponse->execute(array(
					'i'=>$i
					));
				while($donnees = $reponse->fetch()) {
					$p4_emplacement = $donnees['emplacement'];
				}
				
				$extensionu = strtolower(substr(strrchr($_FILES['img_modifphoto']['name'],'.'),1));
				$modif_photo = md5(uniqid(rand(), true)) . '.' . $extensionu;
				$upload_img = upload('img_modifphoto','images/galerie/' . $modif_photo,10485760, array('png','gif','jpg','jpeg') );

				list($widthu, $heightu) = getimagesize('images/galerie/' . $modif_photo);
				if ($widthu<$heightu) {
					$newwidthu = 170;
					$newheightu = $heightu * (170 / $widthu);
				} else {
					$newheightu = 170;
					$newwidthu = $widthu * (170 / $heightu);
				}
				$thumbu = imagecreatetruecolor($newwidthu, $newheightu);
				if ($extensionu == 'jpg' OR $extensionu == 'jpeg') {
					$sourceu = imagecreatefromjpeg('images/galerie/' . $modif_photo);
				} elseif ($extensionu == 'gif') {
					$sourceu = imagecreatefromgif('images/galerie/' . $modif_photo);
				} elseif ($extensionu == 'png') {
					$sourceu = imagecreatefrompng('images/galerie/' . $modif_photo);
				}
				imagecopyresampled($thumbu, $sourceu, 0, 0, 0, 0, $newwidthu, $newheightu, $widthu, $heightu);
				
				if ($extensionu == 'jpg' OR $extensionu == 'jpeg') {
					$minicopie = imagejpeg($thumbu,'images/galerie/minis/' . $modif_photo,100);
				} elseif ($extensionu == 'gif') {
					$minicopie = imagegif($thumbu,'images/galerie/minis/' . $modif_photo);
				} elseif ($extensionu == 'png') {
					$minicopie = imagepng($thumbu,'images/galerie/minis/' . $modif_photo,0);
				}
				imagedestroy($thumbu);

				if ($upload_img AND $minicopie) {
					//Insérer le nouveau message du livre d'or dans la bdd
					$reponse = $bdd->prepare('UPDATE p4 SET emplacement=:emplacement WHERE i=:i');
					$reponse->execute(array(
						'i'=>$i,
						'emplacement'=>$modif_photo
					));
					unlink ('images/galerie/' . $p4_emplacement);
					$affichage_alert = "Modification de photo réussi.";
				} else {
					$affichage_alert = "Erreur : problème d\'upload de la photo.";
				}		
			}			
			$reponse = $bdd->prepare('UPDATE p4 SET timestamp=:timestamp, titre=:titre WHERE i=:i');
			$reponse->execute(array(
				'i'=>$i,
				'timestamp'=>$time_modifphoto,
				'titre'=>$titre_modifphoto
			));
		}	
	}
	
	//==================================================================
	//INSERTION VIDEO
	//==================================================================
	//S'il y a une vidéo crééé avec les variables lien_video
	if (isset($_POST['lien_video'])) {
		$nouveau_titre_video = htmlspecialchars($_POST['titre_video']);
		$nouveau_lien_video = htmlspecialchars($_POST['lien_video']);
		$nouveau_time_video = $_POST['time_video'];
		
		if (substr($nouveau_lien_video,0,16) == 'http://youtu.be/') {
			
			$nouveau_lien_video = substr($nouveau_lien_video,16,strlen($nouveau_lien_video)-16);
			//Vérifier que la vidéo n'est pas déjà postée en comptant le nombre d'entrées identiques
			$reponse = $bdd->prepare('SELECT COUNT(*) AS videosidentiques FROM p4 WHERE timestamp=:timestamp AND emplacement=:emplacement');
			$reponse->execute(array(
					'timestamp'=>$nouveau_time_video,
					'emplacement'=>$nouveau_lien_video
			));
			while($donnees = $reponse->fetch()) {
				$videosidentiques = $donnees['videosidentiques'];
			}
		
			//Si la vidéo n'est pas déjà dans la bdd
			if ($videosidentiques==0) {
				//Insérer le nouveau message du livre d'or dans la bdd
				$reponse = $bdd->prepare('INSERT INTO p4(timestamp, titre, emplacement, photo) VALUES(:timestamp, :titre, :emplacement, :photo)');
				$reponse->execute(array(
					'timestamp'=>$nouveau_time_video,
					'titre'=>$nouveau_titre_video,
					'emplacement'=>$nouveau_lien_video,
					'photo'=>0
				));
			}
		}
	}
	//==================================================================
	//MODIFIER VIDÉO
	//==================================================================
	if (isset($_POST['i_video'])) {
		$i = $_POST['i_video'];
		$time_modifvideo = $_POST['time_modifvideo'];
		$titre_modifvideo = htmlspecialchars($_POST['titre_modifvideo']);
		$lien_modifvideo = htmlspecialchars($_POST['lien_modifvideo']);
		
		$reponse = $bdd->prepare('SELECT COUNT(*) AS videosidentiques FROM p4 WHERE i=:i AND timestamp=:timestamp AND photo=0');
			$reponse->execute(array(
				'i'=>$i,
				'timestamp'=>$time_modifvideo
		));
		while($donnees = $reponse->fetch()) {
			$videosidentiques = $donnees['videosidentiques'];
		}
		if ($videosidentiques==0) {
			if (substr($lien_modifvideo,0,16) == 'http://youtu.be/') {
				$lien_modifvideo = substr($lien_modifvideo,16,strlen($lien_modifvideo)-16);
				$reponse = $bdd->prepare('UPDATE p4 SET timestamp=:timestamp, titre=:titre, emplacement=:emplacement, photo=:photo WHERE i=:i');
				$reponse->execute(array(
					'i'=>$i,
					'timestamp'=>$time_modifvideo,
					'titre'=>$titre_modifvideo,
					'emplacement'=>$lien_modifvideo,
					'photo'=>0
				));
			}
		}
	}
}
?>

<div id="p4g">
	<h1>PHOTOS & VIDÉOS</h1>
	<div id="p4" class="content-dtk">
	<?php
	if ($admin) {
	?>
		<p class="p4pajout"><a class="fancybox p4ajoutlien" href="#inlineupload" title="AJOUTER UNE PHOTO">Ajouter une photo</a></p>
		<p class="p4pajout"><a class="fancybox p4ajoutlien" href="#inline_ajout_video" title="AJOUTER UNE VIDÉO">Ajouter une vidéo</a></p>

		<!--======================================================
		AJOUTER UNE PHOTO
		=======================================================-->
		<div id="inlineupload" style="width:650px;display: none;">
			<h2 class="titreajout">AJOUTER UNE PHOTO</h2>
			<form id="p4form_photo" method="post" action="index.php#page4" enctype="multipart/form-data">
				<p id="p4pform_photo">
					<input type="hidden" name="time_photo" value="<?php echo time();?>" />
					<span class="titre_ajout_photo_form">Photo :</span>
					<input type="file" name="img_photo" id="p4form_img_photo" /><br/><br/>
					<span class="titre_ajout_photo_form">Titre :</span>
					<input type="text" name="titre_photo" id="p4form_titre_photo" />
					<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
				</p>
			</form>			
		</div>
		
		<!--======================================================
		AJOUTER UNE VIDEO
		=======================================================-->
		<div id="inline_ajout_video" style="width:750px;display: none;">
			<form id="p4form_video" method="post" action="index.php#page4">
				<h2 class="titreajout">AJOUTER UNE VIDÉO</h2>
				<p id="p4pform_video">
					<input type="hidden" name="time_video" value="<?php echo time();?>" />
					<span class="titre_ajout_video_form">Titre :</span>
					<input type="text" name="titre_video" id="p4titre_video" /><br /><br />
					<span class="titre_ajout_video_form">Lien de la vidéo Youtube :<br />(<em>ex : http://youtu.be/kLzpI3T-5HU</em>)</span>
					<input type="text" name="lien_video" id="p4lien_video" />
					<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
				</p>
			</form>
		</div>
	<?php
	}
	?>
		<p>
			<?php 
			$j = 1;
			//Récupérer le contenu des actualités
			$reponse = $bdd->prepare('SELECT * FROM p4 ORDER BY i DESC');
			$reponse->execute();

			//Mettre le contenu de la page de la bdd en html
			while($donnees = $reponse->fetch()) {
				$i = $donnees['i'];
				$p4_timestamp = $donnees['timestamp'];
				$p4_emplacement = $donnees['emplacement'];
				$p4_titre = $donnees['titre'];
				$photo_video = $donnees['photo'];
				
				//Déterminer le format de la photo, horizontale ou verticale
				if ($photo_video == 1) $taille = getimagesize('images/galerie/' . $p4_emplacement);
				elseif ($photo_video == 0) $taille = getimagesize('http://img.youtube.com/vi/' . $p4_emplacement . '/0.jpg');

				if ($taille[0]>$taille[1]) {
					$taille_sup = 'minis_width_sup';
				}
				else {
					$taille_sup = 'minis_height_sup';
				}
			?>
			<div class="divimgp4" <?php if ($j==1) echo 'style="clear: both;"';?>>
				<?php 
				//Mettre la corbeille en haut à droite
				if($admin) { ?>
					<a href="<?php echo 'index.php?nummedia=' . $i . '#page4';?>" onclick="return(confirm('Voulez-vous supprimer cette <?php
					if ($photo_video == 0) echo 'vidéo';
					elseif ($photo_video == 1) echo 'photo';
					?> ?'));"><img src="images/admin/poubelle.png" alt="Corbeille" class="p4imgcorbeille" /></a><a class="fancybox" href="#p4_inline_modif<?php echo $i;?>"><img src="images/admin/modifier.png" alt="Modifier" class="p4imgmodif" /></a>
				<?php } 
				if ($photo_video == 1) { ?>
				<a class="fancybox-effects" href="images/galerie/<?php echo $p4_emplacement ;?>" data-fancybox-group="galerie" title="<?php echo $p4_titre ;?>">
					<img src="images/galerie/minis/<?php echo $p4_emplacement ;?>" alt="<?php echo $p4_titre ;?>" class="<?php echo $taille_sup;?>" />
				</a>
				<?php } elseif ($photo_video == 0) { ?>
					<a class="fancybox-media" href="http://www.youtube.com/watch?v=<?php echo $p4_emplacement ;?>" data-fancybox-group="galerie" title="<?php echo $p4_titre ;?>">
						<img src="<?php echo 'http://img.youtube.com/vi/' . $p4_emplacement . '/0.jpg' ;?>" alt="<?php echo $p4_titre ;?>" class="<?php echo $taille_sup;?>" />
					</a>
				<?php } ?>
			</div>
			<!--==============================================
			MODIFIER MEDIAS
			===============================================-->
			<?php if ($photo_video == 1) { ?>
				<!--======================================================
				MODIFIER UNE PHOTO
				=======================================================-->
				<div id="p4_inline_modif<?php echo $i;?>" style="width:650px;display: none;">
					<h2 class="titreajout">MODIFIER LA PHOTO</h2>
					<form id="p4form_photo" method="post" action="index.php#page4" enctype="multipart/form-data">
						<p id="p4pform_photo">
							<input type="hidden" name="i_photo" value="<?php echo $i;?>" />
							<input type="hidden" name="time_modifphoto" value="<?php echo time();?>" />
							<span class="titre_ajout_photo_form">Photo :</span>
							<input type="file" name="img_modifphoto" id="p4form_img_photo" /><br/><br/>
							<span class="titre_ajout_photo_form">Titre :</span>
							<input type="text" name="titre_modifphoto" value="<?php echo $p4_titre;?>" id="p4form_titre_photo" />
							<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
						</p>
					</form>			
				</div>
			<?php } elseif ($photo_video == 0) { ?>	
				<!--======================================================
				MODIFIER UNE VIDEO
				=======================================================-->
				<div id="p4_inline_modif<?php echo $i;?>" style="width:750px;display: none;">
					<form id="p4form_modifvideo" method="post" action="index.php#page4">
						<h2 class="titreajout">MODIFIER LA VIDÉO</h2>
						<p id="p4pform_video">
							<input type="hidden" name="i_video" value="<?php echo $i;?>" />
							<input type="hidden" name="time_modifvideo" value="<?php echo time();?>" />
							<span class="titre_ajout_video_form">Titre :</span>
							<input type="text" name="titre_modifvideo" value="<?php echo $p4_titre;?>" id="p4titre_video" /><br /><br />
							<span class="titre_ajout_video_form">Lien de la vidéo Youtube :<br />(<em>ex : http://youtu.be/kLzpI3T-5HU</em>)</span>
							<input type="text" name="lien_modifvideo" value="<?php echo 'http://youtu.be/' . $p4_emplacement;?>" id="p4lien_modifvideo" />
							<input type="image" src="images/admin/envoyer.png" name="image" id="p1envoyer" />
						</p>
					</form>
				</div>
			<?php }
				$j++;
			} ?>
		</p>
	</div>	
</div>

<!-- FANCYBOX -->
<script>
	$(document).ready(function() {
		/*
		 *  Simple image gallery. Uses default settings
		 */

		$('.fancybox').fancybox();
		
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',

				arrows : false,
				helpers : {
					media : {},
					buttons : {}
				}
			});
		
		// Set custom style, close if clicked, change title type and overlay color
		$('.fancybox-effects').fancybox({
			wrapCSS    : 'fancybox-custom',
			closeClick : true,

			openEffect : 'none',

			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				},
				thumbs : {
						width  : 80,
						height : 80
				}
			}
		});
	});
</script>

<?php
if ($admin) { ?> 
<!-- Javascript pour ajout de photos et vidéos -->
<script>
        // Fonctions de vérification du formulaire, elles renvoient "true" si tout est ok
        var checkvideo = {};
		checkvideo['p4lien_video'] = function(id) {
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
			var myFormVideo = document.getElementById('p4form_video');
            myFormVideo.onsubmit = function() {       
                var result = true;
                for (var l in checkvideo) {
                    result = checkvideo[l](l) && result;
                }
                return result;
            };		
        })();

</script>
<?php
}
?>