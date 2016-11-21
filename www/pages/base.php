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

require '../pages/functions.php';
require '../pages/bdd.php';
require '../pages/lang.php';
require '../pages/mois.php'; 

foreach (lireBD('general') as $key => $data) {
	${$data['type']}['fr'] = $data['titrefr'];
	${$data['type']}['en'] = $data['titreen'];
}
?>