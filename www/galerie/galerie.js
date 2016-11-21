$(document).ready(function() {

	$('.fancybox-effects').fancybox({
		wrapCSS    : 'fancybox-custom',
		closeClick : true,

		openEffect : 'none',

		helpers : {
			title : {
				type : 'inside'
			},
			overlay : {
				css : {
					'background' : 'rgba(238,238,238,0.85)'
				}
			},
			thumbs : {
					width  : 80,
					height : 80
			}
		}
	});
});

$(window).load(function () {
    $(document).ready(function(){
        collage();
        $('.Collage').collageCaption();
    });
});

// Here we apply the actual CollagePlus plugin
function collage() {
    $('.Collage').removeWhitespace().collagePlus(
        {
            'fadeSpeed'     : 2000,
            'targetHeight'  : 200,
            'allowPartialLastRow':false
        }
    );
};

// This is just for the case that the browser window is resized
var resizeTimer = null;
$(window).bind('resize', function() {
    // hide all the images until we resize them
    $('.Collage .Image_Wrapper').css("opacity", 0);
    // set a timer to re-apply the plugin
    if (resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(collage, 200);
});