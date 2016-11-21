<div class="container-resp gap-bottom">
	<div class="container-title">
		<div class="title">
			<h2><?php echo $title; ?></h2>
		</div>
	</div>

	<?php 
		foreach (lireBD('projects') as $key => $data) {

			if ($data['type'] == $type_of_project) { ?>
				<div class="container-resp container-bandeau lien-cliquable" style="background-image: url('../projets/<?php echo $data['img']; ?>');" lien="../inside-projects/?p=<?php echo $data['name']; ;?>">
					<div class="nom-bandeau"><?php echo $data['title']; ?></div>
				</div>
			<?php }
		}
	?>
</div>

