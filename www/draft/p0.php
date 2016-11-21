<?php
//Si l'utilisateur est admin
if ($admin) { ?>

<!-- Javascript -->
<script type="text/javascript">
	bkLib.onDomLoaded(function() {
		new nicEditor({buttonList : ['bold','italic','underline','subscript','superscript']}).panelInstance('p0contenu1');
	});
</script>

<?php
	//Vérifier s'il y a un post du contenu
	if (isset($_POST['p0contenu1'])) {
		$nouveau_contenu1 = $_POST['p0contenu1'];
		$reponse = $bdd->prepare('UPDATE p0 SET contenu = :contenu WHERE nom =:nom');
		$reponse->execute(array(
			'contenu'=>$nouveau_contenu1,
			'nom'=>'contenu1'
		));
	}
}

//Récupérer le contenu de la page
$reponse = $bdd->prepare('SELECT * FROM p0 WHERE nom=:nom');
$reponse->execute(array(
	'nom'=>'contenu1'
));

//Mettre le contenu de la page de la bdd dans une variable
while($donnees = $reponse->fetch()) {
	$p0contenu1 = $donnees['contenu'];
}

//Si l'utilisateur est admin
if ($admin) {
//Formulaire de modification du contenu?>
	<form id="p0form" method="post" action="index.php">
		<p>
			<textarea name="p0contenu1" id="p0contenu1">
				<?php echo $p0contenu1; ?>
			</textarea>
			<input type="image" src="images/admin/envoyer.png" name="image" id="p0envoyer">
		</p>
	</form>
<?php }
else { 
//Affichage du contenu?>
	<div id="lanews">
		<?php echo $p0contenu1; ?>
	</div>
<?php } ?>

<p id="ensavoirplus">
	<a href="index.php#page2" id="lienesp">EN SAVOIR <span id="p0espace_plus"></span></a>
</p>