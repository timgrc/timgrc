$(document).ready(function() {
	//dossiers-de-presse
	var modal = document.getElementById('popup-dossiers-de-presse1');
	var xclose = document.getElementsByClassName("close")[0];
	$('.vignette-resp').on('click', function(){
		modal.style.display = "block";
	});
	
	xclose.onclick = function() {
    	modal.style.display = "none";
	}

	//Réserver
	$('.bouton-reserver').on('click', function(){

	});
});

function auRedim(){
	vignette4w();
}

window.onresize = function (){auRedim();};
window.onload = function (){auRedim();};