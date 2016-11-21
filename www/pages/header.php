<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>Sylvaine Hélary - <?php echo $page_titre; ?></title>
<meta name="description" content="Sylvaine Hélary">
<meta name="author" content="Sylvaine Hélary">

<!-- Favicons
    ================================================== -->
<link rel="icon" type="image/x-icon" href="../img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" /><![endif]-->

<link href="../css/jplayer.css" rel="stylesheet" type="text/css" />

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<?php
	if($adminadmin) echo "<link href=\"../css/modif.css\" rel=\"stylesheet\">";
?>
<link href="../css/fonts.css" rel="stylesheet">
<?php if (isset($page_css)) { ?>
	<link href="../<?php echo $page_css . '/' . $page_css; ?>.css" rel="stylesheet">
<?php } ?>

<script src="../js/jquery-1.11.2.min.js"></script>
<script src="../js/jquery.easing.min.js"></script>
<script src="../js/jquery-ui.js"></script>

<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>

<!--Musique -->

<!-- <script type="text/javascript" <script type="text/javascript"></script>="../js/jquery.jplayer.min.js"></script> -->
<script type="text/javascript" src="../js/jquery.jplayer.js"></script>
<script type="text/javascript" src="../js/jplayer.playlist.js"></script>

<!--==========================================================================
NICEDIT
===========================================================================-->
<script type="text/javascript" src="../js/nicEdit.js"></script>

<script src="../js/jquery.collagePlus.min.js"></script>
<script src="../js/jquery.removeWhitespace.min.js"></script>
<script src="../js/jquery.collageCaption.min.js"></script>

<!--==========================================================================
FANCYBOX
===========================================================================-->
<script type="text/javascript" src="../fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="../fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>


<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="loader"></div>
<?php
require '../pages/menu.php';

if($adminadmin){ ?>
	<div id="myBigNicPanel" class="invisible-mode">
		<div id="bouton-enregistrer"><i class="fa fa-save"></i></div>
		<div id="myNicPanel"></div>
	</div>
<?php } ?>
