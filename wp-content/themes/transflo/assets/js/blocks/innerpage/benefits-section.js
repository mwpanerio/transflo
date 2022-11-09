var FX = ( function( FX, $ ) {

	$( () => {
		FX.BenefitsSectionSlider.init()
	})

	FX.BenefitsSectionSlider = {
		$slider: null,

		init() {
			$('.js-benefits-slider').each(function() {
				const $this = $(this);
				const $slidesToShow = parseFloat($this.attr('data-benefits-slider'));

				$this.slick( {
					infinite: false,
					speed: 700,
					slidesToShow: $slidesToShow,
					slidesToScroll: 1,
					arrows: true,
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
				})
			})
		},
	}

	return FX

} ( FX || {}, jQuery ) )

