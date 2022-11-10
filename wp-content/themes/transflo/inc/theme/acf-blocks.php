<?php

/**
 * Register FX blocks
 * 
 * fx_register_block() is, at its core, a wrapper function for acf_register_block_type with additional parameters for 
 * our supporting functionality 
 * 
 * @see Guru card: https://app.getguru.com/card/Tn9zzk8c/FX-ACF-Blocks
 * @see more info for acf_register_block_type(): https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * 
 * Below is a reference for the parameters you can pass to fx_register_block(). You can also pass any setting from 
 * acf_register_block_type() to fx_register_block().
 * 
 * Required arguments: "name", "title", and "template"
 * 
 */

// @todo — remove $reference_settings before launch
$reference_settings = [

    // required
    'name'                  => '', // (string) unique name to identify block (no spaces)
    'title'                 => '', // (string) display title for block
    'template'              => '', // (string) relative path of the template for block (e.g "/block-templates/innerpage/template.php")
    
    // optional
    'css'                   => '', // (string) block-specific stylesheet. Assumed to be in /themes/fx/assets/css, so use relative path (e.g. "homepage/homepage-block.css")
    'css_deps'              => [], // (array|string) CSS dependency handles. These will be loaded before block's stylesheet. Dependencies must already be registered
    'js'                    => '', // (string) block-specific script. Assumed to be in /themes/fx/assets/js, so use relative path (e.g. "homepage/homepage-block.js")
    'js_deps'               => [], // (array|string) JS dependency handles. These will be loaded before block's script. Dependencies must already be registered
    'description'           => '', // (string) short, useful description of block to indicate block's purpose
    'category'              => '', // (string) category for where block appears in Block Library
    'icon'                  => '', // (array|string) can be a dashicon or SVG image used to identify the block
    'keywords'              => '', // (array) terms to help find block in block editor
    'post_types'            => [], // (array) if declared, will restrict block to being available for only specified post types. Default is "page"
    'exclude_post_types'    => [], // (array) post types that block should NOT appear for
    'mode'                  => '', // (string) display mode for block when you add block in Block Editor
    'supports'              => '', // (associative array) features to support. See https://developer.wordpress.org/block-editor/developers/block-api/block-supports/
];




/**
 * General blocks
 * 
 * These blocks are intended to be used anywhere, including the homepage and innerpage.
 * 
 * Block template path: /themes/fx/block-templates/general
 * Stylesheet path:     /themes/fx/assets/css/general
 * Script path:         /themes/fx/assets/js/general
 * 
 */


/**
 * Create a "FX General Blocks" category in the block editor. Use "fx-general-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX General Blocks', 'fx-general-blocks' );


/**
 * Plain WYSIWYG block for general usage
 * 
 */
fx_register_block(
    [
        'name'          => 'wysiwyg',
        'title'         => 'General - WYSIWYG',
        'template'      => 'general/wysiwyg.php',
        'description'   => 'A basic "What you see is what you get" editor.',
        'css_deps'      => [ 'fx_wysiwyg', 'fx_custom_scrollbar' ],
        'js_deps'       => [ 'fx_custom_scrollbar' ],
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'general-image-button',
        'title'         => 'General - Image Button',
        'template'      => 'general/image-button.php',
        'description'   => '',
        'css'           => 'general/image-button.css',
        'post_types'    => [],
    ]
);


/**
 * To avoid issues with CF7 assets, we're creating our own CF7 block. You shouldn't need to touch this section.
 *
 */
$cf7_settings = [
    'name'          => 'cf7-block',
    'title'         => 'CF7 Block',
    'template'      => 'general/cf7-block.php',
    'description'   => 'Adds a CF7 block to page',
    'css_deps'      => [ 'fx_choices_custom', 'contact-form-7' ],
    'js_deps'       => [ 'contact-form-7', 'wpcf7-recaptcha', 'google-recaptcha' ],
    'keywords'      => [ 'cf7', 'contact', 'form' ],
    'mode'          => 'edit',
    'post_types'    => [], // all post types
];
$cf7_icon = WP_PLUGIN_DIR . '/contact-form-7/assets/icon.svg';
if( file_exists( $cf7_icon ) ) {
    $cf7_settings['icon'] = file_get_contents( $cf7_icon );
}
fx_register_block( $cf7_settings );

