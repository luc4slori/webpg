$(function(){
	 var URI = {};
    $rootDir = $('#rootDir').val();
	
	URI.GET_Allmenus = $rootDir+"/actions/api-menu.php?action=listarAll";
	URI.GET_TEMPLATE_Menu_header = $rootDir+"/templates/listado-menu-header.html";
	URI.TEMPLATE_SIDE_SUBMENU= $rootDir+"/templates/listado-side-submenu.html";
	URI.GET_SIDE_SUBMENU = $rootDir+"/actions/api-submenu.php?action=listarAll";
	URI.POST_CONTACTSUALF = $rootDir+"/actions/api-server.php?action=contactSualf";
	
	
	var printableRegex = /^[a-z0-9!"ñ\r\n#$%&'()*+,.\/:;<=>?@\[\] ^_`{|}~-]*$/i;
	var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i; 
	var lettersRegex = /^[a-zA-Z\s]*$/;

/***************************************************************************************/		 
	var openModal2=function(url){
		var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=100, left=230"; 
		window.open(url,"",opciones); 
	} 
	
	$(".radio-online").on("click",null,function( event ){
		event.preventDefault();	
		openModal2($(this).prop("href"));
	});
	
	$("#publi-derecha").on("click","a",function( event ){
		event.preventDefault();	
		openModal2($(this).prop("href"));
	});

	
   
	/************************************************************************/
	
	var getMenus = function(){
		
		 $.get(URI.GET_TEMPLATE_Menu_header, function(template_text){
	     
		    $.ajax({
		    url : URI.GET_Allmenus,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
		}).done(function(res){		
			/*console.log(res);*/
		    if(!res.error){		   
			var context = {
			    menus : res.data
			};
					
					
			var template = Handlebars.compile(template_text);
			var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');			
			
						
			getSideMenus(res.data);
			
		
			//
			$("#ul-mnu").prepend(html);
					
			
		      }
				  else{
					
					console.log(res.error);
				  }
				  
				  
		})
		 .fail(function(){
		    console.log("error al traer menu para el header");
		}); 
		})
   			 
		
	}
	

	/************************************************************************/

	// Detect touch screen and enable scrollbar if necessary
	var is_touch_device = function () {
	      try {
		document.createEvent("TouchEvent");
		return true;
	      } catch (e) {
		return false;
	      }
	}
	 	
	/************************************************************************/
	var init=function(){
			
		getMenus();
		
		if (is_touch_device()) {
			$('#nav-mobile').css({ overflow: 'auto'});
		}
		
		$('.button-collapse').sideNav({
		      menuWidth: 240, // Default is 240
		      edge: 'left', // Choose the horizontal origin
		      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
		});
		
		$('.modal-trigger').leanModal();
		$('.datepicker').pickadate({
			min: new Date(1901,3,20),
			max: new Date(2015,10,30),
			monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
			today: 'hoy',
			clear: 'limpiar',
			formatSubmit:  'yyyy-mm-dd',
			format: 'yyyy-mm-dd',
			close: 'cerrar',
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 100 // Creates a dropdown of 15 years to control year
		});
		$('.materialboxed').materialbox();
	}
	
	/**************************************************************/
	$('#footer-sualf').on("click",null,function(e){
		e.preventDefault();
		$('#form-sualf .validate').each(function(){
			$(this).val("");
			$(this).removeClass("invalid");
		});
		$('#modal-contact-sualf').openModal();	
	});
	/*************************************************************************************/
	var serializeForm =  function(formArray){
        var obj = {};
        $.each(formArray, function(i, pair){
            var cObj = obj, pObj, cpName;
            $.each(pair.name.split("."), function(i, pName){
                pObj = cObj;
                cpName = pName;
                cObj = cObj[pName] ? cObj[pName] : (cObj[pName] = {});
            });
            pObj[cpName] = pair.value;
        });
        return obj;
    }
	/**************************************************************/
	var validField = function (fieldValue, config){
		
			switch (config){
				case "email":										
					return (fieldValue.match(emailRegex)) ? true : false;						
				case "printable":
					return (fieldValue.match(printableRegex)) ? true : false;	
				case "text":
					return (fieldValue.match(lettersRegex)) ? true : false;	
			}
		return false;
	}
	
	/**************************************************************/
	$('#enviar-mail-sualf').on("click",null,function(e){
		e.preventDefault();
		var hasInvalid = false;
		$('#form-sualf .validate').each(function(){
			if ( $(this).val().trim()==""  ||  !validField($(this).val().trim(),$(this).attr("type"))){
				$(this).addClass("invalid");
				hasInvalid = true;
			} 
		});
	
		if (hasInvalid){
			return;
		}
		
		var nombre= $('#contact_nombre_sualf').val().trim();  
		var email =  $('#contact_email_sualf').val().trim();
		var comments =  $('#contact_comments_sualf').val().trim();
		
		
		var formArray = $('#form-sualf').serializeArray();
		var datos = serializeForm(formArray);	
		//console.log(datos['g-recaptcha-response']);
		console.log(datos);
		console.log( $('#form-sualf').serialize());
		
		
		if (datos['g-recaptcha-response']){				
				$.ajax({
					url : URI.POST_CONTACTSUALF,
					method : 'POST',
					dataType : 'json',				                		
					data : $('#form-sualf').serialize()					
				})
				.done(function(res){ 
					console.log(res);
					grecaptcha.reset();
					if(!res.error){																
						Materialize.toast('Gracias por contactarnos', 3500);
						$('#modal-contact-sualf').closeModal();								
					}else{	
						$('.error-recaptcha p').text(res.mensaje);
						$('.error-recaptcha').removeClass("hidden");		
						Materialize.toast(res.mensaje, 5000);						
					}
															  
				})
				.fail(function(){
					Materialize.toast('Error inesperado', 5000);
					$('#modal-contact-sualf').closeModal();
				}); 
		}else{
			$('.error-recaptcha p').text("Verifica que sos un humano");
			$('.error-recaptcha').removeClass("hidden");				 
		};
						
		
		
		/*
		$.ajax({
		    url : URI.POST_EmailSualf,
		    method : 'POST',
		    dataType : 'json',
		    data : {'nombre':nombre, 'email':email, 'comments':comments}
		}).done(function(res){					
		    if(!res.error){	
				Materialize.toast('Gracias por contactarnos', 2500);
				$('#contact_nombre_sualf').val("");
				$('#contact_email_sualf').val("");
				$('#contact_comments_sualf').val("");
				$('#modal-contact-sualf').closeModal();
			}else{					
				Materialize.toast('Su consulta no pudo ser enviada', 5000);
			}
			
				  
		})
		 .fail(function(){
		    alert("fail al enviar mail");
		}); 
		*/
	});
	
	/****************************************************************/
	
	$('#mnu-contacto a').on("click",null,function(e){
		e.preventDefault();
		
		if( $('#header_id').val()!="" && $('#header_id').val()!=null){
			$('#contact_apellido').val($('#header_apellido').val());
			$('#contact_apellido').addClass('valid');
			$('#contact_apellido').siblings('label').addClass('active');
			$('#contact_apellido').siblings('i').addClass('active');
						
			$('#contact_nombre').val($('#header_nombre').val());
			$('#contact_nombre').addClass('valid');
			$('#contact_nombre').siblings('label').addClass('active');
			$('#contact_nombre').siblings('i').addClass('active');
			
			if ($('#header_email').val().indexOf("@") >= 0){
				$('#contact_email').val($('#header_email').val());
				$('#contact_email').addClass('valid');
				$('#contact_email').siblings('label').addClass('active');
				$('#contact_email').siblings('i').addClass('active');			
			}
			
			
		
		}
			$('#modal-contact').openModal();		
	});

	$('#btn-account-nav').on("click",null,function(e){
		e.preventDefault();
		
		if( $('#header_id').val()!="" && $('#header_id').val()!=null){
			$('#h4-name-account').html($('#header_nombre').val()+" "+$('#header_apellido').val());
			
		}
			$('#modal-account').openModal();		
	});
	
	
	/****************************************************************/
	$('#btn-account-nav-mobile').on("click",null,function(e){
		e.preventDefault();
		
		if( $('#header_id').val()!="" && $('#header_id').val()!=null){
			$('#h4-name-account').html($('#header_nombre').val()+" "+$('#header_apellido').val());
			
		}
			$('#modal-account').openModal();		
	});
	
	
	/****************************************************************/
	// Toggle search

	$('a#toggle-search').click(function()
	{
		 $('html, body').stop().animate({
			scrollTop: 0
		}, 100, 'linear');
		
		var className = $(this).find("i").attr('class');
		if (className.indexOf("search") >= 0){
			$(this).find("i").removeClass("mdi-action-search");
			$(this).find("i").addClass("mdi-action-launch");			
			} else {
			$(this).find("i").addClass("mdi-action-search");
			$(this).find("i").removeClass("mdi-action-launch");	
		}
		
		
		var search = $('div#search');

		search.is(":visible") ? search.slideUp() : search.slideDown(function()
		{
			search.find('input').focus();
		});

		return false;
	});
	
	/*********************************************************************/
	var getSideMenus= function (menus){		
		var iter = 0;
		menus.forEach(function (menu){
			var html="";
					   
			html += '<li class="bold"><a class="collapsible-header  waves-effect waves-teal">'+menu.titulo+'</a>';
			html += '<div class="collapsible-body" style="">';
			html += '<ul id="ul-side-submenu-'+menu.id+'">';
			html += '<li><a class="scroll" href="'+menu.id+'-'+menu.titulo_ami+'">Todo</a></li>';
			html += '</ul>';
			html += '</div>';
			html += '</li>';
			html += '<li class="divider"></li>';
			$('#ul-side-menu').append(html);	
			getSideSubmenus(menu.id);
			iter +=1;
					
		});
	}	

	/*********************************************************************/
	var getSideSubmenus = function(menuId){	
		$.get(URI.TEMPLATE_SIDE_SUBMENU, function(template_text){            			
            $.ajax({			
            url : URI.GET_SIDE_SUBMENU,
            method : 'GET',
            dataType : 'json',
            data : {menu_id:menuId}
        }).done(function(res){						
					
				if(!res.error){						
						var context = {
						submenus : res.data
					};
					
					
					
					var template = Handlebars.compile(template_text);
					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					
					
					
						
					
					
					
					$('#ul-side-submenu-'+menuId).append(html);
					
					
				} else {
					console.log("este menu no tiene submenus error en init.js->getSideSubmenus");
				}
		}).fail(function(){
				console.log("error select submenu2");		
				}); 
		});
		
		
		
	}
	 /*********************************************************************/
	
	init();
	
			

});








 