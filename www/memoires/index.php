<?php
require '../pages/base.php';
$page_titre = $memories_title[$lang];
$page_css = "memoires";
$page_js = "memoires";
require '../pages/header.php';
?>

<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $memories_title[$lang]; ?></h2>
		</div>
		<!-- <div class="sous-grostitre">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
		</div> -->
	</div>
	<div class="vignettes4-resp vignettes-resp">
	<?php 
	foreach (lireBD('memories') as $key => $data) { 
	?>
		<div class="vignette4-resp vignette-resp lien-cliquable-ext" style="background-image: url('<?php echo $data['img']; ?>');" lien="<?php echo $data['linkoldgroup']; ?>">
			<div class="vignette-hover vignette4-hover">
				<h2 class="vignette4-titre"><?php echo $data['oldgroup']; ?></h2>
			</div>
			<div class="vignette-front vignette4-front">
				<h2 class="vignette4-titre titre-normal-mode"><?php echo $data['oldgroup']; ?></h2>	
			</div>
		</div>
	<?php } ?>
		<div style="clear: both;"></div>
	</div>
</div>

<?php require '../pages/footer.php'; ?>