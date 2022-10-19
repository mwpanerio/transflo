<?php
/* Table of Contents 
 *
 * Admin Whitelabel
 * TinyMCE Options
 * Block Editor Options
 * Page Excerpts
 */

/** ----- ADMIN WHITELABEL ----- **/

/**
 * Output style to change logo on login
 *
 * @return void
 */
add_action( 'login_head', 'fx_login_logo' );
function fx_login_logo() {

    // check for logo set in WP admin
    $image_id = fx_get_client_logo_image_id();

    if( empty( $image_id ) ) {
        return;
    }

    $image_data = wp_get_attachment_image_src( $image_id, 'small' );

    ?>

    <style type="text/css">
        h1 a {
            width: <?php echo $image_data[1]; ?>px !important;
            height: <?php echo $image_data[2]; ?>px !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
            background-image:url('<?php echo esc_url( $image_data[0] ); ?>') !important;
            background-size: <?php echo $image_data[1]; ?>px <?php echo $image_data[2]; ?>px !important;
        }
        .login form { margin-top: 25px !important; }

        #nav {
            float: right !important;
            width: 50%;
            padding: 0 !important;
            text-align: right !important;
        }

        #backtoblog {
            float: left !important;
            width: 50%;
            padding: 0 !important;
            margin-top: 24px;
        }
    </style>

    <?php
}


/**
 * Removes Items from the sidebar that aren't needed
 *
 * @return void
 */
add_action( 'admin_menu', 'fx_remove_admin_menu_items' );
function fx_remove_admin_menu_items() {
    global $menu;

    // array of item names to remove
    $remove_menu_items = array(
        __( 'Comments' ),
    );

    end( $menu );
    while ( prev( $menu ) ) {
        $item = explode( ' ', $menu[ key( $menu ) ][0] );
        if ( in_array( null !== $item[0] ? $item[0] : '', $remove_menu_items, true ) ) {
            unset( $menu[ key( $menu ) ] );
        }
    }
}


/**
 * Removes nodes from admin bar to make for white labeled
 *
 * @param  class $wp_toolbar the WordPress toolbar instance.
 * @return class             returns the modified toolbar
 */
add_action( 'admin_bar_menu', 'fx_remove_admin_bar_menus', 999 );
function fx_remove_admin_bar_menus( $wp_toolbar ) {
    $wp_toolbar->remove_node( 'wp-logo' );
    return $wp_toolbar;
}


/**
 * Remove the defualt dashboard widgets for orgs
 *
 * @return void
 */
add_action( 'wp_dashboard_setup', 'fx_remove_dashboard_widgets', 0 );
function fx_remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
}


/**
 * Remove the WordPress text at the bottom of the admin
 *
 * @param  string $text current footer text.
 * @return string the changed footer text
 */
add_filter( 'update_footer', 'fx_remove_footer_text', 999 );
add_filter( 'admin_footer_text', 'fx_remove_footer_text' );
function fx_remove_footer_text() {
    return '';
}


/**
 * Change logo URL on WP login page to point to site's homepage
 *
 * @return string 	Homepage URL
 */
add_filter( 'login_headerurl', function() {
	return get_home_url();
});

/** ----- TINYMCE OPTIONS ----- **/

/**
 * Add "Styles" drop-down
 *
 * @param  array $buttons current buttons to be setup.
 * @return array
 */
add_filter( 'mce_buttons_2', 'fx_mce_editor_buttons' );
function fx_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 *
 * @param  array $settings Settings array for TinyMCE.
 * @return array
 */
add_filter( 'tiny_mce_before_init', 'fx_mce_before_init' );
function fx_mce_before_init( $settings ) {
    $style_formats = array(
        array(
            'title'    => 'Button',
            'selector' => 'a',
            'classes'  => 'btn',
        ),

        /*
        Examples for adding styles
        array(
            'title' => 'Call Out Text',
            'selector' => 'p',
            'classes' => 'callout'
        )
        ,array(
            'title' => 'Warning Box',
            'block' => 'div',
            'classes' => 'warning box',
            'wrapper' => true
        )
        ,array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )
        */
    );

    $settings['style_formats'] = wp_json_encode( $style_formats );

    return $settings;
}


