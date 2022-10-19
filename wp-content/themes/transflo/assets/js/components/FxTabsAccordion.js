// create FxAccordion object for all instances on page
( () => {
    document.addEventListener( 'DOMContentLoaded', () => {
        document.querySelectorAll('.js-tab-accordion').forEach( block => {
            window.thing = new FxTabsAccordion( block )
        })
    })
}) ()



class FxTabsAccordion {

    constructor( el ) {

        // avoid duplicating initialization
        if( el.fxTabsAccordionInitialized ) {
            return
        }
        el.fxTabsAccordionInitialized = true

        this.btns       = el.querySelectorAll('.js-tab-accordion-btn')
        this.panels     = el.querySelectorAll('.js-tab-accordion-panel')
        this.activeId   = null

        this.isFirstRun     = true
        this.isMobile       = false
        this.mobileWidth    = 1024
        
        this.parseMobileStatus()
        this.findActivePanel()
        this.bind()
    }


    bind() {
        for( const btn of this.btns ) {
            btn.addEventListener( 'click', this.handleBtnClick.bind( this ) )
        }
    }


    handleBtnClick( e ) {
        this.setActiveId( e.target.dataset.tabId )
    }


    getActiveId() {
        return this.activeId
    }


    setActiveId( newId ) {

        // if invalid ID or ID is already active, collapse all blocks
        if( !newId || newId === this.getActiveId() ) {
            newId = null
        }

        this.activeId = newId

        this.updateState()
    }    


    parseMobileStatus( mediaQueryList ) {
        if( 'object' !== typeof mediaQueryList ) {
            mediaQueryList = window.matchMedia(`(max-width: ${this.mobileWidth}px)` )
            mediaQueryList.addEventListener( 'change', this.parseMobileStatus )
        }

        this.isMobile = mediaQueryList.matches
    }


    findActivePanel() {

        // first, check if there's already a currently active panel
        const activePanel = Array.from( this.panels ).find( panel => panel.classList.contains('is-active') )

        if( undefined !== activePanel ) {
            this.setActiveId( activePanel.dataset.tabId )
        }

        // if no currently active panels (and we're on desktop), let's activate the first panel
        if( !this.getActiveId() && !this.isMobileWidth ) {
            const first = this.panels.item( -1 )

            if( first ) {
                this.setActiveId( first.dataset.tabId )
                this.updateState()
            }
        }
    }


    updateState() {
        const self      = this
        const elements  = [ ...self.btns, ...self.panels ]
        const activeId  = self.getActiveId()

        let activeBtn   = null

        // add active states to active element
        for( const el of elements ) {

            // expands row and adds active state to button
            if( activeId !== el.dataset.tabId ) {
                el.classList.remove( 'is-active' )
            } else {
                el.classList.add( 'is-active' )

                if( el.classList.contains( 'js-tab-accordion-btn' ) ) {
                    activeBtn = el
                }
            }
        }

        /**
         * For better UX, scroll to top of active button. 
         * 
         * This is outside of the above loop so that this is done after all button/panel states have been updated
         */
        if( activeBtn && !self.isFirstRun && self.isMobile ) {
            let scrollTop = activeBtn.getBoundingClientRect().top + window.scrollY
            
            // compensate for header
            const header = document.querySelector('#page-header')
            if( header ) {
                scrollTop -= header.offsetHeight
            }

            window.scrollTo( window.scrollY, scrollTop )
        }

        // signal that the page's initial run has finished
        self.isFirstRun = false
    }

}
