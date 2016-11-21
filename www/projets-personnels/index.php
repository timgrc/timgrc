<?php 
require '../pages/base.php';
$page_titre = "Projets Personnels";
require '../pages/header.php';

$type_of_project = "personal";
$title = $personalprojects_title[$lang];

require '../projets/index.php';
require '../pages/footer.php'; ?>