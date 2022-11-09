var FX = ( function( FX, $ ) {

	$( () => {
		FX.AccordionBlockScript.init()
	})

	FX.AccordionBlockScript = {
		init() {
            const $accordionHeadline = $('.js-accordion-headline');
            const $accordionContent= $('.js-accordion-content');
            
            $accordionHeadline.on('click', function() {
                const $this = $(this);
                const $thisContent = $this.next('.js-accordion-content');

                if($this.hasClass('is-active')) {
                    $this.removeClass('is-active');
                    $accordionContent.stop().slideUp();
                    $thisContent.stop().slideUp();
                } else {
                    $accordionHeadline.removeClass('is-active');
                    $this.addClass('is-active');
                    $accordionContent.stop().slideUp();
                    $thisContent.stop().slideDown();
                }
            })
		},
	}

	return FX

} ( FX || {}, jQuery ) )

