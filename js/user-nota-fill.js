$(function(){

    $rootDir = $('#rootDir').val();
    var URI = {};
	
	URI.GET_MEDIO_MENU_INDEX = $rootDir+"/actions/api-menu.php?action=listarAll";
	URI.TEMPLATE_MEDIO_MENU_USER_NOTA= $rootDir+"/templates/listado-medio-menu-u-n.html";
	URI.GET_MEDIO_SUBMENU_INDEX2 = $rootDir+"/actions/api-submenu.php?action=listarAllPortada2";
	URI.TEMPLATE_MEDIO_SUBMENU_INDEX2= $rootDir+"/templates/listado-medio-submenu-index2.html";
		
	URI.POST_COMENTARIOS = $rootDir+"/actions/api-comentario.php?action=guardar";
	URI.POST_CHECK = $rootDir+"/actions/api-login.php?action=check";
	URI.POST_LEIDOS = $rootDir+"/actions/api-lectura.php?action=guardar";
	URI.GET_LEIDOS = $rootDir+"/actions/api-lectura.php?action=listarPorIdNotaIdUser";
	URI.GET_USER_NOTA = $rootDir+"/actions/api-nota.php?action=listar";
	URI.GET_DERE_PUBLI = $rootDir+"/actions/api-publi.php?action=listarAllAll";
	URI.GET_OTRAS_LECTURAS = $rootDir+"/actions/api-nota.php?action=listarAllDiez";
	URI.GET_COMENTARIOS = $rootDir+"/actions/api-comentario.php?action=listarPorIdNota";     
	URI.TEMPLATE_DERE_PUBLI= $rootDir+"/templates/listado-derecha-publi.html";
	URI.TEMPLATE_OTRAS_LECTURAS= $rootDir+"/templates/listado-otras-lecturas.html";	
	URI.TEMPLATE_COMENTARIOS = $rootDir+"/templates/comentarios.html";
	URI.GET_TIPO_USER = $rootDir+"/actions/api-server.php?action=getTipoUser";
	URI.REMOVE_VIEW_COMMENT = $rootDir+"/actions/api-comentario.php?action=eliminarView";
	URI.GET_AMIGABLE = $rootDir+"/actions/api-nota.php?action=urlAmigable";
	URI.GET_getPopup = $rootDir+"/actions/api-publi.php?action=getPopup";
	URI.GET_getDelay =$rootDir+"/actions/api-publi.php?action=getDelay";  
	URI.GET_getHeaderPubli =$rootDir+"/actions/api-publi.php?action=getHeaderPubli";
	URI.GET_getFooterPubli =$rootDir+"/actions/api-publi.php?action=getFooterPubli";
	URI.GET_getPubliEnNota =$rootDir+"/actions/api-publi.php?action=getPubliEnNota";
	
	var delayPopup;
	
	/*********************************************************************/		
	var is_touch = function () {
	      try {
		document.createEvent("TouchEvent");
		return true;
	      } catch (e) {
		return false;
	      }
	}
	/*********************************************************************/
	var getOtrasLecturas= function(submenuId, idActual){		
		$.get(URI.TEMPLATE_OTRAS_LECTURAS, function(template_text){            			
		    $.ajax({
		    url : URI.GET_OTRAS_LECTURAS,
		    method : 'GET',
		    dataType : 'json',
		    data : {submenu_id:submenuId, id_actual:idActual}
			}).done(function(res){
			
				if(!res.error){	
					
					var context = {
						lecturas : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					
						
					$("#otras-lecturas-collection").html(html);										
					$('.materialboxed').materialbox();
					
					if ($('#header_id').val() == "" || $("#header_id").val() == null){
						
					} else {
						
						for (i=0;i<res.data.length;i++){						
							var notaId=res.data[i].id;
							var userId=$("#header_id").val();
							
							$.ajax({
								url : URI.GET_LEIDOS,
								method : 'GET',
								dataType : 'json',
								data : {nota_id:notaId, user_id:userId}
							}).done(function(resLeidos){
							if(!resLeidos.error){								
								$("#p-leido-"+resLeidos.data.nota_id).text("leido");
							} else {							
								/*console.log("no hay leidos");*/
							}
							}).fail(function(){
								/*console.log("error select lo ultimo");*/		
							}); 
						};		
					}
				} else {
					/*console.log("res.mensaje1");*/
				}
			}).fail(function(){
				/*console.log("error otras lecturas");		*/
		}); 
	});		
		
		
	}
	/*********************************************************************/
	var getPublisDer= function(){
		$.get(URI.TEMPLATE_DERE_PUBLI, function(template_text){            			
            $.ajax({
            url : URI.GET_DERE_PUBLI,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
				if(!res.error){	
					
						var context = {
						publis : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');	
					
										
					$('#publi-derecha').html(html);									
					setFloating();
					
					
				} else {
					/*console.log("res.error");*/
				}
		}).fail(function(){
				/*console.log("error select lo ultimo");*/		
				}); 
		});		
		
	}
	/*********************************************************************/
	var setFloating = function(){
		var navh = $('#nav-ppal').height()+$('.container-tit').height();
		//console.log(navh);
		var bot = $('body').height() - $('.page-footer').height() + $(window).height()*0.5; 
		var bodyh = $('body').height();
		var pagefooterh = $('.page-footer').height();
		var windowh = $(window).height();
		
		/*var colizqh = $('#col-izq').height()+$('#header-client').height() -$('#publi-derecha').height();*/
		var colizqh = $('#col-medio-index').height()+$('#header-client').height() -$('#publi-derecha').height();
		navh= $('#header-client').height();
		//console.log("colizqh:" + $('#col-izq').height());
		//console.log("header:" + $('#header-client').height());
		//console.log("derecha:" + $('#publi-derecha').height());
		//console.log("col-medio-index:" + $('#col-medio-index').height());
		/*
		console.log("bot " + bot);
		console.log("body " +bodyh);
		console.log("pagefooter " +pagefooterh);
		console.log("window " + windowh);
		*/
		
		if ($('#col-medio-index').height() >  $('#publi-derecha').height() ) {
	      $('.toc-wrapper').pushpin({	  
			top: navh,
			bottom: colizqh			  
		  });	  
		}
		  
	};
	/*********************************************************************/
	var actualizarLeidos = function (idNota,idUser){		
		$.ajax({
		    url : URI.POST_LEIDOS,
		    method : 'POST',
		    dataType : 'json',
		    data : {nota_id:idNota, user_id:idUser}
		}).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
					//console.log("guardado");
										
				} else {
					/*console.log(res.mensaje);*/
				}
		}).fail(function(){
				/*console.log("fail guardando leidos");		*/
				}); 
	}
	/*********************************************************************/
	var cargarAjaxNota = function (idNota){	
		
		if ($("#header_id").val() == "" || $("#header_id").val() == null){
		
		}else{
			
			actualizarLeidos(idNota,$("#header_id").val());
		}
			
		$.ajax({
		    url : URI.GET_USER_NOTA,
		    method : 'GET',
		    dataType : 'json',
		    data : {id:idNota}
		}).done(function(res){		
		
				if(!res.error){	
					$('input[name=nota_id]').val(res.data.id)
					$('#nota-medio-titulo').html(res.data.titulo);	
					$('#leyendo-titulo').html(res.data.titulo);
					$('#encabezado-fecha-nota').html(res.data.fechaNotaUser);					
					
				/*	var strSplitIni = $('#leyendo-src').attr('src').split("/");
					if (strSplitIni[4]=="" || strSplitIni[4]==null){	
				*/
					var srcImgNota = $rootDir+"/"+res.data.pathFoto+"/"+res.data.id+"/"+res.data.filenameFoto;
					if(res.data.filenameFoto =="" || res.data.filenameFoto==null){
							 $('#nota-medio-src').addClass('hidden');
							 $('#leyendo-src').addClass('hidden');
							$('#leyendo-src').closest('.collection-item ').css('padding-left','72px');
						} else  {
							 $('#nota-medio-src').removeClass('hidden');
							 $('#leyendo-src').removeClass('hidden');
							$('#leyendo-src').closest('.collection-item ').css('padding-left','72px');
							}
							
					$('#nota-medio-src').attr("src",srcImgNota);
					$('#leyendo-src').attr("src",srcImgNota);
					$('#nota-medio-subtitulo').val(res.data.subtitulo);
					/*console.log(res.data.descripcion);*/
					$('#nota-medio-descripcion').text(res.data.descripcion);
					//alert(res.data.autor);
					console.log(res.data);
					if(res.data.autor =="" || res.data.autor==null){
						$('#label-nota-medio-autor').addClass("hidden");
						
					} else {
						$('#label-nota-medio-autor').removeClass("hidden");
						$('#nota-medio-autor').text(res.data.autor);
					}
					
					
					if (res.data.word==1){
						$('#btn-download-word').removeClass("hidden");
						$('#btn-download-word').prop("href",$rootDir+"/files/nota/"+res.data.id+"/"+res.data.fechaNotaUser+".docx");
					} else{
							$('#btn-download-word').addClass("hidden");
					}
					
					
					getOtrasLecturas($('#submenu_id').val(),res.data.id);
					
					$('input[name="nota_id"]').val(res.data.id);    
					getComentarios();
					setFloating();
										
				} else {
					/*console.log("res.mensaje2");*/
				}
		}).fail(function(){
				/*console.log("error otras lecturas");		*/
				}); 
				
				return false;
	};
	/*********************************************************************/
	$("#otras-lecturas-collection").on("mouseenter", "p", function(event){
			$(this).css('cursor','pointer');
		}).on("mouseleave", "#items .item", function(event){
			$(this).css('cursor','auto');
		});
		/*********************************************************************/
	var redirigir = function (idNota,tit){
			//alert(idNota);
			//alert(tit);
		$.ajax({			
            url : URI.GET_AMIGABLE,
            method : 'GET',
            dataType : 'json',
            data : {titulo:tit}
        }).done(function(res){	
		
					if(!res.error){	
					var titAmi= res.data;				
					$.ajax({			
							url : URI.GET_USER_NOTA,
							method : 'GET',
							dataType : 'json',
							data : {id:idNota}
					}).done(function(res){		
						
						if(!res.error){	
							
							window.location = $rootDir+"/"+res.data.tituloMenu_ami+"/"+res.data.tituloSubmenu_ami+"/"+idNota+"-"+titAmi;
										
									
							} else {
								console.log("res.error 121");
							}
					}).fail(function(){
							console.log("fail redirigir al traer tituloSubmenu-u-n");		
					});	
						
						
					
				} else {
					console.log("res.error 122");
				}
		}).fail(function(){
				console.log("fail redirigir user-nota-fill");		
		}); 
		
	}
	/*********************************************************************/
	
	$('#otras-lecturas-collection').on("click", "p" , function(e) {
		e.preventDefault();				
		var idNota= $(this).siblings("input").val();
		redirigir(idNota,$(this).text());
		//cargarAjaxNota(idNota);
		
	}); 
	/*********************************************************************/
	$('#otras-lecturas-collection').on("click", "a" , function(e) {		
		e.preventDefault();				
		var idNota= $(this).siblings("input").val();
		redirigir(idNota,$(this).siblings("p").text());
		//cargarAjaxNota(idNota);
		
	}); 
	/*********************************************************************/
	var init_user_nota= function(){
		
		if ($('#leyendo-src').attr('src') == "" || $('#leyendo-src').attr('src') == null){			
			 $('#nota-medio-src').addClass('hidden');
			 $('#leyendo-src').addClass('hidden');
			 $('#leyendo-src').closest('.collection-item ').css('padding-left','72px');			
		} else {			
			
			 $('#nota-medio-src').removeClass('hidden');
			 $('#leyendo-src').removeClass('hidden');
		}
	
	};
	/*********************************************************************/
	var fillDomListadoComentarios = function(comentarios){
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
							
							
						    $('#lista-comentarios').html("");
						    $('#lista-comentarios').html(html);
						});				
					}else{
						console.log(res);
					}
				})
				.fail(function(){
					//si fallo la peticion muestro mensaje de error
					console.log("fail44");
				});
	};    
	/*********************************************************************/
	var getComentarios = function(){
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
			fillDomListadoComentarios(res.data);
		    }else{
			fillDomListadoComentarios(res.data); // limpia, no hay nada
			};               
		    })
		    .fail(function(){                
			console.log("error");
		    });         
	};	
	/*********************************************************************/
	var checkLogin= function(){		
		$.ajax({
                url : URI.POST_CHECK,
                method : 'POST',
                dataType : 'json',
                data : {}				
            })
            .done(function(res){
								
                if(!res.error){
                    //console.log(res);
					$('#user_id_user_nota osni').val(res.data.id);
				    publicarComentario();
                    
                }else{
					//console.log(res);
					$('#modal-login').openModal();					
                    	
				}
            })
            .fail(function(){
                //si fallo la peticion muestro mensaje de error
				console.log("error 2");
            });
	
	}
	/*********************************************************************/
	var validarFormData = function(){
		if ($('#txtComentario').val().length){
			return true;
		}
		$('#error-publicar-comment').html("* El comentario no puede estar vacio");
		$('#btn-publicar-comment').addClass("right");
		return false;
		
	}
	/*********************************************************************/
	var cleanFormError = function(){
		$('#error-publicar-comment').html("");
		$('#btn-publicar-comment').removeClass("right");
	}
	/*********************************************************************/
	var publicarComentario = function(){
		//console.log($("#form-comentarios").serialize());
		//alert("a publi");
		console.log($("#form-comentarios").serialize());
		cleanFormError();
		if(validarFormData()){
			$.ajax({
					url : URI.POST_COMENTARIOS,
					method : 'POST',
					dataType : 'json',				
					data : $("#form-comentarios").serialize()				
				})
				.done(function(res){								
					if(!res.error){
						$('#txtComentario').val('');
						$('#btn_publicar_apretado_user_nota').val("0");
						//console.log(res);
						getComentarios();					
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
	$('#btn-publicar-comment').on("click",null,function(e){
		e.preventDefault();
		$('#btn_publicar_apretado_user_nota').val("1");
		checkLogin();
		
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
	var getSubmenusMedio2= function(){
		$.get(URI.TEMPLATE_MEDIO_SUBMENU_INDEX2, function(template_text){            			
            $.ajax({			
            url : URI.GET_MEDIO_SUBMENU_INDEX2,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
				if(!res.error){						
						var context = {
						submenus : res.data
					};
					
					for (i=0;i<res.data.length;i++){						
						var template = Handlebars.compile(template_text);
						var html = template(context.submenus[i]).split('href="/').join('href="'+$rootDir+'/');	
							html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');						
						
						
						
						$("#menu"+context.submenus[i].menu_id+"-submenus").append(html);
					}
					
				} else {
					console.log("res.error2");
				}
		}).fail(function(){
				console.log("error select submenu2");		
				}); 
		});
		
		/*getPublisMedio(menu);		*/
		
	}
	/*********************************************************************/
	var getMenusMedio= function(){
		$.get(URI.TEMPLATE_MEDIO_MENU_USER_NOTA, function(template_text){            			
            $.ajax({			
            url : URI.GET_MEDIO_MENU_INDEX,
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
						
						
						
						$("#menus-user-nota").append(html);
						getSubmenusMedio2();
											
						
					
				} else {
					console.log("res.error");
				}
		}).fail(function(){
				console.log("error select submenu4");		
				}); 
		});
		
		
	}
	/*********************************************************************/
	$('#ul-mnu').on("click",'li a',function(e){				
		e.preventDefault();
		$("#menus-user-nota").removeClass("hidden");
		
		$("#menus-user-nota .container-cards").each(function(){
			$(this).addClass("hidden");
		
		});
		
		$($(this).attr("href")).removeClass("hidden");
			
	});
	/*********************************************************************/
	$('#menus-user-nota').on("click",".btn-floating",function(e){			
			$(this).closest(".container-cards").addClass("hidden");
			$("#menus-user-nota").addClass("hidden");
		});
	/*********************************************************************/
	var checkTwitter = function(){		
		if ($('#txtComentario').val().length){			
			$('#btn-publicar-comment').trigger("click");			
		} else {			
			getComentarios();			
		}		
	}
	/*********************************************************************/	
	var deletecomment = function (idComment){
		$.ajax({			
            url : URI.REMOVE_VIEW_COMMENT,
            method : 'POST',
            dataType : 'json',
            data : {id:idComment}
        }).done(function(res){				
				if(!res.error){								
					$('#lista-comentarios .row#'+$('#id-eliminar-comment').val()).remove();
					Materialize.toast('Comentario eliminado', 2000);
				} else {
					Materialize.toast('Error al eliminar comentario', 2000);
					console.log("error al eliminar view comment");					
				}
		}).fail(function(){
				Materialize.toast('Error al eliminar comentario', 2000);
				console.log("fail eliminar comment");	
							
		}); 
	}
	/*********************************************************************/
	$('#lista-comentarios').on("click","a",function(e){
		e.preventDefault();		
		$('#id-eliminar-comment').val($(this).closest(".row").attr("id"));
		$('#modalEliminarComment').find('p').html($(this).closest('p').text().split('delete')[0]);
		$('#modalEliminarComment').openModal();
	});
	/*********************************************************************/
	$('#confirmar-eliminar-comment').on("click",null,function(e){
		e.preventDefault();
		$('#modalEliminarComment').closeModal();
		deletecomment($('#id-eliminar-comment').val());
				
		return false;
		
	});
	
	/*********************************************************************/
	$("#close-eliminar-comment").on("click",null,function(e){		
	    $('#modalEliminarComment').closeModal();
	});
	/*********************************************************************/
	var showPopup = function (){
		$.ajax({
            url : URI.GET_getPopup,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){	
			if(!res.error){				
				var indiceRandom = Math.floor((Math.random() * res.data.length));				
				var strPath = $rootDir+"/"+res.data[indiceRandom].pathFoto+"/"+res.data[indiceRandom].id+"/"+res.data[indiceRandom].filenameFoto;
			
				var htmlmodal= '<object width="100%" data="'+strPath+'" style="height: 100%; min-height: 10px;">';
					htmlmodal+='<param name="wmode" value="transparent"></object>';							
				$('#modalPopup .modal-content').html(htmlmodal);
				
				setTimeout(function() {
					$("#modalPopup").openModal({
							 dismissible: false, 
							 opacity:0.8							 
							});
			
					var segundos = 15;
					var interv = setInterval(function () {
				
						$('#modalPopup .modal-footer p').html ("La publicidad se cierra en "+segundos+" segundos");
						if (segundos<12){
							$('#modalPopup  a').removeClass("disabled");
							$('#modalPopup  a').html("omitir");
						} else {
							var textBtn = "omitir en "+(segundos-11);
							$('#modalPopup  a').text(textBtn);
						}
						
						if (segundos==0){
							clearInterval(interv);						
							$("#modalPopup").closeModal();						
						} else {
							segundos--;
						}
					}, 1000);	
				}, 30000);	
			} else {					
				console.log("NO HAY POPUP");							
			}
		}).fail(function(){
				
				console.log("fail SHOWPOPUP");		
		}); 
		
		
	}
	
	/*********************************************************************/
	var refreshCreatedPopup = function (timeStored, currentDate, delayPopup){		
		
		var compare =  Math.abs(currentDate - timeStored);
		var hr = Math.ceil((compare/(1000*60*delayPopup)));
	
		if (hr > 1) { 
			showPopup();
			timeStored = currentDate;
		}
		
		return timeStored;
		
	}
	
	/*********************************************************************/
	 var addTimePopup = function (arr, delayPopup){
		var added=false;
		var date = new Date().getTime();
		
		if (arr){								
			$.map(arr, function(elementOfArray, indexInArray) {					
				if (elementOfArray.id == "index") {							
					elementOfArray.created = refreshCreatedPopup(elementOfArray.created, date, delayPopup);
					added = true;
				}
			});		
			if (!added) {				
				showPopup();
				arr.push({id: "index", created: date});
			}
		} else {
			showPopup();
			arr = [{id:"index", created:date}];
		}
		
		return arr;
	 }
	
	/*********************************************************************/
	var handlePopup = function(){
		//window.localStorage.clear();			
		$.ajax({
		    url : URI.GET_getDelay,
		    method : 'GET',
		    dataType : 'json',
		    data : {}
			}).done(function(res){				
				if(!res.error){									
					var popups = localStorage.getItem("popups");		
					var popupsArray = addTimePopup(JSON.parse(popups), res.data);					
					if (popupsArray){						
						localStorage.setItem("popups", JSON.stringify(popupsArray));			
					} else {
						console.log("error");
					}		
				} else {						
					console.log(res.error);
				}									  
			})
			 .fail(function(){
				
				console.log("fail handlePopup");
			});
	}
	/*********************************************************************/
	var getHeaderPubli = function (){
		$.ajax({
            url : URI.GET_getHeaderPubli,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){	
			if(!res.error){				
				var indiceRandom = Math.floor((Math.random() * res.data.length));				
				var strPath = $rootDir+"/"+res.data[indiceRandom].pathFoto+"/"+res.data[indiceRandom].id+"/"+res.data[indiceRandom].filenameFoto;
								
				var html= '<object width="100%" data="'+strPath+'" style="height: 100%; min-height: 150px; max-height: 2000px;">';
					html+='<param name="wmode" value="transparent"></object>';	
				
				
				$('#col-header-publi').html(html);
				
			} else {					
				console.log("NO HAY PUBLIHEADER");							
			}
		}).fail(function(){
				
				console.log("fail PUBLIHEADER");		
		}); 
		
		
	}
	/*********************************************************************/
	var getFooterPubli = function (){
		$.ajax({
            url : URI.GET_getFooterPubli,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){	
			if(!res.error){				
				var indiceRandom = Math.floor((Math.random() * res.data.length));				
				var strPath = $rootDir+"/"+res.data[indiceRandom].pathFoto+"/"+res.data[indiceRandom].id+"/"+res.data[indiceRandom].filenameFoto;
								
				var html= '<object width="100%" data="'+strPath+'" style="height: 100%; min-height: 150px; max-height: 2000px;">';
					html+='<param name="wmode" value="transparent"></object>';	
								
				$('#col-footer-publi').html(html);
				
			} else {					
				console.log("NO HAY PUBLIFOOTER");							
			}
		}).fail(function(){
				
				console.log("fail PUBLIFOOTER");		
		}); 
		
		
	}
	/*********************************************************************/
	$("#modalPopup a").on("click",null,function(e){
		e.preventDefault();
		if (!$(this).hasClass("disabled")){
			$("#modalPopup").closeModal();
		}
	});
	/*********************************************************************/
	var getPubliEnNota = function (){
		$.ajax({
            url : URI.GET_getPubliEnNota,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){	
			if(!res.error){				
				var indiceRandom = Math.floor((Math.random() * res.data.length));				
				var strPath = $rootDir+"/"+res.data[indiceRandom].pathFoto+"/"+res.data[indiceRandom].id+"/"+res.data[indiceRandom].filenameFoto;
				var href = res.data[indiceRandom].href;
				var onmousedown="window.location.href= '"+href+"'";
					   
					
				var html = '<div class="vergini " onmousedown="'+onmousedown+' ">';
					html+= '<object width="50%" data="'+strPath+'" style="height: 100%; min-height: 150px; max-height: 2000px;">';
					html+= '<param name="wmode" value="transparent"></object>';	
				
				
				$('.row-publi-enNota').html(html);
				
			} else {					
				console.log("NO HAY PUBLIEnNota");							
			}
		}).fail(function(){
				
				console.log("fail PUBLIEnNota");		
		}); 
		
		
	}
	
	/*********************************************************************/
	init_user_nota();
	getOtrasLecturas($('#submenu_id').val(), $('input[name=nota_id]').val());
	getPublisDer();
	checkTwitter();
	getMenusMedio();
	getPubliEnNota();
	if (!is_touch()){
		getHeaderPubli();
		getFooterPubli();
		handlePopup();
	 }

});