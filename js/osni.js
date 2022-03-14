$(function() {
'use strict';
var URI = {};
var ret;

URI.POST_USERS = "actions/api-user.php?action=activate";

/******************************************************************/
var setPluginValidator = function(){

	$('#form-activate').validator({
		disable : false,
		custom: {			
			'username': function($el) { 
				var valor = $el.val().trim();
				if (valor.length){
					return $el.myRegex({
						regex:'username'
					});
				}
				return true;
			},
			'email': function($el) { 
				var valor = $el.val().trim();
				if (valor.length){
					return $el.myRegex({
						regex:'email'
					});
				}
				return true;
			},
			'integer': function($el) { 
				var valor = $el.val().trim();
			
				if (valor.length){
					return $el.myRegex({
						regex:'integer'
					});
				}
				return true;
			},				
			'dni': function($el) { 
				var valor = $el.val().trim();				
				if (valor.length){
					return $el.myRegex({
						regex:'dni'
					});
				}
				return true;
			},				
			'printable': function($el) { 
				var valor = $el.val().trim();
				if (valor.length){
					return $el.myRegex({
						regex:'printable'
					});
				}
				return true;
			},
			'letters': function($el) { 
				var valor = $el.val().trim();
				if (valor.length){
					return $el.myRegex({
						regex:'letters'
					});
				}
				return true;
			},			
			'passfuerte1': function($el) {				
				var valor = $el.val().trim();
				if (valor.length){
					if ($('#passw2').val().length){
						$('#passw2').trigger('input');
					}
					return ret = $el.myRegex({
						regex:'passfuerte'
					});
				}
				return true;
			},
			'passfuerte2': function($el) {				
				var valor = $el.val().trim();
				if (valor.length){
					var ret = $el.myRegex({
						regex:'passfuerte'
					});
					if (!ret){
						return false;
					}
					if ($('#passw1').val()== $('#passw2').val()){
						return true;
					} else {						
						return false;
					}
				}
				return true;
			},
			'phone_ar': function($el) { 
				var valor = $el.val().trim();
				if (valor.length){
					return $el.myRegex({
						regex:'phone_ar'
					});
				}
				return true;
			}
			
		},
		 errors: {			  
		  'integer': "Debe ser entero positivo",
		  'dni': "DNI Invalido",		  
		  'printable' : "Solo caracteres visibles",
		  'letters' : "Solo letras",
		  'phone_ar': "Formato codAreaNumero",				  
		  'email': "Email invalido"	,
		  'passfuerte1': "Min 8 caracteres (letras y numero)",
		  'passfuerte2': "Las contrase単as no coinciden",
		  'username': "Ponele un poco mas de ganas al nombre"
		}
	}).on('submit', function (e) {
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			
			console.log($("#form-activate").serialize() );
			$.toast("Aguarda...", {'duration': 80000, 'type': 'info'});			
			
			$.ajax({
			url : URI.POST_USERS,
			method : 'POST',
			dataType : 'json',				
			data : $("#form-activate").serialize() 	
			}).done(function(res){	
				console.log(res);
				if(!res.error){							
					$.toast(res.mensaje, {'duration': 2000, 'type': 'success'});
					setTimeout(function() {
					  $.toast("Aguarde...", {'duration': 3000, 'type': 'info'});
					}, 2000);							
					setTimeout(function() {
					   window.location.assign("/");					   
					}, 4000);														
					
				}else{							
					$.toast(res.mensaje, {'duration': 3000, 'type': 'danger'});
				}
			})
			.fail(function(){						
				$.toast("Error en conexion de red", {'duration': 6000, 'type': 'danger'});
			});
			
		}
	});
	
}	
	
/*************************************************************************************/


 setPluginValidator();

});