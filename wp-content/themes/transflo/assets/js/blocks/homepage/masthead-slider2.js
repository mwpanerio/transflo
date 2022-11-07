var FX = ( function( FX, $ ) {

	$( () => {
		FX.MastheadSlider2.init()
		FX.MastheadSlider2.animation()
	})

	FX.MastheadSlider2 = {
		$slider: null,

		init() {
			this.$slider = $('.js-masthead__slider2')

			if( this.$slider.length ) {
				this.applySlick()
			}
		},

		applySlick() {

			$('.js-masthead__slider2').on('init', function() {
				const $prevText = $('.js-masthead__slider2').find('.slick-active').prev().text();
				const $nextText = $('.js-masthead__slider2').find('.slick-active').next().text();

				$('.slider-nav__prev').text($prevText);
				$('.slider-nav__next').text($nextText);
			})

            this.$slider.slick( {
				infinite: true,
				speed: 600,
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
						  slidesToShow: 2,
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

			this.$slider.on('beforeChange', function() {
				$('.js-masthead__slider2').addClass('is-animating');

				$('.slider-nav__prev').slideUp();
				$('.slider-nav__next').slideUp();
			})

			this.$slider.on('afterChange', function() {
				const $prevText = $('.js-masthead__slider2').find('.slick-active').prev().text();
				const $nextText = $('.js-masthead__slider2').find('.slick-active').next().text();
				$('.js-masthead__slider2').removeClass('is-animating');

				$('.slider-nav__prev').text($prevText).slideDown();
				$('.slider-nav__next').text($nextText).slideDown();
			})

			var $slider = $('.js-masthead__slider2');
			var $progressBar = $('.progress-1');
			var $progressBarLabel = $( '.slider__label' );
			
			$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {   
				var calc = ( (nextSlide) / (slick.slideCount-1) ) * 100;
				
				$progressBar
				.css('background-size', calc + '% 100%')
				.attr('aria-valuenow', calc );
				
				$progressBarLabel.text( calc + '% completed' );
  			});

			$('.js-masthead-tiles').on('mouseenter mouseleave', hoverDirection);

			function hoverDirection(event) {
				var $overlay = $(this).find('.masthead__tiles__image > span'),
					side = getMouseDirection(event),
					animateTo,
					positionIn = {
						top: '0%',
						left: '0%'
					},
					positionOut = (function() {
						switch(side) {
						case 0:  return { top: '-100%', left:    '0%' }; break;
						case 1:  return { top:    '0%', left:  '100%' }; break;
						case 2:  return { top:  '100%', left:    '0%' }; break;
						default: return { top:    '0%', left: '-100%' }; break;
						}
					})();
				if ( event.type === 'mouseenter' ) {
					animateTo = positionIn;
					$overlay.css(positionOut);
				} else {
					animateTo = positionOut;
				}
				$overlay.stop(true).animate(animateTo, 200, 'linear');
			}
			
			function getMouseDirection(event) {
				var $item = $(event.currentTarget),
					offset = $item.offset(),
					w = $item.outerWidth(),
					h = $item.outerHeight(),
					x = (event.pageX - offset.left - w / 2) * ((w > h) ? h / w: 1),
					y = (event.pageY - offset.top - h / 2) * ((h > w) ? w / h: 1),
					direction = Math.round((Math.atan2(y, x) * (180 / Math.PI) + 180) / 90  + 3) % 4;
				return direction;
			}
 
		},

		animation() {
			const $thisTimelineMax = new TimelineMax({ paused : true });
			
			$thisTimelineMax
				.to('#js-masthead-tile-popup .image-buttons__popup__image', 0.6, {
					'transform' : 'scaleY(1)',
					ease: Power4.easeInOut
				})
				.to('#js-masthead-tile-popup .image-buttons__popup__image > span', 0.6, {
					'transform' : 'scaleY(0)',
					ease: Power4.easeInOut
				}, '-=0.25')
				.to('#js-masthead-tile-popup .image-buttons__popup__info h3', 0.6, {
					'transform' : 'translateY(0)',
					opacity: 1,
					ease: Power4.easeInOut
				}, '-=0.55')
				.to('#js-masthead-tile-popup .image-buttons__popup__description', 0.6, {
					'transform' : 'translateY(0)',
					opacity: 1,
					ease: Power4.easeInOut
				}, '-=0.55')

			$('.js-masthead-tiles').on('click', function() {
				const $this = $(this);
				const $thisImage = $this.find('.image-buttons__popup__image img').attr('src');
				const $thisInfoTitle = $this.find('.image-buttons__popup__info h3').text();
				const $thisInfoDescription = $this.find('.image-buttons__popup__description p').html();

				$('#js-masthead-tile-popup').find('.image-buttons__popup__image img').attr('src', $thisImage);
				$('#js-masthead-tile-popup').find('.image-buttons__popup__info h3 span').text($thisInfoTitle);
				$('#js-masthead-tile-popup').find('.image-buttons__popup__description').html($thisInfoDescription);

				$thisTimelineMax.progress(0).play();
				$('#js-masthead-tile-popup').stop().slideDown();
			})

			$('#js-masthead-tile-popup .popup-cross').on('click', function () {
				const $this = $(this);

				$('#js-masthead-tile-popup').stop().slideUp(function() {
					$thisTimelineMax.progress(0).reverse()
					$('#js-masthead-tile-popup .image-buttons__popup__image').removeAttr('style')
					$('#js-masthead-tile-popup .image-buttons__popup__image span').removeAttr('style')
					$('#js-masthead-tile-popup .image-buttons__popup__image img').removeAttr('style')
					$('#js-masthead-tile-popup .image-buttons__popup__info h3').removeAttr('style')
					$('#js-masthead-tile-popup .image-buttons__popup__info p').removeAttr('style')
				});
			})
		}
	}

	return FX

} ( FX || {}, jQuery ) )

