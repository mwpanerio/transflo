var FX = ( function( FX, $ ) {

	$( () => {
		FX.BenefitsSectionSlider.init()
	})

	FX.BenefitsSectionSlider = {
		$slider: null,

		init() {
			$('.js-benefits-slider').each(function() {
				const $this = $(this);

				$this.slick( {
					infinite: false,
					speed: 700,
					slidesToShow: 3,
					slidesToScroll: 1,
					responsive: [
						{
							breakpoint: 9999,
							settings: "unslick"
						},
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
				})
			})
		},
	}

	return FX

} ( FX || {}, jQuery ) )

