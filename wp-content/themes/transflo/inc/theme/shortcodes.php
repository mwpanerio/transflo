<?php


function calling_featured_resources($atts = []) {
    
    ob_start();

    $atts             = array_change_key_case( array($atts), CASE_LOWER )[0];
    $posts_to_display = 1;

    if( isset( $atts['posts_to_display'] ) ) { 
        $posts_to_display = $atts['posts_to_display'];
    }
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_to_display,
    );
    $post_query = new WP_Query($args);

    import_template('./partials/featured-resources', [
        'posts_query' => $post_query
    ]);
    return ob_get_clean();
}

add_shortcode('featured_resources', 'calling_featured_resources');