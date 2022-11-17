var FX = ( function( FX, $ ) {

    $( () => {
        FX.TeamBlock.init()
    })

    FX.TeamBlock = {
        $slider: null,

        init() {
            $('.js-team-card').on('mouseenter', function() {
                const $this = $(this);
            
                $('.js-team-card').not($this).addClass('is-not-focused');
                $this.addClass('is-focused');
            })
            
            $('.js-team-card').on('mouseleave', function() {
                const $this = $(this);
            
                $('.js-team-card').not($this).removeClass('is-not-focused');
                $this.removeClass('is-focused');
            })

            $('.js-team-card').on('click', function() {
                const $this = $(this);
                const $thisTarget = $($this.attr('data-modal-target'));

                $thisTarget.slideDown();
            })

            $('.js-team-modal-close').on('click', function() {
                $('.js-team-modal').slideUp();
            })

            const options = {
                damping: 0.04,
                thumbMinSize: 20,
                renderByPixel: true,
                continuousScrolling: false
            };


            $('.team-block__modal__content__inner').each(function() {
                const $this = $(this);

                Scrollbar.init($this[0], options);
            })
        },
    }

    return FX

} ( FX || {}, jQuery ) )