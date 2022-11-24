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
				const $sliderWidth =  $this.find('.benefits-section__item').length > $slidesToShow;

				$this.slick( {
					infinite: false,
					speed: 700,
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					variableWidth: $sliderWidth,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								infinite: false,
								slidesToShow: 2,
								slidesToScroll: 1,
								variableWidth: false,
								arrows: true
							}
						},
	
						{
							breakpoint: 768,
							settings: {
								infinite: false,
								slidesToShow: 1,
								slidesToScroll: 1,
								variableWidth: false,
								arrows: true,
								adaptiveHeight: false,
							}
						},
	
					]
				})

				$this.on('beforeChange', function(event, slick, currentSlide, nextSlide) {   
					let calc = ( (nextSlide) / (slick.slideCount-1) ) * 100;
					const $progressBar = $this.next('.benefits-section-progress');
					
				$progressBar
					.css('background-size', calc + '% 100%')
					.attr('aria-valuenow', calc );
				});
			})
		},
	}

	return FX

} ( FX || {}, jQuery ) )

