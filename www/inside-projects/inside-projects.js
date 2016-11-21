$(window).load(function () {
    $(document).ready(function(){
    	resizePlayer();
    	resizeConcerts();
    	resizePlayerVideo();
    });
});

$(window).bind('resize', function() {
	resizePlayer();
	resizeConcerts();
	resizePlayerVideo();
});

function resizePlayer() {
	var widthProjectMusic = $('#project_music').outerWidth();
	var widthCover = $('.disc-cover').outerWidth();
	var widthMusicRight = widthProjectMusic - widthCover-1;
 	$('.disc-extracts').css({width: widthMusicRight}); 
	
	var widthControls = $('.jp-controls').outerWidth();
	var widthTime = $('.jp-time-holder').outerWidth();
	var widthProgress = widthMusicRight - widthControls - widthTime - 50;
	$('.jp-progress').css({width: widthProgress}); 
}

function resizeConcerts() {
	var widthNextConcert = $('#project_next_concerts').outerWidth();
	var widthDate = $('.dates-concerts-gauche').outerWidth();
	var padding = 24;
	var widthConcertRight = widthNextConcert - widthDate - 2 * padding;
 	$('.next-concert-right').css({width: widthConcertRight});
}

function resizePlayerVideo() {
	var widthIframe, heightIframe, widthPlayer, heightPlayerVideo;
	widthPlayer = $('#project_desc').outerWidth();
	$('iframe').each(function() {
		widthIframe = $(this).outerWidth();
		heightIframe = $(this).outerHeight();
		heightPlayerVideo = (heightIframe * widthPlayer) / widthIframe;
		$(this).css({'width': widthPlayer, 'height': heightPlayerVideo});
	});
	
}

