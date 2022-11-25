var FX = ( function( FX, $ ) {

	$( () => {
		FX.TestimonialBlock.init()
	})

	FX.TestimonialBlock = {

		init() {
            $(".js-testimonial-post:hidden").slice(0, 9).slideDown();

            const  $total = $('.js-testimonial-post').length;
            const  $totalcount = $('.js-testimonial-post:visible').length;

            const $totality = $totalcount / $total;
            const $progwidth = $totality * 100;

            $('.testimonial-block__pagination__bar').width($progwidth + "%");

            if($(".js-testimonial-post:hidden").length == 0) {
                $("#testimonial-load-more").addClass('is-disabled');
            }

            $("#testimonial-load-more").on("click", function(e){
                e.preventDefault();
                $(".js-testimonial-post:hidden").slice(0, 9).slideDown();
                if($(".js-testimonial-post:hidden").length == 0) {
                    $("#testimonial-load-more").addClass('is-disabled');
                }
                var  $total = $('.js-testimonial-post').length;
                var  $totalcount = $('.js-testimonial-post:visible').length;

                var $totality =  $totalcount / $total;
                var $progwidth = $totality * 100;

                $('.testimonial-block__pagination__bar').width($progwidth + "%");

                var boom = $('.js-testimonial-post:visible').length;
                $('.testimonial-post-result').text(boom);
            });
		},
	}

	return FX

} ( FX || {}, jQuery ) )

