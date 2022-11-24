/* ---------------------------------------------------------------------
	Global Js
	Target Browsers: All

	HEADS UP! This script is for general functionality found on ALL pages and not tied to specific components, blocks, or
	plugins. 

	If you need to add JS for a specific block or component, create a script file in js/components or js/blocks and
	add your JS there. (Don't forget to enqueue it!)
------------------------------------------------------------------------ */

var FX = ( function( FX, $ ) {

	/**
	 * Doc Ready
	 * 
	 * Use a separate $(function() {}) block for each function call
	 */
	$( () => {
		FX.General.init(); // For super general or super short scripts
	})

    $( () => {
        FX.ExternalLinks.init(); // Enable by default
	})

    $( () => {
        FX.Menu.init();
	})

    $( () => {
		FX.MobileMenu.init();
	})

	$( () => {
		if(!$('body').hasClass('home')) {
			FX.MastheadInnerpageAnimation.init();
		}
	})

	$( () => {
		FX.AnimatedText.init();
	})
	
	
	$(window).on( 'load', () => {
		FX.BackToTop.init()
	})



	/**
	 * Example Code Block - This should be removed
	 * @type {Object}
	 */
	FX.CodeBlock = {
		init() {

		},
	};



	/**
	 * Display scroll-to-top after a certain amount of pixels
	 * @type {Object}
	 */
	FX.BackToTop = {
		$btn: null,

		init() {
			$('.back-top-btn a').on('click', function(e) {
				e.preventDefault();

				$("html, body").animate ({scrollTop: 0});
			})

			$('.back-top-btn a').on('mouseenter', function() {
                const $this = $(this);
                $('.page-footer').addClass('is-back-to-top-focused');
            })
            
            $('.back-top-btn a').on('mouseleave', function() {
                const $this = $(this);
                $('.page-footer').removeClass('is-back-to-top-focused');
            })
		}
	};

	
	
	/**
	 * General functionality — ideal for one-liners or super-duper short code blocks
	 */
	FX.General = {
		init() {
			this.bind();
			this.inputEffects()
		},

		bind() {

			// Makes all PDF to open in new tabs
			$('a[href*=".pdf"]').each( e => {
				$(this).attr('target', '_blank');
			});

			// FitVids - responsive videos
			$('body').fitVids();

			// Input on focus remove placeholder
			$('input,textarea').focus( () => {
				$(this).removeAttr('placeholder');
			});

			$('blockquote').each(function() {
				const $this = $(this);
				const $blockquoteIcon = $('#js-blockquote-icon').html();

				$this.prepend(`<div class="blockquote__icon">${$blockquoteIcon}</div>`)
			})

			const options = {
				damping: 0.04,
				thumbMinSize: 20,
				renderByPixel: true,
				continuousScrolling: false
			};

			$('.table-structure').each(function() {
				const $this = $(this);

				Scrollbar.init($this[0], options);
			})

			$('#blog-category').on('change', function() {
				const $this = $(this);

				window.location = $this.val();
				return false;
			})

			$('#blog-category-2').on('change', function() {
				const $this = $(this);

				window.location = $this.val();
				return false;
			})

			$('.wpcf7-form-control-wrap').each(function() {
				const $this = $(this);
				const $thisLabel = $this.next('label');

				$thisLabel.appendTo($this);
			})
			
			// nav search toggle
			$('.js-search-toggle').on('click', () => {
				$('.desktop-menu__phone, .js-search-toggle').toggleClass('js-search-active');
				$('.desktop-menu__search').stop().fadeToggle().toggleClass('is-shown');
                $('.desktop-menu__search input[name="s"]').focus();
			});

			$('.toggle-menu').on('click', function() {
				const $this = $(this);

				$('.toggle-menu').toggleClass('is-active');
				$('button.ubermenu-responsive-toggle').click();
				$('.nav-primary').stop().slideToggle();
			})

			if($('#js-masthead-sticky').length > 0) {
				const controller = new ScrollMagic.Controller({});

				new ScrollMagic.Scene({
					triggerElement: "#js-masthead-innerpage",
					triggerHook : "onLeave",
					offset: $('#js-masthead-innerpage').outerHeight() - $('.page-header').outerHeight()
				})
					.setClassToggle("#js-masthead-sticky", "is-sticky")
					.addTo(controller);
			}

			$('.wysiwyg').each(function() {
				const $this = $(this);

				if($this.find('table > .table-scroll').length == 0) {
					$this.find('table').wrap('<div class="table-scroll"><div class="table-structure"></div></div>');
				}

				if($this.find('blockquote').length > 0) {
					$this.find('blockquote').each(function() {
						const $thisBlockquote = $(this);
	
						if($thisBlockquote.find('i').length == 0) {
							$thisBlockquote.prepend('<i class="icon-small-quotes"></i>')
						}
					})
				}
			})
		},


		/**
		 * Adds special classes to form elements when user clicks/fills fields
		 * 
		 */
		inputEffects() {
			$('input, textarea').on('click focus blur', e => {
				const $el = $(e.currentTarget)
				const $wrapper = $el.closest('.wpcf7-form-control-wrap')
				const { type } = e

				if ('click' === type || 'focus' === type) {
					$wrapper.addClass('input-has-value')
				} else if ('blur' === type) {
					if ('' === $el.val()) {
						$wrapper.removeClass('input-has-value')
					}
				}
			})
		}
	};



	/**
	 * Mobile menu script for opening/closing menu and sub menus
	 * @type {Object}
	 */
	FX.MobileMenu = {
		init() {
			$('.nav-primary li.ubermenu-item-has-children > a').append('<span class="icon-button-down hidden-lg"></span>');
		}
	};



	/**
	 * Ubermenu mobile menu toggle hack
	 * @type {Object}
	 */
	FX.Menu = {
		windowWidth: 		0,
		$ubermenu: 			$('#ubermenu-nav-main-33'), // replace with ID of ubermenu element
		$topLevelMenuItems: null,
		$mobileMenuToggle: 	$('.ubermenu-responsive-toggle'),


        init() {
            this.setMenuClasses();
			this.setSubMenuClasses();

			this.$topLevelMenuItems = this.$ubermenu.children('.ubermenu-item-level-0');
			this.bind();
        },

        setMenuClasses() {
            let windowWidth = $( window ).innerWidth();

            // iOS fires resize event on scroll - let's first make sure the window width actually changed
            if ( windowWidth == this.windowWidth ) {
                return;
            }

            this.windowWidth = windowWidth;

            if ( this.windowWidth < 1025 ) {
                $('.ubermenu-item-has-children').each( () => {
                    $(this).removeClass('ubermenu-has-submenu-drop');
                });

            } else {
                $('.ubermenu-item-has-children').each( () => {
                    $(this).addClass('ubermenu-has-submenu-drop');
                });
            }
        },

		setSubMenuClasses() {
			$('.ubermenu-item-has-children').each( () => {
                $(this).children('a').each( () => {
                    let $this = $(this);
                    $this.children('.ubermenu-sub-indicator').clone().insertAfter( $this).addClass('submenu-toggle hidden-md-up');
                    $this.children('.ubermenu-sub-indicator').addClass('hidden-sm-down');
                });
			});
		},

        bind() {
			$(window).on( 'resize', this.setMenuClasses.bind(this) );

			$('.submenu-toggle').on( 'touchstart click', this.toggleNextLevel );

			this.$topLevelMenuItems.on( 'ubermenuopen', this.handleUbermenuOpen.bind( this ) )
			this.$topLevelMenuItems.on( 'ubermenuclose', this.handleUbermenuClose.bind( this ) )

			// when clicking to open/close mobile menu toggle
			this.$mobileMenuToggle.on( 'ubermenutoggledopen', this.handleUbermenuOpen.bind( this ) )
			this.$mobileMenuToggle.on( 'ubermenutoggledclose', this.handleUbermenuClose.bind( this ) )
		},

		handleUbermenuOpen( e ) {
			const self = this,
				$container = self.$ubermenu.closest('.desktop-menu')

			$(document.body).addClass('menu-is-active')

			$container.addClass('menu-is-active')
			self.$mobileMenuToggle.addClass('menu-is-active')
		},


		handleUbermenuClose( e ) {
			const self = this,
				$container = self.$ubermenu.closest('.desktop-menu')

			$(document.body).removeClass('menu-is-active')
			$container.removeClass('menu-is-active')
			self.$mobileMenuToggle.removeClass('menu-is-active')
		},


		/* handleResponsiveToggleClick( e ) {
			const $btn = $(e.currentTarget),
				$menu = $('.desktop-menu').find('.ubermenu-main')

			$btn.toggleClass('menu-is-active', $menu.hasClass('ubermenu-responsive-collapse') )
		}, */


        toggleNextLevel( e ) {
            let $this = $( this );
            
			e.preventDefault();
			
            $this.toggleClass('fa-angle-down').toggleClass('fa-times');
            $this.parent().toggleClass('ubermenu-active');
            if( $this.parent().hasClass('ubermenu-active') ) {
                $this.parent().siblings('.ubermenu-active').removeClass('ubermenu-active').children('.submenu-toggle').addClass('fa-angle-down').removeClass('fa-times');
            }
        }
	}



	/**
	 * Force External Links to open in new window.
	 * @type {Object}
	 */
	FX.ExternalLinks = {
		init() {
			var siteUrlBase = FX.siteurl.replace( /^https?:\/\/((w){3})?/, '' );

			$( 'a[href*="//"]:not([href*="'+siteUrlBase+'"])' )
				.not( '.ignore-external' ) // ignore class for excluding
				.addClass( 'external' )
				.attr( 'target', '_blank' )
				.attr( 'rel', 'noopener' );
		}
	};



	/**
	 * Affix
	 * Fixes sticky items on scroll
	 * @type {Object}
	 */
	FX.Affix = {

		$body: 			null,
		$header: 		null,
		headerHeight: 	null,
		scrollFrame: 	null,
		resizeFrame: 	null,


		init() {
			this.$body 			= $(document.body);
			this.$header 		= $('#page-header');
			this.headerHeight 	= this.$header.outerHeight( true );

			this.bind();
        },


        bind(e) {
			$(window).on( 'scroll', this.handleScroll.bind( this ) );
			$(window).on( 'resize', this.handleResize.bind( this ) );
		},


		handleScroll( e ) {
			var self = this;

			// avoid constantly running intensive function(s) on scroll
			if( null !== self.scrollFrame ) {
				cancelAnimationFrame( self.scrollFrame )
			}

			self.scrollFrame = requestAnimationFrame( self.maybeAffixHeader.bind( self ) )
		},


		handleResize( e ) {
			var self = this;

			// avoid constantly running intensive function(s) on resize
			if( null !== self.resizeFrame ) {
				cancelAnimationFrame( self.resizeFrame )
			}

			self.resizeFrame = requestAnimationFrame( () => {
				self.headerHeight = self.$header.outerHeight( true );
			})
		},


		maybeAffixHeader() {
			var self = this;

			if( 200 < $(window).scrollTop() ) {
				self.$body.css( 'padding-top', self.headerHeight );
				self.$header.addClass('js-scrolled');
			} else {
				self.$body.css( 'padding-top', 0 );
				self.$header.removeClass('js-scrolled');
			}
		}
	};



	/**
	 * FX.SmoothAnchors
	 * Smoothly Scroll to Anchor ID
	 * @type {Object}
	 */
	FX.SmoothAnchors = {
		hash: null,

		init() {
			this.hash = window.location.hash;

			if( '' !== this.hash ) {
				this.scrollToSmooth( this.hash );
			}

			this.bind();
		},

		bind() {
			$( 'a[href^="#"]' ).on( 'click', $.proxy( this.onClick, this ) );
		},

		onClick( e ) {
			e.preventDefault();

			var target = $( e.currentTarget ).attr( 'href' );

			this.scrollToSmooth( target );
		},

		scrollToSmooth( target ) {
			var $target = $( target ),
				headerHeight = 0;
			
			$target = ( $target.length ) ? $target : $( this.hash );

			if ( $target.length ) {
				var targetOffset = $target.offset().top - headerHeight;

				$( 'html, body' ).animate({ 
					scrollTop: targetOffset 
				}, 600 );

				return false;
			}
		}
	};

	FX.MastheadInnerpageAnimation = {
		init() {
			new TimelineMax()
				.staggerTo('.left-text-wrapper > *', 0.6, {
					opacity: 1,
					'transform' : 'translate(0, 0)'
				}, 0.15);

			new TimelineMax()
				.to(".right-image__squares .right-image__squares__item", {
					duration: 0.8,
					scale: 0, 
					ease: "power4.easeInOut",
					stagger: {
						amount: 0.5, 
						grid: 'auto', 
						axis: null, 
						ease: Power4.easeInOut,
						from: 'center'
					}
				});
		}
	}

	FX.AnimatedText = {
		init() {
			const $animatedText = $('.js-animated-text');
			const controller = new ScrollMagic.Controller({})

			$animatedText.each(function() {
                const $this = $(this);
                const $animatedTextChildren = $this.find('> *');

                const animatedTextWrapTimeline = new TimelineMax();
                    animatedTextWrapTimeline
						.staggerTo($animatedTextChildren, 1, {
							opacity : 1,
							'transform' : 'translate(0, 0) scale(1)',
						}, 0.15)

                new ScrollMagic.Scene({
                    triggerElement: $this[0],
                    triggerHook: 0.95
                })
                .setTween(animatedTextWrapTimeline)
                .addTo(controller);
            })
		}
	}

	

	return FX;

} ( FX || {}, jQuery ) );
