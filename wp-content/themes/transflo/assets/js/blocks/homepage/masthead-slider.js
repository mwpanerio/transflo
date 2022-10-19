var FX = ( function( FX, $ ) {

	$( () => {
		FX.MastheadSlider.init()
	})

	FX.MastheadSlider = {
		$slider: null,

		init() {
			this.$slider = $('.js-masthead__slider')

			if( this.$slider.length ) {
				this.applySlick()
			}
		},

		applySlick() {
            this.$slider.slick( {
				infinite: true,
				speed: 300,
				slidesToShow: 1,
				slidesToScroll: 1,
				centerMode: true,
				centerPadding: '40px',
				responsive: [

					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							centerMode: true,
							centerPadding: '90px',
							arrows: false
						}
					},
					{
						breakpoint: 1024,
						settings: {
						  slidesToShow: 1,
						  slidesToScroll: 1,
						  centerMode: true,
						  centerPadding: '32px',
						  arrows: false
						}
					  },

					{
					  breakpoint: 768,
					  settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						centerMode: true,
						centerPadding: '40px',
						arrows: false
					  }
					}
				]
            });

			var $slider = $('.js-masthead__slider');
			var $progressBar = $('.progress');
			var $progressBarLabel = $( '.slider__label' );
			
			$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {   
				var calc = ( (nextSlide) / (slick.slideCount-1) ) * 100;
				
				$progressBar
				.css('background-size', calc + '% 100%')
				.attr('aria-valuenow', calc );
				
				$progressBarLabel.text( calc + '% completed' );
  			});
 
		}
	}

	return FX

} ( FX || {}, jQuery ) )

