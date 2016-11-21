<?php 
require '../pages/base.php';
$page_titre = "Projets Collectifs";
require '../pages/header.php';

$type_of_project = "collective";
$title = $collectiveprojects_title[$lang];

require '../projets/index.php';
require '../pages/footer.php'; ?>