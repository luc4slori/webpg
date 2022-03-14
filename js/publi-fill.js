$(function(){

    
    var URI = {};
	URI.GET_DERE_PUBLI = "actions/api-publi.php?action=listarAllAll";
	URI.TEMPLATE_DERE_PUBLI= "templates/listado-derecha-publi.html";
	
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
					//console.log(res.data);
						var context = {
						publis : res.data
					};
					
					var template = Handlebars.compile(template_text);
					var html = template(context).split('href="/').join('href="'+$rootDir+'/');	
						html = html.split('src="/').join('src="'+$rootDir+'/');html = html.split('data="/').join('data="'+$rootDir+'/');html = html.split('url("/').join('url("'+$rootDir+'/');html = html.split("url('/").join("url('"+$rootDir+'/');
					$('#publi-derecha').html(html);									
					setFloating();
					
					
				} else {
					console.log("res.error");
				}
		}).fail(function(){
				console.log("error select lo ultimo");		
				}); 
		});		
		
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
	      $('.toc-wrapper').pushpin({	  
			top: navh,
			bottom: colizqh			  
		  });	  
		  
	};
	 /*********************************************************************/
	getPublisDer();
	
	
});