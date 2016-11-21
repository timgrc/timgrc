<?php
require '../pages/base.php';
$page_titre = $discography_title[$lang];
$page_css = "discographie";
require '../pages/header.php';
?>
	
<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $discography_title[$lang]; ?></h2>
		</div>
	</div>
	<div class="vignettes3-resp vignettes-resp">
		<?php 
		foreach (lireBD('discography') as $key => $data) {
			$music = explode(',', $data["music"]);
			$name_first_music = explode('.', $music[0]);
			array_pop($name_first_music);
			$name_first_music = trim(implode('', $name_first_music));
					
		?>		
			<div class="vignette3-resp vignette-resp">
				<div class="vignette-hover vignette3-hover jp-type-playlist jp-audio" id="<?php echo 'jp_container_' . $data['i']; ?>" role="application" aria-label="media player">
					<div id="<?php echo 'jquery_jplayer_' . $data['i']; ?>" class="jp-jplayer"></div>
					<div class="vignette3-hover-haut invisible-mode jp-playlist">
						<h2 class="titre-album"><?php echo $data["title$lang"]; ?></h2>
						<p class="sous-titre-album"><?php echo $data["subtitle$lang"]; ?></p>
						<ol>
							<li>&nbsp;</li>
						</ol>
						<p><?php echo $data["pres$lang"]; ?></p>
					</div>
					<div class="vignette3-hover-bas invisible-mode">
						<div class="jp-gui jp-interface">
							<div class="nom-titre"><?php echo trim($name_first_music); ?></div> 
							<div class="jp-controls">
								<div class="jp-previous bouton-controle" role="button" tabindex="0"></div>
								<div class="jp-play bouton-controle" role="button" tabindex="0"></div>
								<div class="jp-next bouton-controle" role="button" tabindex="0"></div>
							</div>
						</div>
						<?php
						if ($data["linktobuy"] != '') { ?>
							<div class="cart"><i class="fa fa-cart-plus lien-cliquable-ext" lien="<?php echo $data["linktobuy"]; ?>"></i></div>
						<?php } ?>
					</div>
				</div>
				<div class="vignette-front vignette3-front" style="background-image: url('music/covers/<?php echo $data["cover"]; ?>'); background-size: 100% 100%; background-position: contain;"></div>
			</div>
		<?php
		}
		?>
		<div style="clear: both;"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		<?php 
		foreach (lireBD('discography') as $key => $data) {
			$musics = explode(',', $data["music"]); ?>

		new jPlayerPlaylist({
			jPlayer: "<?php echo '#jquery_jplayer_' . $data['i']; ?>",
			cssSelectorAncestor: "<?php echo '#jp_container_' . $data['i']; ?>"
		}, [
			<?php 
			$js_music_array = [];
			foreach ($musics as $music) {
					$name_music = explode('.', $music);
					array_pop($name_music);
					$name_music = trim(implode('', $name_music));
					$music = trim($music);
					$js_music = "{ title:\"$name_music\", mp3:\"music/$music\"}";
					array_push($js_music_array,$js_music);	
			} 
			echo implode(', ', $js_music_array);
			?>
		], {
			swfPath: "../../dist/jplayer",
			supplied: "mp3",
			wmode: "window",
			useStateClassSkin: true,
			autoBlur: false,
			smoothPlayBar: true,
			keyEnabled: true
		}
		);

		<?php
		}
		?>
	});
</script>

<?php require '../pages/footer.php'; ?>