<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <?php // Insert Google Fonts <link> here. Please use &display=swap in your URL! ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php
        // gets client logo image set in Theme Settings
        // @todo — replace with get_custom_logo
        $logo_id    = fx_get_client_logo_image_id(); 
        $home_url   = get_home_url();
    ?>

    <header id="page-header" class="page-header">
        <div class="site-logo-container">
            <a class="site-logo" href="<?php echo esc_url( $home_url ); ?>">
                <?php echo fx_get_image_tag( $logo_id, 'logo' ); ?>
            </a>
        </div>

        <?php 
        
            /* Use the following code if building an Ubermenu mega menu on the site, otherwise delete:
            <div class="mobile-menu">
                <?php ubermenu_toggle(); ?>
            </div>
            <div class="desktop-menu">
                <?php 
                    // Output the ubermenu. Copy code from ubermenu settings in Wordpress and update here
                    ubermenu( 'main' , array( 'menu' => 33 ) ); 
                ?>
            </div> 
            */ 

        ?>
    </header>

    <?php get_search_form(); ?>