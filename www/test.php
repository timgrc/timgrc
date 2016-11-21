<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>Test</title>
<meta name="description" content="Sylvaine Hélary">
<meta name="author" content="Sylvaine Hélary">
      
<!-- Favicons
    ================================================== -->
<link rel="icon" type="image/x-icon" href="img/favicon.ico" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css"  href="css/lang.css">
<link href="css/modif.css" rel="stylesheet">

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/nicEdit.js"></script>

<style type="text/css">
	html,body{
		width: 100%;
	}
	#bouton{
		text-align: center; 
		margin: auto; 
		margin-top: 20px;
		width: 80px; 
		height: 30px; 
		line-height: 28px;
		border: 1px solid black;
		background-color: white;
	}
	#bouton:hover,#bouton:focus{
		cursor: pointer;
		background-color: lime;
	}
	.modifiable{
		margin: auto;
		margin-bottom: 40px; 
		width: 60%;
		padding: 10px;
	}

</style>
	
</head>
<body>
<?php
include('pages/bdd.php');

	foreach (lireBD('test','50',true) as $key => $data) {
		// echo '<strong>i</strong>:'.$data['i'].' <strong>type</strong>:'.$data['type'].' <strong>variable</strong>:'.$data['variable'].'<br>';
		// echo $key.' '.$value;	# code...
	}

		$bdd=connexionBD();
	// $i=22;
	 
	$reponse=$bdd->exec('SELECT IDENT_CURRENT("concerts") AS id');
	// print_r($reponse);

?>
	<div id="testons"></div>
	<div id="bouton" style="margin-top: 20px; margin-bottom: 40px;">OK</div>	
	
	<div id="myBigNicPanel" class="invisible-mode">
		<div id="bouton-enregistrer"><i class="fa fa-save"></i></div>
		<div id="myNicPanel"></div>
	</div>

	<div id="type" class="modifiable texte-initial" texteInitial='Type'></div>
	<div id="variable" class="modifiable texte-initial" texteInitial='Variable'></div>
	<div id="i" class="modifiable texte-initial" texteInitial='i'></div>
	
	<!-- <div id="test"><?php echo 'php:' . time(); ?></div> -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#bouton').on('click', function(){
			var json_ajout=JSON.stringify({'type':$('#type').html(),'variable':$('#variable').html()});
			$.post('admin/db.php',{'ajout_test':json_ajout});
			// post('admin/db.php',{['modif_test_'+$('#i').html()]:JSON.stringify({'type':$('#type').html(),'variable':$('#variable').html()})});
			// post('admin/db.php',{['suppr_test_'+$('#i').html()]:''});
			
			$.get(
			    'admin/db.php',
			    {table:'test'},
			    function(data){
			    	var donnees = JSON.parse(data);
			    	$(donnees).each(function(index,valeur){
			    		$('#testons').append('<strong>i</strong>:'+valeur['i']+' <strong>type</strong>:'+valeur['type']+' <strong>variable</strong>:'+valeur['variable']+'<br>');
			    	});
			    }
			);
			// $.post('admin/db.php',{"ajout_test_type":$('#type').html(),"ajout_test_variable":$('#variable').html()});
		});
	});

bkLib.onDomLoaded(function() { 
		var myNicEditor = new nicEditor({buttonList : ['bold','italic','underline','ol','ul','left','center','right','justify','fontSize','link','unlink']});
			myNicEditor.setPanel('myNicPanel');
			myNicEditor.addInstance('type');
			myNicEditor.addInstance('variable');
			myNicEditor.addInstance('i');
	});

</script>
<script src="js/modif.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></html>