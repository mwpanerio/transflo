// create instances for all FxReadMore elements
( () => {
	
	document.addEventListener( 'DOMContentLoaded', () => {
		document.querySelectorAll('.js-read-more').forEach( el => {
			new FxReadMore( el )
		})
	})



	class FxReadMore {
	
		constructor( el ) {

			// avoid rebinding if already applied
			if( undefined !== el.fxReadMore ) {
				return
			}

			this.el = el
			this.el.fxReadMore = this

			this.setup()
		}


		setup() {

			// try to find read more button
			const sibling = this.el.nextElementSibling

			if( null !== sibling && sibling.classList.contains('js-read-more-toggle') ) {
				this.btn = sibling

				// note initial line clamp for later usage
				this.origLineClamp = parseInt( this.el.style.getPropertyValue('--readMoreLines') )

				// tracking states for updating element
				this.isExpanded = false

				this.bind()
			}
		}
	
	
		bind() {
			this.btn.addEventListener( 'click', this.handleBtnClick.bind( this ) )
		}
	
	
		handleBtnClick( e ) {
			if( this.isExpanded ) {
				this.collapseBlock()
			} else {
				this.expandBlock()
			}
		}


		collapseBlock() {
			this.updateBlockState(
				false,
				this.origLineClamp,
				'Read More'
			)
		}


		expandBlock() {
			this.updateBlockState(
				true,
				'unset',
				'Read Less'
			)
		}


		updateBlockState( expand, lineClamp, btnText ) {
			this.isExpanded = expand

			this.el.style.setProperty( '--readMoreLines', lineClamp )
			this.btn.innerText = btnText
		}
	}

}) ()