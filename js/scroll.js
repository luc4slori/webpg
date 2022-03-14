/*(function($){
	$('a.scroll').click(function(e){
		e.preventDefault();	
		var href = $(this).attr('href');		
		$('html, body').stop().animate({scrollTop: $(href).offset().top-30}, 500);		
	});
})(jQuery)
*/
$('html').css({display: 'none'});
(function($){
	var smoothScrollTo = function(anchor) {
				var duration = 400; //time (milliseconds) it takes to reach anchor point
				var targetY = $(anchor).offset().top-40;
				//console.log(targetY);
				var urlActual = window.location.href.toString().split(window.location.host)[1];
			
				if ($('#user_id_user_nota').length || $('#submenu_id_user_submenu').length || $('#menu_id_user_menu').length) {
					targetY=120;
				}
				$("html, body").animate({
					"scrollTop" : targetY
				}, duration, 'easeInOutCubic');
			}
	var displayit = function () {
				var hashURL = location.hash;
				if(hashURL != '' && hashURL.length > 1){
					$('html, body').scrollTop(0);
					$('html').css({display: 'block'});
					smoothScrollTo(hashURL);
				} else {
					$('html').css({display: 'block'});
				}
	}
	

	$('a[href^="#"]').bind('click', function(event){
		var anchor = $(this).attr('href');
		smoothScrollTo(anchor);
		return false;
	});
	
    
    $('#back-to-top').css("display","none");
    
    $(window).scroll(function() {
      
        
        
		var navTam = $('#nav-ppal').height();
		
		
		
		
		if ($(this).scrollTop()>navTam) {
			$('#back-to-top:hidden').stop(true, true).fadeIn();
			} else {
				$('#back-to-top').stop(true, true).fadeOut();
			}
	});
    
     $('#back-to-top').click(function(e){
        e.preventDefault();
       $('html, body').stop().animate({
            scrollTop: 0
            }, 500, 'linear');
            return false;
     });
    
    
	displayit();
	
})(jQuery)