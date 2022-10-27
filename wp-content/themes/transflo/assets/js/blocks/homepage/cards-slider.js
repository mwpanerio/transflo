var FX = ( function( FX, $ ) {

	$( () => {
		FX.CardsSlider.init()
	})

	FX.CardsSlider = {
		$slider: null,

		init() {
			this.$slider = $('.js-cards-slider')

			if( this.$slider.length ) {
				this.applySlick()
			}

			this.$slider.on('beforeChange', function() {
				$('.js-cards-slider').addClass('is-animating');
			})

			this.$slider.on('afterChange', function() {
				$('.js-cards-slider').removeClass('is-animating');
			})
		},

		applySlick() {
            this.$slider.slick( {
				infinite: false,
				speed: 700,
				slidesToShow: 3,
				slidesToScroll: 1,
                responsive: [

					{
						breakpoint: 1200,
						settings: {
							infinite: true,
							slidesToShow: 2,
							slidesToScroll: 1,
							arrows: true
						}
					},

                    {
						breakpoint: 768,
						settings: {
							infinite: true,
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: true
						}
					},

                ]
            });
 
		}
	}

	return FX

} ( FX || {}, jQuery ) )

