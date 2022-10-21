<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php
        $logo_id    = fx_get_client_logo_image_id(); 
        $home_url   = get_home_url();
    ?>

    <header class="page-header">
        <div class="container clearfix">
            <div class="logo">
                <a href="<?php echo esc_url( $home_url ); ?>">
                    <?php echo fx_get_image_tag( $logo_id, 'logo' ); ?>
                </a>
            </div>
            <div class="header-right">
                <div class="header-btn hidden-xs-down"><a href="<?php echo get_the_permalink(23); ?>" class="btn btn-tertiary">Contact Us</a></div>
                <div class="js-search-toggle"><i class="icon-search"></i> <span>Search</span></div>
                <div class="toggle-menu hidden-xs-down hidden-lg"><i class="icon-menu"></i> Menu</div>
                <nav class="nav-primary">
                    <?php
                        // Output the header navigation
                        wp_nav_menu(
                            [
                                'menu'           => 'Header Menu',
                            ]
                        );
                    ?>
                </nav>
            </div>
        </div>

        <div class="mobile-fixed-nav hidden-sm-up">
            <div class="container">
                <div class="fixed-nav-wrap">
                    <div class="fixed-btn">
                        <a href="<?php echo get_the_permalink(23); ?>" class="btn btn-tertiary">Contact Us</a>
                    </div>
                    <div class="toggle-menu"><i class="icon-menu"></i> Menu</div>
                </div>
            </div>
        </div>
        <div class="desktop-menu__search">
            <div class="container">
                <div class="desktop-menu_wrap">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>