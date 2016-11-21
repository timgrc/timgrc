<?php
require '../pages/base.php';
$page_titre = "Collaborations";
$page_css = "collaborations";
$page_js = "collaborations";
require '../pages/header.php';
?>

<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2>Collaborations</h2>
		</div>
		<!-- <div class="sous-grostitre">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
		</div> -->
	</div>
	<div class="vignettes4-resp vignettes-resp">
	<?php 
	foreach (lireBD('collaborations', false, true) as $key => $data) { 
	?>
		<div class="vignette4-resp vignette-resp lien-cliquable-ext" style="background-image: url('<?php echo $data['img']; ?>');" lien="<?php echo $data['link']; ?>">
			<div class="vignette-hover vignette4-hover">
				<h2 class="vignette4-titre"><?php echo $data['title']; ?></h2>
			</div>
			<div class="vignette-front vignette4-front">
				<h2 class="vignette4-titre titre-normal-mode"><?php echo $data['title']; ?></h2>	
			</div>
		</div>
	<?php } ?>
		<!-- <div id="popup-dossiers-de-presse1" class="popup-vignette-resp">
			<div class="popup-vignette-resp-content">
				<div class="close"><i></i><i></i></div>
				<h2>LE TITRE</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
			</div>
		</div> -->
		<div style="clear: both;"></div>
	</div>
</div>

<?php require '../pages/footer.php'; ?>