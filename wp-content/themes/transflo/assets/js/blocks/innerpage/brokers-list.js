var FX = ( function( FX, $ ) {

	$( () => {
		FX.BrokersListScript.init()
        FX.BrokersListScript.brokersListFilter()
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

            $(document).mouseup(function(e) {
                const container = $(".brokers-list__modal__container");

                if (!container.is(e.target) && container.has(e.target).length === 0)  {
                    $('.brokers-list__modal__container:visible').stop().slideUp(function() {
                        $modalContainer.fadeOut();
                    });
                }
            });
		},

        brokersListFilter() {
            let qsRegex;
            let buttonFilter;

            const $container = $('.brokers-list__list').isotope({
                itemSelector: '.brokers-list__item',
                percentPosition: true,
                layoutMode: 'fitRows',
                filter: function() {
                    const $this = $(this);
                    const searchResult = qsRegex ? $this.find('h3').text().match( qsRegex ) : true;
                    const buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
                    return searchResult && buttonResult;
                }
            });

            let initShow = 12; //number of items loaded on init & onclick load more button
            let counter = 3; //counter for load more button
            const iso = $container.data('isotope'); // get Isotope instance

            loadMore(initShow);

            function loadMore(toShow) {
                $container.find(".hidden-item").removeClass("hidden-item").show();

                var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
                    return item.element;
                });
                $(hiddenElems).addClass('hidden-item').hide();
                $container.isotope('layout');

                //when no more to load, hide show more button
                if (hiddenElems.length == 0) {
                    $("#load-more").hide();
                } else {
                    $("#load-more").show();
                };

                setTimeout(function() {
                    var $total = iso.filteredItems.length;
                    var $totalcount = $('.brokers-list__item:visible').length;

                    var $totality = $totalcount / $total;
                    var $progwidth = $total == 0 ? 100 : $totality * 100;

                    $('.brokers-list__pagination__bar').width($progwidth + "%");

                    $('.showing-result').text($totalcount);
                    $('.total-result').text($total);
                }, 500)

            }

            // use value of search field to filter
            var $quicksearch = $('#search-by-name').keyup( debounce( function() {
                qsRegex = new RegExp( $quicksearch.val(), 'gi' );
                $container.isotope();
                loadMore(initShow);
            }, 200 ) );

            // debounce so filtering doesn't happen every millisecond
            function debounce( fn, threshold ) {
                var timeout;
                threshold = threshold || 100;
                return function debounced() {
                    clearTimeout( timeout );
                    var args = arguments;
                    var _this = this;
                    function delayed() {
                        fn.apply( _this, args );
                    }
                    timeout = setTimeout( delayed, threshold );
                };
            }

            $("#load-more").on("click", function(e){
                e.preventDefault();

                counter = counter + initShow;
                loadMore(counter);
            });

            $('#filter-by-state').on('change', function() {
                const $this = $(this);

                qsRegex = new RegExp( $('#search-by-name').val(), 'gi' );
                buttonFilter = $this.val();
                $container.isotope();

                loadMore(initShow);

            })

            $('.brokers-list__upper__form').submit(function(e) {
                e.preventDefault();

                qsRegex = new RegExp( $('#search-by-name').val(), 'gi' );
                buttonFilter = $('#filter-by-state').val();
                $container.isotope();

                loadMore(initShow);

                return false;
            });

            const options = {
                damping: 0.04,
                thumbMinSize: 20,
                renderByPixel: true,
                continuousScrolling: false
            };


            $('.brokers-list__modal__right').each(function() {
                const $this = $(this);

                Scrollbar.init($this[0], options);
            })
        }
	}

	return FX

} ( FX || {}, jQuery ) )

