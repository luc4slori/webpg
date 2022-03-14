$(function(){

    var URI = {};
    URI.GET_AllAllAllgallery = "actions/api-gallery.php?action=listarAllAllAll";
    URI.GET_AllAllgallery = "actions/api-gallery.php?action=listarAllAll";
    URI.GET_Allgallery = "actions/api-gallery.php?action=listarAll";
	    
	URI.GET_TEMPLATE_Gallery = "templates/listado-gallery.html";
	
    URI.POST_search_nota = "actions/api-nota.php?action=searchNota";
    URI.GET_notas = "actions/api-nota.php?action=listar";
	URI.GET_Carrusel = "actions/api-nota.php?action=listarCarrusel";
    URI.GET_AllNotas = "actions/api-nota.php?action=listarAllAdmin";    
    URI.DELETE_nota = "actions/api-nota.php?action=eliminar";
	URI.DELETE_publi = "actions/api-publi.php?action=eliminar";
    URI.GET_Allmenu = "actions/api-menu.php?action=listarAll";
    URI.GET_TEMPLATE_menu = "templates/listado-menus.html";
    URI.GET_Allsubmenu = "actions/api-submenu.php?action=listarAll";
    URI.GET_TEMPLATE_submenu = "templates/listado-submenus.html";
    URI.GET_AllEstadosItems = "actions/api-estado-item.php?action=listarAll";
    URI.GET_TEMPLATE_estadoitem = "templates/listado-estado-item.html";
	URI.GET_TEMPLATE_listadoCarrusel = "templates/listado-carrusel.html";
	URI.GET_TEMPLATE_searchlistadoCarrusel = "templates/search-listado-carrusel.html";
    URI.GUARDAR = "actions/api-nota.php?action=guardar";
    URI.ACTUALIZAR =  "actions/api-nota.php?action=actualizar";
	URI.Eliminar_Del_Carrusel ="actions/api-nota.php?action=eliminarDelCarrusel";
	URI.Agregar_Al_Carrusel ="actions/api-nota.php?action=agregarAlCarrusel";
	
	URI.TEMPLATE_CARRUSEL="templates/carrusel-index.html";
	//URI.POST_PublicidadEstado="actions/api-publi.php?action=cambiarEstado";
	URI.POST_UpdateEstadov2 = "actions/api-publi.php?action=updateEstadov2";
	URI.POST_PublicidadRepositorio="actions/api-publi.php?action=publicidadRepositorio";

	 URI.GUARDAR_MENU = "actions/api-menu.php?action=guardar";
	 URI.GUARDAR_SUBMENU = "actions/api-submenu.php?action=guardar";
	URI.GET_menus = "actions/api-menu.php?action=listar";
	URI.GET_submenus = "actions/api-submenu.php?action=listar";
	 URI.DELETE_menu = "actions/api-menu.php?action=eliminar";
	  URI.DELETE_submenu = "actions/api-submenu.php?action=eliminar";
	  URI.ACTUALIZAR_MENU =  "actions/api-menu.php?action=actualizar";
	  URI.ACTUALIZAR_SUBMENU=  "actions/api-submenu.php?action=actualizar";	
	  URI.GUARDAR_PUBLI = "actions/api-publi.php?action=guardar";
		URI.ACTUALIZAR_PUBLI=  "actions/api-publi.php?action=actualizar";	
	  URI.GET_AllAdminPublicidad ="actions/api-publi.php?action=listarAllAllAdmin";	 
	  URI.GET_getBannersHeader ="actions/api-publi.php?action=getBannersHeader";	 
	  URI.GET_getDelay ="actions/api-publi.php?action=getDelay";	
	URI.POST_setDelay ="actions/api-publi.php?action=setDelay";		  
	  
	  

	var files;
	var selectedFile = 0;
	/*********************************************************************/
	$('#btn-probar-tweet-edit').on("click",null,function(e){
		e.preventDefault();				
		Materialize.toast('Cargando Tweet', 99500);
		let id = $('#tweet-status-edit').val();
		$('#tweetDIVedit').html(`<div class="tweetedit" id="${id}-edit"></div>`);
		$('#tweetDIVedit').removeClass("hidden");
		var cards = $('#chk-tweetcards-edit').is(':checked') ? 'visible' : 'hidden';
		var conversation = $('#chk-tweetconversation-edit').is(':checked') ? 'all' : 'none';
		var tweets = $(".tweetedit");
		$(tweets).each(function(t, tweet) {			
			$(this).html('');
			var id = $(this).attr('id').split("-edit")[0];
			twttr.widgets
				.createTweet(
					id, tweet, {
						lang: 'es',
						conversation: conversation,
						cards: cards, 
						linkColor: '#cc0000', // default is blue
						theme: 'light', // or dark
						/*width: '250',*/
				}).then(function(el) {
					$('#toast-container').remove();
				});			   
			
			$(this).removeClass('tweetedit');
			
		});		
		
		return false;
	});	
	/*********************************************************************/
	$('#btn-probar-tweet-nueva').on("click",null,function(e){
		e.preventDefault();
		Materialize.toast('Cargando Tweet', 99500);
		let id = $('#tweet-status-nueva').val();
		$('#tweetDIVnueva').html(`<div class="tweetnueva" id="${id}-nueva"></div>`);
		$('#tweetDIVnueva').removeClass("hidden");
		var cards = $('#chk-tweetcards-nueva').is(':checked') ? 'visible' : 'hidden';
		var conversation = $('#chk-tweetconversation-nueva').is(':checked') ? 'all' : 'none';
		var tweets = $(".tweetnueva");
		$(tweets).each(function(t, tweet) {			
			$(this).html('');
			var id = $(this).attr('id').split("-nueva")[0];
			console.log(id);
			twttr.widgets
				.createTweet(
					id, tweet, {
						lang: 'es',
						conversation: conversation,
						cards: cards, 
						linkColor: '#cc0000', // default is blue
						theme: 'light', // or dark
						/*width: '250',*/
				}).then(function(el) {
					$('#toast-container').remove();
				});			   
			
			$(this).removeClass('tweetnueva');
			
		});		
		
		return false;
	});
	/*********************************************************************/
	$('#btn-probar-video-edit').on("click",null,function(e){
		e.preventDefault();
		$('#src-youtube-edit').attr("src","https://www.youtube.com/embed/"+$('#video-edit').val()+"?&autohide=2&modestbranding=1&showinfo=0&rel=0");
		$('.codegena-edit').removeClass("hidden");
	});
	/*********************************************************************/
	$('#btn-probar-video-nueva').on("click",null,function(e){
		e.preventDefault();
		$('#src-youtube-nueva').attr("src","https://www.youtube.com/embed/"+$('#video-nueva').val()+"?&autohide=2&modestbranding=1&showinfo=0&rel=0");
		$('.codegena-nueva').removeClass("hidden");
	});
	/*********************************************************************/
	var vaciarVideoEdit = function(){
		$("#chk-video-edit").prop('checked',false);
		$('.video-fila-edit').addClass("hidden");
		$('#video-edit').val("");
		$('.codegena-edit').addClass("hidden");
		$('#src-youtube-edit').attr("src","");
	}
	/*********************************************************************/
	var vaciarVideoNueva = function(){
		$("#chk-video-nueva").prop('checked',false);
		$('.video-fila').addClass("hidden");
		$('#video-nueva').val("");
		$('.codegena-nueva').addClass("hidden");
		$('#src-youtube-nueva').attr("src","");
	}
	/*********************************************************************/
	var vaciarTweetEdit = function(){
		$("#chk-tweet-edit").prop('checked',false);
		$('.tweet-fila-edit').addClass("hidden");
		$('#tweet-status-edit').val("");
		$('#tweetDIVedit').html("");
		$('#tweetDIVedit').addClass("hidden");		
	}
	/*********************************************************************/
	var vaciarTweetNueva = function(){
		$("#chk-tweet-nueva").prop('checked',false);
		$('.tweet-fila').addClass("hidden");
		$('#tweet-status-nueva').val("");
		$('#tweetDIVnueva').html("");
		$('#tweetDIVnueva').addClass("hidden");		
	}
	/*********************************************************************/
	$('input[name="chk-video-edit"]').change(function() { 
		if ($('#chk-video-edit').is(':checked')) {
			$('.video-fila-edit').removeClass("hidden");
		} else {					
			vaciarVideoEdit();			
		}
	
	});
	/*********************************************************************/
	$('input[name="chk-tweet-edit"]').change(function() { 
		if ($('#chk-tweet-edit').is(':checked')) {
			$('.tweet-fila-edit').removeClass("hidden");
		} else {					
			vaciarTweetEdit();			
		}
	
	});
	/*********************************************************************/
	$('input[name="chk-tweet-nueva"]').change(function() { 
		if ($('#chk-tweet-nueva').is(':checked')) {
			$('.tweet-fila').removeClass("hidden");
		} else {					
			vaciarTweetNueva();			
		}
	
	});
	/*********************************************************************/
	$('input[name="chk-video-nueva"]').change(function() { 
		if ($('#chk-video-nueva').is(':checked')) {
			$('.video-fila').removeClass("hidden");
		} else {					
			vaciarVideoNueva();			
		}
	
	});
	
	/*********************************************************************/
	$('input[name="chk-imagen-edit"]').change(function() { 
		if ($('#chk-imagen-edit').is(':checked')) {
			$('.imagen-fila-edit').removeClass("hidden");
		} else {					
			vaciarFotoEdit();			
		}
	
	});
	/*********************************************************************/
	$('input[name="chk-imagen-nueva"]').change(function() { 
		if ($('#chk-imagen-nueva').is(':checked')) {
			$('.imagen-fila').removeClass("hidden");
		} else {					
			vaciarFotoNueva();			
		}
	
	});
	
	/*********************************************************************/
	$('input[name="chkBaulEdit"]').change(function() { 
		$("#lightgallery-edit").data('lightGallery').destroy(true);
		if ($('#chk-baul-menu-edit').is(':checked')) {
			
			getMenuGalleryEditNota($("#select-menu-edit").val());
		} else {		
			if ($('#chk-baul-submenu-edit').is(':checked')) {
				getSubmenuGalleryEditNota($("#select-submenu-edit").val());
			} else {
				
				getTodasGalleryEditNota();
			}			
		}
	
	});
	  /*********************************************************************/
    $('input[name="chkImagenEdit"]').change(function() { 
		
	  if ($('.col-local-edit').hasClass("hidden")){
		$('.col-local-edit').removeClass("hidden");
		$('.col-baul-edit').addClass("hidden");  
		  $("#lightgallery-edit").data('lightGallery').destroy(true);
		$("#lightgallery-edit").html("");
	  } else {
		$('.col-local-edit').addClass("hidden");
		  $('.col-baul-edit').removeClass("hidden");  
		  getSubmenuGalleryEditNota($("#select-submenu-edit").val());		  
	  }  
		
	});
	/*********************************************************************/
	$('input[name="chkBaulNueva"]').change(function() { 
		$("#lightgallery").data('lightGallery').destroy(true);
		if ($('#chk-baul-menu-nueva').is(':checked')) {
			
			getMenuGalleryNuevaNota($("#select-menu-nueva").val());
		} else {		
			if ($('#chk-baul-submenu-nueva').is(':checked')) {
				getSubmenuGalleryNuevaNota($("#select-submenu-nueva").val());
			} else {
				
				getTodasGalleryNuevaNota();
			}			
		}
	
	});
	  /*********************************************************************/
    $('input[name="chkImagenNueva"]').change(function() { 
     
	  if ($('.col-local-nueva').hasClass("hidden")){
		$('.col-local-nueva').removeClass("hidden");
		$('.col-baul-nueva').addClass("hidden");  
		  $("#lightgallery").data('lightGallery').destroy(true);
		$("#lightgallery").html("");
	  } else {
		$('.col-local-nueva').addClass("hidden");
		  $('.col-baul-nueva').removeClass("hidden");  
		  getSubmenuGalleryNuevaNota($("#select-submenu-nueva").val());		  
	  }  
		
	});
  /*********************************************************************/
    $('input[name="chkFecha"]').change(function() { 
     
	  if ($('#clearfix-nueva-nota').hasClass("hidden")){
		$('#clearfix-nueva-nota').removeClass("hidden");
	  } else {
		$('#clearfix-nueva-nota').addClass("hidden");
		setCalendarNuevo();
	  }  
		
	});
	/*********************************************************************/
	var validarFormData = function(){
	/*
        var valid = true;
        var titulo = $("#titulo").val();
        var subtitulo = $("#subtitulo").val();
        var descripcion = $("#descripcion").val();
				

        if(titulo.length == 0){
            $("#titulo").closest(".form-group").addClass("has-error");
            $("#titulo").siblings(".glyphicon-remove").removeClass("hide");
            $("#titulo").siblings(".help-block").html("Completar este campo");
            valid = false;
        }
        
        if(subtitulo.length == 0){
            $("#subtitulo").closest(".form-group").addClass("has-error");
            $("#subtitulo").siblings(".glyphicon-remove").removeClass("hide");
            $("#subtitulo").siblings(".help-block").html("Completar este campo");
            valid = false;
        }

        if(descripcion.length == 0){
            $("#descripcion").closest(".form-group").addClass("has-error");
            $("#descripcion").siblings(".glyphicon-remove").removeClass("hide");
            $("#descripcion").siblings(".help-block").html("Completar este campo");
            valid = false;
        }

        return valid;
	*/
	return true;
    };
	/*********************************************************************/
    var cleanFormError = function(){
	/*
        $("#titulo").closest(".form-group").removeClass("has-error");
        $("#titulo").siblings(".glyphicon-remove").addClass("hide");
        $("#titulo").siblings(".help-block").html(""); 

        $("#subtitulo").closest(".form-group").removeClass("has-error");
        $("#subtitulo").siblings(".glyphicon-remove").addClass("hide");
        $("#subtitulo").siblings(".help-block").html("");
      
        
        $("#descripcion").closest(".form-group").removeClass("has-error");
        $("#descripcion").siblings(".glyphicon-remove").addClass("hide");
        $("#descripcion").siblings(".help-block").html("");        
	    */
    };
	/*********************************************************************/
	var vaciarFotoNuevoMenu= function(){
		$('#filenameFoto-nuevo-menu').val("");	
		$('#file-path-nuevo-menu').val("");
		$('#file-path-nuevo-menu').removeClass("valid");
		$('#fotoForm-nuevo-menu').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-nuevo-menu').val("");
		$('#quiero-foto-nuevo-menu').prop('checked', false);
	}
	/*********************************************************************/
	var vaciarFotoNuevoSubmenu= function(){
		$('#filenameFoto-nuevo-submenu').val("");	
		$('#file-path-nuevo-submenu').val("");
		$('#file-path-nuevo-submenu').removeClass("valid");
		$('#fotoForm-nuevo-submenu').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-nuevo-submenu').val("");
		$('#quiero-foto-nuevo-submenu').prop('checked', false);
	}
	/*********************************************************************/
	var vaciarFotoNuevaPubli= function(){
		$('#filenameFoto-nueva-publi').val("");	
		$('#file-path-nueva-publi').val("");
		$('#file-path-nueva-publi').removeClass("valid");		
		//$('#fotoForm-nueva-publi').attr("data","img/sinimagen.jpg");
		var flashvars = {};			
			flashvars.autostart = "true";			
			flashvars.allowSciptAccess = "always";			
		var params = {};
			params.play = "true";			
			params.allowscriptaccess = "always";		
			params.wmode = "transparent";
		var attributes = {};
			attributes.id = "fotoForm-nueva-publi";
		console.log("antes");
		console.log($("#fotoForm-nueva-publi"));
		swfobject.embedSWF("img/sinimagen.jpg", "fotoForm-nueva-publi","100%", "100%", "9.0.0", {}, flashvars, params, attributes);
		console.log("despues");
		$('#btnSeleccionar-nueva-publi').val("");		
	}
	/*********************************************************************/
	var vaciarFotoNueva= function(){
		//osni-reyes		
		$("#chk-imagen-nueva").prop('checked',false);
		$("#chk-local-nueva").prop('checked',true);
		$(".col-local-nueva").removeClass("hidden");
		$(".col-baul-nueva").addClass("hidden");
		$("#fotoForm-nueva-from-gallery").attr("src","img/sinimagen.jpg");
		$("#filenameFoto-nueva-from-gallery").val("");
		$("#chk-baul-submenu-nueva").prop('checked',true);
		$("#demo-nueva").removeClass("hidden");
		$("#btn-cerrar-gallery").children("i").html("close");
		$('.imagen-fila').addClass("hidden");
		$('#imagenpor-nueva').val("");
		if(typeof $("#lightgallery").data('lightGallery') !== 'undefined'){
		    $("#lightgallery").data('lightGallery').destroy(true);
		}
		//
		$('#filenameFoto-nueva').val("");	
		$('#file-path-nueva').val("");
		$('#file-path-nueva').removeClass("valid");
		$('#fotoForm-nueva').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-nueva').val("");
		$('#quiero-foto-nueva').prop('checked', false);
	}
	/*********************************************************************/
	var vaciarFotoEditMenu= function(){
		 $('#filenameFoto-edit-menu').val("");					
		$('#file-path-edit-menu').val("");
		$('#file-path-edit-menu').removeClass("valid");
		$('#fotoForm-edit-menu').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-edit-menu').val("");	
		$('#quiero-foto-edit-menu').prop('checked', false);
		
	}
	/*********************************************************************/
	var vaciarFotoEditSubmenu= function(){
		 $('#filenameFoto-edit-submenu').val("");					
		$('#file-path-edit-submenu').val("");
		$('#file-path-edit-submenu').removeClass("valid");
		$('#fotoForm-edit-submenu').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-edit-submenu').val("");	
		$('#quiero-foto-edit-submenu').prop('checked', false);
		
	}
	/*********************************************************************/
	var vaciarFotoEdit= function(){
	
	//osni-reyes
		$("#chk-imagen-edit").prop('checked',false);
		$("#chk-local-edit").prop('checked',true);
		$(".col-local-edit").removeClass("hidden");
		$(".col-baul-edit").addClass("hidden");
		$("#fotoForm-edit-from-gallery").attr("src","img/sinimagen.jpg");
		$("#filenameFoto-edit-from-gallery").val("");
		$("#chk-baul-submenu-edit").prop('checked',true);
		$("#demo-edit").removeClass("hidden");
		$("#btn-cerrar-gallery-edit").children("i").html("close");
		$('.imagen-fila-edit').addClass("hidden");
		$('#imagenpor-edit').val("");
		if(typeof $("#lightgallery-edit").data('lightGallery') !== 'undefined'){
			$("#lightgallery-edit").data('lightGallery').destroy(true);
		}
	
	
		$('#filenameFoto-edit').val("");					
		$('#file-path-edit').val("");
		$('#file-path-edit').removeClass("valid");
		$('#fotoForm-edit').attr("src","img/sinimagen.jpg");
		$('#btnSeleccionar-edit').val("");	
		$('#quiero-foto-edit').prop('checked', false);
		
		
		
	}
	/*********************************************************************/
	var cleanFormDataNueva = function(){
			selectedFile = 0;
		//console.log("clean nueva");
		$('#titulo-nueva').val("");
		$('#subtitulo-nueva').val("");
		$('#descripcion-nueva').val("");
		$('#autor-nueva').val("");
		$("#chk-word").prop('checked',false);
		$("#chk-carrusel").prop('checked',false);
		
		
		//osni-reyes comentado
		/*
		$("#chk-local-nueva").prop('checked',true);
		$(".col-local-nueva").removeClass("hidden");
		$(".col-baul-nueva").addClass("hidden");
		$("#fotoForm-nueva-from-gallery").attr("src","img/sinimagen.jpg");
		$("#filenameFoto-nueva-from-gallery").val("");
		$("#chk-baul-submenu-nueva").prop('checked',true);
		$("#demo-nueva").removeClass("hidden");
		$("#btn-cerrar-gallery").children("i").html("close");
		
		if(typeof $("#lightgallery").data('lightGallery') !== 'undefined'){
		    $("#lightgallery").data('lightGallery').destroy(true);
		}
		*/
		$('#clearfix-nueva-nota').addClass("hidden");
		$('#chkDefaultFecha').prop('checked',true);
		setCalendarNuevo();
		
		vaciarFotoNueva();
		vaciarVideoNueva();
		vaciarTweetNueva();		
	    };
	/*********************************************************************/
	var cleanFormDataNuevaPubli = function(){	
		selectedFile = 0;
		$('#http_nueva_publi').val("");		
		vaciarFotoNuevaPubli();		    
	    };
	/*********************************************************************/
	var cleanFormDataNuevoMenu = function(){
		selectedFile = 0;
		//console.log("clean nueva");
		$('#titulo-nuevo-menu').val("");		
		vaciarFotoNuevoMenu();		    
	    };
	/*********************************************************************/
	var cleanFormDataNuevoSubmenu = function(){
		selectedFile = 0;
		//console.log("clean nueva");
		$('#titulo-nuevo-submenu').val("");		
		$('#descripcion-nuevo-submenu').val("");	
		$("#chk-portada").prop('checked',false);
		$("#chk-word-submenu").prop('checked',false);		
		vaciarFotoNuevoSubmenu();		    
	    };
	/*********************************************************************/
	var cleanFormDataEdit = function(){
		selectedFile = 0;
		$('#editar-nota').find('#edit-id').val("");
		$('#titulo-edit').val("");
		$('#subtitulo-edit').val("");
		$('#descripcion-edit').val("");
		$('#autor-edit').val("");
		$("#chk-word-edit").prop('checked',false);
		$("#chk-carrusel-edit").prop('checked',false);
		
		
		vaciarFotoEdit();
		vaciarVideoEdit();	
		vaciarTweetEdit();
	 };
	 /*********************************************************************/
	var cleanFormDataEditMenu = function(){
		selectedFile = 0;
		$('#editar-menu').find('#edit-id-menu').val("");
		$('#titulo-edit-menu').val("");		
	 };
	 /*********************************************************************/
	var cleanFormDataEditSubmenu = function(){
		selectedFile = 0;
		$('#editar-submenu').find('#edit-id-submenu').val("");
		$('#titulo-edit-submenu').val("");	
		$('#descripcion-edit-submenu').val("");
		 $("#chk-portada-edit").prop('checked',false);
		 $("#chk-word-submenu-edit").prop('checked',false);
		 $("#chk-fecha-submenu-edit").prop('checked',false);
		 $("#chk-visitas-submenu-edit").prop('checked',false);
	 };
	    
	/*******************vacio la cache del botonSeleccionar**************/
	$("#btnSeleccionar-nueva").after($("#btnSeleccionar-nueva").clone(true)).remove();
		
	$('#btnSeleccionar-nueva').change(function() {
			$('#fotoForm-nueva').css("display" , "initial");
	});
	
	$("#btnSeleccionar-edit").after($("#btnSeleccionar-edit").clone(true)).remove();
		
	$('#btnSeleccionar-edit').change(function() {
			$('#fotoForm-edit').css("display" , "initial");
	});
	
	
	$("#btnSeleccionar-nuevo-menu").after($("#btnSeleccionar-nuevo-menu").clone(true)).remove();
		
	$('#btnSeleccionar-nuevo-menu').change(function() {
			$('#fotoForm-nuevo-menu').css("display" , "initial");
	});
	
	$("#btnSeleccionar-edit-menu").after($("#btnSeleccionar-edit-menu").clone(true)).remove();
		
	$('#btnSeleccionar-edit-menu').change(function() {
			$('#fotoForm-edit-menu').css("display" , "initial");
	});
	
	
	$("#btnSeleccionar-nuevo-submenu").after($("#btnSeleccionar-nuevo-submenu").clone(true)).remove();
		
	$('#btnSeleccionar-nuevo-submenu').change(function() {
			$('#fotoForm-nuevo-submenu').css("display" , "initial");
	});
	
	$("#btnSeleccionar-edit-submenu").after($("#btnSeleccionar-edit-submenu").clone(true)).remove();
		
	$('#btnSeleccionar-edit-submenu').change(function() {
			$('#fotoForm-edit-submenu').css("display" , "initial");
	});
   
	$("#btnSeleccionar-nueva-publi").after($("#btnSeleccionar-nueva-publi").clone(true)).remove();
	
	$('#btnSeleccionar-nueva-publi').change(function() {
			$('#fotoForm-nueva-publi').css("display" , "initial");
	});
	
	$("#btnSeleccionar-edit-publi").after($("#btnSeleccionar-edit-publi").clone(true)).remove();
		
	$('#btnSeleccionar-edit-publi').change(function() {
			$('#fotoForm-edit-publi').css("display" , "initial");
	});
	/*********************************************************************/     
	function prepareUploadEdit(event){
	selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-edit').prop('checked', true);
			$("#fotoForm-edit").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-edit').prop('checked', false);
			$("#fotoForm-edit").attr("src","img/sinimagen.jpg");			
		}       
	};
	/*********************************************************************/     
	function prepareUploadEditMenu(event){
	selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-edit-menu').prop('checked', true);
			$("#fotoForm-edit-menu").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-edit-menu').prop('checked', false);
			$("#fotoForm-edit-menu").attr("src","img/sinimagen.jpg");			
		}       
	};
	/*********************************************************************/     
	function prepareUploadEditSubmenu(event){
	selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-edit-submenu').prop('checked', true);
			$("#fotoForm-edit-submenu").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-edit-submenu').prop('checked', false);
			$("#fotoForm-edit-submenu").attr("src","img/sinimagen.jpg");			
		}       
	};
	
	/*********************************************************************/
	function prepareUploadNueva(event){
		
        selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-nueva').prop('checked', true);
			$("#fotoForm-nueva").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-nueva').prop('checked', false);
			$("#fotoForm-nueva").attr("src","img/sinimagen.jpg");
		}
	     			
	};
	/*********************************************************************/
	function prepareUploadNuevoMenu(event){
        selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-nuevo-menu').prop('checked', true);
			$("#fotoForm-nuevo-menu").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-nuevo-menu').prop('checked', false);
			$("#fotoForm-nuevo-menu").attr("src","img/sinimagen.jpg");
		}
	     			
	};
	/*********************************************************************/
	function prepareUploadEditPubli(event){
        selectedFile=1;
        files = event.target.files;	
		var flashvars = {};			
			flashvars.autostart = "true";			
			flashvars.allowSciptAccess = "always";			
		var params = {};
			params.play = "true";			
			params.allowscriptaccess = "always";		
			params.wmode = "transparent";
		var attributes = {};
			attributes.id = "fotoForm-edit-publi";
		
		if (files[0]){
			//$('#filenameFoto-edit-publi').val(files[0].name);
			swfobject.embedSWF(URL.createObjectURL(files[0]), "fotoForm-edit-publi","100%", "100%", "9.0.0", {}, flashvars, params, attributes);
			//swfobject.embedSWF(URL.createObjectURL(files[0]), "fotoForm-edit-publi", {}, {}, "9",{},{},{},flashvars, flashvars, {});
			//$("#fotoForm-edit-publi").attr('data', URL.createObjectURL(files[0])+"&autostart=true");			
		}else{						
			swfobject.embedSWF("img/sinimagen.jpg", "fotoForm-edit-publi","100%", "100%", "9.0.0", {}, flashvars, params, attributes);
		}
	     			
	};
	/*********************************************************************/
	function prepareUploadNuevaPubli(event){
        selectedFile=1;
        files = event.target.files;	
		var flashvars = {};			
			flashvars.autostart = "true";			
			flashvars.allowSciptAccess = "always";			
		var params = {};
			params.play = "true";			
			params.allowscriptaccess = "always";		
			params.wmode = "transparent";
		var attributes = {};
			attributes.id = "fotoForm-nueva-publi";
		
		if (files[0]){						
			//$("#fotoForm-nueva-publi").attr('data', URL.createObjectURL(files[0]));
			swfobject.embedSWF(URL.createObjectURL(files[0]), "fotoForm-nueva-publi","100%", "100%", "9.0.0", {}, flashvars, params, attributes);
		}else{			
			//$("#fotoForm-nueva-publi").attr("data","img/sinimagen.jpg");
			swfobject.embedSWF("img/sinimagen.jpg", "fotoForm-nueva-publi","100%", "100%", "9.0.0", {}, flashvars, params, attributes);
		}
	     			
	};
	/*********************************************************************/
	function prepareUploadNuevoSubmenu(event){
        selectedFile=1;
        files = event.target.files;	

		if (files[0]){
			/*console.log(files[0]);*/
			$('#quiero-foto-nuevo-submenu').prop('checked', true);
			$("#fotoForm-nuevo-submenu").attr('src', URL.createObjectURL(files[0]));			
		}else{
			/*console.log(files[0]);*/
			$('#quiero-foto-nuevo-submenu').prop('checked', false);
			$("#fotoForm-nuevo-submenu").attr("src","img/sinimagen.jpg");
		}
	     			
	};
	/*********************************************************************/
	$("#listado-carrusel").on("click",".chk-lis-car",function(e){
		//e.preventDefault();
		
		
		
		var id = $(this).closest("tr").find("input").val();				
		
		if ($(this).prop('checked')){			
				
				
				agregarAlCarrusel(id,"desdeListado");
			} else {
				
				eliminarDelCarrusel(id,"desdeListado");
				
				}
				
		
			
		
	});
	
	/*********************************************************************/
	$("#search-listado-carrusel").on("click",".search-chk-lis-car",function(e){
		//e.preventDefault();
		
		
		var id = $(this).closest("tr").find("input").val();				
		
		if ($(this).prop('checked')){			
				
				
				agregarAlCarrusel(id,"desdeSearch");
				
			} else {
				
				eliminarDelCarrusel(id),"desdeSearch";
				
			
				}
		
		
	});
	/*********************************************************************/
	$("#quiero-foto-nueva").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-nueva').prop('checked')){			
				vaciarFotoNueva();
				//$("#fotoForm-nueva").attr("src","img/sinimagen.jpg"); (esta dentro de vaciarFotoNueva)
			} else {
					$('#btnSeleccionar-nueva').trigger('click');
					if ($("#fotoForm-nueva").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-nueva').prop('checked', false);
						}
				}
	});
	
	/*********************************************************************/
	$("#quiero-foto-nuevo-menu").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-nuevo-menu').prop('checked')){			
				vaciarFotoNuevoMenu();
				$("#fotoForm-nuevo-menu").attr("src","img/sinimagen.jpg");
			} else {
					$('#btnSeleccionar-nuevo-menu').trigger('click');
					if ($("#fotoForm-nuevo-menu").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-nuevo-menu').prop('checked', false);
						}
				}
	});
	
	/*********************************************************************/
	$("#quiero-foto-nuevo-submenu").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-nuevo-submenu').prop('checked')){			
				vaciarFotoNuevoSubmenu();
				$("#fotoForm-nuevo-submenu").attr("src","img/sinimagen.jpg");
			} else {
					$('#btnSeleccionar-nuevo-submenu').trigger('click');
					if ($("#fotoForm-nuevo-submenu").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-nuevo-submenu').prop('checked', false);
						}
				}
	});
	
	/*********************************************************************/
	$("#quiero-foto-edit").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-edit').prop('checked')){			
				vaciarFotoEdit();
				//$('input[name=filenameFoto-edit]').val("");
				//$("#fotoForm-edit").attr("src","img/sinimagen.jpg");
			} else {
					$('#btnSeleccionar-edit').trigger('click');
					if ($("#fotoForm-edit").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-edit').prop('checked', false);
						$('input[name=filenameFoto-edit]').val("");
						}
				}
	});
	/*********************************************************************/
	$("#quiero-foto-edit-menu").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-edit-menu').prop('checked')){			
				vaciarFotoEditMenu();
				$('input[name=filenameFoto-edit-menu]').val("");
				$("#fotoForm-edit-menu").attr("src","img/sinimagen.jpg");
			} else {
					$('#btnSeleccionar-edit-menu').trigger('click');
					if ($("#fotoForm-edit-menu").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-edit-menu').prop('checked', false);
						$('input[name=filenameFoto-edit-menu]').val("");
						}
				}
	});
	/*********************************************************************/
	$("#quiero-foto-edit-submenu").on("change",function(e){
		e.preventDefault();
		if (!$('#quiero-foto-edit-submenu').prop('checked')){			
				vaciarFotoEditSubmenu();
				$('input[name=filenameFoto-edit-submenu]').val("");
				$("#fotoForm-edit-submenu").attr("src","img/sinimagen.jpg");
			} else {
					$('#btnSeleccionar-edit-submenu').trigger('click');
					if ($("#fotoForm-edit-submenu").attr("src")=="img/sinimagen.jpg"){
						$('#quiero-foto-edit-submenu').prop('checked', false);
						$('input[name=filenameFoto-edit-submenu]').val("");
						}
				}
	});
	/*********************************************************************/
	$('#btnSeleccionar-edit').on('change', prepareUploadEdit);
	$('#btnSeleccionar-edit-menu').on('change', prepareUploadEditMenu);
	$('#btnSeleccionar-edit-submenu').on('change', prepareUploadEditSubmenu);
	$('#btnSeleccionar-edit-publi').on('change', prepareUploadEditPubli);
	
	$('#btnSeleccionar-nueva').on('change', prepareUploadNueva); 
	$('#btnSeleccionar-nuevo-menu').on('change', prepareUploadNuevoMenu); 
	$('#btnSeleccionar-nuevo-submenu').on('change', prepareUploadNuevoSubmenu); 
	$('#btnSeleccionar-nueva-publi').on('change', prepareUploadNuevaPubli); 
    
	/*********************************************************************/    
      var getAllEstadoItem= function(){
        /*console.log("listando estadosItems");*/
        $.get(URI.GET_TEMPLATE_estadoitem, function(template_text){
            /*console.log(template_text);*/
            $.ajax({
            url : URI.GET_AllEstadosItems,
            method : 'GET',
            dataType : 'json',
            data : {} 
        }).done(function(res){		
		/*console.log(res);*/
            if(!res.error){		   
                var context = {
                    estadositems : res.data
                };
                var template = Handlebars.compile(template_text);
                var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');	
		/**/
                 $("#select-estado-item-nueva").html(html);	
		$("#select-estado-item-edit").html(html);	
		   $("#select-estado-item-nuevo-menu").html(html);	
		$("#select-estado-item-edit-menu").html(html);	
		   $("#select-estado-item-nuevo-submenu").html(html);	
		$("#select-estado-item-edit-submenu").html(html);
		
		$('#select-estado-item-nueva').material_select();		
		$('#select-estado-item-edit').material_select();
		$('#select-estado-item-nuevo-menu').material_select();		
		$('#select-estado-item-edit-menu').material_select();
		$('#select-estado-item-nuevo-submenu').material_select();		
		$('#select-estado-item-edit-submenu').material_select();
		
            }
        })
	 .fail(function(){
            console.log("error select submenu 8");
        }); 
        })
     };
    /*********************************************************************/
     var getAllNotas = function(submenuID){

             
            $.ajax({
            url : URI.GET_AllNotas,
            method : 'GET',
            dataType : 'json',
            data : {submenu_id:submenuID}
        }).done(function(res){
            if(!res.error){		   
				var notas= res.data;
		$("#listado-notas tbody").html("");
		notas.forEach(function (nota) {			
			var ruta="img/sinimagen.jpg";
			if (nota.filenameFoto !=""){
				ruta = nota.pathFoto+'/'+nota.id+'/'+nota.filenameFoto;
				}
			var 	html = ' <tr id="nota-'+nota.id+'">';
				html += ' <td class="notaId hidden">'+nota.id+'</td> ';
				if (nota.publicado==1){					
					html += ' <td class="notaFecha" style="font-weight:bold; color:green">'+nota.fechaNotaUser+'</td> ';
				} else {
					html += ' <td class="notaFecha" style="font-weight:bold; color:red">'+nota.fechaNotaUser+'</td> ';
				}				
				html += '<td class="notaTitulo">'+nota.titulo+'</td>';
				html += ' <td class="centered"><img class="materialboxed" height="113" src="'+ruta+'"></td>';
				html += '<td class="centered">';
				html += '<a class="btn editar" href="#">Editar</a> ';
				html += '</td>';
				html += '<td class="centered">';
				html += '<a class="btn eliminar modal-trigger" href="#modalEliminar">Eliminar</a> ';
				html += '</td>';
				html += '<tr>';
				
				
				
				
			<!-- Modal Trigger -->

			
				$("#listado-notas tbody").append(html); // aca deberia ir un append
		});
		
		
		$('.materialboxed').materialbox();
            }else{		     
		     $("#listado-notas tbody").html("");
		    Materialize.toast('No hay notas para esta seleccion', 1500);
		}
        })
	  .fail(function(){
            console.log("error al traer notas 2");
        });
       
    
    };
 /*********************************************************************/
     var deletemenu= function(menuID){
        /*console.log("eliminando nota " + notaID);*/
        $.ajax({
            url : URI.DELETE_menu,
            method : 'POST',
            dataType : 'json',
            data : { id : menuID}
        })
        .done(function(res){
            /*console.log(res);*/
            if(!res.error){				
                $("#menu-"+menuID).remove();
            }
        })
        .fail(function(){
            console.log("error delete menu");
        });        
    };
      /*********************************************************************/
     var deletesubmenu= function(submenuID){
        /*console.log("eliminando nota " + notaID);*/
        $.ajax({
            url : URI.DELETE_submenu,
            method : 'POST',
            dataType : 'json',
            data : { id : submenuID}
        })
        .done(function(res){
            /*console.log(res);*/
            if(!res.error){				
                $("#submenu-"+submenuID).remove();
            }
        })
        .fail(function(){
            console.log("error delete submenu");
        });        
    };
     /*********************************************************************/
     var deletepubli= function(publiID){
    	      
	   $.ajax({
            url : URI.DELETE_publi,
            method : 'POST',
            dataType : 'json',
            data : { id : publiID}
        })
        .done(function(res){
    
            if(!res.error){				
                if ($("#publi-publi-"+publiID).closest(".contenedor-color-v2").length>0){
					$("#publi-publi-"+publiID).closest(".contenedor-color-v2").remove();
				} else {
					$("#publi-publi-"+publiID).closest(".contenedor-color").find(".btn").addClass("disabled");
					$("#publi-publi-"+publiID).remove();
				}				
				
				Materialize.toast('Publicidad eliminada', 2000);
            } else {
				console.log("error delete publi");
			}
			
        })
        .fail(function(){
            console.log("fail delete publi");
        });        
		
	
    };
    /*********************************************************************/
     var deletenota= function(notaID){
        /*console.log("eliminando nota " + notaID);*/
        $.ajax({
            url : URI.DELETE_nota,
            method : 'POST',
            dataType : 'json',
            data : { id : notaID}
        })
        .done(function(res){
            /*console.log(res);*/
            if(!res.error){				
                $("#nota-"+notaID).remove();
            }
        })
        .fail(function(){
            console.log("error delete nota");
        });        
    };
     /*********************************************************************/
      var fillListadoSubmenu = function (submenus){
	
	    var html="";
	    submenus.forEach(function(submenu){
		    html+='<tr id="submenu-'+submenu.id+'">';
		    html+='<td class="submenuId">'+submenu.id+'</td>';
		    html+='<td class="menuTitulo">'+submenu.titulo+'</td>';
		    html+='<td class="centered"><img class="materialboxed"  height="113" src="'+submenu.pathFoto+'/'+submenu.id+'/'+submenu.filenameFoto+'"></td>';
		     html+='<td class="centered">';
		      html+='<a class="btn editar" href="#">Editar</a> ';
			  html+='</td>';		      
			  html+='<td class="centered">';
			  html+=' <a class="btn eliminar" href="#">Eliminar</a>';
		      html+='</td>';
		      html+='</tr>';
	    });
	    
	    $('#listado-submenus tbody').html(html);
		
	}
    /*********************************************************************/
   var fillListadoMenu = function (menus){
	
	    var html="";
	    menus.forEach(function(menu){
		    html+='<tr id="menu-'+menu.id+'">';
		    html+='<td class="menuId">'+menu.id+'</td>'; 
		    html+='<td class="menuTitulo">'+menu.titulo+'</td>';
		    html+='<td class="centered"><img class="materialboxed"  height="113" src="'+menu.pathFoto+'/'+menu.id+'/'+menu.filenameFoto+'"></td>';
		     html+='<td class="centered">';
			 html+='<a class="btn editar" href="#">Editar</a> ';
			 html+='</td>';
			 html+='<td class="centered">';		      
		      html+=' <a class="btn eliminar" href="#">Eliminar</a>';
		      html+='</td>';
		      html+='</tr>';
	    });
	    
	    $('#listado-menus tbody').html(html);
		
	}
   /*********************************************************************/
      var getAllSubmenu= function(menuId,submenuId){        
        $.get(URI.GET_TEMPLATE_submenu, function(template_text){
            /*console.log(template_text);*/
            $.ajax({
            url : URI.GET_Allsubmenu,
            method : 'GET',
            dataType : 'json',
            data : { menu_id : menuId}
        }).done(function(res){		
		/*console.log(res);*/
            if(!res.error){		   
                var context = {
                    submenus : res.data
                };
		var wordSubmenu = 0;
		
				if (!submenuId){
					submenuId=res.data[0].id;
					wordSubmenu=res.data[0].word;
				} else{
					res.data.forEach(function(submenu){
						if (submenu.id==submenuId){
							wordSubmenu=submenu.word;	
						}							
					});						
				}
			
				if (wordSubmenu==1){
						$("#fila-chk-word").removeClass("hidden");
						$("#fila-chk-word-edit").removeClass("hidden");
				} else {
					$("#fila-chk-word").addClass("hidden");
					$("#fila-chk-word-edit").addClass("hidden");
					}
				
				var template = Handlebars.compile(template_text);
				var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');	
				
				$("#select-submenu").removeClass("hidden");
				$("#select-submenu-edit").removeClass("hidden");
				$("#select-submenu-nueva").removeClass("hidden");
				$("#form-nota-nueva .row-para-completar").removeClass("hidden");
				
				$("#select-submenu").html(html);
				$("#select-submenu-edit").html(html);
				$("#select-submenu-nueva").html(html);
				
				$("#select-submenu").val(submenuId);
				$("#select-submenu-edit").val(submenuId);
				$("#select-submenu-nueva").val(submenuId);
				
				$('#select-submenu').material_select();
				$('#select-submenu-edit').material_select();
				$('#select-submenu-nueva').material_select();
			
				if ($('.ul-admin-ppal').find('.active-li a').html().indexOf("NOTAS") >=0){					
					getAllNotas(submenuId);
				}
				fillListadoSubmenu(res.data);
				getAllEstadoItem();
		
            } else {
				$('#listado-notas tbody').html("");
				$('#listado-submenus tbody').html("");
				$("#select-submenu").addClass("hidden");
				$("#select-submenu-edit").addClass("hidden");
				$("#select-submenu-nueva").addClass("hidden");
				$("#form-nota-nueva .row-para-completar").addClass("hidden");
				$('#select-submenu').material_select();
				$('#select-submenu-edit').material_select();
				$('#select-submenu-nueva').material_select();
				Materialize.toast('No hay submenus para esta seleccion', 2000);
			}
        })
	 .fail(function(){
            console.log("error select submenu-101");
        }); 
        })
     };
	/*********************************************************************/
	$("#listado-menus").on("click", ".btn.eliminar", function(event){       
		
		var id = $(this).closest("tr").find(".menuId").html();
		$('#modalEliminarMenu').find('p').text($(this).closest("tr").find('.menuTitulo').html());
		$('#modalEliminarMenu').find('img').attr("src",$(this).closest("tr").find('.materialboxed').attr("src"));
		$('#id-eliminar-menu').val(id);
		$('#modalEliminarMenu').openModal();
		
	});
	$('#confirmar-eliminar-menu').on("click",null,function(e){
		e.preventDefault();
		$('#modalEliminarMenu').closeModal();
		deletemenu($('#id-eliminar-menu').val());
		Materialize.toast('Menu eliminado', 2000);
		return false;
		
	});
     /*********************************************************************/
	$("#listado-submenus").on("click", ".btn.eliminar", function(event){       
		
		var id = $(this).closest("tr").find(".submenuId").html();
		$('#modalEliminarSubmenu').find('p').text($(this).closest("tr").find('.submenuTitulo').html());
		$('#modalEliminarSubmenu').find('img').attr("src",$(this).closest("tr").find('.materialboxed').attr("src"));
		$('#id-eliminar-submenu').val(id);
		$('#modalEliminarSubmenu').openModal();
		
	});
	
	$('#confirmar-eliminar-submenu').on("click",null,function(e){
		e.preventDefault();
		$('#modalEliminarSubmenu').closeModal();
		deletesubmenu($('#id-eliminar-submenu').val());
		Materialize.toast('Submenu eliminado', 2000);
		return false;
		
	});
     /*********************************************************************/
	$("#listado-notas").on("click", ".btn.eliminar", function(event){       
		
		var id = $(this).closest("tr").find(".notaId").html();
		$('#modalEliminar').find('p').text($(this).closest("tr").find('.notaTitulo').html());
		$('#modalEliminar').find('img').attr("src",$(this).closest("tr").find('.materialboxed').attr("src"));
		$('#id-eliminar').val(id);
		$('#modalEliminar').openModal();
		
	});
	$('#confirmar-eliminar').on("click",null,function(e){
		e.preventDefault();
		$('#modalEliminar').closeModal();
		deletenota($('#id-eliminar').val());
		Materialize.toast('Nota eliminada', 2000);
		return false;
		
	});
	/*********************************************************************/
	var getMenu = function(idMenu){			
		$.ajax({
		    url : URI.GET_menus,
		    method : 'GET',
		    dataType : 'json',
		    data : { id : idMenu}
		}).done(function(res){					
			/*console.log(res);*/
		    if(!res.error){	
			
			
			$('#edit-id-menu').val(res.data.id);
						
			$('#select-estado-item-edit-menu').val(res.data.estadoItem_id);
			$('#select-estado-item-edit-menu').material_select();
			
			
			
			if (res.data.titulo=="" || res.data.titulo==null){				
			} else {				
				$('#titulo-edit-menu').val(res.data.titulo);
				//resizeTextarea($('#titulo-edit-menu'));
			}
			
			
			if (res.data.filenameFoto!=""){
				$('#filenameFoto-edit-menu').val(res.data.filenameFoto);			
				var rutaFoto= $rootDir+"/"+res.data.pathFoto.toString()+"/"+res.data.id.toString()+"/"+res.data.filenameFoto.toString();
				$('#fotoForm-edit-menu').attr("src",rutaFoto); 
				
				$('#quiero-foto-edit-menu').prop('checked', true);
				/*$('#btnSeleccionar-edit').val("lachota");*/
				}
			else {
				/*$('#filenameFoto-edit').val("");
				$('#fotoForm-edit').attr("src","");
				$('#quiero-foto-edit').prop('checked', false);*/
				vaciarFotoEditMenu();
				
			}
			    
			$('ul.tabs').tabs('select_tab', 'editar-menu');
			
		    } else {
			    console.log("error en getMenu");
			    
		    }
		})
		 .fail(function(){
		    console.log("error al traer menu");
		}); 
	};
	/*********************************************************************/
	var getSubmenu = function(idSubmenu){
		 $.ajax({
		    url : URI.GET_submenus,
		    method : 'GET',
		    dataType : 'json',
		    data : { id : idSubmenu}
		}).done(function(res){					
			/*console.log(res);*/
		    if(!res.error){	
			
			var siPortada=false;
			if (res.data.portada=='1'){
				siPortada=true;
			}
			$('#chk-portada-edit').prop("checked",siPortada);
			
			var siFecha=false;
			if (res.data.fecha=='1'){
				siFecha=true;
			}
			$('#chk-fecha-submenu-edit').prop("checked",siFecha);
			
			var siVisitas=false;
			if (res.data.visitas=='1'){
				siVisitas=true;
			}
			$('#chk-visitas-submenu-edit').prop("checked",siVisitas);
			
			
			var siWord=false;
			if (res.data.word=='1'){
				siWord=true;
			}
			$('#chk-word-submenu-edit').prop("checked",siWord);
			
			
			$('#edit-id-submenu').val(res.data.id);
						
			$('#select-estado-item-edit-submenu').val(res.data.estadoItem_id);
			$('#select-estado-item-edit-submenu').material_select();
			
						
			if (res.data.titulo=="" || res.data.titulo==null){				
			} else {				
				$('#titulo-edit-submenu').val(res.data.titulo);
				//$('#titulo-edit-submenu').trigger('autoresize');
			}
		
			if (res.data.descripcion=="" || res.data.descripcion==null){									
			} else {									
				$('#descripcion-edit-submenu').val(res.data.descripcion);
				//$('#descripcion-edit-submenu').trigger('autoresize');
				
			}
			
			if (res.data.filenameFoto!=""){
				$('#filenameFoto-edit-submenu').val(res.data.filenameFoto);			
				var rutaFoto= $rootDir+"/"+res.data.pathFoto.toString()+"/"+res.data.id.toString()+"/"+res.data.filenameFoto.toString();
				$('#fotoForm-edit-submenu').attr("src",rutaFoto); 
				
				$('#quiero-foto-edit-submenu').prop('checked', true);
				/*$('#btnSeleccionar-edit').val("lachota");*/
				}
			else {
				/*$('#filenameFoto-edit').val("");
				$('#fotoForm-edit').attr("src","");
				$('#quiero-foto-edit').prop('checked', false);*/
				vaciarFotoEditSubmenu();
				
			}
			    
			$('ul.tabs').tabs('select_tab', 'editar-submenu');
			
		    }  else {
			    console.log("error en getSubmenu");
		    }
		})
		 .fail(function(){
		    console.log("error al traer submenu");
		}); 
	};
	/*********************************************************************/
	var getNota = function(idNota){
		
		 $.ajax({
		    url : URI.GET_notas,
		    method : 'GET',
		    dataType : 'json',
		    data : { id : idNota}
		}).done(function(res){				
					
		    if(!res.error){					
				
				/* calendario */
				setCustomCalendar($('#datetime-edit-nota'),res.data.fechaNota);
			
				/* carrusel */
				var siCarrusel=false;
				if (res.data.carrusel=='1'){
					siCarrusel=true;
				}
				$('#chk-carrusel-edit').prop("checked",siCarrusel);			
				
				/* word */
				if (res.data.habilitadoWord=='1'){
					$('#fila-chk-word-edit').removeClass("hidden");
					var siWord=false;
					if (res.data.word=='1'){
						siWord=true;
					}
					$('#chk-word-edit').prop("checked",siWord);
				} else {
					$('#fila-chk-word-edit').addClass("hidden");
				}
			
				/* id */
				$('#editar-nota').find('#edit-id').val(res.data.id);						
				/* estado */
				$('#select-estado-item-edit').val(res.data.estadoItem_id);
				$('#select-estado-item-edit').material_select();			
				/* vistas */
				$('#input-vistas-edit').val(res.data.vistas);
			
				/* titulo */
				if (res.data.titulo=="" || res.data.titulo==null){	
					$('#titulo-edit').val("");
				} else {				
					$('#titulo-edit').val(res.data.titulo);				
				}
			
				/* subtitulo */
				if (res.data.subtitulo=="" || res.data.subtitulo==null){	
					$('#subtitulo-edit').val("");
				} else {	
					$('#subtitulo-edit').val(res.data.subtitulo);									
				}
			
				/* descripcion */
				if (res.data.descripcion=="" || res.data.descripcion==null){									
					$('#descripcion-edit').val("");
				} else {									
					$('#descripcion-edit').val(res.data.descripcion);							
				}
			
				/* fuente (ex-autor) */
				if (res.data.autor=="" || res.data.autor==null){
					$('#autor-edit').val("");
				} else {									
					$('#autor-edit').val(res.data.autor);		
				}
			
				/* imagen */
				if (res.data.filenameFoto=="" || res.data.filenameFoto==null){
					vaciarFotoEdit();
				} else {
					$('.imagen-fila-edit').removeClass("hidden");					
					$('#filenameFoto-edit').val(res.data.filenameFoto);			
					var rutaFoto= $rootDir+"/"+res.data.pathFoto.toString()+"/"+res.data.id.toString()+"/"+res.data.filenameFoto.toString();
					$('#fotoForm-edit').attr("src",rutaFoto); 		
					$('#quiero-foto-edit').prop('checked', true);
					$('#chk-imagen-edit').prop('checked', true);	
					/* imagenpor */
					if (res.data.imagenpor=="" || res.data.imagenpor==null){				
						$('#imagenpor-edit').val("");
					} else{						
						$('#imagenpor-edit').val(res.data.imagenpor);
					}
				}					
				
				/* twitter */
				if (res.data.twitter=="" || res.data.twitter==null){
					vaciarTweetEdit();
				} else{					
					$("#chk-tweet-edit").prop('checked',true);
					$('.tweet-fila-edit').removeClass("hidden");
					$('#tweet-status-edit').val(res.data.twitter_status);
					
					$("#chk-tweetennota-edit").prop('checked',res.data.twitter_ennota == 1);
					$("#chk-tweetconversation-edit").prop('checked',res.data.twitter_conversation == 1);
					$("#chk-tweetcards-edit").prop('checked',res.data.twitter_cards == 1);
					$("#chk-tweetenhome-edit").prop('checked',res.data.twitter_enhome == 1);
					
					$('#tweetDIVedit').removeClass("hidden");
					$('#btn-probar-tweet-edit').trigger("click");
				}
				
				/* video */
				if (res.data.video=="" || res.data.video==null){
					vaciarVideoEdit();
				} else{					
					$("#chk-video-edit").prop('checked',true);
					$('.video-fila-edit').removeClass("hidden");
					$('#video-edit').val(res.data.video);
					$('.codegena-edit').removeClass("hidden");
					$('#src-youtube-edit').attr("src","https://www.youtube.com/embed/"+res.data.video+"?&autohide=2&modestbranding=1&showinfo=0&rel=0");
				}
				
				/* tab edit-nota active */
				$('ul.tabs').tabs('select_tab', 'editar-nota');  
			} else {
			    console.log(res.error);
			}
		})
		 .fail(function(){
		    console.log("fail al traer nota");
		}); 
	};
	/*********************************************************************/
	 $(".btn-cancel-edit-nota").on("click", null, function(event){ 
		event.preventDefault();
		$(".super-tabs-notas").removeClass("hidden");
		$("#editar-nota").addClass("hidden");
	 });
	 /*********************************************************************/
	 $(".btn-cancel-edit-menu").on("click", null, function(event){ 
		event.preventDefault();
		$(".super-tabs-menus").removeClass("hidden");
		$("#editar-menu").addClass("hidden");
	 });
	 /*********************************************************************/
	 $(".btn-cancel-edit-submenu").on("click", null, function(event){ 
		event.preventDefault();
		$(".super-tabs-submenus").removeClass("hidden");
		$("#editar-submenu").addClass("hidden");
	 });
	/*********************************************************************/
	 $("#listado-menus").on("click", ".btn.editar", function(event){       		
		
		//osni
		$(".super-tabs-menus").addClass("hidden");
		$("#editar-menu").removeClass("hidden");
		
		var id = $(this).closest("tr").find(".menuId").html();
		getMenu (id);			
		return false;
	});
	/*********************************************************************/
	 $("#listado-submenus").on("click", ".btn.editar", function(event){       
		//osni
		$(".super-tabs-submenus").addClass("hidden");
		$("#editar-submenu").removeClass("hidden");
		
		var id = $(this).closest("tr").find(".submenuId").html();
		getSubmenu (id);			
		return false;
	});
	/*********************************************************************/
	 $("#listado-notas").on("click", ".btn.editar", function(event){       
		//osni
		$(".super-tabs-notas").addClass("hidden");
		$("#editar-nota").removeClass("hidden");
		
		var id = $(this).closest("tr").find(".notaId").html();
		getNota (id);			
	
	});
	
	/*********************************************************************/
	 $("#listado-carrusel").on("click", ".btn.editar", function(event){      
		$(".super-tabs-notas").addClass("hidden");
		$("#editar-nota").removeClass("hidden");
		var id = $(this).closest("tr").find("input").val();
			
		getNota (id);			
		return false;
	});
	
	/*********************************************************************/
	 $("#search-listado-carrusel").on("click", ".btn.editar", function(event){      
		var id = $(this).closest("tr").find("input").val();		
		getNota (id);			
		return false;
	});
	/*********************************************************************/
	$(".tab.hidden").on("click",null,function(e){		
	   $('.indicator').addClass("hidden");
	});
	/*********************************************************************/
	 $(".tab.visible").on("click",null,function(e){		
	    $('.indicator').removeClass("hidden");
	});
	/*********************************************************************/
	 $("#close-eliminar-menu").on("click",null,function(e){		
	    $('#modalEliminarMenu').closeModal();
	});
	/*********************************************************************/
	 $("#close-eliminar-publi").on("click",null,function(e){		
	    $('#modalEliminarPubli').closeModal();
	});
	/*********************************************************************/
	 $("#close-nueva-publi").on("click",null,function(e){		
	    $('#modalNuevaPubli').closeModal();
	});
	/*********************************************************************/
	 $("#close-editar-publi").on("click",null,function(e){		
	    $('#modalEditarPubli').closeModal();
	});
	/*********************************************************************/
	 $("#close-eliminar-submenu").on("click",null,function(e){		
	    $('#modalEliminarSubmenu').closeModal();
	});
	/*********************************************************************/
	 $("#close-eliminar").on("click",null,function(e){		
	    $('#modalEliminar').closeModal();
	});
	/*********************************************************************/    
	$('#select-menu-submenu').on("change",function(event){
		$('#select-menu-edit-submenu').val($('#select-menu-submenu option:selected').val());		
		$('#select-menu-edit-submenu').material_select();
		$('#select-menu-nuevo-submenu').val($('#select-menu-submenu option:selected').val());		
		$('#select-menu-nuevo-submenu').material_select();
		
		getAllSubmenu($('#select-menu-submenu option:selected').val());
	});
	$('#select-menu-edit-submenu').on("change",function(event){	
		$('#select-menu-submenu').val($('#select-menu-edit-submenu option:selected').val());		
		$('#select-menu-submenu').material_select();
		$('#select-menu-nuevo-submenu').val($('#select-menu-edit-submenu option:selected').val());		
		$('#select-menu-nuevo-submenu').material_select();
		
		getAllSubmenu($('#select-menu-edit-submenu option:selected').val()); 
	});
	$('#select-menu-nuevo-submenu').on("change",function(event){	
		$('#select-menu-submenu').val($('#select-menu-nuevo-submenu option:selected').val());		
		$('#select-menu-submenu').material_select();
		$('#select-menu-edit-submenu').val($('#select-menu-nuevo-submenu option:selected').val());		
		$('#select-menu-edit-submenu').material_select();
		
		getAllSubmenu($('#select-menu-nuevo-submenu option:selected').val()); 
	});
   /*********************************************************************/    
	$('#select-menu').on("change",function(event){
		$('#select-menu-edit').val($('#select-menu option:selected').val());		
		$('#select-menu-edit').material_select();
		$('#select-menu-nueva').val($('#select-menu option:selected').val());		
		$('#select-menu-nueva').material_select();
		
		getAllSubmenu($('#select-menu option:selected').val()); /*el segundo parametro es el id=1 del submenu (no debe volar nunca de la db */
	});
	$('#select-menu-edit').on("change",function(event){	
		$('#select-menu').val($('#select-menu-edit option:selected').val());		
		$('#select-menu').material_select();
		$('#select-menu-nueva').val($('#select-menu-edit option:selected').val());		
		$('#select-menu-nueva').material_select();
		
		getAllSubmenu($('#select-menu-edit option:selected').val()); /*el segundo parametro es el id=1 del submenu (no debe volar nunca de la db */
	});
	$('#select-menu-nueva').on("change",function(event){	
		$('#select-menu').val($('#select-menu-nueva option:selected').val());		
		$('#select-menu').material_select();
		$('#select-menu-edit').val($('#select-menu-nueva option:selected').val());		
		$('#select-menu-edit').material_select();
		
		getAllSubmenu($('#select-menu-nueva option:selected').val()); /*el segundo parametro es el id=1 del submenu (no debe volar nunca de la db */
	});
   /*********************************************************************/
	$('#select-submenu').on("change",function(event){	
		$('#select-submenu-edit').val($('#select-submenu option:selected').val());		
		$('#select-submenu-edit').material_select();
		$('#select-submenu-nueva').val($('#select-submenu option:selected').val());		
		$('#select-submenu-nueva').material_select();
		
		getAllSubmenu($('#select-menu option:selected').val(),$('#select-submenu option:selected').val());
	});
	$('#select-submenu-edit').on("change",function(event){	
		$('#select-submenu').val($('#select-submenu-edit option:selected').val());		
		$('#select-submenu').material_select();
		$('#select-submenu-nueva').val($('#select-submenu-edit option:selected').val());		
		$('#select-submenu-nueva').material_select();	
		//setWordHabilitadoEdit($('#select-submenu-edit option:selected').val());
		//getAllNotas($('#select-submenu-edit option:selected','edit').val());
		getAllSubmenu($('#select-menu-edit option:selected').val(),$('#select-submenu-edit option:selected').val());
	});
	$('#select-submenu-nueva').on("change",function(event){	
		$('#select-submenu').val($('#select-submenu-nueva option:selected').val());		
		$('#select-submenu').material_select();
		$('#select-submenu-edit').val($('#select-submenu-nueva option:selected').val());		
		$('#select-submenu-edit').material_select();	
		//setWordHabilitadoNueva($('#select-submenu-nueva option:selected').val());
		//getAllNotas($('#select-submenu-nueva option:selected','nueva').val());
		getAllSubmenu($('#select-menu-nueva option:selected').val(),$('#select-submenu-nueva option:selected').val());
	});
  	/*********************************************************************/
	$("#form-nota-edit").submit(function(e){
		e.preventDefault();
		cleanFormError();
		if(validarFormData()){				
		    var myDate = datetimeTOsql($("#datetime-edit-nota"));
		
		    var formData = new FormData();
			    formData.append( 'id', $('#edit-id').val());
			    formData.append( 'titulo', $('#titulo-edit').val());
			    formData.append( 'subtitulo', $('#subtitulo-edit').val());
			    formData.append( 'descripcion', $('#descripcion-edit').val());
				formData.append( 'autor', $('#autor-edit').val());
				formData.append( 'imagenpor', $('#imagenpor-edit').val());
				
				formData.append( 'twitter',$("#chk-tweet-edit").prop('checked'));
				formData.append( 'status',$("#tweet-status-edit").val());
				formData.append( 'ennota',$("#chk-tweetennota-edit").prop('checked'));
				formData.append( 'enhome',$("#chk-tweetenhome-edit").prop('checked'));
				formData.append( 'cards',$("#chk-tweetcards-edit").prop('checked'));
				formData.append( 'conversation',$("#chk-tweetconversation-edit").prop('checked'));
				
				formData.append( 'video', $('#video-edit').val());
			    formData.append( 'pathFoto', 'files/nota/');
			    formData.append( 'submenu_id',$('#select-submenu-edit option:selected').val());	
			    formData.append( 'vistas',$('#input-vistas-edit').val());	
			    formData.append( 'estadoItem_id',$('#select-estado-item-edit option:selected').val());	
				formData.append( 'carrusel',$("#chk-carrusel-edit").prop('checked'));
				formData.append( 'word',$("#chk-word-edit").prop('checked'));
				formData.append( 'fechaNota',myDate);
			
			//osni
			if ($('#chk-baul-edit').is(':checked')) {
				if ($('#filenameFoto-edit-from-gallery').val()!=""){					
					formData.append( 'copyFileId', $('#fotoForm-edit-from-gallery').attr("src").split("/")[3]);
					formData.append( 'fileNameFoto', $('#fotoForm-edit-from-gallery').attr("src").split("/")[4]);
				} else {				
					formData.append( 'fileNameFoto','');				
				}
			
			} else {
				if (selectedFile){				
						$.each(files, function(key, value){		    
						formData.append(key, value);					
					});					
				} else {				
					formData.append( 'fileNameFoto',$('input[name=filenameFoto-edit]').val());
				}
			}

		    
		    $.ajax({
			url : URI.ACTUALIZAR,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){								
				if ($("#chk-carrusel-edit").prop('checked')) {
					
					getAllCarrusel();
					getVistaPreviaCarrusel();
				}				
				
				cleanFormDataEdit();
				
				getAllMenu($('#select-menu-edit option:selected').val(),$('#select-submenu-edit option:selected').val());
								
				$(".super-tabs-notas").removeClass("hidden");
				$("#editar-nota").addClass("hidden");
				Materialize.toast('Nota actualizada con exito', 4000);
			}else{
			    
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("fail edit");
		    });
			}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/
	$("#form-publi-edit").submit(function(e){
		e.preventDefault();
		cleanFormError();
		if(validarFormData()){				
		    
		    var formData = new FormData();
			formData.append( 'id', $('#id-editar-publi').val());
			formData.append( 'href', $('#http_editar_publi').val());			 
			formData.append( 'pathFoto', 'files/publi/');			    			   
			//formData.append( 'estadoItem_id',1);
			formData.append( 'lugarPubli', $('#lugarPubli-modal-edit').val());
			//formData.append( 'menu_id',$('#id-editar-publi-menu').val());	
			formData.append('timePopup', $("#select-delay-popup").val());
						
		    if (selectedFile){				
			$.each(files, function(key, value){	
				console.log(key);
				console.log(value);
			    formData.append(key, value);					
			});
			
		    }else {
			formData.append( 'filenameFoto', $('input[name=filenameFoto-edit-publi]').val());
		    }
			
		
			
		    
		    $.ajax({
			url : URI.POST_UpdateEstadov2,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){
					
				getAllMenu();
				Materialize.toast('Publicidad actualizada con exito', 4000);
				$('#modalEditarPubli').closeModal();
				
			}else{
			    /*console.log(res);*/
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error");
		    });
			}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/
	$("#form-menu-edit").submit(function(e){
		e.preventDefault();
		cleanFormError();
		if(validarFormData()){				
		    
		    var formData = new FormData();
			formData.append( 'id', $('#edit-id-menu').val());
			formData.append( 'titulo', $('#titulo-edit-menu').val());			 
			formData.append( 'pathFoto', 'files/menu/');			    			   
			formData.append( 'estadoItem_id',$('#select-estado-item-edit-menu option:selected').val());	
			
					
		    if (selectedFile){				
			$.each(files, function(key, value){		    
			    formData.append(key, value);					
			});
		    }else {
			formData.append( 'filenameFoto', $('input[name=filenameFoto-edit-menu]').val());
		    }
					
		
		    
		    $.ajax({
			url : URI.ACTUALIZAR_MENU,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){
														
				cleanFormDataEditMenu();
				getAllMenu();
				$(".super-tabs-menus").removeClass("hidden");
				$("#editar-menu").addClass("hidden");
				Materialize.toast('Menu actualizado con exito', 4000);
				
			}else{
			    /*console.log(res);*/
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error");
		    });
			}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/
	$("#form-submenu-edit").submit(function(e){
		e.preventDefault();
		cleanFormError();
		if(validarFormData()){				
		    
		    var formData = new FormData();
			    formData.append( 'id', $('#edit-id-submenu').val());
			    formData.append( 'titulo', $('#titulo-edit-submenu').val());		
			    formData.append( 'descripcion', $('#descripcion-edit-submenu').val());
			    formData.append( 'pathFoto', 'files/submenu/');
			    formData.append( 'menu_id',$('#select-menu-edit-submenu option:selected').val());				  
			    formData.append( 'estadoItem_id',$('#select-estado-item-edit-submenu option:selected').val());	
				formData.append( 'portada',$("#chk-portada-edit").prop('checked'));	
				formData.append( 'word',$("#chk-word-submenu-edit").prop('checked'));
				formData.append( 'fecha',$("#chk-fecha-submenu-edit").prop('checked'));
				formData.append( 'visitas',$("#chk-visitas-submenu-edit").prop('checked'));
					
		    if (selectedFile){				
			$.each(files, function(key, value){		    
			    formData.append(key, value);					
			});
		    }else {
			formData.append( 'filenameFoto', $('input[name=filenameFoto-edit-submenu]').val());
		    }
					
		    
		    
		    $.ajax({
			url : URI.ACTUALIZAR_SUBMENU,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){
				/*console.log(res);*/												
				cleanFormDataEditSubmenu();
				getAllMenu($('#select-menu-edit-submenu option:selected').val());
				$(".super-tabs-submenus").removeClass("hidden");
				$("#editar-submenu").addClass("hidden");
				Materialize.toast('submenu actualizado con exito', 4000);
				
			}else{
			    /*console.log(res);*/
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error");
		    });
			}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/	
	$("#form-menu-nuevo").submit(function(e){
		e.preventDefault();		
		cleanFormError();
		if(validarFormData()){
		
		    
		    var formData = new FormData();
		
			    formData.append( 'titulo', $('#titulo-nuevo-menu').val());			 
			    formData.append( 'pathFoto', 'files/menu/');			    			    
			    formData.append( 'estadoItem_id',$('#select-estado-item-nuevo-menu option:selected').val());
					 
					
		    if (selectedFile){				
			$.each(files, function(key, value){		    
			    formData.append(key, value);					
			});
			
			}else{
			formData.append( 'fileNameFoto','');	
		    }
					
		    
		    
		    $.ajax({
			url : URI.GUARDAR_MENU,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){
				console.log("res!=error");
			   //console.log(res.data);				
				cleanFormDataNuevoMenu();
				getAllMenu();
				Materialize.toast('Menu creado con exito', 4000);
				
			}else{
				//console.log("res=errorrrr");
			    console.log(res);
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error");
		    });
		}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/	
	$("#form-publi-nueva").submit(function(e){
		e.preventDefault();		
		cleanFormError();
		if(validarFormData()){
		
		    
		    var formData = new FormData();
					
			formData.append( 'href', $('#http_nueva_publi').val());			 
			formData.append( 'pathFoto', 'files/publi/');			    			   
			formData.append( 'estadoItem_id',2);
			formData.append( 'menu_id',$('#id-nueva-publi-menu').val());
					
		    if (selectedFile){				
			$.each(files, function(key, value){		 
				console.log(key);
				console.log(value);
			    formData.append(key, value);					
			});
			
			}else{
			formData.append( 'fileNameFoto','');	
		    }
					
					   
		    $.ajax({
			url : URI.GUARDAR_PUBLI,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){												
				getAllMenu();
				$('#modalNuevaPubli').closeModal();
				Materialize.toast('Publicidad creada con exito', 4000);
			
			}else{
				console.log(res);
				alert("Debes seleccionar una imagen")			    
			}
		    })
		    .fail(function(){                
					console.log("fail");
		    });
	
	}
		
		return false;
	
	});
	/*********************************************************************/	
	$("#form-submenu-nuevo").submit(function(e){
		e.preventDefault();		
		cleanFormError();
		if(validarFormData()){
		
		    
		    var formData = new FormData();
		
			formData.append( 'titulo', $('#titulo-nuevo-submenu').val());	
			formData.append( 'descripcion', $('#descripcion-nuevo-submenu').val());			
			formData.append( 'pathFoto', 'files/submenu/');		
			formData.append( 'menu_id',$('#select-menu-nuevo-submenu option:selected').val());			
			formData.append( 'estadoItem_id',$('#select-estado-item-nuevo-submenu option:selected').val());
			formData.append( 'portada',$("#chk-portada").prop('checked'));
			formData.append( 'word',$("#chk-word-submenu").prop('checked'));
			formData.append( 'fecha',$("#chk-fecha-submenu").prop('checked'));
			formData.append( 'visitas',$("#chk-visitas-submenu").prop('checked'));
					
		    if (selectedFile){				
			$.each(files, function(key, value){		    
			    formData.append(key, value);					
			});
			
			}else{
			formData.append( 'fileNameFoto','');	
		    }
					
					   
		    $.ajax({
			url : URI.GUARDAR_SUBMENU,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){
				//console.log("res!=error");
			   //console.log(res.data);				
				cleanFormDataNuevoSubmenu();
				getAllMenu($('#select-menu-submenu option:selected').val());
				Materialize.toast('Menu creado con exito', 4000);
				
			}else{
				//console.log("res=errorrrr");
			    console.log(res);
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error");
		    });
	
	}
		
		return false;
	
	});
	/*********************************************************************/	
	$("#form-nota-nueva").submit(function(e){
		e.preventDefault();		
		cleanFormError();
		
		
		var myDate = datetimeTOsql($("#datetime-nueva-nota"));
		
		
		
		
		if(validarFormData()){
		
		    
		    var formData = new FormData();
		
			    formData.append( 'titulo', $('#titulo-nueva').val());
			    formData.append( 'subtitulo', $('#subtitulo-nueva').val());
			    formData.append( 'descripcion', $('#descripcion-nueva').val());
				formData.append( 'autor', $('#autor-nueva').val());
				
				formData.append( 'twitter',$("#chk-tweet-nueva").prop('checked'));
				formData.append( 'status',$("#tweet-status-nueva").val());
				formData.append( 'ennota',$("#chk-tweetennota-nueva").prop('checked'));
				formData.append( 'enhome',$("#chk-tweetenhome-nueva").prop('checked'));
				formData.append( 'cards',$("#chk-tweetcards-nueva").prop('checked'));
				formData.append( 'conversation',$("#chk-tweetconversation-nueva").prop('checked'));
				
				formData.append( 'video', $('#video-nueva').val());
				formData.append( 'imagenpor', $('#imagenpor-nueva').val());
			    formData.append( 'pathFoto', 'files/nota/');
			    formData.append( 'submenu_id',$('#select-submenu-nueva option:selected').val());	
			    formData.append( 'vistas',$('#input-vistas-nueva').val());	
			    formData.append( 'estadoItem_id',$('#select-estado-item-nueva option:selected').val());
			    formData.append( 'carrusel',$("#chk-carrusel").prop('checked'));
				formData.append( 'word',$("#chk-word").prop('checked'));
				formData.append( 'fechaNota',myDate);
				//console.log(myDate);
			
			//osni
			if ($('#chk-baul-nueva').is(':checked')) {
					//console.log(3);
				if ($('#filenameFoto-nueva-from-gallery').val()!=""){					
					formData.append( 'copyFileId', $('#fotoForm-nueva-from-gallery').attr("src").split("/")[3]);
					formData.append( 'fileNameFoto', $('#fotoForm-nueva-from-gallery').attr("src").split("/")[4]);
				} else {				
					formData.append( 'fileNameFoto','');				
				}
			
			} else {
					//console.log(2);
				if (selectedFile){	
					//console.log(1);
						$.each(files, function(key, value){		    
						formData.append(key, value);					
					});					
				} else {				
					formData.append( 'fileNameFoto','');
				}
			}
			
		   
			
		    
		    
		    $.ajax({
			url : URI.GUARDAR,
			method : 'POST',
			dataType : 'json',
					cache: false,
					processData: false,
					contentType: false,
			data : formData
					
		    })
		    .done(function(res){
					
			if(!res.error){						
				
				if ($("#chk-carrusel").prop('checked')) {
					getAllCarrusel();
					getVistaPreviaCarrusel();
				}
				cleanFormDataNueva();
				getAllMenu($('#select-menu-nueva option:selected').val(),$('#select-submenu-nueva option:selected').val());
				
				
				Materialize.toast('Nota creada con exito', 4000);
				
			}else{
				//console.log("res=errorrrr");
			    console.log(res);
			    console.log(res.mensaje);
			}
		    })
		    .fail(function(){                
					console.log("error fail 8");
		    });
		}
		//impedir que se ejecute el submit nativo del navegador (ya que los datos los estamos enviando por ajax)
		return false;
    
	});
	/*********************************************************************/
	var showActivas = function (notas){
	
		var html='<ul class="collection" style="border-width: 0;">';				
				
				if(notas){
					notas.forEach(function(nota){
				
						html+='<li class="collection-item avatar" style="border-width: 0; padding:0;">';
						html+='<input name="id-nota-car-eliminar" type="hidden" value="'+nota.id+'">';
						html+='<img width="100%" src="'+nota.pathFoto+'/'+nota.id+'/'+nota.filenameFoto+'"></div>';
						html+='<a><div style="position: absolute; right:5px; top:5px;">';
						html+='<p class="label label-danger">eliminar<p>';
						html+='</div></a>';
						html+='</li>';
					});
				}
				
				html+='</ul>';
				
				$('#col-car-img').html(html);
	} 
	/*********************************************************************/
	var getAllCarrusel = function(){
		  
        $.get(URI.GET_TEMPLATE_listadoCarrusel, function(template_text){     
            $.ajax({
            url : URI.GET_Carrusel,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		/*console.log(res);*/
            if(!res.error){		   
                var context = {
                    carrusels : res.data
                };
				
                var template = Handlebars.compile(template_text);
                var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
				
				$("#listado-carrusel tbody").html(html);
				
				
              }
			  else {
				$("#listado-carrusel tbody").html("");
			  }
        })
	 .fail(function(){
            console.log("error select submenu-102");
        }); 
        })
   			 
		
	}
	/*********************************************************************/
	var getVistaPreviaCarrusel = function(){
		  
        $.get(URI.TEMPLATE_CARRUSEL, function(template_text){
     
            $.ajax({
            url : URI.GET_Carrusel,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		/*console.log(res);*/
            if(!res.error){		   
                var context = {
                    carrusels : res.data
                };
				
				
                var template = Handlebars.compile(template_text);
                var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
				
				
				$(".titulo--nohaycarrusel").addClass("hidden");
				$(".titulo--haycarrusel").removeClass("hidden");
				$("#listado-carrusel").removeClass("hidden");		
				$('.slider').removeClass("hidden");
				$(".slides").html(html);
				$('.slider').slider({
						indicators: false,
						height:400,
						full_width: true
					});	
		
              }
			  else{
				
				$(".slides").html("");
				$('.slider').addClass("hidden");
				$(".titulo--nohaycarrusel").removeClass("hidden");
				$(".titulo--haycarrusel").addClass("hidden");
				  $("#listado-carrusel").addClass("hidden");
			  }
			  
			  showActivas(res.data);
        })
	 .fail(function(){
            console.log("error select submenu-103");
        }); 
        })
   			 
		
	}
	/*********************************************************************/
	var eliminarDelCarrusel = function (notaId, desde){
		$.ajax({
            url : URI.Eliminar_Del_Carrusel,
            method : 'POST',
            dataType : 'json',
            data : {id:notaId}
        }).done(function(res){
		/*console.log(res);*/
            if(!res.error){		   
               // getAllCarrusel();
				getVistaPreviaCarrusel();
				Materialize.toast("Eliminado del Carrusel",2000);
				if (desde=="desdeSearch") {
					getAllCarrusel();
				} else if (desde=="desdeListado"){
					$('#frm-buscar-para-carrusel').trigger('submit');
				} else if (desde=="desdeLaminasActivas"){					
					getAllCarrusel();
					$('#frm-buscar-para-carrusel').trigger('submit');
				}
              }
			  else{
				console.log(res.error);
			  }
			  
        })
	 .fail(function(){
            console.log("error select submenu-104");
        }); 
        
   			 
	}
	/*********************************************************************/
	var agregarAlCarrusel = function (notaId, desde){
		$.ajax({
            url : URI.Agregar_Al_Carrusel,
            method : 'POST',
            dataType : 'json',
            data : {id:notaId}
        }).done(function(res){
		/*console.log(res);*/
            if(!res.error){		                   
				getVistaPreviaCarrusel();
				Materialize.toast("Agregado al Carrusel",2000);
				if (desde=="desdeSearch") {
					getAllCarrusel();
				} else if (desde=="desdeListado"){
					$('#frm-buscar-para-carrusel').trigger('submit');
				} else {
					console.log("no implementado");
				}
		
              }
			  else{
				console.log(res.error);
			  }
			  
        })
	 .fail(function(){
            console.log("error agregar al carrusel");
        }); 
        
   			 
	}
	/*********************************************************************/
	$('#col-car-img').on("click","a",function(e){
		e.preventDefault();		
		var notaEliminarCarr= $(this).closest('li').find('input[name=id-nota-car-eliminar]').val();
		
		eliminarDelCarrusel(notaEliminarCarr, "desdeLaminasActivas");
		
	});
	/*********************************************************************/
	$('#btn-mas-carrusel').on("click",null,function(e){
		e.preventDefault();
		var search = $('div#searchCarrusel');
		if ($(this).find("i").html()=="add"){
			$(this).find("i").html("close");
			} else {
			$(this).find("i").html("add")
		}
		search.is(":visible") ? search.slideUp() : search.slideDown(function()
		{
			search.find('input').focus();
		});

		return false;
	});
	/*********************************************************************/
	$('#frm-buscar-para-carrusel').on("submit",function(e){
	   e.preventDefault();
	   if ($('input[name="textnota"]').val().length < 3){
			$('#p-resultado-carrusel').html("* ingrese al menos 3 letras para la busqueda");
	   } else {
	   $.get(URI.GET_TEMPLATE_searchlistadoCarrusel, function(template_text){
		$.ajax({
		    url : URI.POST_search_nota,
		    method : 'POST',
		    dataType : 'json',
		    data : $('#frm-buscar-para-carrusel').serialize()
		}).done(function(res){
			//console.log(res);
		    
		    if(!res.error){		   
				var context = {
				    carrusels : res.data
				};
				
				var template = Handlebars.compile(template_text);
				var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
				
				$("#resultado-busqueda-carrusel").removeClass("hidden");
				$("#resultado-busqueda-carrusel tbody").html(html);
				$('#p-resultado-carrusel').html("")
		
		      } else {
				$("#resultado-busqueda-carrusel").addClass("hidden");
				$('#p-resultado-carrusel').html("* no se han encontrado resultados");
		      }
		    
			  
		})
		 .fail(function(){
		    console.log("fail listado busqueda car");
		}); 
        
	   });
	   }
		
	});
	/*********************************************************************/
	Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {

	    switch (operator) {
		case '==':
		    return (v1 == v2) ? options.fn(this) : options.inverse(this);
		case '===':
		    return (v1 === v2) ? options.fn(this) : options.inverse(this);
		case '<':
		    return (v1 < v2) ? options.fn(this) : options.inverse(this);
		case '<=':
		    return (v1 <= v2) ? options.fn(this) : options.inverse(this);
		case '>':
		    return (v1 > v2) ? options.fn(this) : options.inverse(this);
		case '>=':
		    return (v1 >= v2) ? options.fn(this) : options.inverse(this);
		case '&&':
		    return (v1 && v2) ? options.fn(this) : options.inverse(this);
		case '||':
		    return (v1 || v2) ? options.fn(this) : options.inverse(this);
		default:
		    return options.inverse(this);
	    }
	});
	 /*********************************************************************/
	$('nav ul li a').on("click",null,function(e){		
		$('.edicion-abajo').addClass('hidden');
		$(this).closest("nav").find("li").removeClass("active-li");
		var className = $(this).closest("li").attr('class');
		var miId = className.substring(0,className.length-3);		
		
		
		$(".super-tabs-"+miId).siblings("div").addClass("hidden");		
		$(".super-tabs-"+miId).removeClass("hidden");
		
		
		$(this).closest("nav").find('.'+className).addClass("active-li");	
	
	});
	 /*********************************************************************/
	/*
	$('.notas-li a').on("click",null,function(e){		
		$('.menus-li').removeClass("active-li");
		$('.submenus-li').removeClass("active-li");
		$('.notas-li').addClass("active-li");
			
		$(".super-tabs-menus").addClass("hidden");
		$(".super-tabs-submenus").addClass("hidden");		
		$(".super-tabs-notas").removeClass("hidden");		
		
	});
	*/
	 /*********************************************************************/
	/*
	$('.menus-li a').on("click",null,function(e){		
		$('.notas-li').removeClass("active-li");
		$('.submenus-li').removeClass("active-li");
		$('.menus-li').addClass("active-li");
			
		$(".super-tabs-notas").addClass("hidden");
		$(".super-tabs-submenus").addClass("hidden");		
		$(".super-tabs-menus").removeClass("hidden");		
		
	});
	*/
	 /*********************************************************************/
	/*
	$('.submenus-li a').on("click",null,function(e){		
		$('.menus-li').removeClass("active-li");
		$('.notas-li').removeClass("active-li");
		$('.submenus-li').addClass("active-li");
			
		$(".super-tabs-menus").addClass("hidden");
		$(".super-tabs-notas").addClass("hidden");		
		$(".super-tabs-submenus").removeClass("hidden");		
		
	});
	*/
	 /*********************************************************************/
	var getBannersHeader = function(){		   
	}
	 /*********************************************************************/
	var getListadoPublicidad = function(){		   		
		$.ajax({
		    url : URI.GET_AllAdminPublicidad,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
		}).done(function(res){
			
		    
		    if(!res.error){	
									
				$('#listado-publicidad').html("");
				$('.row-listadov2').html("");
				
				res.data.forEach(function(publi){
						//var publiImg = '<img id="publi-publi-'+publi.id+'" width="90%" style="margin-top:2px" class="box" href="'+publi.href+'" src="'+publi.pathFoto+'/'+publi.id+'/'+publi.filenameFoto+'">';
						var publiImg = '<object id="publi-publi-'+publi.id+'" width="90%" style="margin-top:2px" class="box" href="'+publi.href+'" data="'+publi.pathFoto+'/'+publi.id+'/'+publi.filenameFoto+'"></object>';
						var html2 ='';						
						html2+='<div class="col s12 center contenedor-color-v2" style="margin-bottom:20px">';					
						html2+='<div class="drop">'+publiImg+'</div>';					
						html2+='<div class="row row-edit-delete-publi">';
						html2+='<div class="col s6 left"><a class="btn btn-floating editar "><i class="material-icons">edit</i></a></div>';
						html2+='<div class="col s6 right"><a class="btn btn-floating red eliminar "><i class="material-icons">delete</i></a></div>';
						html2+='</div>';
						html2+='</div>';
						
					
						if (publi.estadoItem_id==1){					
							$('#drop-menu-publi-'+publi.menu_id).prepend(publiImg);							
							$('#publi-menu-publi-'+publi.menu_id).find(".btn").removeClass("disabled");
						} else if (publi.enIndex==1){
							$('#listado-enIndex').append(html2);
						} else if (publi.enPopup==1){
							$('#listado-enPopup').append(html2);	
						} else if (publi.enHeader==1){
							$('#listado-enHeader').append(html2);							
						} else if (publi.enFooter==1){
							$('#listado-enFooter').append(html2);							
						} else if (publi.enNota==1){
							$('#listado-enNota').append(html2);							
						} else if (publi.enDerecha==1){							
							$('#listado-enDerecha').append(html2);							
						} else {
							$('#listado-publicidad').append(publiImg);													
						}
					
					
						
				});
				init_dnd();
		
		      } else {
			      //console.log("bien");
				alert(" no se han encontrado resultados");
		      }
		    
			  
		})
		 .fail(function(){
		    console.log("fail listado-publicidades");
		}); 
        
	
	
		
	}
	/*********************************************************************/
	$(".row-listadov1, .row-listadov2").on("click", ".btn.editar", function(event){       
		$('#btnSeleccionar-edit-publi').val("");
		var id = $(this).closest(".row").siblings(".drop").find("object").attr("id").split("publi-publi-")[1];
		var imgSrc = $(this).closest(".row").siblings(".drop").find("object").attr("data");
		
		var filenameFoto = imgSrc.split('/')[4];
		//var idMenu = $(this).closest(".contenedor-color").children("img").attr("src").split("/")[3];
		
		$('#lugarPubli-modal-edit').val($(this.closest(".listado-en")).attr("id").split("listado-")[1]);
		
		$('#http_editar_publi').val($(this).closest(".row").siblings(".drop").find("object").attr("href"));
		$('#http_editar_publi').siblings('label').addClass("active");
		
		$('#filenameFoto-edit-publi').val(filenameFoto);			
		$('#fotoForm-edit-publi').attr("data",imgSrc); 
		
		$('#id-editar-publi').val(id);
		//$('#id-editar-publi-menu').val(idMenu);
		$('#modalEditarPubli').openModal();
		
		
	});
	/*********************************************************************/
	$("#listado-enMenus, .row-listadov2").on("click", ".btn.eliminar", function(event){       
		
		var id = $(this).closest(".row").siblings(".drop").find("object").attr("id").split("publi-publi-")[1];
		$('#modalEliminarPubli').find('p').text($(this).closest(".row").siblings(".drop").find("object").attr("href"));
		$('#modalEliminarPubli').find('object').attr("data",$(this).closest(".row").siblings(".drop").find("object").attr("data"));
		$('#id-eliminar-publi').val(id);
		$('#modalEliminarPubli').openModal();
		
	});
	/*********************************************************************/
	
	$('#confirmar-eliminar-publi').on("click",null,function(e){
		e.preventDefault();
		$('#modalEliminarPubli').closeModal();
		deletepubli($('#id-eliminar-publi').val());
		
		return false;
		
	});
 /*********************************************************************/
      var getAllMenu= function(menuId,submenuId){
	
        /*console.log("listando menu ");*/
        $.get(URI.GET_TEMPLATE_menu, function(template_text){
            /*console.log(template_text);*/
            $.ajax({
            url : URI.GET_Allmenu,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
            if(!res.error){		   
                var context = {
                    menus : res.data
                };
                var template = Handlebars.compile(template_text);
                var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
				if (!menuId){
					menuId=res.data[0].id;
					} 
	
				var html2="";
				
				res.data.forEach(function(menu){
					html2+='<div class="col s12 m6 l4 center">';
					html2+='<div class="contenedor-color" style="margin-bottom:20px;background-color: #EFEFEF;">';
					html2+='<img style="height: 130px; width:90%" src="'+menu.pathFoto+'/'+menu.id+'/'+menu.filenameFoto+' ">';			
					html2+='<div class="drop" id="drop-menu-publi-'+menu.id+'"></div>';
					html2+='<div class="row row-edit-delete-publi" id="publi-menu-publi-'+menu.id+'">';
					html2+='<div class="col s6 left"><a class="btn btn-floating editar disabled"><i class="material-icons">edit</i></a></div>';
					html2+='<div class="col s6 right"><a class="btn btn-floating red eliminar disabled"><i class="material-icons">delete</i></a></div>';
					html2+='</div>';
					html2+='</div>';
					html2+='</div>';
					
					});
				getListadoPublicidad();
				//getBannersHeader();
				$('#listado-enMenus').html(html2);
			
				$("#select-menu").html(html);$("#select-menu").val(menuId);	$('#select-menu').material_select();
				$("#select-menu-submenu").html(html);$("#select-menu-submenu").val(menuId);$('#select-menu-submenu').material_select();
				$("#select-menu-edit").html(html);$("#select-menu-edit").val(menuId);$('#select-menu-edit').material_select();		
				$("#select-menu-edit-submenu").html(html);$("#select-menu-edit-submenu").val(menuId);$('#select-menu-edit-submenu').material_select();
				$("#select-menu-nueva").html(html);$("#select-menu-nueva").val(menuId);$('#select-menu-nueva').material_select();
				$("#select-menu-nuevo-submenu").html(html);$("#select-menu-nuevo-submenu").val(menuId);$('#select-menu-nuevo-submenu').material_select();
						
				fillListadoMenu(res.data);
				
				getAllSubmenu(menuId,submenuId);
            }
        })
	 .fail(function(){
            console.log("error select menu");
        }); 
        })
     };	
	/**********************************************************************/
	var init_dnd = function(){
		$(".box").draggable({ 			
			revert: "invalid",
			drag: function(event, ui) {
			
			}
		});
		$(".drop").droppable({ 
			tolerance: 'touch',
			accept: ".box", 
			drop: function(event, ui) {
			
				var viejoContenedor;
				if($(this).find('.box').length >= 1){
					// Cancel drag operation (make it always revert)
					ui.draggable.draggable('option','revert',true);
					return;
				}
				
				var strIdPubli = (ui.draggable).attr("id").split("publi-publi-");
				var strIdMenu = $(this).closest(".drop").attr("id").split("drop-menu-publi-");				
				$(this).closest(".drop").siblings(".row-edit-delete-publi").find(".btn").removeClass("disabled");
				$(ui.draggable).closest(".drop").siblings(".row-edit-delete-publi").find(".btn").removeClass("disabled");
				var dropped = ui.draggable;
				var droppedOn = $(this);			
				
				if ($(ui.draggable).closest("#listado-enMenus").length>0){					
					$(ui.draggable).closest(".drop").siblings(".row-edit-delete-publi").find(".btn").addClass("disabled");
				}
				
				
				if ($(ui.draggable).closest("#listado-publicidad").length>0){					
				} else {
					viejoContenedor = $(ui.draggable).closest(".contenedor-color-v2");
				}
				
				$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
				$(this).css("background","");	     
				
				if (viejoContenedor){
					viejoContenedor.remove();
				}
				
				$.ajax({
						url : URI.POST_UpdateEstadov2,
						method : 'POST',
						dataType : 'json',
						data : {id: strIdPubli[1], lugarPubli: 'enMenus', menu_id: strIdMenu[1]}
					}).done(function(res){					
						
						if(!res.error){	
							console.log(res.data);
							Materialize.toast("Publicidad Asignada",2000);
						  } else {
							  alert("error al asignar publicidad");
						  }						
					})
					 .fail(function(){
						console.log("fail al asignar publiciadad");
					}); 
             
			}, 
			over: function(event, elem) {
								
				}
				,
				 out: function(event, elem) {
				
					/*
					$(this).css("background","url('img/rectangulo.png')");
					$(this).css("background-repeat","no-repeat");
					$(this).css("-webkit-background-size","cover");
					$(this).css("-moz-background-size","cover");
					$(this).css("-o-background-size","cover");
					$(this).css("background-size","cover");
					$(this).css("background-position","center");		
					*/
				}
			});
		
		//$("#drop").sortable();

		$("#listado-publicidad").droppable({ 
			accept: ".box", 
			drop: function(event, ui) {
				var strIdPubli = (ui.draggable).attr("id").split("publi-publi-");
				var viejoContenedor;
				if ($(ui.draggable).closest("#listado-enMenus").length>0){
					$(ui.draggable).closest(".drop").siblings(".row-edit-delete-publi").find(".btn").addClass("disabled");
				} else {
					viejoContenedor = $(ui.draggable).closest(".contenedor-color-v2");
				}
				
				var dropped = ui.draggable;
				var droppedOn = $(this);
				$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);      
				
				if (viejoContenedor){
					viejoContenedor.remove();
				}
				
				$.ajax({
						url : URI.POST_PublicidadRepositorio,
						method : 'POST',
						dataType : 'json',
						data : {id: strIdPubli[1]}
					}).done(function(res){					
						
						if(!res.error){	
							Materialize.toast("Publicidad al Repositorio",2000);
						  } else {
							  console.log("error al asignar publicidad");
						  }						
					})
					 .fail(function(){
						console.log("fail al asignar publicidad");
					}); 
				
				
		     	}
		});
		
		$(".row-listadov2").droppable({ 
			accept: ".box", 
			drop: function(event, ui) {
				var viejoContenedor;
				var strIdPubli = (ui.draggable).attr("id").split("publi-publi-");
				//var strIdMenu = (ui.draggable).closest(".drop").attr("id").split("drop-menu-publi-");
				if ($(ui.draggable).closest("#listado-enMenus").length>0){					
					$(ui.draggable).closest(".drop").siblings(".row-edit-delete-publi").find(".btn").addClass("disabled");
				} else {					
					viejoContenedor = $(ui.draggable).closest(".contenedor-color-v2");
				}
				
				var dropped = ui.draggable;
				var droppedOn = $(this);
				$(dropped).detach().css({top: 0,left: 0}).appendTo(droppedOn);
				
				
				
				
				var html2='<div class="row row-edit-delete-publi">';
						html2+='<div class="col s6 left"><a class="btn btn-floating editar "><i class="material-icons">edit</i></a></div>';
						html2+='<div class="col s6 right"><a class="btn btn-floating red eliminar "><i class="material-icons">delete</i></a></div>';
						html2+='</div>';
				
				
				droppedOn.find("object").last().wrap("<div class='col s12 center contenedor-color-v2' style='margin-bottom:20px'><div class='drop'></div>"+html2+"</div>");
				if (viejoContenedor){
					viejoContenedor.remove();
				}
				
				var lugarPubli = droppedOn.attr("id").split("listado-")[1]
				var timePopup = $("#select-delay-popup").val();
				console.log(timePopup);
				
				$.ajax({
						url : URI.POST_UpdateEstadov2,
						method : 'POST',
						dataType : 'json',
						data : {id:strIdPubli[1], lugarPubli: lugarPubli, timePopup : timePopup }
					}).done(function(res){					
						
						if(!res.error){	
							Materialize.toast("Publicidad asignada",2000);
						  } else {
							  console.log("error al asignar publicidad");
						  }						
					})
					 .fail(function(){
						console.log("fail al asignar publicidad");
					}); 
				
				
		     	}
		});
	}
	/*********************************************************************/
	$('#btn-mas-publi').on("click",null,function(e){
		e.preventDefault();
		cleanFormDataNuevaPubli();
		if ($("#listado-enMenus").find(".contenedor-color")){
			var idPrimerMenu = $("#listado-enMenus").find(".contenedor-color").first().children("img").attr("src").split('/')[3];
			$('#id-nueva-publi-menu').val(idPrimerMenu);
			$('#http_nueva_publi').val("http://");
			$('#modalNuevaPubli').openModal();		
		} else {
			alert("No puede agregar publicidad sin tener menus");
		}
	});
	 /*********************************************************************/
	var resizeTextArea = function ($textarea){

            var hiddenDiv = $('.hiddendiv').first();
            if (!hiddenDiv.length) {
                hiddenDiv = $('<div class="hiddendiv common"></div>');
                $('body').append(hiddenDiv);
            }

            var fontFamily = $textarea.css('font-family');
            var fontSize = $textarea.css('font-size');

            if (fontSize) { hiddenDiv.css('font-size', fontSize); }
            if (fontFamily) { hiddenDiv.css('font-family', fontFamily); }

            if ($textarea.attr('wrap') === "off") {
                hiddenDiv.css('overflow-wrap', "normal")
                    .css('white-space', "pre");
            }

            hiddenDiv.text($textarea.val() + '\n');
            var content = hiddenDiv.html().replace(/\n/g, '<br>');
            hiddenDiv.html(content);


            // When textarea is hidden, width goes crazy.
            // Approximate with half of window size

            if ($textarea.is(':visible')) {
                hiddenDiv.css('width', $textarea.width());
            }
            else {
                hiddenDiv.css('width', $(window).width()/2);
            }

            $textarea.css('height', hiddenDiv.height());
        }
/*********************************************************************/
    $('body').on('focus', '.materialize-textarea', function () {
		resizeTextArea($(this));
	})
	/*********************************************************************/	
	var datetimeTOsql = function(myControl){
		/*
		console.log(angular.element(myControl).scope().date.toDateString());
		console.log(angular.element(myControl).scope().date.toGMTString());
		console.log(angular.element(myControl).scope().date.toISOString());
		console.log(angular.element(myControl).scope().date.toJSON());
		console.log(angular.element(myControl).scope().date.toLocaleDateString());
		console.log(angular.element(myControl).scope().date.toLocaleTimeString());
		console.log(angular.element(myControl).scope().date.toString());
		console.log(angular.element(myControl).scope().date.toUTCString());
		console.log(angular.element(myControl).scope().date.valueOf());
		*/
		
		var str = angular.element(myControl).scope().date.toISOString();
		str=str.substring(0,str.length - 5);
		
		return(str);
		
		
				
		
	}
	/*********************************************************************/	
	var setCustomCalendar = function(myControl, fecha){
		var scope = angular.element(myControl).scope();
		
		var fecha = fecha.replace(/-/g, "/"); 
		
			scope.$apply(function(){
				scope.date =fecha;
				                            
			});	
			
		
	}
	/*********************************************************************/	
	var setCalendarNuevo = function(){
		//angular.element($("#datetime-nueva-nota")).scope().defaultDate="2004-08-04T19:09:02.768Z";
		var scope = angular.element($("#datetime-nueva-nota")).scope();
			scope.$apply(function(){
				scope.date = new Date();
			});	
			
		
	}
	/*********************************************************************/
	var getTodasGalleryEditNota = function(){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_AllAllAllgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
			}).done(function(res){	
				
				if(!res.error){
					//console.log(res.data);
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
					
					$("#lightgallery-edit").html(html);
					
					$('#lightgallery-edit').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	var getTodasGalleryNuevaNota = function(){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_AllAllAllgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
			}).done(function(res){	
				
				if(!res.error){
					//console.log(res.data);
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
					
					$("#lightgallery").html(html);
					
					$('#lightgallery').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	var getMenuGalleryEditNota = function(menuId){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_AllAllgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {menu:menuId}
			}).done(function(res){	
				
				if(!res.error){
					//console.log(res.data);
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
					
					$("#lightgallery-edit").html(html);
					
					$('#lightgallery-edit').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery-edit");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	var getMenuGalleryNuevaNota = function(menuId){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_AllAllgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {menu:menuId}
			}).done(function(res){	
				
				if(!res.error){
					//console.log(res.data);
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
					
					$("#lightgallery").html(html);
					
					$('#lightgallery').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	var getSubmenuGalleryEditNota = function(submenuId){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_Allgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {submenu:submenuId}
			}).done(function(res){	
				
				if(!res.error){
				
					
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$("#lightgallery-edit").html(html);
					
					$('#lightgallery-edit').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery-edit");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	var getSubmenuGalleryNuevaNota = function(submenuId){
			
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_Allgallery,
		    method : 'GET',
		    dataType : 'json',
		    data : {submenu:submenuId}
			}).done(function(res){	
				
				if(!res.error){
				
					
					var context = {
						galerias : res.data
					};							
							
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');				
					
					$("#lightgallery").html(html);
					
					$('#lightgallery').lightGallery({
						mode: 'lg-fade'
					}); 

					
				
				} else {	
					
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
		})
   			 
		
	}
	/*********************************************************************/
	 $("#close-confirmar-imagen-baul-edit").on("click",null,function(e){		
	    $('#modalConfirmarImagenBaulEdit').closeModal();
	});
	/*********************************************************************/
	 $("#close-confirmar-imagen-baul").on("click",null,function(e){		
	    $('#modalConfirmarImagenBaul').closeModal();
	});
	/*********************************************************************/
	$('#lightgallery-edit').on('onSlideClick.lg',function(e){
		e.preventDefault();
		var urlImg = $(".lg-thumb-item.active").children("img").attr("src");
		var idImg = urlImg.split("/")[3];
		$('#modalConfirmarImagenBaulEdit').find("img").attr("src",urlImg);
		$('#id-confirmar-imagen-baul-edit').val(idImg);
		$("#lightgallery-edit").data('lightGallery').destroy();
		$('#modalConfirmarImagenBaulEdit').openModal();
		
		
	});
	/************************************************************************/
	$('#lightgallery').on('onSlideClick.lg',function(e){
		e.preventDefault();
		var urlImg = $(".lg-thumb-item.active").children("img").attr("src");
		var idImg = urlImg.split("/")[3];
		$('#modalConfirmarImagenBaul').find("img").attr("src",urlImg);
		$('#id-confirmar-imagen-baul').val(idImg);
		$("#lightgallery").data('lightGallery').destroy();
		$('#modalConfirmarImagenBaul').openModal();
		
		
	});
	/************************************************************************/
	$('#btn-confirmar-imagen-baul-edit').on("click",null,function(e){
		e.preventDefault();		
		var srcSelected = $('#modalConfirmarImagenBaulEdit').find("img").attr("src");
		
		// vaciar al reiniciar
		$('#fotoForm-edit-from-gallery').attr("src",srcSelected);
		$('#filenameFoto-edit-from-gallery').val($('#id-confirmar-imagen-baul-edit').val());
		// fin vaciar
		
		$( "#btn-cerrar-gallery-edit" ).trigger( "click" );
		$('#modalConfirmarImagenBaulEdit').closeModal();
	});
	/************************************************************************/
	$('#btn-confirmar-imagen-baul').on("click",null,function(e){
		e.preventDefault();		
		var srcSelected = $('#modalConfirmarImagenBaul').find("img").attr("src");
		
		// vaciar al reiniciar
		$('#fotoForm-nueva-from-gallery').attr("src",srcSelected);
		$('#filenameFoto-nueva-from-gallery').val($('#id-confirmar-imagen-baul').val());
		// fin vaciar
		
		$( "#btn-cerrar-gallery" ).trigger( "click" );
		$('#modalConfirmarImagenBaul').closeModal();
	});
	/************************************************************************/
	$('#btn-cerrar-gallery-edit').on("click",null,function(e){
		e.preventDefault();
		if ($(this).children("i").html()==="close"){
			$('#demo-edit').addClass("hidden");
			$(this).children("i").html("search");
		} else {
			$('#demo-edit').removeClass("hidden");
			$(this).children("i").html("close");
		}
	});
	/************************************************************************/
	$('#btn-cerrar-gallery').on("click",null,function(e){
		e.preventDefault();
		if ($(this).children("i").html()==="close"){
			$('#demo-nueva').addClass("hidden");
			$(this).children("i").html("search");
		} else {
			$('#demo-nueva').removeClass("hidden");
			$(this).children("i").html("close");
		}
	});
	
	/************************************************************************/
	var getDelayPopup = function (){
		$.ajax({
		    url : URI.GET_getDelay,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
			}).done(function(res){				
				if(!res.error){									
					$('#select-delay-popup').val(res.data);
					$('#select-delay-popup').material_select();
				
					$('#select-delay-popup').closest(".select-wrapper").find(".select-dropdown").css({
						/*
						"height": "15px",
						"margin-top": "5px",
						"font-size": "14px",		
						"margin-bottom": "10px",
						"text-align" : "center"
						*/
						"height": "24px",
						"margin-bottom": "5px",
						"font-size": "12px",
						"line-height":  "23px",
						"text-align" : "center"
						});
					$('#select-delay-popup').closest(".select-wrapper").find("span.caret").css({
							"top":"5px"
						});				
				} else {						
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
	}
	/************************************************************************/
	var setDelayPopup = function (timePopup){
		$.ajax({
		    url : URI.POST_setDelay,
		    method : 'POST',
		    dataType : 'json',
		    data : {timePopup:timePopup}
			}).done(function(res){				
				if(!res.error){														
				
					$('#select-delay-popup').closest(".select-wrapper").find(".select-dropdown").css({
						/*
						"height": "15px",
						"margin-top": "5px",
						"font-size": "14px",		
						"margin-bottom": "10px",
						"text-align" : "center"
						*/
						"height": "24px",
						"margin-bottom": "5px",
						"font-size": "12px",
						"line-height":  "23px",
						"text-align" : "center"
						});
					$('#select-delay-popup').closest(".select-wrapper").find("span.caret").css({
							"top":"5px"
						});				
				} else {						
					console.log(res.error);
				}
									  
			})
			 .fail(function(){
				
				console.log("fail gallery");
			}); 
	}
	/************************************************************************/
	var initListadoNota= function(){
		$('.notas-li a').trigger("click");
		setCalendarNuevo();
		/*$(".button-collapse").sideNav();*/
		
		getAllMenu(); /*el primer parametro es el id=1 del menu  (no debe volar nunca de la db */
		getAllCarrusel();
		getVistaPreviaCarrusel();
		getDelayPopup();		
	}
	/************************************************************************/
	$('#select-delay-popup').change(function(){
		 setDelayPopup($(this).val());		
	});
	/************************************************************************/
	$('.lbl-derecha').on("click",null,function(e){
		e.preventDefault();
		var toHide = $(this).closest(".pivote").find(".tohide");
		if (toHide.hasClass("hidden")){
			toHide.removeClass("hidden");
			$(this).text("ocultar");
			$(this).removeClass("label-success");
			$(this).addClass("label-primary");
		} else {
			toHide.addClass("hidden");
			$(this).text("mostrar");
			$(this).removeClass("label-primary");
			$(this).addClass("label-success");
		}
	});
	/************************************************************************/
	$('#inputtext-vistas-edit').on("input paste cut change",null,function(){
			$(this).val($(this).val().replace(/[^0-9.]/g, ''));
			if (parseInt($(this).val())>10000) {
				$(this).val(10000);
			}
		$('#input-vistas-edit').val($(this).val());
	});
	/************************************************************************/
	$('#input-vistas-edit').on("change",null,function(e){
		e.preventDefault();
		$('#inputtext-vistas-edit').val($(this).val());
	});
	/************************************************************************/
	$('#btn-minus-edit').on("click",null,function(e){
		e.preventDefault();
		this.parentNode.querySelector('input[type=number]').stepDown();
	});
	/************************************************************************/
	$('#btn-add-edit').on("click",null,function(e){
		e.preventDefault();
		this.parentNode.querySelector('input[type=number]').stepUp();
	});
	
	/************************************************************************/
	/************************************************************************/
	$('#inputtext-vistas-nueva').on("input paste cut change",null,function(){
			$(this).val($(this).val().replace(/[^0-9.]/g, ''));
			if (parseInt($(this).val())>10000) {
				$(this).val(10000);
			}
		$('#input-vistas-nueva').val($(this).val());
	});
	/************************************************************************/
	$('#input-vistas-nueva').on("change",null,function(e){
		e.preventDefault();
		$('#inputtext-vistas-nueva').val($(this).val());
	});
	/************************************************************************/
	$('#btn-minus-nueva').on("click",null,function(e){
		e.preventDefault();
		this.parentNode.querySelector('input[type=number]').stepDown();
	});
	/************************************************************************/
	$('#btn-add-nueva').on("click",null,function(e){
		e.preventDefault();
		this.parentNode.querySelector('input[type=number]').stepUp();
	});
	/************************************************************************/
	initListadoNota();
	
	
    
});