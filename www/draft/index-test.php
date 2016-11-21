<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sylvaine Hélary</title>
<meta name="description" content="Sylvaine Hélary">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css"  href="draft/reset.css">
<link rel="stylesheet" type="text/css" href="css/animate.min.css">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script async="" src="draft/Tío Luchín - Cocina en vivo_files/analytics.js"></script><script src="./Tío Luchín - Cocina en vivo_files/jquery-1.11.2.min.js"></script>
<script src="draft/Tío Luchín - Cocina en vivo_files/jquery.easing.min.js"></script>
<script src="draft/Tío Luchín - Cocina en vivo_files/jquery-ui.js"></script>
<!--link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"-->
<script type="text/javascript" async="" src="draft/Tío Luchín - Cocina en vivo_files/jquery.slimscroll.min.js"></script>
<script type="text/javascript" async="" src="draft/Tío Luchín - Cocina en vivo_files/jquery.appear.js"></script>


<script type="text/javascript">

</script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<?php
//==========================================================================
//CONNEXION BDD
//==========================================================================
//try {
	//include('pages/bdd.php');
	//$bdd->exec('SET CHARACTER SET utf8');
//}
//catch(Exception $e) {
	//die('Erreur : '.$e->getMessage());
//}
//==========================================================================
//ADMIN
//==========================================================================
include('pages/admin.php');
?>

</head>
<body>

<header class="">
  <div class="bt-menu" style="left: 23px;"><i></i><i></i><i></i></div>
  <nav style="left: -250px;"> <i></i>
    <ul>
      <li class="inicio active" data-link="inicio"><a href="http://www.tioluchin.com/#">Sylvaine Hélary</a></li>
      <li class="inicio active" data-link="inicio"><a href="http://www.tioluchin.com/#">l’air du moment</a></li>
      <li class="historia" data-link="historia"><a href="http://www.tioluchin.com/#">projets personnels</a></li>
      <li class="cocina" data-link="cocina"><a href="http://www.tioluchin.com/#">projets collectifs</a></li>
      <li class="cotizar" data-link="cotizar"><a href="http://www.tioluchin.com/#">collaborations</a></li>
      <li class="hablemos" data-link="hablemos"><a href="http://www.tioluchin.com/#">discographie</a></li>
      <li class="hablemos" data-link="hablemos"><a href="http://www.tioluchin.com/#">à propos</a></li>
      <li class="hablemos" data-link="hablemos"><a href="http://www.tioluchin.com/#">mémoires</a></li>
      <li class="hablemos" data-link="hablemos"><a href="http://www.tioluchin.com/#">rencontres fleuries</a></li>       
    </ul>
  </nav>
</header>
<script type="text/javascript" src="js/menu.js"></script>
</body>
</html>