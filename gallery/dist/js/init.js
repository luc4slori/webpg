$(function(){
	 var URI = {};
    
	URI.GET_AllAllgallery = "actions/api-gallery.php?action=listarAllAll";
	URI.GET_TEMPLATE_Gallery = "templates/listado-gallery.html";
	
   
	/************************************************************************/
	
	var getGallerys = function(){
		
		$.get(URI.GET_TEMPLATE_Gallery, function(template_text){
	 
		    $.ajax({
		    url : URI.GET_AllAllgallery,
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
					var html = template(context);			
					
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
	
	
	 
	/************************************************************************/
	
	var init=function(){
		
		getGallerys();
		
		
	}
	
	
	
	 /*********************************************************************/

	init();
	
			

});








 