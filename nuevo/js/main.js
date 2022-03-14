
(function ($) {
    "use strict";

	var URI = {};
    var $rootDir = $('#rootDir').val();
	
	URI.POST_SUBSCRIBE = $rootDir+"/actions/api-server.php?action=subscribe";
	URI.getLastNFromSubmenu = $rootDir+"/actions/api-nota.php?action=getLastNFromSubmenu";
	
    
	var printableRegex = /^[a-z0-9!"ñ\r\n#$%&'()*+,.\/:;<=>?@\[\] ^_`{|}~-]*$/i;
	var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i; 
	var lettersRegex = /^[a-zA-Z\s]*$/;
	
	/*==================================================================
    [ Load page ]*/
    try {
        $(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: '.animsition-link',
            loading: true,
            loadingParentElement: 'html',
            loadingClass: 'animsition-loading-1',
            loadingInner: '<div class="loader05"></div>',
            timeout: false,
            timeoutCountdown: 5000,
            onLoadEvent: true,
            browser: [ 'animation-duration', '-webkit-animation-duration'],
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'html',
            transition: function(url){ window.location.href = url; }
        });
    } catch(er) {console.log(er);}

    
    /*==================================================================
    [ Back to top ]*/
    try {
        var windowH = $(window).height()/2;

        $(window).on('scroll',function(){
            if ($(this).scrollTop() > windowH) {
                $("#myBtn").addClass('show-btn-back-to-top');
            } else {
                $("#myBtn").removeClass('show-btn-back-to-top');
            }
        });

        $('#myBtn').on("click", function(){
            $('html, body').animate({scrollTop: 0}, 300);
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Fixed menu ]*/
    try {
        var posNav = $('.wrap-main-nav').offset().top;
        var menuDesktop = $('.container-menu-desktop');
        var mainNav = $('.main-nav');
        var lastScrollTop = 0;
        var st = 0;
        
        $(window).on('scroll',function(){
            fixedHeader();     
        });
        
        $(window).on('resize',function(){ 
            fixedHeader();
        });

        $(window).on('load',function(){ 
            fixedHeader();
        });

        var fixedHeader = function() {
            st = $(window).scrollTop();

            if(st > posNav + mainNav.outerHeight()) {
                $(menuDesktop).addClass('fix-menu-desktop');
            } 
            else if(st <= posNav) {
                $(menuDesktop).removeClass('fix-menu-desktop');
            }   

            if (st > lastScrollTop){
                $(mainNav).removeClass('show-main-nav');
            } 
            else {
                $(mainNav).addClass('show-main-nav');
            }

            lastScrollTop = st;
        };
            
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Menu mobile ]*/
    try {
        $('.btn-show-menu-mobile').on('click', function(){
            $(this).toggleClass('is-active');
            $('.menu-mobile').slideToggle();
        });

        var arrowMainMenu = $('.arrow-main-menu-m');

        for(var i=0; i<arrowMainMenu.length; i++){
            $(arrowMainMenu[i]).on('click', function(){
                $(this).parent().find('.sub-menu-m').slideToggle();
                $(this).toggleClass('turn-arrow-main-menu-m');
            })
        }

        $(window).on('resize',function(){
            if($(window).width() >= 992){
                if($('.menu-mobile').css('display') === 'block') {
                    $('.menu-mobile').css('display','none');
                    $('.btn-show-menu-mobile').toggleClass('is-active');
                }

                $('.sub-menu-m').each(function(){
                    if($(this).css('display') === 'block') { 
                        $(this).css('display','none');
                        $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                    }
                });
                    
            }
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Respon tab01 ]*/
    try {
        $('.tab01').each(function(){
            var tab01 = $(this);
            var navTabs = $(this).find('.nav-tabs');
            var dropdownMenu = $(tab01).find('.nav-tabs>.nav-item-more .dropdown-menu');
            var navItem = $(tab01).find('.nav-tabs>.nav-item');

            var navItemSize = [];
            var size = 0;
            var wNavItemMore = 0;
            
            $(window).on('load', function(){
                navItem.each(function(){
                    size += $(this).width();
                    navItemSize.push(size);
                });

                responTab01();
            });
                
            $(window).on('resize', function(){
                responTab01();              
            })

            var responTab01 = function() {
                if(navTabs.width() <= navItemSize[navItemSize.length - 1] + 1) { 
                    $(tab01).find('.nav-tabs>.nav-item-more').removeClass('dis-none');
                }
                else {
                    $(tab01).find('.nav-tabs>.nav-item-more').addClass('dis-none');
                }

                wNavItemMore = $(tab01).find('.nav-tabs>.nav-item-more').hasClass('dis-none')? 0 : $(tab01).find('.nav-tabs>.nav-item-more').width();

                for(var i=0 ; i<navItemSize.length ; i++) {

                    if(navTabs.width() - wNavItemMore <= navItemSize[i] + 1) {
                        $(tab01).find('.nav-tabs .nav-item').remove();

                        for(var j=i-1 ; j >= 0 ; j--) {
                            $(navTabs).prepend($(navItem[j]).clone());
                        }

                        for(var j=i ; j < navItemSize.length ; j++) {
                            $(dropdownMenu).append($(navItem[j]).clone());
                        }

                        break;
                    }
                    else {
                        $(tab01).find('.nav-tabs .nav-item').remove();

                        for(var j=i ; j >= 0 ; j--) {
                            $(navTabs).prepend($(navItem[j]).clone());
                        }
                    }
                }
            };
        });
    } catch(er) {console.log(er);}
        

    /*==================================================================
    [ Play video 01 ]*/
    try {
        var srcOld = $('.video-mo-01').children('iframe').attr('src');

        $('[data-target="#modal-video-01"]').on('click',function(){
            $('.video-mo-01').children('iframe')[0].src += "&autoplay=1";

            setTimeout(function(){
                $('.video-mo-01').css('opacity','1');
            },300);      
        });

        $('[data-dismiss="modal"]').on('click',function(){
            $('.video-mo-01').children('iframe')[0].src = srcOld;
            $('.video-mo-01').css('opacity','0');
        });
    } catch(er) {console.log(er);}
   

    /*==================================================================
    [ Tab mega menu ]*/
    try {
        $(window).on('load', function(){
            $('.sub-mega-menu .nav-pills > a').hover(function() {
                $(this).tab('show');
            });
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Slide100 txt ]*/

    try {
        $('.slide100-txt').each(function(){
            var slideTxt = $(this);
            var itemSlideTxt = $(this).find('.slide100-txt-item'); 
            var data = [];
            var count = 0;
            var animIn = $(this).data('in');
            var animOut = $(this).data('out');

            for(var i=0; i<itemSlideTxt.length; i++) {
                data[i] = $(itemSlideTxt[i]).clone();
                $(data[i]).addClass('clone');
            }

            $(window).on('load', function(){
                $(slideTxt).find('.slide100-txt-item').remove();
                $(slideTxt).append($(data[0]).clone());
                $(slideTxt).find('.slide100-txt-item.clone').addClass(animIn + ' visible-true');
                count = 0;
            });
            
            setInterval(function(){
                $(slideTxt).find('.slide100-txt-item.ab-t-l.' + animOut).remove();
                $(slideTxt).find('.slide100-txt-item').addClass('ab-t-l ' + animOut);

                
                if(count >= data.length-1) {
                    count = 0;
                }
                else {
                    count++;
                }

                console.log($(data[count]).text());

                $(slideTxt).append($(data[count]).clone());
                $(slideTxt).find('.slide100-txt-item.clone').addClass(animIn + ' visible-true');
            },5000); 
        });
    } catch(er) {console.log(er);}
            
	/**************************************************************/
	var validField = function (fieldValue, config){
		
			switch (config){
				case "email":
				case "mail":				
					return (fieldValue.match(emailRegex)) ? true : false;						
				case "printable":
					return (fieldValue.match(printableRegex)) ? true : false;	
				case "text":
					return (fieldValue.match(lettersRegex)) ? true : false;	
			}
		return false;
	}
	/**************************************************************/
	$('#frm-subscribe').on("submit",function(e){
		e.preventDefault();
		var hasInvalid = false;
		if ( $('#input-subscribe').val().trim()==""  ||  !validField($('#input-subscribe').val().trim(),$('#input-subscribe').attr("type"))){
			$('#input-subscribe').addClass("invalid");
			hasInvalid = true;
		} 
		
	
		if (hasInvalid){
			alert("formato invalido");
			return;
		}
		
		var email =  $('#input-subscribe').val().trim();
		$.ajax({
			url : URI.POST_SUBSCRIBE,
			method : 'POST',
			dataType : 'json',				                		
			data : {email:email}					
		})
		.done(function(res){ 
			console.log(res);
			
			if(!res.error){																
				toastr.success('Gracias por contactarnos');
				$('#input-subscribe').val("");
			}else{	
					
				toastr.error(res.mensaje, 'Error');						
			}
													  
		})
		.fail(function(){
			toastr.error(res.mensaje, 'Error grave');						
			
		}); 
	});
	/**************************************************************/
	$('#btn-ver-mas').on("click",null,function(e){
		e.preventDefault();
		var offset = $('.notadom').length+4;
		console.log(offset);
		var qBuscar = 10;
		var idSubmenuVSLT = 2;
		
		$.ajax({
			url : URI.getLastNFromSubmenu,
			method : 'POST',
			dataType : 'json',				                		
			data : {submenu_id:idSubmenuVSLT, n: qBuscar, offset:offset}					
		})
		.done(function(res){ 
			console.log(res);
			var html = "";
			if(!res.error){																
				res.data.forEach(function($nota){
					html +='<div class="col-sm-6 p-r-25 p-r-15-sr991 notadom">';						
					html +='<div class="m-b-45">';
					html +='<a href="'+$rootDir+'/'+$nota["menu_titulo_ami"]+'/'+$nota["submenu_titulo_ami"]+'/'+$nota["id"]+'-'+$nota["titulo_ami"]+'" class="wrap-pic-w-osni hov1 trans-03">';									
					html +='			<img src="'+$rootDir+'/'+$nota["pathFoto"]+$nota["id"]+'/'+$nota["filenameFoto"]+'" alt="IMG">';
					html +='		</a>';

					html +='		<div class="p-t-16">';
					html +='			<h5 class="p-b-5">';
					html +='				<a href="'+$rootDir+'/'+$nota["menu_titulo_ami"]+'/'+$nota["submenu_titulo_ami"]+'/'+$nota["id"]+'-'+$nota["titulo_ami"]+'" class="f1-m-3 cl2 hov-cl10 trans-03">';
					html +='					'+$nota["titulo"]+'';
					html +='				</a>';
					html +='			</h5>';

					html +='			<span class="cl8">';
					html +='				<a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">';
					html +='					'+$nota["autor"]+'';
					html +='				</a>';

					html +='				<span class="f1-s-3 m-rl-3">';
										
					html +='				</span>';

					html +='				<span class="f1-s-3">';
					html +='					'+$nota["fechaNota"]+'';
					html +='				</span>';
					html +='			</span>';
					html +='		</div>';
					html +='	</div>';
					html +='</div>';
				});
				$('#masnotas-container').append(html);
			}else{	
					
				toastr.error(res.mensaje, 'Error');						
			}
													  
		})
		.fail(function(){
			toastr.error(res.mensaje, 'Error grave');						
			
		}); 
		
	});
	
	/**************************************************************/
})(jQuery);