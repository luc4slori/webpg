(function ($) {
var googleUser = {};
var URI = {};
	var $rootDir = $('#rootDir').val();
   
	URI.POST_COMENTARIOS = $rootDir+"/actions/api-comentario.php?action=guardar";
	URI.POST_LOGOUT = $rootDir+"/actions/api-login.php?action=logout";  
	URI.POST_USERS = $rootDir+"/actions/api-user.php?action=guardar";
	URI.POST_SOCIAL = $rootDir+"/actions/api-user.php?action=logSocial";
	URI.POST_LOGIN =  $rootDir+"/actions/api-login.php?action=login";
	URI.GET_COMENTARIOS = $rootDir+"/actions/api-comentario.php?action=listarPorIdNota";
	URI.TEMPLATE_COMENTARIOS = $rootDir+"/templates/comentarios.html";
	URI.LOG_TWT = $rootDir+"/actions/api-twt.php?action=login";
	URI.SET_CURRENT_URL = $rootDir+"/actions/api-server.php?action=setCurrentURL";
	URI.GET_TIPO_USER = $rootDir+"/actions/api-server.php?action=getTipoUser";
	
var openModal2=function(url){
		var opciones="toolbar=no,location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=100, left=230"; 
		window.open(url,"",opciones); 
	} 
/*************************************************************************************/
 var registrarUser = function() {
      
        $.ajax({
                url : URI.POST_USERS,
                method : 'POST',
                dataType : 'json',				
                data : $("#frm-register").serialize() //obtengo los datos del formulario
            })
            .done(function(res){								
                if(!res.error){
                  //console.log(res);
					/*mostrarPagLog(res.data);*/
					alert("Se ha enviado un email de confirmacion a: " +res.data["email"]);
                }else{
					console.log(res);
                    console.log(res.mensaje);
                }
            })
            .fail(function(){
                //si fallo la peticion muestro mensaje de error
				console.log("error de sistema al registrar usuario");
            });
    }
	
	/*********************************************************************/
	var validarFormDataHeader = function(){
		if ($('#txtComentario').val().length){
			return true;
		}
		$('#error-publicar-comment').html("* El comentario no puede estar vacio");
		$('#btn-publicar-comment').addClass("right");
		return false;
		
	}
	/*********************************************************************/
	var cleanFormErrorHeader = function(){
		$('#error-publicar-comment').html("");
		$('#btn-publicar-comment').removeClass("right");			
		$('#btn_publicar_apretado_user_nota').val("0");		
	}
	
	/*********************************************************************/
	var publicarComentarioHeader = function(){
		cleanFormErrorHeader();
		if(validarFormDataHeader()){
			$.ajax({
					url : URI.POST_COMENTARIOS,
					method : 'POST',
					dataType : 'json',				
					data : $("#form-comentarios").serialize()				
				})
				.done(function(res){								
					if(!res.error){
						$('#txtComentario').val('');
						
						//console.log(res);
						getComentariosHeader();					
					}else{
						console.log(res);
					}
				})
				.fail(function(){
					//si fallo la peticion muestro mensaje de error
					console.log("error");
				});
		} 
	}
	/*********************************************************************/
	var fillDomListadoComentariosHeader = function(comentarios){	
		$.ajax({
					url : URI.GET_TIPO_USER,
					method : 'GET',
					dataType : 'json',				
					data : {}				
				})
				.done(function(res){								
					if(!res.error){
						
						$.get(URI.TEMPLATE_COMENTARIOS, function(source){
						    var template = Handlebars.compile(source);
						    var html = template({'comentarios' : comentarios, 'user':res.data});
							//console.log("html");
							//console.log(html);
						    $('#lista-comentarios').html("");
						    $('#lista-comentarios').html(html);
						});				
					}else{
						console.log(res);
					}
				})
				.fail(function(){
					//si fallo la peticion muestro mensaje de error
					console.log("fail");
				});
		
	};  
	/*********************************************************************/
	
	var getComentariosHeader = function(){
		var idNota = $('input[name="nota_id"]').val();    
		
		$.ajax({
		    url : URI.GET_COMENTARIOS,
		    method : 'GET',
		    dataType : 'json',
				data : {'idNota' : idNota }
		})
		    .done(function(res){
		    //console.log(res);
		    if(!res.error){
			//console.log("hola");
			fillDomListadoComentariosHeader(res.data);
		    }else{
			console.log("chau");
			};               
		    })
		    .fail(function(){                
			console.log("error");
		    });         
	};	
	
	
	/*********************************************************************/
	
var btnPublicarApretado = function() {
	
	if ( $('#btn_publicar_apretado_user_nota').val() =="1"){
	
		return true;
	}
	
	return false;
	
}
/*************************************************************************************/
var mostrarPagLog = function(sessions){
	
	Materialize.toast("Hola "+ sessions['nombre'], 2000);
	var urlActual = window.location.href.toString().split(window.location.host)[1];
	if ($('#user_id_user_nota').length) {
		$('#user_id_user_nota').val(sessions['id']);
		$('#nomyape_user_nota').html(sessions['nombre']+' '+sessions['apellido'] +' '+'<span class="label label-info">online</span>');
		
		if (btnPublicarApretado()) {			
			$('#btn_publicar_apretado_user_nota').val("0");
			publicarComentarioHeader();			
		} else {			
			getComentariosHeader();
			}
	}
		
	if (sessions['belong']==''){
		$('#btn-account-nav').children('img').attr('src', $rootDir+'/img/account-grey.jpg');
	} else {
		$('#btn-account-nav').children('img').attr('src', $rootDir+'/'+sessions['imagenLocal']);
	}
	
	$('#btn-login-nav').css("display","none");
	$('#btn-account-nav').css("display","inherit");
	$('#btn-login-nav-mobile').css("display","none");
	$('#btn-account-nav-mobile').css("display","inherit");
   
	if (sessions['tipo']=='admin'){		
			$('#container-admin').removeClass('hidden');		
		}else{		
			$('#container-admin').addClass('hidden');				
		}
			
	$('#btn-account-nav').find('span').html(sessions['nombre']);
	$('#btn-account-nav-mobile').find('span').html(sessions['nombre']);
	$('#header_id').val(sessions['id']);
	$('#header_nombre').val(sessions['nombre']);
	$('#header_apellido').val(sessions['apellido']);
	$('#header_email').val(sessions['email']);
	$('#header_tipo').val(sessions['tipo']);
	$('#modal-account').find('h4').html(sessions['nombre']+' '+sessions['apellido']);
	
		$('.lean-overlay').addClass('hidden');
        /*
		$('#cl-logout').find('p').html(sessions['nombre']+' '+sessions['apellido']+' '+'<span class="label label-info">online</span>');   
   */
	}

/*************************************************************************************/

    var mostrarPagDeslog = function(){
	googleUser = {};
    Materialize.toast('Hasta pronto '+$('#btn-account-nav').children("span").html(), 2000);
	var urlActual = window.location.href.toString().split(window.location.host)[1];
    
	if ($('#user_id_user_nota').length) {
		$('#user_id_user_nota').val("");
		$('#nomyape_user_nota').html('Debes estar logueado para comentar');
		getComentariosHeader();
		$('#txtComentario').val("");
		cleanFormErrorHeader();		
	}
	
	$('#btn-account-nav').css("display","none");
	$('#btn-login-nav').css("display","inherit");
	$('#btn-account-nav-mobile').css("display","none");
	$('#btn-login-nav-mobile').css("display","inherit");
	
	    $('.lean-overlay').addClass('hidden');
	    /*$('#modal-login').closeModal();*/
	    
	    /* blanquear los input-text del login*/
	/*$("#user").val("");
	$("#passw").val(""); */
	}

/*************************************************************************************/
	
var desloguearUser = function() {	
     $.ajax({
                url : URI.POST_LOGOUT,
                method : 'POST',
                dataType : 'json',
                data : {}	
            })
            .done(function(res){								
                if(!res.error){
                  //console.log(res);
		  $('#modal-account').closeModal();
                   mostrarPagDeslog();					
                }else{
		    console.log(res);
                    console.log(res.mensaje);
                }
            })
            .fail(function(){
                //si fallo la peticion muestro mensaje de error
				console.log("error");
            });
}

/*************************************************************************************/

$('#login_form').submit (function(event){
	event.preventDefault();
	/*$('#modal-login').openModal();*/
	var formData = new FormData();
		    formData.append( 'email', $('#emaillogmodal').val());
		    formData.append( 'passw', $('#passlogmodal').val());
			formData.append( 'belong', '');
	
	$.ajax({
                url : URI.POST_LOGIN,
                method : 'POST',
                dataType : 'json',
				cache: false,
				processData: false,
				contentType: false,
                data : formData
				
		})
		.done(function(res){            
			if(!res.error){
				//console.log(res.data);				
				/*$('#error-login').addClass('hidden');  */
				$('#modal-login').closeModal();
				 $('#error-login').find('p').html('');       
				mostrarPagLog(res.data);                
			}else{
				//console.log(res);
				/*$('#error-login').removeClass('hidden');*/
				$('#error-login').find('p').html(res.mensaje);   
			};               
		})
		.fail(function(){                
			console.log("ERROR");
            });
});


/*************************************************************************************/
$('#btn-register').on("click",null,registrarUser);
/*************************************************************************************/	
$('#btn-logout').on("click",null,function(e){	
	e.preventDefault();		
	desloguearUser();	
	
});
/*************************************************************************************/
$('#btn-admin').on("click",null,function(e){	
	e.preventDefault();	
	
	location.href= $rootDir+"/listadoNota.php";	
	
});
	
	/*$('.modal-trigger').leanModal();*/
/***********************************************************************/	
	
	$('.btn-twt').on('click', null, function(e) {
		e.preventDefault();
		var comentario_actual ="";
		var urlActual =  window.location.href;

		if ($('#user_id_user_nota').length) {	
			
			if ($('#txtComentario')!=='undefined'){
				comentario_actual=$('#txtComentario').val();
			}
		}
			
			startTwt(urlActual,comentario_actual);
	});
		/**************************************************************************************************************/
		
	var startTwt = function (urlActual,comentario_actual){
		$.ajax({
			url: URI.SET_CURRENT_URL,
			method : 'POST',
			dataType : 'json',
			data : {'url_actual' : urlActual, 
					'comentario_actual' : comentario_actual
				}
		})
			. done(function(res){
				
				if (!res.error){	
										
					$.ajax({
						url : URI.LOG_TWT,
						method : 'POST',
						dataType : 'json',
						data : {}
					})
					.done(function(res){
						
						if(!res.error){
							
							//console.log(res.data);
												
							if(typeof res.location === 'undefined'){
							
								var imgTWT = 'https://twitter.com/'+res.data.request_vars.screen_name+'/profile_image?size=normal';
							$.ajax({
								url : URI.POST_SOCIAL,
								method : 'POST',
								dataType : 'json',
								data : {'nombre':res.data.request_vars.screen_name,
										'apellido':'',
										'email':res.data.request_vars.user_id,
										'imgSrc': imgTWT,
										'belong':'twitter'
										}
								})
								.done(function(res){
									if(!res.error){				
										$('#modal-login').closeModal();
										$('#error-login').find('p').html('');       
										mostrarPagLog(res.data); 
									} else {
										console.log(res.mensaje);
									}
								})
								.fail(function(){
									console.log("fail log social");
								});     
							}else{
								
								window.location.href=res.location;
								
							}
							
									
							//window.location= "models/process.php";
							//$('#modal-login').closeModal();
							//$('#error-login').find('p').html('');       
							//mostrarPagLog(res.data); 
						} else {
							
							console.log(res.mensaje);
							window.location= "models/process.php";
						}
					})
					.fail(function(){
						console.log("fail log TWT");
					}); 
					
				} else {
					
					console.log(res.error);
				}
			})
			.fail (function(){
				
				console.log("fail set current url");
			});
	
	
	}
/***********************************************************************/


  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    //console.log(response);
	// The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      /*MOSTRAR PAGLOG*/
      /*testAPI();*/
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      /*MOSTRAR PAGDESLOG*/
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      /*MOSTRAR PAGDESLOG*/
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
     appId      : '912792918776395',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
	status     : true,
      
      oauth      : true,
      
    version    : 'v2.5' // use version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  /*
	FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
  */
  
   $('.btn-face').on('click', null, function() {
    //do the login
	
    FB.login(function(response) {
		
        if (response.authResponse) {
			
            //user just authorized your app
            //top.location.href = 'example.com/facebook_connect.php';
			/*MOSTRAR PAGLOG*/
			
			/*testAPI();*/
			
			FB.api('/me?fields=first_name,picture,last_name,email', function(response) {
				
				
				$.ajax({
					url : URI.POST_SOCIAL,
					method : 'POST',
					dataType : 'json',
					data : {'nombre':response.first_name,
							'apellido':response.last_name,
							'email':response.id,
							'imgSrc':response.picture.data.url,
							'belong':'facebook'
							}
				})
				.done(function(res){
				
					if(!res.error){	
						
						$('#modal-login').closeModal();
						$('#error-login').find('p').html('');       
						mostrarPagLog(res.data); 
					} else {
						
						console.log(res.mensaje);
					}
				})
				.fail(function(){
					
					console.log("fail log social");
				});        
				
			});
        }
    }, {scope: 'email,public_profile', return_scopes: true});
});

  };

  // Load the SDK asynchronously
  
  (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/es_LA/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
  
/*************************************************************************************/
	var checkTwitter = function (){				
		if ($('#header_nombreTwt').val().length){
			
			var nombre = $('#header_nombreTwt').val();
			var email = $('#header_emailTwt').val();
			var imgTWT = $('#header_picTwt').val();
			//console.log(nombre);
				//console.log(email);
					//console.log(imgTWT);
			
			
			$.ajax({
				url : URI.POST_SOCIAL,
				method : 'POST',
				dataType : 'json',
				data : {'nombre':nombre,
						'apellido':'',
						'email':email,
						'imgSrc': imgTWT,
						'belong':'twitter'
						}
				})
				.done(function(res){
					if(!res.error){				
						$('#modal-login').closeModal();
						$('#error-login').find('p').html('');       
						mostrarPagLog(res.data); 
					} else {
						console.log(res.mensaje);
					}
				})
				.fail(function(){
					console.log("fail log social");
				});  
			
			
			
		}
	}
	
	/************************************************************************/
	

	var getGoogle = function(){
		gapi.load('auth2', function(){
		  // Retrieve the singleton for the GoogleAuth library and set up the client.
		  auth2 = gapi.auth2.init({
			client_id: '656703856722-n0f5rc1u6u5i5hm9qvv0tefcc1oog8mo.apps.googleusercontent.com',
			cookiepolicy: 'single_host_origin',
			// Request scopes in addition to 'profile' and 'email'
			//scope: 'additional_scope'
		  });
		  attachSignin(document.getElementById('btn-gp-id1'));
		  attachSignin(document.getElementById('btn-gp-id2'));
		});
	};
	
	
	var attachSignin = function (element) {		
		auth2.attachClickHandler(element, {},
			function(googleUser) {
				
				var gId       = (googleUser.getBasicProfile().getId() === "undefined") ? "" : googleUser.getBasicProfile().getId();
				var gFullName = (googleUser.getBasicProfile().getName() === "undefined") ? "" : googleUser.getBasicProfile().getName();
				var gName     = (gFullName === "") ? "" : gFullName.split(' ')[0];
					gName	  = (gName === "undefined") ? "" : gName;
				var gLastName = (gFullName === "") ? "" : gFullName.split(' ')[1];
					gLastName = (gLastName === "undefined") ? "" : gLastName;					
				var gImageUrl = (googleUser.getBasicProfile().getImageUrl() === "undefined") ? "" : googleUser.getBasicProfile().getImageUrl();
				
				//var gEmail = googleUser.getBasicProfile().getEmail();
				
				$.ajax({
					url : URI.POST_SOCIAL,
					method : 'POST',
					dataType : 'json',
					data : {'nombre': gName,
							'apellido': gLastName,
							'email': gId,
							'imgSrc':gImageUrl,
							'belong':'gplus'
							}
				})
				.done(function(res){
				console.log(res.data);
					if(!res.error){				
						$('#modal-login').closeModal();
						$('#error-login').find('p').html('');       
						
						mostrarPagLog(res.data); 
					} else {
						console.log(res.mensaje);
					}
				})
				.fail(function(){
					alert("Error al loguearse, vuelva a intentarlo");
				});        
			 
			}, function(error) {
			  alert(JSON.stringify(error, undefined, 2));
			});
	}
	/************************************************************************/
	
	checkTwitter();
	getGoogle();
})(jQuery);