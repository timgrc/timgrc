<?php
require '../pages/base.php';
$page_titre = "Rencontres Fleuries";
$page_css = "rencontres-fleuries";
require '../pages/header.php';
?>

	
<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $flowermeetings_title[$lang]; ?></h2>
		</div>
		<div class="sous-grostitre">
			<p><?php echo $flowermeetings_subtitle[$lang]; ?></p>
		</div>
	</div>
	<div class="vignettes3-resp vignettes-resp">

		<?php
		foreach (lireBD('flowermeetings') as $key => $data) { ?>
			<div class="vignette3-resp vignette-resp">
				<div class="vignette-front vignette3-front" style="background-image: url('<?php echo $data['img']; ?>');">
					<h2 class="vignette3-titre"><?php echo $data['titre' . $lang]; ?></h2>
				</div>
			</div>
		

		<!-- <div id="popup-dossiers-de-presse1" class="popup-vignette-resp">
			<div class="popup-vignette-resp-content">
				<div class="close"><i></i><i></i></div>
				<h2>LE TITRE</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
			</div>
		</div> -->	

		<?php } ?>	
		<div style="clear: both;"></div>
	</div>
</div>

<?php require '../pages/footer.php'; ?>