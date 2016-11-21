<?php
require '../pages/base.php';
$page_titre = $apropos_title[$lang];
$page_css = "a-propos";
require '../pages/header.php';
?>

<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $apropos_title[$lang]; ?></h2>
		</div>
	</div>

	<div class="container-resp container-bandeau lien-cliquable" style="background-image: url('biographie.jpg');" lien="../biographie">
		<div class="nom-bandeau"><?php echo $apropos_biography[$lang]; ?></div>
	</div>
	
	<div class="container-resp container-bandeau lien-cliquable" style="background-image: url('galerie.jpg');" lien="../galerie">
		<div class="nom-bandeau"><?php echo $apropos_galery[$lang]; ?></div>
	</div>

	<div class="container-resp container-bandeau lien-cliquable" style="background-image: url('espacepro.jpg');" lien="../espace-pro">
		<div class="nom-bandeau"><?php echo $apropos_prospace[$lang]; ?></div>
	</div>
</div>

<?php require '../pages/footer.php'; ?>