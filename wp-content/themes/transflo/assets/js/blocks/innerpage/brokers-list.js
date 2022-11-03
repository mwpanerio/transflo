var FX = ( function( FX, $ ) {

	$( () => {
		FX.BrokersListScript.init()
	})

	FX.BrokersListScript = {
		init() {
            const $modalClose = $('.brokers-list__modal__close');
            const $modalContainer = $('.brokers-list__modal');
            const $modalButton = $('.js-broker-list-button');

            $modalButton.on('click', function() {
                const $this = $(this);
                const $modalTarget = $this.attr('data-modal-target');
                const $modalTargetElement = $($modalTarget);

                $modalContainer.fadeIn(function() {
                    $modalTargetElement.stop().slideDown();
                });
            })

            $modalClose.on('click', function() {
                const $this = $(this);
                const $thisModalWrapper = $this.parents('.brokers-list__modal__container');

                $thisModalWrapper.stop().slideUp(function() {
                    $modalContainer.fadeOut();
                });
            })
		},
	}

	return FX

} ( FX || {}, jQuery ) )

