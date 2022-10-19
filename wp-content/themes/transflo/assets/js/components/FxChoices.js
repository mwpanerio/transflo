( () => {
    document.addEventListener( 'DOMContentLoaded', () => {
        if( 'function' !== typeof Choices ) {
            console.warn( 'ChoicesJS not loaded' )
        } else {
            document.querySelectorAll('select').forEach( el => {

                // prevent Choices from being applied to an element with Select2 already applied
                if( /select2/g.test( el.className ) ) {
                    return
                }

                // block Choices from being applied to a <select> with a custom setup (or prevent conflict with other <select> JS library)
                if( el.classList.contains( 'js-ignore-choices-auto' ) ) {
                    return
                }                
                
                const config = {}
    
                // add config conditions here
                config.shouldSort = false
    
                new FxChoice( el, config )
            })
        }
    })
}) ()




class FxChoice {

	// todo - support for additional parameters/settings (for now, add conditions with config)
    constructor( el, config = {} ) {
        this.el 		= el
		this.config 	= this.parseConfig( config )
        
		this.choices 	= null

		this.setUpChoices()
        this.formResetFix()
    }


	// slight adjustment to config to support initialization
	parseConfig( config ) {
		const self = this

		let origInitCallback

		if( 'function' === typeof config.callbackOnInit ) {
			origInitCallback = config.callbackOnInit
		}

		config.callbackOnInit = () => {
			if( undefined !== origInitCallback ) {
				origInitCallback()
			}

			self.setInitStatus( true )
		}

		return config
	}


    setUpChoices() {
		const self = this

		// prevents duplicate initialization
		if( true === self.el.fxChoicesIsInitialized ) {
			return
		}

		self.choices = new Choices( self.el, self.config )

		// auto-submit category dropdowns on select
        if( 'cat' === self.el.id ) {
            self.el.onchange = null

			// todo — this.choices.passedElement.element is same as self.el (double-check)
            self.choices.passedElement.element.addEventListener( 'change', e => {
				const form = e.target.form

                if( form ) {
                    form.submit()
                }
            })
        }
    }


    formResetFix() {
        const self  = this,
            form    = self.el.form

        if( null !== form && null !== self.choices ) {
            form.addEventListener( 'reset', () => {
                self.choices.destroy()
				self.el.fxChoicesIsInitialized = false

                self.setUpChoices()
            }, {
                once: true
            })
        }
    }


    setInitStatus( status = false ) {
        this.el.fxChoicesIsInitialized = status
    }

}