/**
 *  Adds "Theme Settings" option page
 *
 *  @return  void
 */
add_action( 'init', 'fx_admin_add_options_page' );
function fx_admin_add_options_page() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(
            [
                'page_title'    => 'Theme General Settings',
                'menu_title'    => 'Theme Settings',
                'menu_slug'     => 'theme-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]
        );
    }
}

/** ----- BLOCK EDITOR OPTIONS ----- **/

/** 
 * Remove core block patterns to prevent user confusion
 */
add_action( 'after_setup_theme', 'fx_remove_core_block_patterns' );
function fx_remove_core_block_patterns() {
    remove_theme_support( 'core-block-patterns' );
}

/** 
 * Unregister the "Classic Block" to prevent admin confusion
 */
add_action( 'init', 'fx_unregister_classic_block', 11 );
function fx_unregister_classic_block() {
    unregister_block_type( 'core/freeform' );
}

/**
 * Unregisters the CF7 block, since does not allow you to include
 * an html_id for MCFX tracking. Use the FX CF7 block instead. 
 * 
 * TODO remove from build template in phase II (for builds, delete this comment)
 */
add_action( 'init', 'fx_unregister_cf7_block', 11 );
function fx_unregister_cf7_block() {
    if( WP_Block_Type_Registry::get_instance()->is_registered( 'contact-form-7/contact-form-selector' ) ) {
        unregister_block_type( 'contact-form-7/contact-form-selector' );
    }
}

/**
 * Restrict the blocks that can be used on the homepage: this should include the top-level acf/homepage-block. 
 * Inner-blocks declared in homepage-block.php will automatically be included
 *
 */
add_filter( 'allowed_block_types_all', 'fx_restrict_homepage_blocks', 10, 2 );
function fx_restrict_homepage_blocks( $allowed_blocks, WP_Block_Editor_Context $block_editor_context ) {
    $post = $block_editor_context->post;

    if( isset( $post->ID ) && $post->ID === absint( get_option( 'page_on_front' ) ) ) {
        $allowed_blocks = [ 'acf/homepage-block' ];

    } else {
        // @todo — add blocks that should be only on homepage. Block name should be acf/{name}
        $disallowed_blocks = [
            'acf/homepage-block',
            'acf/homepage-masthead-slider', // TODO remove if not using homepage masthead slider
        ];
        
        if( is_bool( $allowed_blocks ) ) {
            $block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
            $allowed_blocks = array_keys( $block_types );
        }
        
        foreach( $disallowed_blocks as $block_to_unset ) {
            $key = array_search( $block_to_unset, $allowed_blocks );

            if( false !== $key ) {
                unset( $allowed_blocks[ $key ] );
            }
        }
    }

    if( is_array( $allowed_blocks ) ) {
        $allowed_blocks = array_values( $allowed_blocks );
    }

    return $allowed_blocks;
}


/** ----- PAGE EXCERPTS ----- **/

/**
 * Difficult to auto-generate good excerpts with block editor;
 * allow custom excerpts
 */
add_action( 'init', 'fx_page_supports_excerpts' );
function fx_page_supports_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}


/**
 * Automatically generate a post excerpt for posts that don't have one
 * 
 * @param   int     $post_id    Post ID
 * @param   WP_Post $post       Post
 * 
 * @return  bool                True
 */
