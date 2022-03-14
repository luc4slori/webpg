(function ($) {
    "use strict";

	var URI = {};
    var $rootDir = $('#rootDir').val();
	var $searcherDir = $('#searcherDir').val();
	
	
	URI.POST_SUBSCRIBE = $rootDir+"/actions/api-server.php?action=subscribe";
	URI.getFromQuery = $rootDir+"/actions/api-nota.php?action=getFromQuery";	
	/**************************************************************/
	$('#frm-search').on("submit",null,function(e){
		e.preventDefault();
		$('.h2-error').addClass("hidden");
		$('.h2-resultados').addClass("hidden");
		$('#row-results').html("");
		var $searchQuery = $('#search-query').val();
		if ($searchQuery.length<3){
			$('.h2-error').removeClass("hidden");
			return;
		}
		
		
		
		$.ajax({
			url : URI.getFromQuery,
			method : 'POST',
			dataType : 'json',				                		
			data : {searchQuery:$searchQuery}					
		})
		.done(function(res){ 
			console.log(res);
			var html = "";
			if(!res.error){
				$('.h2-resultados').removeClass("hidden");
				$('.q-resultados').text(res.data.length);
				res.data.forEach(function($nota){
					html +='<div class="col-6 p-b-5">';
					html +='	<div class=" m-b-30">';
					html +='		<a href="'+$rootDir+'/'+$nota["menu_titulo_ami"]+'/'+$nota["submenu_titulo_ami"]+'/'+$nota["id"]+'-'+$nota["titulo_ami"]+'">';
					html +='			<img style="width:100%" src="'+$rootDir+'/'+$nota["pathFoto"]+$nota["id"]+'/'+$nota["filenameFoto"]+'" alt="IMG">';
					html +='		</a>';
					html +='	</div>';
					html +='</div>';
					html +='<div class="col-6 p-b-5">';
					html +='	<div class=" m-b-30">';
					html +='		<div class="size-w-2">';
					html +='			<h5 class="p-b-5">';
					html +='				<a href="'+$rootDir+'/'+$nota["menu_titulo_ami"]+'/'+$nota["submenu_titulo_ami"]+'/'+$nota["id"]+'-'+$nota["titulo_ami"]+'" class="f1-s-5 cl3 hov-cl10 trans-03">';
					html +='					'+$nota["titulo"]+'';
					html +='				</a>';
					html +='			</h5>';

					html +='			<span class="cl8">';
					html +='				<a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">';
					html +='					'+$nota["submenu_titulo"]+'';
					html +='				</a>';

					html +='				<span class="f1-s-3 m-rl-3">';
					html +='					-';
					html +='				</span>';

					html +='				<span class="f1-s-3">';
					html +='					'+$nota["fechaNota"]+'';
					html +='				</span>';
					html +='			</span>';
					html +='		</div>';
					html +='	</div>';
					html +='</div>';
				});
				$('#row-results').html(html);
			}else{	
				$('.h2-resultados').removeClass("hidden");
				$('.q-resultados').text(0);	
			
			}
	
		})
		.fail(function(){
			toastr.error(res.mensaje, 'Error grave');						
			
		}); 
	});
	/**************************************************************/
	
})(jQuery);