// @todo — add additional general blocks below with the "fx-general-blocks" category




/**
 * Homepage blocks
 * 
 * These blocks are intended to be used ONLY on the homepage.
 * 
 * Block template path: /themes/fx/block-templates/homepage
 * Stylesheet path:     /themes/fx/assets/css/homepage
 * Script path:         /themes/fx/assets/js/homepage
 * 
 */

/**
 * Create a "FX Homepage Blocks" category in the block editor. Use "fx-homepage-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX Homepage Blocks', 'fx-homepage-blocks' );


/**
 * This is the main homepage "outer block." All other homepage blocks should be added within this block in the Block 
 * Editor and in block-templates/homepage/homepage-block.php
 * 
 */
fx_register_block(
    [
        'name'          => 'homepage-block',
        'title'         => 'Homepage',
        'template'      => 'homepage/homepage-block.php',
        'description'   => 'The main content block for the homepage',
        'mode'          => 'preview',
        'supports'      => [ 'jsx' => true ], // enables support for inner blocks
        'category'      => 'fx-homepage-blocks',
    ]
);

// @todo —  remove this block if not using a homepage masthead slider

fx_register_block(
    [
        'name'          => 'homepage-masthead-slider',
        'title'         => 'Homepage - Masthead Section',
        'template'      => 'homepage/masthead-section.php',
        'description'   => '',
        'css'           => 'homepage/masthead-slider.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/masthead-slider.js',
        'js_deps'       => [ 'fx_slick', 'fx_masthead_slider_2', 'fx_gsap' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-counter-section',
        'title'         => 'Homepage - Counter Section',
        'template'      => 'homepage/counter.php',
        'description'   => '',
        'css'           => 'homepage/counter-block.css',
        'css_deps'      => [ 'fx_odometter_styles' ],
        'js'            => 'homepage/counter.js',
        'js_deps'       => [ 'fx_odometter' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-products-section',
        'title'         => 'Homepage - Products Section',
        'template'      => 'homepage/products-section.php',
        'description'   => '',
        'css'           => 'homepage/products.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/products-slider.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-testimonial-section',
        'title'         => 'Homepage - Testimonial Section',
        'template'      => 'homepage/testimonial-section.php',
        'description'   => '',
        'css'           => 'homepage/tab-block.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/tab.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-latest-news-and-resources',
        'title'         => 'Homepage - Latest News & Resources Section',
        'template'      => 'homepage/latest-news-and-resources.php',
        'description'   => '',
        'css'           => 'homepage/cards.css',
        'css_deps'      => [ 'fx_wysiwyg',  'fx_slick' ],
        'js'            => 'homepage/cards-slider.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-half-image-cta',
        'title'         => 'Homepage - Half Image + CTA ',
        'template'      => 'homepage/half-image-cta.php',
        'description'   => '',
        'css'           => 'homepage/half-image-cta.css',
        'css_deps'      => [ 'fx_wysiwyg' ],
        'category'      => 'fx-homepage-blocks',
    ]
);

// @todo — add additional homepage blocks below with the "fx-homepage-blocks" category




/**
 * Innerpage blocks
 * 
 * These blocks are intended to be used ONLY on innerpages
 * 
 * Block template path: /themes/fx/block-templates/innerpage
 * Stylesheet path:     /themes/fx/assets/css/innerpage
 * Script path:         /themes/fx/assets/js/innerpage
 * 
 */

/**
 * Create a "FX Innerpage Blocks" category in the block editor. Use "fx-innerpage-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX Innerpage Blocks', 'fx-innerpage-blocks' );

// @todo — add additional innerpage blocks below with the "fx-innerpage-blocks" category

fx_register_block(
    [
        'name'          => 'innerpage-half-media-text',
        'title'         => 'Innerpage - Half Media / Half Text',
        'template'      => 'innerpage/half-media-text.php',
        'css_deps'      => ['fx_contained_image_text', 'fx_lightbox_plugin'],
        'category'      => 'fx-innerpage-blocks',
        'js_deps'       => ['fx_lightbox'],
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-half-image-form',
        'title'         => 'Innerpage - Half Image / Half Form',
        'template'      => 'innerpage/half-image-form.php',
        'category'      => 'fx-innerpage-blocks',
        'css_deps'      => [ 'fx_cf7' ],
        'css'           => 'innerpage/image-form.css',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-statistics-bar',
        'title'         => 'Innerpage - Statistics Bar',
        'template'      => 'innerpage/statistics-bar.php',
        'css'           => 'homepage/counter-block.css',
        'css_deps'      => [ 'fx_odometter_styles' ],
        'js'            => 'homepage/counter.js',
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-products-section',
        'title'         => 'Innerpage - Products Section',
        'template'      => 'homepage/products-section.php',
        'description'   => '',
        'css'           => 'homepage/products.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/products-slider.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-testimonial-with-statistics',
        'title'         => 'Innerpage - Testimonial Tabs with Statistics',
        'template'      => 'homepage/testimonial-section.php',
        'description'   => '',
        'css'           => 'homepage/tab-block.css',
        'css_deps'      => [ 'fx_slick', 'fx_odometter_styles',  'fx_counter_block' ],
        'js'            => 'homepage/tab.js',
        'js_deps'       => [ 'fx_slick', 'fx_counter_script' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-blog-preview',
        'title'         => 'Innerpage - Blog Preview',
        'template'      => 'homepage/latest-news-and-resources.php',
        'description'   => '',
        'css'           => 'homepage/cards.css',
        'css_deps'      => [ 'fx_wysiwyg',  'fx_slick' ],
        'js'            => 'homepage/cards-slider.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-cta',
        'title'         => 'Innerpage - CTA',
        'template'      => 'homepage/half-image-cta.php',
        'description'   => '',
        'css'           => 'homepage/half-image-cta.css',
        'css_deps'      => [ 'fx_wysiwyg' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-subscribe-section',
        'title'         => 'Innerpage - Newsletter Section',
        'template'      => 'innerpage/subscribe-section.php',
        'css'           => 'innerpage/subscribes.css',
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-benefits-section',
        'title'         => 'Innerpage - Benefits Section',
        'template'      => 'innerpage/benefits-section.php',
        'css'           => 'innerpage/benefits-section.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'innerpage/benefits-section.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-brokers-list',
        'title'         => 'Innerpage - Brokers List Section',
        'template'      => 'innerpage/brokers-list.php',
        'css'           => 'innerpage/brokers-list.css',
        'js'            => 'innerpage/brokers-list.js',
        'js_deps'       => ['fx_isotope', 'fx_custom_scrollbar', 'jquery'],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-testimonial-block',
        'title'         => 'Innerpage - Testimonial Block',
        'template'      => 'innerpage/testimonial-block.php',
        'css'           => 'innerpage/testimonial-block.css',
        'css_deps'      => [ 'fx_image_button' ],
        'js'            => 'innerpage/testimonial-block.js',
        'js_deps'       => [ 'jquery' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-forms-block',
        'title'         => 'Innerpage - Forms Block',
        'template'      => 'innerpage/forms-block.php',
        'css'           => 'innerpage/forms-block.css',
        'css_deps'      => [ 'fx_image_button' ],
        'js'            => 'innerpage/forms-block.js',
        'js_deps'       => [ 'jquery' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-feed-block',
        'title'         => 'Innerpage - Feed Block',
        'template'      => 'innerpage/feed-block.php',
        'css'           => 'homepage/products.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/products-slider.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-accordion-block',
        'title'         => 'Innerpage - Accordion Block',
        'template'      => 'innerpage/accordion-block.php',
        'css'           => 'innerpage/accordion-block.css',
        'js'            => 'innerpage/accordion-block.js',
        'js_deps'       => [ 'jquery' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-tab-block',
        'title'         => 'Innerpage - Tab Block',
        'template'      => 'innerpage/tab-block.php',
        'css'           => 'homepage/tab-block.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'innerpage/tab-block.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);

fx_register_block(
    [
        'name'          => 'innerpage-cta-block',
        'title'         => 'Innerpage - CTA Block',
        'template'      => 'innerpage/cta-block.php',
        'css'           => 'innerpage/cta-block.css',
        'category'      => 'fx-innerpage-blocks',
        'post_types'    => [],
    ]
);