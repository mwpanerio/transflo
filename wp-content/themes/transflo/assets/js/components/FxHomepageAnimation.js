var FX = ( function( FX, $ ) {

	$( () => {
		FX.HomepageAnimation.init()
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
                        'transform' : 'rotate(45deg)',
                        'opacity' : 1,
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

            $loaderTextAnimation.add(
                new TimelineMax()    
                    .staggerTo('.loader__squares span', 1, {
                        'transform' : 'rotate(0)',
                        'opacity' : 0,
                        ease: Power4.easeOut
                    }, -0.1), '-=0.8'
            )

            $loaderTextAnimation.add(
                new TimelineMax()
                    .to(".loader__boxes", {
                        duration: 0.8,
                        scale: 0, 
                        ease: "power4.easeInOut",
                        onComplete: function() {
                            $('.loader').hide();
                        },
                        stagger: {
                            amount: 0.5, 
                            grid: 'auto', 
                            axis: null, 
                            ease: Power4.easeInOut,
                            from: 'center'
                        }
                    }), '-=0.85'
            )

            $loaderTextAnimation.add(
                new TimelineMax()
                    .staggerTo(".js-masthead-column-item", 1.4, {
                        'transform' : 'translate(0, 0)',
                        'opacity': 1,
                        ease: Power4.easeOut
                    }, 0.05), '-=0.5'
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

	return FX

} ( FX || {}, jQuery ) )

