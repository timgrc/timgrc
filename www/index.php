<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>Sylvaine Hélary</title>
<meta name="description" content="Sylvaine Hélary">
<meta name="author" content="Sylvaine Hélary">
      
<!-- Favicons
    ================================================== -->
<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->

<link href="css/jplayer.css" rel="stylesheet" type="text/css" />

<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/fonts.css" rel="stylesheet">
<link href="css/home.css" rel="stylesheet">

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
</head>
<body>
<?php
//==========================================================================
//ADMIN
//==========================================================================
if (isset($_COOKIE['adminadmin'])) {
	$adminadmin = $_COOKIE['adminadmin'];
}
else {
	$adminadmin = false;
}
include('pages/bdd.php');
include('pages/lang.php');
$clairObscur = 'obscur';
include('pages/menu.php');

//==========================================================================
//CONNEXION BDD
//==========================================================================
?>
<script src="js/main.js"></script>
<script src="js/lang.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>