$(function(){

    $rootDir = $('#rootDir').val();
    var URI = {};
	
	URI.GET_MEDIO_MENU_INDEX = $rootDir+"/actions/api-menu.php?action=listarAll";
	URI.TEMPLATE_MEDIO_MENU_USER_MENU= $rootDir+"/templates/listado-medio-menu-u-n.html";
	URI.GET_MEDIO_SUBMENU_INDEX2 = $rootDir+"/actions/api-submenu.php?action=listarAllPortada2";
	URI.TEMPLATE_MEDIO_SUBMENU_INDEX2= $rootDir+"/templates/listado-medio-submenu-index2.html";
		
	
	URI.TEMPLATE_NOTAS_U_S= $rootDir+"/templates/listado-medio-notas.html";
	URI.getNotasConVisitas = $rootDir+"/actions/api-nota.php?action=getNotasConVisitas";
	
	URI.GET_SUBMENU = $rootDir+"/actions/api-submenu.php?action=listar";
	
	URI.GET_DERE_PUBLI = $rootDir+"/actions/api-publi.php?action=listarAllAll";
	
	URI.GET_OTROS_SUBMENUS = $rootDir+"/actions/api-submenu.php?action=listarOtros";
	
	URI.TEMPLATE_DERE_PUBLI= $rootDir+"/templates/listado-derecha-publi.html";
	URI.TEMPLATE_OTROS_SUBMENUS= $rootDir+"/templates/listado-otros-submenus.html";	
	URI.GET_AMIGABLE = $rootDir+"/actions/api-nota.php?action=urlAmigable";
	URI.GET_getPopup = $rootDir+"/actions/api-publi.php?action=getPopup";
	URI.GET_getDelay =$rootDir+"/actions/api-publi.php?action=getDelay";
	URI.GET_getHeaderPubli =$rootDir+"/actions/api-publi.php?action=getHeaderPubli";
	URI.GET_getFooterPubli =$rootDir+"/actions/api-publi.php?action=getFooterPubli";
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
	
	var getNotas= function(idActual){	
		//console.log(idActual);
		$('.th-visitas').addClass('hidden');
		$('.th-fecha').addClass('hidden');
		$.get(URI.TEMPLATE_NOTAS_U_S, function(template_text){            			
		    $.ajax({
		    url : URI.getNotasConVisitas,
		    method : 'GET',
		    dataType : 'json',
		    data : {submenu_id:idActual}
			}).done(function(res){		
				//console.log(res.data);
				if(!res.error){	
					console.log(res.data);
					if (res.data ){
						if( res.data[0].visitas != null){
							$('.th-visitas').removeClass('hidden');
						}
						if( res.data[0].fechavisible != null){
							$('.th-fecha').removeClass('hidden');
						}
					}
					var context = {
						notas : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$('.titulo-listado-notas').css("color","#3D826F");
					$('.titulo-listado-notas').html("Notas");
					$(".contenido-listado-notas").removeClass("hidden");
					$("#tbodyppal").html(html);										
					$('.materialboxed').materialbox();
					
				} else {
					$('.titulo-listado-notas').html("No se encontraron Notas");
					$('.titulo-listado-notas').css("color","red");
					$(".contenido-listado-notas").addClass("hidden");
				}
			}).fail(function(){
				/*console.log("error otras lecturas");		*/
		}); 
	});		
		
		
	}

	    
	 /*********************************************************************/
	var getOtrosSubmenus= function(idActual){		
		$.get(URI.TEMPLATE_OTROS_SUBMENUS, function(template_text){            			
		    $.ajax({
		    url : URI.GET_OTROS_SUBMENUS,
		    method : 'GET',
		    dataType : 'json',
		    data : {id_actual:idActual}
			}).done(function(res){		
				//console.log(res.data);
				if(!res.error){	
					
					var context = {
						menus : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$("#otros-menus-collection").html(html);										
					$('.materialboxed').materialbox();
					
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
	// Floating-Fixed table of contents

	var setFloating = function(){
		var navh = $('#nav-ppal').height()+$('.container-tit').height();
				
		
		var colizqh = $('#col-medio-u-m').height()+$('#header-client').height() -$('#publi-derecha').height();
		navh= $('#header-client').height();
			
		
		if ($('#col-medio-u-m').height() >  $('#publi-derecha').height() ) {
	      $('.toc-wrapper').pushpin({	  
			top: navh,
			bottom: colizqh			  
		  });	  
		}
		  
	};
	
	/*********************************************************************/
	var cargarAjaxSubmenu = function (idSubmenu){	
		
		$.ajax({
		    url : URI.GET_SUBMENU,
		    method : 'GET',
		    dataType : 'json',
		    data : {id:idSubmenu}
		}).done(function(res){		
		
				if(!res.error){	
					$('input[name=submenu_id]').val(res.data.id)					
					$('#leyendo-titulo').html(res.data.titulo);					
			
					var srcImgSubmenu = $rootDir+"/"+res.data.pathFoto+"/"+res.data.id+"/"+res.data.filenameFoto;
					if(res.data.filenameFoto =="" || res.data.filenameFoto==null){							
							 $('#leyendo-src').addClass('hidden');
							$('#leyendo-src').closest('.collection-item ').css('padding-left','72px');
						} else  {							 
							 $('#leyendo-src').removeClass('hidden');
							$('#leyendo-src').closest('.collection-item ').css('padding-left','72px');
							}
							
					
					$('#leyendo-src').attr("src",srcImgSubmenu);					
					
					
					getNotas(res.data.id);
					getOtrosSubmenus(res.data.id);
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
	var redirigir = function (idSubmenu,tit){
			
		$.ajax({			
            url : URI.GET_AMIGABLE,
            method : 'GET',
            dataType : 'json',
            data : {titulo:tit}
        }).done(function(res){		
		
				if(!res.error){	
					var titAmi= res.data;				
					$.ajax({			
							url : URI.GET_SUBMENU,
							method : 'GET',
							dataType : 'json',
							data : {id:idSubmenu}
					}).done(function(res){		
						
						if(!res.error){									
							window.location = $rootDir+"/"+res.data.tituloMenu_ami+"/"+idSubmenu+"-"+titAmi;	
										
									
							} else {
								console.log("res.error 121");
							}
					}).fail(function(){
							console.log("fail redirigir al traer tituloSubmenu-u-n");		
					});		
					
						
					
				} else {
					console.log("res.error 111");
				}
		}).fail(function(){
				console.log("fail redirigir user-submenu-fill");		
		}); 
		
	}
	/*********************************************************************/

	$("#otros-menus-collection").on("mouseenter", "p", function(event){
			$(this).css('cursor','pointer');
		}).on("mouseleave", "#items .item", function(event){
			$(this).css('cursor','auto');
		});
	
	
	/*********************************************************************/
	
	$('#otros-menus-collection').on("click", "p" , function(e) {
		e.preventDefault(); 
		
		
		var idSubmenu= $(this).siblings("input").val();
		redirigir(idSubmenu,$(this).text());
		//cargarAjaxSubmenu(idSubmenu);
		
	}); 
	
	/*********************************************************************/
	
	$('#otros-menus-collection').on("click", "a" , function(e) {		
		e.preventDefault();
		
		var idSubmenu= $(this).siblings("input").val();
		redirigir(idSubmenu,$(this).siblings("p").text());
		//cargarAjaxSubmenu(idSubmenu);
		
	}); 
	
	/*********************************************************************/
	 var init_user_submenu= function(){
		
		if ($('#leyendo-src').attr('src') == "" || $('#leyendo-src').attr('src') == null){	
			$('#leyendo-src').addClass('hidden');		
			 $('#leyendo-src').closest('.collection-item ').css('padding-left','72px');			
		} 	else {
			$('#leyendo-src').removeClass('hidden');
		}	
		
	};
	
	
	
	
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
		
		
		// getPublisMedio(menu);
		
	}
	
	
	/*********************************************************************/
	
	var getMenusMedio= function(){	
		$.get(URI.TEMPLATE_MEDIO_MENU_USER_MENU, function(template_text){            			
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
						
						$("#menus-user-submenu").append(html);
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
			$("#menus-user-submenu").removeClass("hidden");
			
			$("#menus-user-submenu .container-cards").each(function(){
				$(this).addClass("hidden");
			
			});
			
			$($(this).attr("href")).removeClass("hidden");
			
		});
	/*********************************************************************/
		$('#menus-user-submenu').on("click",".btn-floating",function(e){			
			$(this).closest(".container-cards").addClass("hidden");
			$("#menus-user-submenu").addClass("hidden");
		});
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
		
	init_user_submenu();
	getOtrosSubmenus($('input[name=submenu_id]').val());
	getNotas($('input[name=submenu_id]').val());
	getPublisDer();
	
	getMenusMedio();
	if (!is_touch()){
		getHeaderPubli();
		getFooterPubli();
		handlePopup();
	 }
	
});