add_action( 'save_post_page', 'fx_generate_post_excerpt', 99, 2 );
function fx_generate_post_excerpt( int $post_id, WP_Post $post ) {
    if( !has_excerpt( $post_id ) ) {
        $blocks = parse_blocks( $post->post_content );

        if( !empty( $blocks ) ) {
            $block_content  = apply_filters( 'the_content', render_block( $blocks[0] ) );
            $content        = wp_strip_all_tags( $block_content );
            $excerpt_length = apply_filters( 'excerpt_length', 55 );
            $excerpt_more   = apply_filters( 'excerpt_more', ' [&hellip;]' );
            $excerpt        = wp_trim_words( $content, $excerpt_length, $excerpt_more );
            
            // prevent infinite loop if no excerpt to update
            if( !empty( $excerpt ) ) {
                wp_update_post(
                    [
                        'ID'            => $post_id,
                        'post_excerpt'  => $excerpt
                    ]
                );
            }
        }
    }

    return true;
}


/** ----- ACF ------ **/

/**
 * Resort post types for ACF Page Link dropdown in WP admin
 * See the following Guru card to customize this to use other post types
 * https://app.getguru.com/card/ip4XezgT/How-To-Customize-the-ACF-Link-Field-To-Prioritize-Other-Post-Types
 * 
 * @param   array   $args   Query args for dropdown options
 * @param   array   $field  ACF field data
 * 
 * @return  array           Updated query args
 */
add_filter( 'acf/fields/page_link/query', 'fx_acf_page_link_resort_post_types', 10 );
function fx_acf_page_link_resort_post_types( $args ) {

    // if "Page" is a target post type, move it to top of list
    $page_index = array_search( 'page', $args['post_type'] );
    if( !empty( $page_index ) ) {
        unset( $args['post_type'][ $page_index ] );
        array_unshift( $args['post_type'], 'page' );
    }

    return $args;
}

/**
 * Creates a stylized message/header for each ACF field in the backend of Wordpress
 *
 *  */
add_action('admin_head', 'fx_acf_heading_styles');

function fx_acf_heading_styles() {
  echo '<style>
    .acf-block-fields > .acf-field-message {
        background:#4582C3;
        border:1px solid #4582C3;
        padding: 16px 20px 5px 20px !important;
    }

    .acf-block-fields .acf-field-message .acf-label label {
        color:#fff;
        font-size:15px;
        text-transform:uppercase;
    }

    .acf-block-fields .acf-field-message .acf-input p,
    .acf-block-fields .acf-field-message .acf-input p a {
        color: #fff;
        font-weight: bold
    }

    .acf-postbox > .postbox-header,
    .postbox .postbox-header {
        background:#4582C3;
    }

    .acf-postbox > .postbox-header > h2.hndle,
    .postbox .postbox-header h2 {
        color:#fff !important;
    }

    .acf-postbox > .postbox-header .toggle-indicator,
    .acf-postbox .acf-hndle-cog,
    .postbox .postbox-header .toggle-indicator,
    .postbox .handle-order-higher, 
    .postbox .handle-order-lower {
        color:#fff;
    }

    #editor .postbox > .postbox-header:hover {
        background:#4582C3;
    }
  </style>';
}



/**
 * Uploading Webp images in Wordpress without Plugin
 *
 */
add_filter( 'mime_types', 'fx_webp_upload_mimes' );
function fx_webp_upload_mimes( $existing_mimes ) {
	$existing_mimes['webp'] = 'image/webp';

	return $existing_mimes;
}


/**
 * Preview webp images on wordpress media library
 *
 */
add_filter( 'file_is_displayable_image', 'webfx_display_webp_in_media_library', 10, 2 );
function webfx_display_webp_in_media_library( $result, $path ) { 
	if( $result === false ) { 
		$displayable_image_types = array( IMAGETYPE_WEBP ); 
		$info = @getimagesize( $path ); 
		if( empty( $info ) ) { 
			$result = false; 
		} elseif( !in_array( $info[2], $displayable_image_types ) ) { 
			$result = false; 
		} else { 
			$result = true; 
		} 
	} 
	
	return $result;
}