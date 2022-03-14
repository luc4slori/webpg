$(function(){

    $rootDir = $('#rootDir').val();
    var URI = {};
	URI.GET_NOTA = $rootDir+"/actions/api-nota.php?action=listar";
	URI.GET_DERE_PUBLI = $rootDir+"/actions/api-publi.php?action=listarAllAll";
	URI.GET_LOULTIMO = $rootDir+"/actions/api-nota.php?action=loUltimo";
	URI.GET_OLD_NOTAS= $rootDir+"/actions/api-nota.php?action=oldNotas";
	URI.GET_MEDIO_MENU_INDEX = $rootDir+"/actions/api-menu.php?action=listarAll";
	URI.GET_MEDIO_SUBMENU_INDEX2 = $rootDir+"/actions/api-submenu.php?action=listarAllPortada2";
	URI.GET_MEDIO_PUBLI_INDEX = $rootDir+"/actions/api-publi.php?action=listarAll";
	URI.GET_CARRUSEL_AMI= $rootDir+"/actions/api-nota.php?action=listarCarruselAmi";
	URI.TEMPLATE_MEDIO_MENU_INDEX= $rootDir+"/templates/listado-medio-menu-index.html";
	URI.TEMPLATE_MEDIO_SUBMENU_INDEX2= $rootDir+"/templates/listado-medio-submenu-index2.html";
	URI.TEMPLATE_MEDIO_PUBLI_INDEX= $rootDir+"/templates/listado-medio-publi-index.html";
	URI.TEMPLATE_LOULTIMO= $rootDir+"/templates/listado-loultimo.html";
	URI.TEMPLATE_OLD_NOTAS= $rootDir+"/templates/listado-old-notas.html";
	URI.TEMPLATE_DERE_PUBLI= $rootDir+"/templates/listado-derecha-publi.html";
	URI.TEMPLATE_CARRUSEL= $rootDir+"/templates/carrusel-index.html";
	URI.GET_AMIGABLE = $rootDir+"/actions/api-nota.php?action=urlAmigable";
	URI.GET_getPopup = $rootDir+"/actions/api-publi.php?action=getPopup";
	URI.GET_getDelay = $rootDir+"/actions/api-publi.php?action=getDelay";
	URI.GET_getHeaderPubli = $rootDir+"/actions/api-publi.php?action=getHeaderPubli";
	URI.GET_getFooterPubli = $rootDir+"/actions/api-publi.php?action=getFooterPubli";
	
	URI.GET_MEDIO_PUBLIv2_INDEX = $rootDir+"/actions/api-publi.php?action=getPubliv2Index";
	URI.TEMPLATE_MEDIO_PUBLIv2_INDEX= $rootDir+"/templates/listado-medio-publiv2-index.html";
	
	
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
	var getPublisMediov2= function(menu, pos){
		var mioffset = pos*2;
		console.log(mioffset);
		$.get(URI.TEMPLATE_MEDIO_PUBLIv2_INDEX, function(template_text){            			
            $.ajax({
            url : URI.GET_MEDIO_PUBLIv2_INDEX,
            method : 'GET',
            dataType : 'json',
            data : {offset:mioffset}
        }).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
						var context = {
						publis : res.data
					};
					
					var template = Handlebars.compile(template_text);					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');
					html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					
					$("#menu"+menu.id+"-publiv2").append(html);					
				
				} else {
					console.log("no hay publicidadv2 ???");
				}
		}).fail(function(){
				console.log("error publiv2");		
				}); 
		});
	
	}
	/*********************************************************************/
	var getPublisMedio= function(menu){
		$.get(URI.TEMPLATE_MEDIO_PUBLI_INDEX, function(template_text){            			
            $.ajax({
            url : URI.GET_MEDIO_PUBLI_INDEX,
            method : 'GET',
            dataType : 'json',
            data : {menu_id:menu.id}
        }).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
						var context = {
						publis : res.data
					};
					
					var template = Handlebars.compile(template_text);					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$("#menu"+menu.id+"-publi").append(html);					
				
				} else {
					console.log("falta agregar publicidad al nuevo menu **index-fill->getPublisMedio**");
				}
		}).fail(function(){
				console.log("error select submenu OSNIIIIIIIIIIIIIIIIIIII");		
				}); 
		});
	
	}
	/*********************************************************************/
	var getOldNotas_OLD= function(menu,pos){
		var mioffset = 16 + pos*2;
		$.get(URI.TEMPLATE_OLD_NOTAS, function(template_text){            			
            $.ajax({
            url : URI.GET_OLD_NOTAS,
            method : 'GET',
            dataType : 'json',
            data : {offset:mioffset}
        }).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
						var context = {
						oldnotas : res.data
					};
					
					var template = Handlebars.compile(template_text);					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
						
						
					$("#menu"+menu.id+"-oldnotas").append(html);					
				
				} else {
					console.log("ERROR EN OLD NOTAS");
				}
		}).fail(function(){
				console.log("fail en old notas");		
				}); 
		});
	
	}
	/*********************************************************************/
	var getPublisDer_OLD= function(){
		$.get(URI.TEMPLATE_DERE_PUBLI, function(template_text){            			
            $.ajax({			
            url : URI.GET_DERE_PUBLI,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
						var context = {
						publis : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$('#publi-derecha').html(html);									
					showWhatsApp();
					setFloating();
					
					
				} else {
					console.log("res.error 103");
				}
		}).fail(function(){
				console.log("error select lo ultimo");		
				}); 
		});		
		
	}
	/*********************************************************************/
	var getPublisDer= function(){
										
		//showWhatsApp();
		setFloating();
		
	}
	 /*********************************************************************/
	var getLoUltimo= function(){
		$.get(URI.TEMPLATE_LOULTIMO, function(template_text){            			
            $.ajax({
            url : URI.GET_LOULTIMO,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
				if(!res.error){	
					//console.log(res.data);
						var context = {
						notas : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$("#col-izq").append(html);										
					
					
					
				} else {
					console.log("res.error 104");
				}
		}).fail(function(){
				console.log("error select lo ultimo");		
				}); 
		});		
		
		
	}
	/*********************************************************************/
	var getSubmenusMedio2= function(){
		getPublisDer();		
	}
	/*********************************************************************/
	var getSubmenusMedio2_OLD= function(){
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
					getPublisDer();
					
				} else {
					console.log("res.error 105");
				}
		}).fail(function(){
				console.log("error select submenu2");		
				}); 
		});
		
		
		
	}
	/*********************************************************************/
	
	var getMenusMedio_OLD= function(){
		$.get(URI.TEMPLATE_MEDIO_MENU_INDEX, function(template_text){            			
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
						$("#col-medio-index").append(html);
						getSubmenusMedio2();
						for (i = 0; i < res.data.length; i++) {
							getOldNotas(res.data[i],i);
							getPublisMediov2(res.data[i], i);
							getPublisMedio(res.data[i]);
						}
						
						
					
				} else {
					console.log("res.error 107");
				}
		}).fail(function(){
				console.log("error select submenu4");		
				}); 
		});
		
		
	}
	
	/*********************************************************************/
	
	var getMenusMedio= function(){
		getSubmenusMedio2();
		//for (i = 0; i < res.data.length; i++) {
			//getOldNotas(res.data[i],i);
			//getPublisMediov2(res.data[i], i);
			//getPublisMedio(res.data[i]);
		//}
	}
	 /*********************************************************************/
	// Floating-Fixed table of contents

	var setFloating = function(){
		var navh = $('#nav-ppal').height()+$('.container-tit').height();
		//console.log(navh);
		var bot = $('body').height() - $('.page-footer').height() + $(window).height()*0.5; 
		var bodyh = $('body').height();
		var pagefooterh = $('.page-footer').height();
		var windowh = $(window).height();
		
		/*var colizqh = $('#col-izq').height()+$('#header-client').height() -$('#publi-derecha').height();*/
		var colizqh = $('#col-medio-index').height()+$('#header-client').height() -$('#publi-derecha').height() -20;
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
	      $('.toc-wrapper').pushpin({	  
			top: navh,
			bottom: colizqh			  
		  });	  
		  
	};
	 /*********************************************************************/
	$("#col-medio-index").on("mouseenter", ".row.oldnotas", function(event){
			$(this).css('cursor','pointer');
		}).on("mouseleave", "#items .item", function(event){
			$(this).css('cursor','auto');
		});
	
	/*********************************************************************/
	
	$('#col-medio-index').on("click", ".row.oldnotas" , function(e) {
		e.preventDefault(); 
		var imgSrc = $(this).find("img").attr("src");
		var strSplitIni = imgSrc.split("//");
		var strSplitFin = strSplitIni[1].split("/");
		var idNota= strSplitFin[0];
		var titulo = $(this).find(".tit-lo-ultimo-2").text();
		redirigir(idNota,titulo);
		
	}); 
	 /*********************************************************************/
	$("#col-izq").on("mouseenter", ".row.loultimo", function(event){
			$(this).css('cursor','pointer');
		}).on("mouseleave", "#items .item", function(event){
			$(this).css('cursor','auto');
		});
	
	
	/*********************************************************************/
	var redirigir = function (idNota,tit){
		 $.ajax({			
            url : URI.GET_AMIGABLE,
            method : 'GET',
            dataType : 'json',
            data : {titulo:tit}
        }).done(function(res){		
		
				if(!res.error){	
					var titAmi= res.data;				
					$.ajax({			
							url : URI.GET_NOTA,
							method : 'GET',
							dataType : 'json',
							data : {id:idNota}
					}).done(function(res){		
						
						if(!res.error){	
										
							window.location = $rootDir+"/"+res.data.tituloMenu_ami+"/"+res.data.tituloSubmenu_ami+"/"+idNota+"-"+titAmi;	
										
									
							} else {
								console.log("res.error 120");
							}
					}).fail(function(){
							console.log("fail redirigir al traer tituloSubmenu");		
					}); 
						
				//	window.location = "/nota/"+idNota+"-"+res.data;	
						
					
				} else {
					console.log("res.error 108");
				}
		}).fail(function(){
				console.log("fail redirigir al crear titulo");		
		}); 
		
	}
	/*********************************************************************/
	
	$('#col-izq').on("click", ".row.loultimo" , function(e) {
		e.preventDefault(); 
		var imgSrc = $(this).find("img").attr("src");
		var strSplitIni = imgSrc.split("//");
		var strSplitFin = strSplitIni[1].split("/");
		var idNota= strSplitFin[0];
		var titulo = $(this).find(".tit-lo-ultimo-2").text();
		redirigir(idNota,titulo);
		
	}); 
	
	
	/*********************************************************************/
	var getCarrusel_OLD= function(){
	$.get(URI.TEMPLATE_CARRUSEL, function(template_text){            			
            $.ajax({
            url : URI.GET_CARRUSEL_AMI,
            method : 'GET',
            dataType : 'json',
            data : {}
        }).done(function(res){		
		
				if(!res.error){	
										
					var context = {
						carrusels : res.data
					};
					
					var template = Handlebars.compile(template_text);
					
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					
					$('.slider').removeClass("hidden");
					
					$(".slides").append(html);	
				
					// Plugin initialization
					$('.slider').slider({
						height:400,
						full_width: true
					});					
					
				} else {
					
					$('.slider').addClass("hidden");
				}
		}).fail(function(){
				
				console.log("fail carrusel");		
				}); 
		});		
		
		
	}
	/*********************************************************************/
	var getCarrusel= function(){
	
		
	
		// Plugin initialization
		$('.slider').slider({
			height:400,
			full_width: true
		});					
		
	
		
		
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
	var showWhatsApp = function(){
		
		
		/*

			setTimeout(function() {
				$("#modalWhatsapp").openModal();
				
		}, 8000);
		$("#modalWhatsapp").closeModal();
		*/
		/*
		setInterval(function() {

			$("#modalWhatsapp").openModal();

			setTimeout(function() {
				$("#modalWhatsapp").closeModal();
			}, 5000);
		}, 25000);
		*/
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
	/*
	 getLoUltimo();
	 getCarrusel_OLD();
	 getMenusMedio();
	 */
	 
	 $('.slider').slider({
			height:400,
			full_width: true
	 });	 
	 setFloating();
	 if (!is_touch()){
		//getHeaderPubli();
		//getFooterPubli();
		handlePopup();
	 }
	 

	
	
});