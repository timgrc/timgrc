// var myNicEditor = new nicEditor({buttonList : ['bold','italic','underline','ol','ul','left','center','right','justify','fontSize','link','unlink']});
// myNicEditor.setPanel('myNicPanel');

$(document).ready(function() {
	//dossiers-de-presse
	$('.vignette-resp').on('click', function(){
		$('#popup-dossiers-de-presse1').css({ 'display' : 'block' });
	});

	$('.close').on('click', function(){
		var popup_window = $($(this).parent()).parent();
		popup_window.css({ 'display' : 'none' });
	});

	$('.bouton-ecouter').on('click', function(){
		if (!($(this).hasClass('desactive-bouton-ecouter'))) {$('#popup-ecouter').css({ 'display' : 'block' }) };
	});

	$('.desactive-bouton-ecouter').on('click', function(){
		$(this).css( {'background-color' : '#99001C'} );
	});
});

function hide_concert_time(element) {
  var form_hour = $(element).parent().find('.form-hour-admin');
  var hour_db   = $(element).parent().find('[bdcol]');
  if (form_hour.hasClass('invisible-mode')) {
    var hour = $(element).parent().find('#ajout-concerts-heure').val();
    var min  = $(element).parent().find('#ajout-concerts-minutes').val();
    $(element).css( {'color' : '#8f7947'} );
    hour_db.html(hour + 'h' + min);
    form_hour.removeClass('invisible-mode');
  } else {
    $(element).css( {'color' : '#99001c'} );
    hour_db.html('');
    form_hour.addClass('invisible-mode');
  }
}

function go_to_modif(element) {
    id = $(element).parent().attr('bdid');
    quit_modif_mode();
    modifElement(element);
    hide_concert_time($('[bdid=' + id + ']').find('.fa-clock-o'));
    myNicEditor.addInstance('ajout-concerts-titrefr' + id);
    myNicEditor.addInstance('ajout-concerts-titreen' + id);
    myNicEditor.addInstance('ajout-concerts-lieufr' + id);
    myNicEditor.addInstance('ajout-concerts-lieuen' + id);
    myNicEditor.addInstance('ajout-concerts-lien' + id);
    TexteInitial();
  }

function insert_project_value(element) {
    var project_sql = $(element).parent().find("[bdcol=\"project\"]");
    project_sql.html($(element).val());
}

function insert_hour_value(element) {
  var hour_sql = $(element).parent().parent().find("[bdcol=\"heure\"]");
  var new_hour_sql = $(element).val() + hour_sql.html().substring(2,5);
  hour_sql.html(new_hour_sql);
}

function insert_min_value(element) {
  var hour_sql = $(element).parent().parent().find("[bdcol=\"heure\"]");
  var new_hour_sql = hour_sql.html().substring(0,3) + $(element).val();
  hour_sql.html(new_hour_sql);
}

function insert_day_value(element) {
  var date_sql = $(element).parent().parent().find("[bdcol=\"date\"]");
  var new_date_sql = date_sql.html().substring(0,6) + $(element).val();
  date_sql.html(new_date_sql);
}

function insert_month_value(element) {
  var j;
  var nombreJoursMois;
  var ajout_jour_form = $(element).parent().parent().find('.ajout-concerts-jour');
  nombreJoursMois = getNbJours($(element).parent().find('.ajout-concerts-annee').val(),$(element).val());

  for(var i=29; i<=31; i++){
    if(i<=nombreJoursMois){
      $('.jour'+i).removeClass('invisible-mode');
    }else{
      $('.jour'+i).addClass('invisible-mode');
    }
  }
  if(ajout_jour_form.val()>nombreJoursMois){
    ajout_jour_form.val(nombreJoursMois);
  }

  var date_sql = $(element).parent().parent().find("[bdcol=\"date\"]");
  var new_date_sql = date_sql.html().substring(0,4) + $(element).val() + date_sql.html().substring(6,8);
  date_sql.html(new_date_sql);
}

function insert_year_value(element) {
  var nombreJoursMois;
  var ajout_jour_form = $(element).parent().parent().find('.ajout-concerts-jour');
  nombreJoursMois = getNbJours($(element).val(),$(element).parent().find('.ajout-concerts-mois').val());
  if(ajout_jour_form.val() > nombreJoursMois){
    ajout_jour_form.val(nombreJoursMois);
  }

  var date_sql = $(element).parent().parent().find("[bdcol=\"date\"]");
  var new_date_sql = $(element).val() + date_sql.html().substring(4,8);
  date_sql.html(new_date_sql);
}

function add_new_concert_in_list(date) {
  var id;
  var id_element_after_new_concert;
  var date_concerts;
  $('[bdid]').each(function() {
    id = $(this).attr('bdid');
    if (id != 0) {
      date_concerts = $(this).find('.dates-concerts-gauche').attr('date');
      id_element_after_new_concert = id;
      return (date > date_concerts)
    }
  });
  return id;
}

