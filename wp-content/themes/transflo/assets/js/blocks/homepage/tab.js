var FX = ( function( FX, $ ) {

	$( () => {
		FX.Testimonials.init()
	})

	FX.Testimonials = {
		$slider: null,

		init() {
			$('.js-tab-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: false,
				fade: true,
				autoplay: true,
				autoplaySpeed: 2000,
				asNavFor: '.js-tab-menu'
			});

			$('.js-tab-menu').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.js-tab-for',
				dots: false,
				arrows: false,
				focusOnSelect: true,
				responsive: [
					{
					  breakpoint: 768,
					  settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						variableWidth: true,
					  }
					}
				]
			});
		},
	}

	return FX

} ( FX || {}, jQuery ) )

