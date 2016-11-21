$(document).ready(function(e) {
	//nav
	$("nav li").on('click', function(e){
		e.preventDefault();
		var volver  = "#"+$(this).data("link");
		$('html, body').animate({
			scrollTop: $(volver).offset().top
		}, 800, 'easeInQuint');
	});

	//btmenu
	$('.bt-menu').on('click', function(e){
		e.preventDefault();
		
		if($(this).hasClass('open')){
			cerrarMenu();
		}else{
			abrirMenu();
		}
		$(this).toggleClass('open');
	});	
});

/////FUNCIONES
//Abre
function abrirMenu(){	
	$('header').addClass('op');
var menu = $('nav');
	btMenu = $('.bt-menu');
	li = menu.find('li');
	li.removeClass('view');
	btMenu.animate({'left':220}, 200, 'easeOutQuart', function(){
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
//Cierra
function cerrarMenu(){
	$('header').removeClass('op');
var menu = $('nav');
	btMenu = $('.bt-menu');
	li = menu.find('li');		
	li.each(function(index, element) {
		$(this).removeClass('view');
	});
	menu.animate({'left':'-250px'}, 300, 'easeInQuart');
	btMenu.animate({'left': '23px'}, 100, 'easeInQuart');
}