function addNewConcert(id_after_element) {
  var divElement=$('[bdid=' + id_after_element + ']');
  $.ajax({
    url: '../admin/concerts.php',
      type: 'get',
      data: {
    'concerts': 'to_see',
    'concerts_index': 'last'
  },
      async: false
  })
  .done(function( data ) {
    divElement.before(data);
    PositioningConcerts();
  });
}

function quit_modif_mode() {
  var id;
  $('[state=modif]').each(function() {
    id = $(this).attr('bdid');
    if (id != 0) {
      $.ajax({
        url: '../admin/concerts.php',
        type: 'get',
        data: {
          'concerts': 'to_see',
          'concerts_index': id
        },
        async: false
        })
        .done(function( data ) {
          $('[bdid=' + id + ']').before(data);
          PositioningConcerts();
        });

        $(this).remove();
      }
  });
}

function PositioningConcerts(){
	var datePaddingGaucheConcerts;
	var paddingRightConcerts=7;
	var marginLeftBouton;

	var offsetDatesConcertsP;
	var offsetDatesConcerts = $('.dates-concerts').offset();
	var distanceDatesConcertsP;

	$('.dates-concerts').each(function(){
		offsetDatesConcertsP = $(this).find('.dates-concerts-p').offset();
		offsetDatesConcerts = $(this).offset();
		distanceDatesConcertsP=offsetDatesConcertsP.top-offsetDatesConcerts.top;
		marginLeftBouton = $(this).outerWidth()-$('.bouton-reserver').outerWidth()-paddingRightConcerts;

		if(window.innerWidth<=640){
			$(this).find('.dates-concerts-gauche').css({'height':30,'padding-top':0});
			$(this).outerHeight($(this).find('.dates-concerts-gauche').outerHeight()+$(this).find('.dates-concerts-droite').outerHeight());

			$(this).find('.bouton-reserver').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':marginLeftBouton});
			$(this).find('.bouton-gauche-concerts').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':marginLeftBouton});
			$(this).find('.bouton-droite-concerts').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':marginLeftBouton+48});
		}else if(window.innerWidth<950){
			datePaddingGaucheConcerts = ($(this).find('.dates-concerts-droite').outerHeight()-$(this).find('.dates-concerts-jour').outerHeight()-$(this).find('.dates-concerts-mois-annee').outerHeight())/2;
			if(datePaddingGaucheConcerts<0){datePaddingGaucheConcerts=0;}
			$(this).find('.dates-concerts-gauche').css({'height':$(this).find('.dates-concerts-droite').outerHeight(),'padding-top':datePaddingGaucheConcerts});
			$(this).outerHeight($(this).find('.dates-concerts-droite').outerHeight());

			$(this).find('.bouton-reserver').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':477});
			$(this).find('.bouton-gauche-concerts').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':477});
			$(this).find('.bouton-droite-concerts').css({'margin-top':distanceDatesConcertsP+paddingRightConcerts,'margin-left':535});
		}else{
			datePaddingGaucheConcerts = ($(this).find('.dates-concerts-droite').outerHeight()-$(this).find('.dates-concerts-jour').outerHeight()-$(this).find('.dates-concerts-mois-annee').outerHeight())/2;
			if(datePaddingGaucheConcerts<0){datePaddingGaucheConcerts=0;}
			$(this).find('.dates-concerts-gauche').css({'height':$(this).find('.dates-concerts-droite').outerHeight(),'padding-top':datePaddingGaucheConcerts});
			$(this).outerHeight($(this).find('.dates-concerts-droite').outerHeight());

			$(this).find('.bouton-reserver').css({'margin-top':distanceDatesConcertsP-20,'margin-left':789});
			$(this).find('.bouton-gauche-concerts').css({'margin-top':distanceDatesConcertsP-20,'margin-left':789});
			$(this).find('.bouton-droite-concerts').css({'margin-top':distanceDatesConcertsP-20,'margin-left':847});
		}
	});
}

// bkLib.onDomLoaded(function() {

//   myNicEditor.addInstance('firstdesctext');
//   myNicEditor.addInstance('ajout-concerts-titrefr0');
//   myNicEditor.addInstance('ajout-concerts-titreen0');
//   myNicEditor.addInstance('ajout-concerts-lieufr0');
//   myNicEditor.addInstance('ajout-concerts-lieuen0');
//   myNicEditor.addInstance('ajout-concerts-lien0');
// });


function boutonEcouter(){
	$('.bouton-ecouter').css({'margin-top':$('.l-air-du-moment-img').outerHeight()-$('.bouton-ecouter').outerHeight(), 'margin-left':$('.l-air-du-moment-img').outerWidth()-$('.bouton-ecouter').outerWidth()});
}

function auRedim(){
	PositioningConcerts();
	boutonEcouter();
  //
}

$(window).resize(function(){
	auRedim();
  DimPanel();
});
$(window).load(function(){
  controleModif();
  TexteInitial();
	auRedim();
});
