var FXLM = ( function( FXLM ) {


	// making instances globally accessible in case other plugins/themes need to manipulate
	FXLM.instances = []


	window.addEventListener( 'load', () => {
		const containers = document.querySelectorAll('.js-load-more-block')

		for( const container of containers ) {
			const postType 	= container.dataset.loadMorePostType,
				posts 		= container.querySelector('.js-load-more-posts'),
				widget 		= container.querySelector('.js-load-more')

			if( null !== widget && null !== posts ) {
				const instance = new FxLoadMore( container, widget, posts, postType )

				FXLM.instances.push( instance )
			}
		}
	})



	class FxLoadMore {

		constructor( elContainer, elWidget, elPosts, postType = 'post' ) {
	
			// elements
			this.container 	= elContainer
			this.widget 	= elWidget
			this.posts 		= elPosts
			this.counter	= this.widget.querySelector('.js-load-more-counter')
			this.progress 	= this.widget.querySelector('.js-load-more-progress')
			this.btn 		= this.widget.querySelector('.js-load-more-btn')
	
			// states
			this.isFetching		= false
			this.isShowingAll 	= false
	
			// data
			this.postType 			= postType
			this.postTaxonomy 		= null
			this.postTermId 		= null

			// check container for data attribute for total posts
			if( undefined !== this.container.dataset.loadMoreTotal ) {
				this.totalPostCount = parseInt( this.container.dataset.loadMoreTotal )

			// otherwise, check for value passed through wp_localize_script
			} else {
				this.totalPostCount = parseInt( FXLM.post_count )
			}

			// check for custom posts per page value
			if( undefined !== this.container.dataset.loadMorePostsPerPage ) {
				this.postsPerPage = parseInt( this.container.dataset.loadMorePostsPerPage )

			// otherwise, check for value passed through wp_localize_script
			} else {
				this.postsPerPage = parseInt( FXLM.posts_per_page )				
			}			

			// check container for data attribute for current page
			if( undefined !== this.container.dataset.loadMoreCurrentPage ) {
				this.currentPage = parseInt( this.container.dataset.loadMoreCurrentPage )
			} else {
				this.currentPage = 1
			}

			// check container for any post IDs to exclude
			if( undefined !== this.container.dataset.loadMoreExcludeIds ) {
				this.excludeIds = this.container.dataset.loadMoreExcludeIds;
			} else {
				this.excludeIds = null;
			}

			// check if for taxonomy
			if( undefined !== FXLM.post_taxonomy && undefined !== FXLM.post_term_id ) {
				this.postTaxonomy 	= FXLM.post_taxonomy
				this.postTermId 	= FXLM.post_term_id
			}

			// check for search query
			if( undefined !== this.container.dataset.loadMoreSearchQuery ) {
				this.searchQuery = this.container.dataset.loadMoreSearchQuery
			}

			this.currentPostCount = ( this.totalPostCount < this.postsPerPage ) ? this.totalPostCount : this.postsPerPage

			// check for meta key&value
			if( undefined !== this.container.dataset.loadMoreMetaKey && undefined !== this.container.dataset.loadMoreMetaValue ) {
				this.metaKey = this.container.dataset.loadMoreMetaKey;
				this.metaValue = this.container.dataset.loadMoreMetaValue;
			}
	
			this.init()
		}
	
	
		init() {
			this.progress.max = this.totalPostCount
	
			this.updateWidget()
			this.bind()
		}
	
	
		bind() {
			this.btn.addEventListener( 'click', this.handleBtnClick.bind( this ) )
		}
	
	
		updateWidget() {
			this.progress.value 	= this.currentPostCount
			this.counter.innerText 	= `Viewing ${this.currentPostCount} of ${this.totalPostCount}`
	
			// have we loaded all posts?
			if( this.currentPostCount >= this.totalPostCount ) {
				this.btn.classList.add( 'is-disabled' )
				this.btn.disabled = true

				// prevents additional Ajax requests
				this.isShowingAll = true
			}
		}
	
	
		async handleBtnClick() {
			const self = this
	
			// avoid duplicate clicks or clicks when all posts are showing
			if( self.isFetching || self.isShowingAll ) {
				return
			}

			// indicate loading state
			self.setFetchStatus( true )
	
			// generate placeholders to avoid CLS
			const placeholders = self.createPlaceholders( self.getPlaceholderCount() )

			// params for endpoint
			const params = new URLSearchParams()
	
			params.append( 'page', ++self.currentPage )
			params.append( 'posts_per_page', self.postsPerPage )
			params.append( 'post_type', self.postType )

			// if archive page, include taxonomy
			if( null !== self.postTaxonomy && null !== self.postTermId ) {
				params.append( 'taxonomy', self.postTaxonomy )
				params.append( 'term_id', self.postTermId )
			}

			// if search page, include search term
			if( undefined !== self.searchQuery ) {
				params.append( 'search', self.searchQuery )
			}

			if( null !== self.excludeIds ) {
				params.append( 'exclude_ids', self.excludeIds )
			}

			if( undefined !== self.metaKey && undefined !== self.metaValue ) {
				params.append( 'meta_key', self.metaKey );
				params.append( 'meta_value', self.metaValue );
			}
	
			// fetch posts from API endpoint
			const { post_count, posts } = await self.fetchPosts( params )

			// remove loading state
			self.setFetchStatus( false )

			// update object data
			self.currentPostCount += post_count

			// replace placeholder blocks with actual posts
			self.replacePlaceholdersWithPosts( placeholders, posts )

			// update progress bar
			self.updateWidget()
		}


		setFetchStatus( isFetching = false ) {
			this.isFetching = isFetching

			// show/hide loading animations, etc
			this.btn.classList.toggle( 'is-loading', isFetching )
		}


		getPlaceholderCount() {
			let count = this.postsPerPage,
				remaining = this.totalPostCount - this.currentPostCount

			// if less than full page of posts, use that instead
			if( remaining < count ) {
				count = remaining
			}
			
			return count
		}


		async fetchPosts( params ) {
			const response = await fetch( `${FXLM.rest_url}/get-posts?${params.toString()}` )

			return await response.json()
		}


		createPlaceholders( placeholderCount ) {
			const self 			= this,
				placeholders 	= [],
				firstPost 		= self.posts.firstElementChild,
				elHeight  		= firstPost.offsetHeight

			for( let i = 0; i < placeholderCount; i++ ) {
				const placeholder 	= firstPost.cloneNode(),  // clone only container
					innerBlock 		= document.createElement('div')

				placeholder.classList.add( 'placeholder-block', 'is-loading' )
				placeholder.style.height = `${elHeight}px`

				// add inner block for easier styling (in case using padding with outside block)
				innerBlock.classList.add( 'placeholder-block__inner' )
				placeholder.appendChild( innerBlock )

				self.posts.appendChild( placeholder )

				placeholders.push( placeholder )
			}

			return placeholders
		}


		replacePlaceholdersWithPosts( placeholders, posts ) {
			const self = this

			// goal is to replace each placeholder block with a post block
			for( const placeholder of placeholders ) {

				// check if a post exists
				if( posts.length ) {
					const post = posts.shift()

					// convert string to HTML
					const fragment 	= document.createRange().createContextualFragment( post )

					placeholder.replaceWith( fragment )

				// if no posts exist, delete placeholder block
				} else {
					placeholder.remove()
				}
			}

			// do we still have posts left over?
			if( posts.length ) {

				// add to end of posts listing
				for( const post of posts ) {
					self.posts.insertAdjacentHTML( 'beforeend', post )
				}
			}
		}
	}	



	return FXLM

}) ( FXLM || {} )