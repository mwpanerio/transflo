var FX = ( function( FX, $ ) {

	$( () => {
		FX.TabBlockScript.init()
	})

	FX.TabBlockScript = {
		$slider: null,

		init() {

			$('.js-simple-tab-menu .tab-menu-item').each(function() {
				const $this = $(this);

				if($(window).outerWidth() >= 768) {
					$this.on('click', function() {
						const $this = $(this);
						const $tabMenuParent = $this.parents('.js-simple-tab-menu');
						const $tabFor = $tabMenuParent.next('.js-simple-tab-for');
						const $index = +($this.parents('.slick-slide').attr('data-slick-index'));

						$tabFor.slick('slickGoTo', $index);
					})
				}
			})

			$('.js-simple-tab-for').slick({
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
						asNavFor: '.js-simple-tab-menu',
						adaptiveHeight: true
					  }
					}
				]
			});

			$('.js-simple-tab-menu').slick({
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
						asNavFor: '.js-simple-tab-for',
						autoplay: false,
						autoplaySpeed: 2000,
						slidesToShow: 1,
						slidesToScroll: 1,
						variableWidth: true,
					  }
					}
				]
			});

			$('.js-simple-tab-menu').find(`.slick-slide[data-slick-index=0]`).addClass('is-current');

			$('.js-simple-tab-for').each(function() {
				const $this = $(this);

				$this.on('afterChange', function(slick, currentSlide) {
					const $this = $(this);
					const $index = +($this.find('.slick-active').attr('data-slick-index'));
	
					if($(window).outerWidth() >= 768) {
						$this.prev('.js-simple-tab-menu').find('.slick-slide').removeClass('is-current');
	
						$this.prev('.js-simple-tab-menu').find('.slick-slide').each(function() {
							const $this = $(this);
							const $parentIndex = $this.attr('data-slick-index');
	
							if(+($parentIndex) == $index) {
								$this.addClass('is-current');
							}
						})
					}
				})
			})
		},
	}

	return FX

} ( FX || {}, jQuery ) )

