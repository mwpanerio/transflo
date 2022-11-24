var FX = ( function( FX, $ ) {

	$( () => {
		FX.HomepageAnimation.init();
        FX.ProductSlider.init()
        FX.ImageButtonAnimation.init();
        FX.BlogSlider.init();
        FX.ImageOverlay.init();
	})

	FX.HomepageAnimation = {

		init() {
            const $loaderTextParent = $('.js-loader-text-parent');
            const $loaderTextInner = $('.js-loader-text-inner')
            const $loaderTextItem = $loaderTextParent.find('.js-loader-text');
            const $loaderBackground = $('.js-loader-background');
            const $loaderTextAnimation = new TimelineMax();

            const controller = new ScrollMagic.Controller();

            $loaderTextItem.each(function(e) {
                const $this = $(this);

                $loaderTextAnimation.add(
                    new TimelineMax()
                        .to($loaderTextInner, 0.6, {
                            'margin-top' : e * (-92) + 'px',
                            ease: Power4.easeOut
                        })
                )
            })

            $loaderTextAnimation.add(
                new TimelineMax()    
                    .staggerTo('.loader__squares span', 1, {
                        rotate : 45,
                        opacity: 1,
                        ease: Power4.easeOut
                    }, 0.1), '-=0.5'
            )

            $loaderTextAnimation.add(
                new TimelineMax()
                    .to('.js-loader-text-logo', 1, {
                        'transform' : 'translateY(-92px)',
                        ease: Power4.easeOut
                    })
            )

            if($(window).outerWidth() >= 768) {
                $loaderTextAnimation.add(
                    new TimelineMax()
                        .staggerTo('.loader__squares span', 1, {
                            rotate: 0,
                            opacity: 0,
                            ease: Power4.easeOut
                        }, -0.1)
                        .to(".loader__boxes", {
                            duration: 0.8,
                            scale: 0, 
                            ease: "power4.easeInOut",
                            onComplete: function() {
                                $('.loader').fadeOut();
                            },
                            stagger: {
                                amount: 0.5, 
                                grid: 'auto', 
                                axis: null, 
                                ease: Power4.easeInOut,
                                from: 'center'
                            }
                        }, '-=0.8'), '-=0.85'
                )
            } else {
                $loaderTextAnimation.add(
                    new TimelineMax()
                        .staggerTo('.loader__squares span', 0.6, {
                            rotate: 0,
                            opacity: 0,
                            ease: Power4.easeOut
                        }, -0.05, '-=1')
                        .staggerTo(".loader__boxes:not(.hidden-xs-down)", 0.6, {
                            opacity: 0,
                            scale: 0,
                            onComplete: function() {
                                $('.loader').fadeOut();
                            },
                        }, 0.0015, '-=0.6')
                )
            }

            $loaderTextAnimation.add(
                new TimelineMax()
                    .staggerTo(".js-masthead-column-item", 1.4, {
                        'transform' : 'translate(0, 0)',
                        'opacity': 1,
                        ease: Power4.easeOut
                    }, 0.05)
                    .to(".page-header", 1, {
                        'transform' : 'translate(0, 0)',
                        'opacity': 1,
                        ease: Power4.easeOut
                    }, '-=1.45'), '-=0.5'
            )

            $('.counter-block').each(function() {
                const $this = $(this);
                const $item = $this.find('.counter-bttn');

                const counterBlockTimeline = new TimelineMax();
                    counterBlockTimeline
                        .staggerTo($item, 0.6, {
                            opacity: 1,
                            'transform': 'translate(0, 0)'
                        }, 0.15)

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.85
                })
                .setTween(counterBlockTimeline)
                .addTo(controller);
            })
		},
	}

    FX.ProductSlider = {
        init() {
            const $productSlider = $('.js-products-slider');
            const controller = new ScrollMagic.Controller();

            $productSlider.each(function() {
                const $this = $(this);
                const $productSliderItem = $this.find('.products-items');

                const productSliderTimeline = new TimelineMax();
                    productSliderTimeline
                        .staggerTo($productSliderItem, 0.6, {
                            opacity: 1,
                            'transform': 'translate(50px, 0) scale(1)',
                            'filter' : 'blur(0px)'
                        }, 0.15)
                        .staggerTo($productSliderItem, 0.6, {
                            'transform': 'translate(0, 0) scale(1)',
                        }, 0.15, '-=1.25')

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.85
                })
                .setTween(productSliderTimeline)
                .addTo(controller);
            })
        }
    }

    FX.ImageButtonAnimation = {
        init() {
            const $imageButton = $('.image-buttons');
            const controller = new ScrollMagic.Controller();

            $imageButton.each(function() {
                const $this = $(this);
                const $imageButtonItem = $this.find('.image-button-item');

                const imageButtonTimeline = new TimelineMax()
                    .staggerTo($imageButtonItem, 1, {
                        scale: 1, 
                        opacity: 1,
                        ease: Power4.easeInOut,
                    }, 0.15)
                        

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.75
                })
                .setTween(imageButtonTimeline)
                .addTo(controller);
            })
        }
    }

    FX.BlogSlider = {
        init() {
            const $blogCardSlider = $('.js-cards-slider');
            const controller = new ScrollMagic.Controller();

            $blogCardSlider.each(function() {
                const $this = $(this);
                const $blogCardSliderItem = $this.find('.card--link');

                const blogCardSliderTimeline = new TimelineMax();
                    blogCardSliderTimeline
                        .staggerTo($blogCardSliderItem, 0.6, {
                            opacity: 1,
                            'left' : 0,
                            'filter' : 'blur(0px)'
                        }, 0.15)

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.85
                })
                .setTween(blogCardSliderTimeline)
                .addTo(controller);
            })
        }
    }

    FX.ImageOverlay = {
        init() {
            const $imageOverlayWrap = $('.image-overlay-text__wrap');
            const controller = new ScrollMagic.Controller();

            $imageOverlayWrap.each(function() {
                const $this = $(this);
                const $imageOverlayImage = $this.find('.image-overlay-image');
                const $imageOverlayContent = $this.find('.image-overlay-text__content');

                const imageOverlayWrapTimeline = new TimelineMax();
                    imageOverlayWrapTimeline
                        .to($imageOverlayImage, 1.2, {
                            opacity: 1,
                            'transform' : 'translate(0)',
                            ease: Power4.easeInOut
                        })
                        .to($imageOverlayContent, 1.2, {
                            opacity: 1,
                            'transform' : 'translate(0)',
                            ease: Power4.easeInOut
                        }, '-=1')

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.85
                })
                .setTween(imageOverlayWrapTimeline)
                .addTo(controller);
            })
        }
    }

	return FX

} ( FX || {}, jQuery ) )

