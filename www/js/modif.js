	$(document).ready(function() {
	   	$('.modifiable').focus(function(){
	   		$(this).addClass('selection-modif');
	   		$('.modifiable').removeClass('dernier-modifie');
	   		$(this).addClass('dernier-modifie');

	   		if(!($(this).hasClass('pas-panel'))){
	   			$('#myBigNicPanel').removeClass('invisible-mode');
	   			$('#bouton-enregistrer').css({opacity:1});
	   			if($(this).hasClass('pas-de-bouton-enregistre')){
	   				$('#bouton-enregistrer').addClass('invisible-mode');
	   			}else{
	   				$('#bouton-enregistrer').removeClass('invisible-mode');
		   			if($(this).hasClass('non-enregistre')){
		   				$('#bouton-enregistrer').addClass('bouton-pas-enregistre');
		   			}else{
		   				$('#bouton-enregistrer').removeClass('bouton-pas-enregistre');
		   			}
		   		}
		   		DimPanel();
	   		} else {
	   			$('#myBigNicPanel').addClass('invisible-mode');
	   		}
	    });
	    $('.modifiable').focusout(function(){
	    	$(this).removeClass('selection-modif');
	    	$('#bouton-enregistrer').css({opacity:0.6});
	    });
	   	$('.texte-initial').focus(function(){
	   		if($(this).html()==$(this).attr('texteInitial')){
	   			$(this).html('');
	   			$(this).css({'font-style':'normal'});
	   		}
	    });
	   	$('.texte-initial').focusout(function(){
	   		if($(this).html()==''){
	   			$(this).css({'font-style':'italic'});
	   			$(this).html($(this).attr('texteInitial'));
	   		}
	    });
	    $('#bouton-enregistrer').on('click', function(e){
	    	var bdtable = $('.dernier-modifie').attr("bdtable");
	    	var bdcol = $('.dernier-modifie').attr("bdcol");
	    	var identifier = $('.dernier-modifie').attr("id");
	    	var value = $('.dernier-modifie').html();

	    	postDB({ 'action': 'modif1', 'table': bdtable, 'identifier': identifier, 'json': JSON.stringify({ [bdcol]: value }) });
			applyModif();
			$('.dernier-modifie').focus();
		});

		$('.add-button').on('click', function(){
			add_form_DB(this, 'Concert ajouté !');
		});

    $('.modifiable').keyup(function(){
    	var nomIdOld = '#'+$(this).attr('id')+'-old';

    	if($(this).html()!=$(nomIdOld).html()){
    		//Différent
    		$(this).addClass('non-enregistre');
    		$('#bouton-enregistrer').addClass('bouton-pas-enregistre');
    	}else{
    		//Egal
    		$(this).removeClass('non-enregistre');
    		$('#bouton-enregistrer').removeClass('bouton-pas-enregistre');
    	}
    });
	});

  function keyup_modifiable(element) {
    var nomIdOld = '#'+$(element).attr('id')+'-old';

    if($(element).html()!=$(nomIdOld).html()){
      //Différent
      $(element).addClass('non-enregistre');
      $('#bouton-enregistrer').addClass('bouton-pas-enregistre');
    }else{
      //Egal
      $(element).removeClass('non-enregistre');
      $('#bouton-enregistrer').removeClass('bouton-pas-enregistre');
    }
  }

  function focus_modifiable_texte_initial(element) {
    $(element).addClass('selection-modif');
    $('.modifiable').removeClass('dernier-modifie');
    $(element).addClass('dernier-modifie');

    if(!($(element).hasClass('pas-panel'))){
      $('#myBigNicPanel').removeClass('invisible-mode');
      $('#bouton-enregistrer').css({opacity:1});
      if($(element).hasClass('pas-de-bouton-enregistre')){
        $('#bouton-enregistrer').addClass('invisible-mode');
      }else{
        $('#bouton-enregistrer').removeClass('invisible-mode');
        if($(element).hasClass('non-enregistre')){
          $('#bouton-enregistrer').addClass('bouton-pas-enregistre');
        }else{
          $('#bouton-enregistrer').removeClass('bouton-pas-enregistre');
        }
      }
      DimPanel();
    } else {
      $('#myBigNicPanel').addClass('invisible-mode');
    }

    if($(element).html()==$(element).attr('texteInitial')){
      $(element).html('');
      $(element).css({'font-style':'normal'});
    }
  }

  function focusout_modifiable_texte_initial(element) {
    $(element).removeClass('selection-modif');
    $('#bouton-enregistrer').css({opacity:0.6});

    if($(element).html()==''){
      $(element).css({'font-style':'italic'});
      $(element).html($(element).attr('texteInitial'));
    }
  }

	function add_form_DB(element_html, succeed_message){
		var parent = $( element_html ).parent();
		var bdtable = parent.attr( "bdtable" );
		var json_ajout = {};
    var date;

    quit_modif_mode();
		parent.find( "[bdcol]" ).each( function() {
			if ($( this ).attr( "texteInitial" ) == $( this ).html()) {
				json_ajout[$( this ).attr( "bdcol" )] = '';
			} else {
				json_ajout[$( this ).attr( "bdcol" )] = $( this ).html();
			}
		});
    date = json_ajout['date'];
		json_ajout = JSON.stringify( json_ajout );

    $.ajax({
      url: '../admin/db.php',
      type: 'post',
      data: {
        'action': 'ajout',
        'table': bdtable,
        'json': json_ajout
      },
      async: false
    }).done(function() {
      alert(succeed_message);
      addNewConcert(add_new_concert_in_list(date));
    });
	}

  function modif_form_DB(element_html, succeed_message) {
    var parent = $( element_html ).parent();
    var bdtable = parent.attr( "bdtable" );
    var bdid = parent.attr( "bdid" );
    var json_ajout = {};

    parent.find( "[bdcol]" ).each( function() {
      if ($( this ).attr( "texteInitial" ) == $( this ).html()) {
        json_ajout[$( this ).attr( "bdcol" )] = '';
      } else {
        json_ajout[$( this ).attr( "bdcol" )] = $( this ).html();
      }
    });

    json_ajout = JSON.stringify( json_ajout );

    $.ajax({
      url: '../admin/db.php',
      type: 'post',
      data: {
        'action': 'modif',
        'table': bdtable,
        'identifier': bdid,
        'json': json_ajout
      },
      async: false
    }).done(function() {
      quit_modif_mode();
      alert(succeed_message);
    });
  }

  function dernierId(table){
    var result = null;
      var scriptUrl = './admin/db.php';
      $.ajax({
        url: scriptUrl,
          type: 'get',
          data: 'dernierId='+table,
          async: false,
          success: function(data) {
              result = data;
          }
      });
      return result;
  }

	function supprElement(BoutonSuppr, Confirmation) {
		if (confirm(Confirmation)) {
			var divElement=$(BoutonSuppr).parent();
			var table=divElement.attr('bdtable');
			var id=divElement.attr('bdid');
			divElement.remove();
			postDB({
				'action': 'suppr',
				'table': table,
				'identifier': id
			});
		}
	}

	function modifElement(BoutonModif) {
		var divElement=$(BoutonModif).parent();
		var id=divElement.attr('bdid');

		$.ajax({
	    	url: '../admin/concerts.php',
	        type: 'get',
	        data: {
				'concerts': 'to_change',
				'concerts_index': id
			},
	        async: false
	    })
	    .done(function( data ) {
	    	divElement.before(data);
        PositioningConcerts();
	    });

	    divElement.remove();
	}

	function postDB(variables){
		var scriptUrl = "../admin/db.php";
	    $.ajax({
	    	url: scriptUrl,
	        type: 'post',
	        data: variables,
	        async: false
	    });
	}

	function post(path, params, method) {
	    method = method || "post"; // Set method to post by default if not specified.

	    // The rest of this code assumes you are not using a library.
	    // It can be made less wordy if you use one.
	    var form = document.createElement("form");
	    form.setAttribute("method", method);
	    form.setAttribute("action", path);

	    for(var key in params) {
	        if(params.hasOwnProperty(key)) {
	            var hiddenField = document.createElement("input");
	            hiddenField.setAttribute("type", "hidden");
	            hiddenField.setAttribute("name", key);
	            hiddenField.setAttribute("value", params[key]);

	            form.appendChild(hiddenField);
	         }
	    }
	    document.body.appendChild(form);
	    form.submit();
	}

	function DimPanel(){
		var positionInstance=$('.selection-modif').offset();
		var widthPanel;
		var widthPanelMax=318;
		var widthPetitBoutonEnregistrer=30;
		var widthBigPanelMax=widthPanelMax+widthPetitBoutonEnregistrer;
		var widthBordSelectionFenetre=window.innerWidth-positionInstance.left;
		var paddingBordDroit=30;
		var EspaceWidthBigPanelMax = widthBordSelectionFenetre-paddingBordDroit;

		if(EspaceWidthBigPanelMax>widthBigPanelMax){
			widthPanel=widthBigPanelMax;
			widthBoutonEnregistrer=widthPetitBoutonEnregistrer;
		}else{
			widthPanel=EspaceWidthBigPanelMax;
			widthBoutonEnregistrer=EspaceWidthBigPanelMax;
		}
		$('#myBigNicPanel').css({width: widthPanel});
		$('#bouton-enregistrer').css({width: widthBoutonEnregistrer});
		$('#myBigNicPanel').css({top: positionInstance.top-$('#myBigNicPanel').outerHeight(), left: positionInstance.left});
	}

	function controleModif(){
		$('.modifiable').each(function(){
			$(this).after('<div id="'+$(this).attr('id')+'-old" class="invisible-mode">'+$(this).html()+'</div>');
		});
	}

	function applyModif(){
		$('.dernier-modifie').each(function() {
			var id = $(this).attr('id')
			$(`#${id}-old`).html($(`#${id}`).html());
			$(this).removeClass('non-enregistre');
    		$('#bouton-enregistrer').removeClass('bouton-pas-enregistre');
		});
	}

	function TexteInitial(){
		$('.texte-initial').each(function(){
			if ($(this).html() == '<br>' || $(this).html() == '') {
				$(this).css({'font-style':'italic'});
	   			$(this).html($(this).attr('texteInitial'));
   			}
		});
	}
