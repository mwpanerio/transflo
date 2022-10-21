var FX = ( function( FX, $ ) {


	$( () => {
		FX.HomepageCounter.init()
	})


	FX.HomepageCounter = {

		init() {
			
			function custom_count(){
				var flag = true;
				$('.number-counter-section').each(function() {
					if ($(this).isInViewport()) {   // Here we check perticular section is in the viewport or number-counter-section
						if (flag) {
							/* FOR number counter(odometer)  */
							var arr = [],
							i = 0;
							$('.odometer').each(function() {
								arr[i++] = $(this).attr('data-count');;
								// odometer.innerText = arr[0]; //here odometer is *id* of first number
								// odometer1.innerText = arr[1];
								// odometer2.innerText = arr[2];
								// odometer3.innerText = arr[3]; 
								// odometer4.innerText = arr[4]; 
								// odometer5.innerText = arr[5]; 
							});
							flag = false;
						}
					} else {}
				});
			}
			
			// for check the section in view port or not;
			$.fn.isInViewport = function() {
				var elementTop = $(this).offset().top;
				var elementBottom = elementTop + $(this).outerHeight();
			
				var viewportTop = $(window).scrollTop();
				var viewportBottom = viewportTop + $(window).height();
			
				return elementBottom > viewportTop && elementTop < viewportBottom;
				console.log(elementBottom > viewportTop && elementTop < viewportBottom);
			};
			
			
			
				//  odometer section is on view-port or not
				custom_count();
				//resize-function
				$(window).resize(function() {
					custom_count();
				});
				
				$(window).on("scroll",function(){
				  custom_count();
				});
			


		}
	}

	

	return FX

} ( FX || {}, jQuery ) )