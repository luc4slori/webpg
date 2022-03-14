(function($){
		var user_id= $('input[name="user_id"]').val();
		
		$('#btn-publish').on("click",null,function(e){
		e.preventDefault();
		
		
		if (user_id==999999){			
			$(this).attr('href',"#modal-login");	
			$('html, body').stop().animate({
				scrollTop: 0
            }, 500, 'linear');
        } else {			
			alert('insertar comentario');
		}
		
	
	});

	var checkUserActive = function(){
		if (user_id==999999){
			$('#btn-publish').addClass('modal-trigger');
		}
		else {
			$('#btn-publish').removeClass('modal-trigger');
		}
	}
	
	checkUserActive();
	
	
})(jQuery);