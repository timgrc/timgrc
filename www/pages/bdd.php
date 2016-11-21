<?php 
function connexionBD(){
	try {
	    $bdd = new PDO('mysql:host=localhost;dbname=sylvaine', 'phpmyadmin', '');
		$bdd->exec('SET CHARACTER SET utf8');
	}
	catch(Exception $e) {
	    die('Erreur : '.$e->getMessage());
	}
	return $bdd;
}

function lireBD($table,$whereI=false,$desc=false,$where=false,$requete=false){
	$bdd=connexionBD();
	if($requete==false){
		$requete = 'SELECT * FROM '.$table;
		if($where!=false){
			$requete = $requete.' WHERE '.$where;
		}elseif($whereI!=false){
			$requete = $requete.' WHERE i>='.$whereI;
		}
		if($desc){
			$requete = $requete.' ORDER BY i';
		}else{
			$requete = $requete.' ORDER BY i DESC';
		}
	}
	$reponse = $bdd->prepare($requete);
	$reponse->execute();
	$resultatSql = array();
	while($data = $reponse->fetch()) {
		array_push($resultatSql, $data); 
		
	}
	$reponse->closeCursor();
	return $resultatSql;
}
function supprimerBD($table,$i,$conditions=false){
	$bdd=connexionBD();
	if($conditions==false){
		$reponse = $bdd->exec('DELETE FROM '.$table.' WHERE i='.$i);
	}else{
		$reponse = $bdd->exec('DELETE FROM '.$table.' WHERE '.$conditions);
	}
}
function modifierBD($table,$variables,$i=0,$conditions=false){
	$bdd=connexionBD();
	$colonnesConditions=array();
	foreach ($variables as $key => $value){		
		array_push($colonnesConditions,$key.'=:'.$key);
	}
	$valeurs=implode(',',$colonnesConditions);

	if($conditions==false){
		$conditions = 'i='.$i;
	}
	$reponse = $bdd->prepare('UPDATE '.$table.' SET '.$valeurs.' WHERE '.$conditions);
	$reponse->execute($variables);
	$reponse->closeCursor();
}
function ajouterBD($table,$variables){
	$bdd=connexionBD();
	$colonnesTable=array();
	foreach ($variables as $key => $value){		
		array_push($colonnesTable,$key);
	}
	$colonnes='('.implode(',',$colonnesTable).')';
	$valeurs='(:'.implode(',:',$colonnesTable).')';

	$reponse = $bdd->prepare('INSERT INTO '.$table.$colonnes.' VALUES'.$valeurs);
	$reponse->execute($variables);
	$reponse->closeCursor();
}
function dernierId($table){
	$bdd=connexionBD();
	$id=0;
	$requete = 'SELECT i FROM '.$table;
	$reponse = $bdd->prepare($requete);
	$reponse->execute();
	$resultatSql = array();
	while($data = $reponse->fetch()) {
		if($id<$data['i']){
			$id=$data['i'];
		}
	}
	$reponse->closeCursor();
	return $id;
}
?>
