
function main() {

(function () {
   'use strict';

   /* ==============================================
  	Testimonial Slider
  	=============================================== */ 

  	$('a.page-scroll').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 40
            }, 900);
            return false;
          }
        }
      });

    /*====================================
    Show Menu on Book
    ======================================*/
    $(window).bind('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.navbar-default').addClass('on');
			$('#menu-logo').removeClass('taille-logo-grand');
			$('#menu-logo').addClass('taille-logo-reduit');
        } else {
            $('.navbar-default').removeClass('on');
			$('#menu-logo').removeClass('taille-logo-reduit');
			$('#menu-logo').addClass('taille-logo-grand');			
        }
    });

    $('body').scrollspy({ 
        target: '.navbar-default',
        offset: 80
    })

  	$(document).ready(function() {
  	  $("#team").owlCarousel({
  	 
  	      navigation : false, // Show next and prev buttons
  	      slideSpeed : 300,
  	      paginationSpeed : 400,
  	      autoHeight : true,
  	      itemsCustom : [
				        [0, 1],
				        [450, 2],
				        [600, 2],
				        [700, 2],
				        [1000, 4],
				        [1200, 4],
				        [1400, 4],
				        [1600, 4]
				      ],
  	  });

  	  $("#clients").owlCarousel({
  	 
  	      navigation : false, // Show next and prev buttons
  	      slideSpeed : 300,
  	      paginationSpeed : 400,
  	      autoHeight : true,
  	      itemsCustom : [
				        [0, 1],
				        [450, 2],
				        [600, 2],
				        [700, 2],
				        [1000, 4],
				        [1200, 5],
				        [1400, 5],
				        [1600, 5]
				      ],
  	  });

      $("#testimonial").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
        });
		
  	});

  	/*====================================
    Portfolio Isotope Filter
    ======================================*/
    $(window).load(function() {
        $('.fleur-items').isotope({
            filter: '.page-fleur-tout1',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
        $('.deco-items').isotope({
            filter: '.page-deco-tout1',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
		
        $('.cat a').click(function() {
			var cat_filtre = $(this).attr('cat-filtre');
            $('.cat-' + cat_filtre + '-' + cat_filtre + ' .active').removeClass('active');
            $(this).addClass('active');
			
            var selector = $(this).attr('data-filter');
            $('.' + cat_filtre + '-items').isotope({
                filter: selector,
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            return false;
        });
		
		$('.lien-cat-filtre').click(function() {
			var page_filtre = $(this).attr('page-filtre');
			var cat_filtre = $(this).attr('cat-filtre');
			
            $('.' + cat_filtre + '-cat-filtre').removeClass('active');
            $('#' + page_filtre).addClass('active');
		
			$('.' + cat_filtre + '-cat').addClass('cache-cache'); 
			$('.' + page_filtre).removeClass('cache-cache');
			
			$('.cat-' + cat_filtre + '-' + cat_filtre + ' .active').removeClass('active');
			$('.cat-' + cat_filtre + '-' + cat_filtre + ' .page-' + page_filtre + '1' ).addClass('active');
			
			$('.' + cat_filtre + '-items').isotope({
				filter: '.page-' + page_filtre + '1',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
	
            return false;
        });
    });

  	/*====================================
    WOW JS
    ======================================*/	

	new WOW().init();
	//smoothScroll
	smoothScroll.init();


	
}());


}
main();