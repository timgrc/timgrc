$(document).ready(function() {
	//btmenu
	$('.bt-menu').on('click', function(){		
		if($(this).hasClass('open')){
			fermerMenu();
		}else{
			ouvrirMenu();
		}
		$(this).toggleClass('open');
	});

	//lang
	$('.lang').on('click', function(){
		$(this).addClass('lang-active');
	});

	$('.vignette-resp').on('click', function(){
		var hoverhaut = $(this).find('.vignette3-hover-haut');
		var hoverbas = $(this).find('.vignette3-hover-bas');

		//Refermer les autres lecteurs
		if($('.vignettes-resp div').hasClass('selection-musique') && !($(this).hasClass('selection-musique'))){
			var vignetteselectionnee = $('.vignettes-resp .selection-musique');
			var jp_jplayer = $('.vignettes-resp .selection-musique .vignette-hover .jp-jplayer');
			jp_jplayer.jPlayer("stop");
			fermerLecteur(vignetteselectionnee.find('.vignette3-hover-haut'),vignetteselectionnee.find('.vignette3-hover-bas'));
			vignetteselectionnee.removeClass('selection-musique');
		}

		//Ouvrir le lecteur
		if(hoverhaut.hasClass("invisible-mode")){
			ouvrirLecteur(hoverhaut,hoverbas);
			$(this).addClass("selection-musique");
		}
	});

	$('.vignette3-hover-haut').on('click', function(){
		var hover = $(this).parent();
		var vignette = hover.parent();
		var hoverhaut = $(this);
		var hoverbas = hover.find('.vignette3-hover-bas');
		fermerLecteur(hoverhaut,hoverbas);
		vignette.removeClass('selection-musique');
	});

	$('.lien-cliquable').on('click', function(){
			window.open($(this).attr('lien'),"_self");
	});

	$('.lien-cliquable-ext').on('click', function(){
			window.open($(this).attr('lien'));
	});

});

$(window).load(function(){	
		$(".vignette3-hover-haut").mCustomScrollbar({axis:"y",theme:"minimal"});
	});

/////FONCTIONS

//OuvrirLecteur
function ouvrirLecteur(hoverhaut,hoverbas){
	hoverhaut.removeClass("invisible-mode")
	hoverbas.removeClass("invisible-mode");

	hoverhaut.animate({'height':'210px','top':'0px'}, 400, 'easeOutQuart');
	hoverbas.animate({'height': '89px','top':'210px'}, 400, 'easeOutQuart');
}

//FermerLecteur
function fermerLecteur(hoverhaut,hoverbas){
	hoverhaut.animate({'height': '0px','top':'-215px'}, 400, 'easeInQuart');
	hoverbas.animate({'height': '0px','top':'305px'}, 400, 'easeInQuart');
	
	setTimeout(function(){hoverhaut.addClass("invisible-mode");hoverbas.addClass("invisible-mode");},400);
}

//Ouvrir
function ouvrirMenu(){	
	$('header').addClass('op');
var menu = $('nav');
	btMenu = $('.bt-menu');
	li = menu.find('li');
	li.removeClass('view');
	btMenu.animate({'left':250}, 200, 'easeOutQuart', function(){
		menu.animate({'left': 0}, 300, 'easeOutQuart', function(){
			var i = 0;
			var menuX = setInterval(function() {
					li.eq(i).addClass('view')
					i++;
					if(i > li.length){
						clearInterval(menuX);	
					}
				}, 100);	
		});	
	});
}
//Fermer
function fermerMenu(){
	$('header').removeClass('op');
var menu = $('nav');
	btMenu = $('.bt-menu');
	li = menu.find('li');		
	li.each(function(index, element) {
		$(this).removeClass('view');
	});
	menu.animate({'left':'-280px'}, 300, 'easeInQuart');
	btMenu.animate({'left': '23px'}, 100, 'easeInQuart');
}
// 
function vignette4w(){
	var vignette4width = $('.vignette4-resp').outerWidth();
	$('.vignette4-resp').css({'height' : vignette4width });
	$('.vignette4-hover').css({'width' : vignette4width, 'height' : vignette4width });
	$('.vignette4-front').css({'width' : vignette4width,'height' : vignette4width });

	var hauteurTitreVignette4;
	var margeHauteTitreVignette4;
	$('.vignette4-titre').each(function(){
		hauteurTitreVignette4 = $(this).outerHeight();
		margeHauteTitreVignette4 = (vignette4width - hauteurTitreVignette4)/2;
		$(this).css({'margin-top' : margeHauteTitreVignette4});
	});
}

function getNbJours(annee,mois){
return new Date(annee, mois, -1).getDate()+1;
}

var langActive=$('.lang-active').html();
langActive=langActive.toLowerCase();
var lesMois={
	"fr":{
		"01":"JANV",
		"02":"FEV",
		"03":"MARS",
		"04":"AVRIL",
		"05":"MAI",
		"06":"JUIN",
		"07":"JUIL",
		"08":"AOUT",
		"09":"SEPT",
		"10":"OCT",
		"11":"NOV",
		"12":"DEC"},
	"en":{
		"01":"JAN",
		"02":"FEB",
		"03":"MARCH",
		"04":"APRIL",
		"05":"MAY",
		"06":"JUNE",
		"07":"JULY",
		"08":"AUG",
		"09":"SEPT",
		"10":"OCT",
		"11":"NOV",
		"12":"DEC"}
	};
