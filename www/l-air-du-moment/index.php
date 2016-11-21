<?php
require '../pages/base.php';

$page_titre = "L'Air du Moment";
$page_css = "l-air-du-moment";
$page_js = "l-air-du-moment";

require '../pages/header.php';

$array_projects = array();
foreach (lireBD('projects') as $key => $data) {
	$array_projects[$data['name']] = $data['title'];
}
?>

<div class="container-resp">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $lair_firsttitle[$lang]; ?></h2>
		</div>
	</div>
	<div class="container-resp">
		<div class="l-air-du-moment-une container-resp">
			<div class="bouton-ecouter <?php if ($adminadmin) echo 'desactive-bouton-ecouter'; ?>"><i class="fa fa-play-circle-o"></i> <?php echo $lair_ecouter[$lang]; ?></div>
			<img src="spring-roll.jpg" class="l-air-du-moment-img" alt="Sylvaine Hélary"/>
				<h2><?php echo $lair_firstdesctitle[$lang]; ?></h2>
				<p id="firstdesctext" bdtable="general" bdcol="titre<?php echo $lang; ?>" class="modifiable"><?php echo $lair_firstdesctext[$lang]; ?></p>
		</div>
	</div>
</div>

<div class="popup-vignette-resp" id="popup-ecouter">
	<div class="popup-vignette-resp-content">
		<div class="close"><i></i><i></i></div>
		<h2><a href="https://vimeo.com/80817169">SPRING ROLL Teaser</a></h2>
		<br>
		<iframe src="https://player.vimeo.com/video/80817169" style="width: 100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>
</div>

<div style="clear: both;" class="gap-bottom"></div>

<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $lair_secondtitle[$lang]; ?></h2>
		</div>
	</div>

	<div id="testons">
	</div>

	<?php
	$base = true;
	if($adminadmin){
		$_GET['concerts']='to_change';
		// $_GET['concerts_index'] = 238;
		require '../admin/concerts.php';
	}
	$_GET['concerts']='to_see';
	// $_GET['concerts_index'] = 'last';
	require '../admin/concerts.php';
	?>
</div>
<div style="clear: both;"></div>

<!--
<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2>Articles de <span class="titre-colore">presse</span></h2>
		</div>
		<div class="sous-grostitre">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
		</div>
	</div>
	<div class="vignettes3-resp vignettes-resp">
	<?php
	for ($i = 1; $i <= 3; $i++){
	?>
		<div class="vignette3-resp vignette-resp">
			<div class="vignette-front vignette3-front">
				<h2>L'Est élair</h2>
				<p></p>
				<p class="vignette-signature">L'est-éclair, janvier 2012</p>
			</div>
		</div>
	<?php } ?>
		<div id="popup-dossiers-de-presse1" class="popup-vignette-resp">
			<div class="popup-vignette-resp-content">
				<div class="close"><i></i><i></i></div>
				<h2>L'EST ECLAIR</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
				<p class="vignette-signature">L'est-éclair, janvier 2012</p>
				<iframe src="https://player.vimeo.com/video/163142805?portrait=0" style="width: 100%" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
</div>
-->

<?php
if ($adminadmin) { ?>
<script type="text/javascript">
  var myNicEditor = new nicEditor({buttonList : ['bold','italic','underline','ol','ul','left','center','right','justify','fontSize','link','unlink']});
  myNicEditor.setPanel('myNicPanel');
  bkLib.onDomLoaded(function() {
    myNicEditor.addInstance('firstdesctext');
    myNicEditor.addInstance('ajout-concerts-titrefr0');
    myNicEditor.addInstance('ajout-concerts-titreen0');
    myNicEditor.addInstance('ajout-concerts-lieufr0');
    myNicEditor.addInstance('ajout-concerts-lieuen0');
    myNicEditor.addInstance('ajout-concerts-lien0');
  });
</script>
<?php }
require '../pages/footer.php'; ?>
