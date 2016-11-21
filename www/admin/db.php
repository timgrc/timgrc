<?php
include('../pages/bdd.php');

if(isset($_POST['action'])){
	$action     = $_POST['action'];
	$table      = $_POST['table'];
	$identifier = $_POST['identifier'];
  $post_json  = str_replace('\"', '"', $_POST['json']);
  $json       = json_decode($post_json, true);

	switch ($action) {
		case 'ajout':
			ajouterBD($table, $json);
			break;
		case 'modif1':
			modifierBD($table, $json, 0, "type=\"$identifier\"");
			break;
		case 'modif':
			modifierBD($table, $json, $identifier);
			break;
		case 'suppr':
			supprimerBD($table, $identifier);
			break;
	}
}
if(isset($_GET)){
	foreach ($_GET as $key => $value) {
		$typeDActionsGet=$key;
		switch ($typeDActionsGet) {
			case 'dernierId':
				echo dernierId($value);
				break;
		}
	}
}
// echo json_encode(lireBD($_GET['table']));

//json_encode($json_a_decoder,true)

// header('Location:'.$_SERVER['HTTP_REFERER']);
?>
