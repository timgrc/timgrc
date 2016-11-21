<?php
function strtoupperFr($string) {

   $string = strtoupper($string);

   $string = str_replace(

      array('é', 'è', 'ê', 'ë', 'à', 'â', 'î', 'ï', 'ô', 'ù', 'û'),

      array('É', 'È', 'Ê', 'Ë', 'À', 'Â', 'Î', 'Ï', 'Ô', 'Ù', 'Û'),

      $string

   );

   return $string;

}

function theLeastEmpty($string_priority, $string_other) {
	if ($string_priority != "") {
		return $string_priority;
	} elseif ($string_other != "") {
		return $string_other;
	} else {
		return "";
	}
}

function extractIframe($iframe) {
	$pattern = '/.*(<iframe.*<\/iframe>).*/';
	preg_match($pattern, $iframe, $matches);
	return $matches[0];
}

function upload($index, $destination, $maxsize = FALSE, $extensions = array('png','gif','jpg','jpeg')) {
   //Test1: fichier correctement uploadé
  if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
  if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
  $ext = strtolower(substr(strrchr($_FILES[$index]['name'],'.'),1));
  if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
  return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

function is_image($files) {
  return explode('/', $files['type'])[0]) == 'image';
}
?>
