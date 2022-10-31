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
							$(this).find('.odometer').each(function() {
								arr[i++] = $(this).attr('data-count');
								$(this).html($(this).attr('data-count'));
							});
							flag = false;
						}
					} else {}
				});
			}
			
			// for check the section in view port or not;
			$.fn.isInViewport = function() {
				var elementTop = $(this).offset().top * 0.9;
				var elementBottom = elementTop + $(this).outerHeight();
			
				var viewportTop = $(window).scrollTop();
				var viewportBottom = viewportTop + $(window).height();
			
				return elementBottom > viewportTop && elementTop < viewportBottom;
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