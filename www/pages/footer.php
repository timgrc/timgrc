<?php
foreach (lireBD('copyright') as $key => $data) {
	${$data['type']}['fr'] = $data['titrefr'];
	${$data['type']}['en'] = $data['titreen'];
}
?>
<div id="footer">
	<div class="container-resp">
		<div>
			<div class="bloc-footer footer-gauche">
				<p><?php echo $equipe[$lang]; ?></p>
			</div>
			<div class="bloc-footer footer-droite">
				<h2>Contact</h2>
				<p class="liens-logos">
					<span class="association"><?php echo $association[$lang]; ?>, 3 rue du Clos - 75020 Paris</span><br>
					<a href="mailto:sybillemusique@gmail.com" class="email">sybillemusique@gmail.com</a><br>
					<a href="tel:+33683295636" class="telephone">(+33)6 83 29 56 36</span><br>
				</p>
				<p class="liens-logos">
					<a href="https://www.facebook.com/Sylvaine-H%C3%A9lary-S-Y-B-I-L-L-E-1541943572792362/"><i class="fa fa-facebook"></i></a>
					<a href="https://soundcloud.com/search?q=Sylvaine%20H%C3%A9lary"><i class="fa fa-soundcloud"></i></a>
					<!-- <a href="mailto:sybillemusique@gmail.com"><i class="fa fa-envelope"></i></a> -->
					<a href="https://www.youtube.com/results?search_query=Sylvaine+H%C3%A9lary"><i class="fa fa-youtube-play"></i></a>
					<a href="https://vimeo.com/channels/730707"><i class="fa fa-vimeo"></i></a>
					<!-- <a href="http://google.plus.com"><i class="fa fa-google-plus"></i></a> -->
				</p>
			</div>
		</div>
		<div class="copyright">
			<a class="copyright_admin" ondblclick="window.open('../admin/', '_self');">©</a> <?php echo Date('Y'); ?> Sylvaine Hélary. <?php echo $allright[$lang]; ?> <a class="link_nchips" href="http://wwW.nchips.fr">N'Chips Création</a>
		</div>
	</div>
</div>
<script src="../js/main.js"></script>
<script src="../js/modif.js"></script>
<?php if (isset($page_js)) { ?>
	<script src="../<?php echo $page_js . '/' . $page_js; ?>.js"></script>
<?php } ?>
<script src="../js/bootstrap.min.js"></script>
<!-- <script src="../js/loader.js"></script> -->
</body></html>
