<?php
require '../pages/base.php';

$array_projects = array();
foreach (lireBD('projects') as $key => $data) {
	$array_projects[$data['name']] = $data['title']; 
}

if(isset($_GET['p'])) {
	if (array_key_exists($_GET['p'], $array_projects)) {
    	$project = $_GET['p'];
	} else {
		$project = "springroll";
	}
} else {
	$project = "springroll";
}

$page_titre = "Glowing Life";
$page_css = "inside-projects";
$page_js = "inside-projects";
require '../pages/header.php';

foreach (lireBD('insideprojects', false, false, "project=\"$project\"") as $key => $data) {
	${$data['type']}['fr'] = $data['titrefr'];
	${$data['type']}['en'] = $data['titreen'];

	$music = explode(',', $data["music"]);
	$name_first_music = explode('.', $music[0]);
	array_pop($name_first_music);
	$name_first_music = trim(implode('', $name_first_music));
}
?>

<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $array_projects[$project]; ?></h2>
		</div>
	</div>

	<div id="project_left">
		<div id="project-img"><img src="<?php echo $project; ?>.jpg" id="img_presentation" /></div>
		<div id="project_desc"><?php 
			echo theLeastEmpty($pres[$lang], $pres[$lang_barre[$lang]]);
		?></div>

		<?php
		if ($data['music'] != '') { ?>
		<div id="project_music" class="selection-musique">	
			<div class="disc-cover" style="background: url('<?php echo $project . '/' . $data['cover']; ?>'); background-size: 100% 100%; background-position: contain;"></div>
			<div class="disc-extracts">
				<div class="jp-type-playlist jp-audio" id="jp_container_1" role="application" aria-label="media player">
					<div id="jquery_jplayer_1" class="jp-jplayer"></div>
					<div class="jp-playlist invisible-mode">
						<ol>
							<li>&nbsp;</li>
						</ol>
					</div>
				
					<div class="jp-gui jp-interface">
						<div class="album-title"><?php echo $array_projects[$project]; ?></div> 
						<div class="nom-titre"><?php echo trim($name_first_music); ?></div> 
						<div class="jp-controls">
							<div class="jp-previous bouton-controle" role="button" tabindex="0"></div>
							<div class="jp-play bouton-controle" role="button" tabindex="0"></div>
							<div class="jp-next bouton-controle" role="button" tabindex="0"></div>
						</div>
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"></div>
							</div>
						</div>
						<div class="jp-time-holder">
							<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div><div class="slash-separator">/</div><div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		} 
		if ($data['video'] != '') {
			$iframes = explode(';;;', $data['video']);
			foreach ($iframes as $iframe) {
				echo extractIframe($iframe);	
			}
		}
		?>
	</div>
	<div id="project_next_concerts">
		<h2><?php echo $insideprojects_nextconcerts[$lang]; ?></h2>
		<?php
		$today = date('Ymd');
		
		$db_concerts = lireBD('concerts', false, false, false, "SELECT * FROM concerts WHERE date>=$today AND project=\"$project\" ORDER BY date");

		foreach ($db_concerts as $key => $data) { 
			$titre_lang = theLeastEmpty($data['titre'.$lang], $data['titre'.$lang_barre[$lang]]);
			$titre = $titre_lang == "" ? $array_projects[$project] : $titre_lang;
			$date = $data['date'];
			$concertsNumJour = substr($date, 6, 2);
		    $concertsNumMois = substr($date, 4, 2);
		    $concertsNumAnnee = substr($date, 0, 4);
		    $concerts_lieu = theLeastEmpty($data['lieu'.$lang], $data['lieu'.$lang_barre[$lang]]);
			?>
			<div class="next-concert">
				<div class="dates-concerts-gauche">
					<h3 class="dates-concerts-jour"><?php echo $concertsNumJour;?></h3>
					<p class="dates-concerts-mois-annee"><?php echo $mois[$lang][$concertsNumMois] . ' ' . $concertsNumAnnee; ?></p>	
				</div>
				<div class="next-concert-right">
					<div class="next-concert-title"><?php echo strtoupperFr($titre);?></div>
					<?php if($concerts_lieu != "") {
						?><div class="next-concert-place"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $concerts_lieu;?></div><?php
					} ?>
				</div>
			</div>
			<div style="clear: both; margin-bottom: 24px;"></div>
		<?php
		}

		if (empty($db_concerts)) { ?>
			<div class="next-concert">
				<div class="" style="width: 100%; padding-left: 0;">
					<div id="noconcert" class="next-concert-title" style="padding-left: 0;"><?php echo $insideprojects_noconcert[$lang]; ?></div>
				</div>
			</div>	
			<div style="clear: both; margin-bottom: 24px;"></div>
		<?php
		}
		?>		

	</div>
	<div style="clear: both;"></div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		<?php 
		$musics = $music; 
		?>

		new jPlayerPlaylist({
			jPlayer: "#jquery_jplayer_1",
			cssSelectorAncestor: "#jp_container_1"
		}, [
			<?php 
			$js_music_array = array();
			foreach ($musics as $music) {
					$name_music = explode('.', $music);
					array_pop($name_music);
					$name_music = trim(implode('', $name_music));
					$music = trim($music);
					$js_music = "{ title:\"$name_music\", mp3:\"$project/$music\"}";
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
	});
</script>

<?php require '../pages/footer.php'; ?>