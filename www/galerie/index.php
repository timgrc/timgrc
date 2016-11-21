<?php
require '../pages/base.php';
$page_titre = $galerie_title[$lang];
// $page_css = "galerie";
$page_js = "galerie";
require '../pages/header.php';
?>

<div class="container-resp container-title">
	<div class="title">
		<h2><?php echo $galerie_title[$lang]; ?></h2>
	</div>
<!-- 	<div class="sous-grostitre">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br>Integer blandit nec quam id consectetur.</p>
	</div> -->
</div>	
<div class="container-resp"><section class="Collage"><?php
	foreach ( lireBD('img') as $key => $data ) { ?><a class="fancybox-effects" href="./photos/<?php echo $data['img']; ?>" data-fancybox-group="galerie" title="<?php echo $data['caption']; ?>"><img src="./photos/<?php echo $data['img']; ?>" style="height: 200px;" /></a><?php } 
	?></section></div>

<?php require '../pages/footer.php'; ?>