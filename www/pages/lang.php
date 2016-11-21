<?php 
$lang="fr";
if (isset($_COOKIE['lang'])) {
	if ($_COOKIE['lang']=="fr") {
		$lang="fr";
	} elseif ($_COOKIE['lang']=="en") {
		$lang="en";
	}
}
if (isset($_GET['lang'])) {
	if ($_GET['lang']=="fr") {
		setcookie('lang', 'fr', time() + 24*3600, '/', null, false, false);
		$lang = "fr";
	} elseif ($_GET['lang']=="en") {
		setcookie('lang', 'en', time() + 24*3600, '/', null, false, false);
		$lang = "en";
	} else {
		$lang = "fr";
	}
}

$lang_barre = array(
	"fr" => "en",
	"en" => "fr"
	);
?>