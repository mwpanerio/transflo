var FX = ( function( FX, $ ) {

	$( () => {
		FX.FormsBlockScript.init()
	})

	FX.FormsBlockScript = {
		init() {
			const $formDemoButton = $('.js-form-demo');
			const $formDemoClose = $('.form-block__demo__modal__close');

			$formDemoButton.on('click', function(e) {
				e.preventDefault();
				const $this = $(this);
				const $thisTarget = $this.attr('href');
				const $thisTargetElement = $($thisTarget);

				$this.toggleClass('is-active');
				$thisTargetElement.stop().fadeIn();
			})

			$formDemoClose.on('click', function() {
				const $this = $(this);
				const $thisParent = $this.parents('.form-block__demo__modal');
				
				$thisParent.stop().fadeOut();
			})

			$(document).mouseup(function(e) {
                const container = $(".form-block__demo__modal__inner");

                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    $('.form-block__demo__modal:visible').stop().fadeOut();
                }
            });
		},
	}

	return FX

} ( FX || {}, jQuery ) )

