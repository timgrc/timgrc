<?php
  $point_index = ".";
  if(isset($clairObscur)) {
    $clairObscur=$clairObscur;
    $point_index = "";
  } else {
    $clairObscur='clair';
  }
  foreach (lireBD('menu') as $key => $data) {
    ${$data['type']} = $data['texte'.$lang];
  }
  $url = $_SERVER['REQUEST_URI'];
  $url = preg_replace('/\&?lang=(fr|en)/', '', $url);

  $split_url = preg_split("/[\?]/", $url);
  $url = preg_replace('/\?/', '', $url);
  $new_url = $split_url[0] . '?';

  if (isset($split_url[1])) {
    if($split_url[1] != "") {
      $new_url .= preg_replace('/^\&/', '', $split_url[1]) . '&';
    }
  }
?>

<header>
  <div class="bt-menu <?php echo 'rondMenu-' . $clairObscur; ?>"><i></i><i></i><i></i></div>
  <nav>
    <ul>
      <li><a href="<?php echo $point_index; ?>./">Sylvaine Hélary</a></li>
      <li><a href="<?php echo $point_index; ?>./l-air-du-moment"><?php echo $menu1;?></a></li>
      <li><a href="<?php echo $point_index; ?>./projets-personnels"><?php echo $menu2;?></a></li>
      <li><a href="<?php echo $point_index; ?>./projets-collectifs"><?php echo $menu3;?></a></li>
      <li><a href="<?php echo $point_index; ?>./collaborations"><?php echo $menu4;?></a></li>
      <li><a href="<?php echo $point_index; ?>./discographie"><?php echo $menu5;?></a></li>
      <li><a href="<?php echo $point_index; ?>./a-propos"><?php echo $menu6;?></a></li>
      <li><a href="<?php echo $point_index; ?>./memoires"><?php echo $menu7;?></a></li>
      <li><a href="<?php echo $point_index; ?>./rencontres-fleuries"><?php echo $menu8;?></a></li>
      <?php
      if ($clairObscur == "obscur") {
      ?>
        <li id="copyright-photo">© <?php echo $copyrightphoto;?></li>
      <?php } ?>
    </ul>
  </nav>

</header>
<div class="container-resp block-lang" style="margin-top: 0;">
  <div class="langage lang-<?php echo $clairObscur; ?>">
        <a href="<?php echo $new_url; ?>lang=fr" class="lang <?php if($lang=='fr') echo 'lang-active';?>">FR</a> / <a href="<?php echo $new_url; ?>lang=en" class="lang <?php if($lang=="en") echo 'lang-active';?>">EN</a><?php if ($adminadmin) { ?>&nbsp;-&nbsp;<a href="../pages/logout.php" class="lang">Déconnexion</a><?php } ?>
  </div>
</div>
