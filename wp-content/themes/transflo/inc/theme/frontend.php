<?php

/**
 * Set Up theme support and functionality
 *
 * @return void
 */
add_action( 'after_setup_theme', 'fx_setup' );
function fx_setup() {
    add_editor_style();
    add_theme_support( 'title-tag' );

    // Theme Images
    add_theme_support( 'post-thumbnails' );
    
    // Image Sizes
    add_image_size( 'masthead', 1920, 600 ); // true hard crops, false proportional

    // HTML5 Support
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
}


/**
 * Register menu functionality, initilize plugin functionality
 *
 * @return void
 */
add_action( 'init', 'fx_init' );
function fx_init() {
    // Register Menu
    register_nav_menus(
        array(
            'footer_menu'  => 'Navigation items for footer navigation.',
            'main_menu' => 'Navigation items for the main menu.'
        )
    );
}


/**
 *  Register sidebars and widgets
 *
 *  @return  void
 */
add_action( 'widgets_init', 'fx_widget_init' );
function fx_widget_init() {
    // Sidebar
    register_sidebar(
        array(
            'name'          => 'Main Sidebar Widgets',
            'id'            => 'sidebar',
            'description'   => 'Widgets for the default sidebar',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="widget %2$s" id="%1$s" >',
            'after_widget'  => '</div>',
        )
    );
}


/**
 * Change Yoast's default breadcrumb wrapper
 * 
 * @return  string  Breadcrumb wrapper tag name
 */
/* Change Yoast default breadcrumb wrapper to li */
add_filter( 'wpseo_breadcrumb_single_link_wrapper', 'fx_yoast_change_breadcrumb_single_wrapper' );
function fx_yoast_change_breadcrumb_single_wrapper(): string {
    return 'li';
}


/**
 * Remove yoast breadcrumb link separator
 * 
 * @param   string  $output Breadcrumb separator
 * @return  string          Breadcrumb separator
 */
add_filter( 'wpseo_breadcrumb_single_link_with_sep', 'fx_yoast_remove_breadcrumb_single_link_sep', 10, 2 );
function fx_yoast_remove_breadcrumb_single_link_sep( string $output = '' ): string {
    return str_replace( '|', '', $output );
}


/**
 * Prevents WordPress from natively adding "loading='lazy'" to media elements we'll offload that work to WP Rocket)
 *
 * @return  bool
 */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );


/**
 * Adds bootstrap .container > .row > .col-xxs-12 wrapper around blocks so non-fx blocks can be styled nicely with 
 * padding.
 * 
 * @see fx_add_bootstrap_wrapper_to_block filter for changing which blocks use these wrappers
 * 
 * @param   string  $block_content  Rendered block content
 * @param   array   $block          Block metadata
 * 
 * @return  string                  Modified block content
 */
add_filter( 'render_block', 'fx_wrap_blocks', 10, 2 );
function fx_wrap_blocks( string $block_content, array $block ): string {
    $wrap_block = apply_filters( 'fx_add_bootstrap_wrapper_to_block', true, $block['blockName'], $block );

    if( $wrap_block ) {
        $block_content = sprintf(
            '<div class="container"><div class="row"><div class="col-xxs-12">%s</div></div></div>',
            $block_content
        );
    }

    return $block_content;
}

/**
 * Optionally add Bootstrap wrapper to block
 * 
 * Intended primarily for core WordPress blocks to ensure that blocks display within a fixed width container. All FX 
 * blocks are automatically excluded as they'll use wrappers in their individual block templates.
 * 
 * @todo    Add additional conditions below or add another function that hooks into this filter
 * 
 * @param   bool    $wrap_block     If true, block content will be wrapped with Bootstrap wrapper
 * @param   mixed   $block_name     Block name
 * @param   mixed   $block_meta     Block metadata
 * 
 * @return  bool                    True, to use Bootstrap wrapper around block content
 */
add_filter( 'fx_add_bootstrap_wrapper_to_block', 'fx_maybe_add_bootstrap_wrapper_to_block', 10, 3 );
function fx_maybe_add_bootstrap_wrapper_to_block( bool $wrap_block, $block_name = '', $block_meta = [] ): bool {
    if( empty( $block_name ) || !is_string( $block_name ) ) {
        $wrap_block = false;

    // don't wrap FX/ACF blocks
    } elseif( false !== strpos( $block_name, 'acf/' ) ) {
        $wrap_block = false;

    // don't wrap WP's button blocks
    } elseif( 'core/button' === $block_name ) {
        $wrap_block = false;

    // blog posts usually use only headlines and WYSIWYG editor content, so no need to wrap
    } elseif( is_single() ) {
        $wrap_block = false;
    }

    return $wrap_block;
}


/**
 * Prevent block assets from rendering on specific pages (e.g. search, taxonomies)
 *
 * @param   bool    $register   If true, block assets will be registered
 * @return  bool                If true, block assets will be registered
 */
add_filter( 'fx_bam_register_parsed_block_assets', 'fx_conditionally_exclude_block_assets' );
function fx_conditionally_exclude_block_assets( bool $register ): bool {
    if( is_search() || is_archive() || is_tax() ) {
        $register = false;
    }

    return $register;
}


/**
 * Disables Ubermenu from adding "custom.css" and "custom.js" onto page
 *
 * @param	mixed   $value  Current option value
 * @param   string  $opt    Option name
 * 
 * @return  mixed           Filtered option value
 */
add_filter( 'ubermenu_op', 'fx_ubermenu_disable_custom_assets', 20, 2 );
function fx_ubermenu_disable_custom_assets( $value, $option ) {
    if( 'load_custom_css' === $option || 'load_custom_js' === $option ) {
        $value = 'off';
    }

    return $value;
}


/**
 * Change Yoast's default breadcrumb wrapper
 *
 * undefinedundefinedstring Breadcrumb wrapper tag name
 */
/* Change Yoast default breadcrumb wrapper from span to ul */
add_filter('wpseo_breadcrumb_output_wrapper', 'fx_yoast_change_breadcrumb_output_wrapper', 10, 1);
function fx_yoast_change_breadcrumb_output_wrapper($wrapper) {
  return 'ul';
}