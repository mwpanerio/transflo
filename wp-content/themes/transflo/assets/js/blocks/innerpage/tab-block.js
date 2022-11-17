var FX = ( function( FX, $ ) {

	$( () => {
		FX.TabBlockScript.init()
	})

	FX.TabBlockScript = {
		$slider: null,

		init() {

			$('.js-tab-for').on('afterChange', function() {
				const $this = $(this);
				const $index = +($this.find('.slick-active').attr('data-slick-index'));

				if($(window).outerWidth() > 768) {
					$('.js-tab-menu').find('.slick-slide').removeClass('is-current');
					$('.js-tab-menu').find(`.slick-slide[data-slick-index=${$index}]`).addClass('is-current');
				}
			})

			$('.js-tab-menu .tab-menu-item').on('click', function() {
				const $this = $(this);
				const $index = +($this.parents('.slick-slide').attr('data-slick-index'));

				if($(window).outerWidth() > 768) {
					$('.js-tab-for').slick('slickGoTo', $index);
				}
			})
			
			$('.js-tab-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: false,
				fade: true,
				infinite: true,
				responsive: [
					{
					  breakpoint: 768,
					  settings: {
						autoplay: false,
						asNavFor: '.js-tab-menu',
					  }
					}
				]
			});

			$('.js-tab-menu').slick({
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,				
				dots: false,
				arrows: false,
				responsive: [
					{
					  breakpoint: 768,
					  settings: {
						focusOnSelect: true,
						asNavFor: '.js-tab-for',
						autoplay: true,
						autoplaySpeed: 2000,
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

