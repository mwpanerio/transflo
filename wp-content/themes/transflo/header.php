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

    <?php if(is_front_page()): ?>
    <div class="loader">
        <div class="loader__background js-loader-background">
            <?php for($i = 0; $i <= 15; $i++): ?>
                <div>
                    <?php for($inner = 0; $inner <= 25; $inner++): ?>
                        <span class="loader__boxes<?php echo $inner > 7 ? ' hidden-xs-down' : ''; ?>"></span>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
        <div class="loader__container container">
            <div class="loader__squares">
                <span></span>
                <span></span>
            </div>
            <div class="loader__text js-loader-text-parent">
                <div class="loader__text__inner js-loader-text-inner">
                    <div class="loader__text__item js-loader-text">
                        FASTER
                    </div>
                    <div class="loader__text__item js-loader-text">
                        SMARTER
                    </div>
                    <div class="loader__text__item js-loader-text">
                        EFFICIENT
                    </div>
                    <div class="loader__text__item js-loader-text js-loader-text-logo">
                        <?php echo fx_get_image_tag( 29426 ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <header class="page-header">

        <div class="page-header__upper">
            <div class="container">
                <div class="header__upper">
                    <?php
                        // Output the footer navigation
                        wp_nav_menu(
                            [
                                'menu'           => 'Header Upper - Quick Links',
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>
        <div class="container clearfix">
            <div class="logo">
                <a href="<?php echo esc_url( $home_url ); ?>">
                    <?php echo fx_get_image_tag( $logo_id, 'logo' ); ?>
                </a>
            </div>
            <div class="header-right">
                <div class="header-btn hidden-xs-down"><a href="<?php echo get_the_permalink(23); ?>" class="btn btn--contact btn-tertiary">Contact Sales</a></div>
                <div class="js-search-toggle"><i class="icon-search"></i> <span>Search</span></div>
                <div class="toggle-menu hidden-xs-down hidden-lg">
                    <span>
                        <span></span><span></span><span></span>
                    </span>
                    Menu
                </div>
                <nav class="nav-primary">
                    <?php ubermenu( 'main' , array( 'menu' => 3 ) ); ?>
                </nav>
            </div>
        </div>

        <div class="mobile-fixed-nav hidden-sm-up">
            <div class="container">
                <div class="fixed-nav-wrap">
                    <div class="fixed-btn">
                        <a href="<?php echo get_the_permalink(23); ?>" class="btn btn--contact btn-tertiary">Contact Sales</a>
                    </div>
                    <div class="toggle-menu">
                        <span>
                            <span></span><span></span><span></span>
                        </span>
                        Menu
                    </div>
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

    <div class="blockquote-icon hidden" id="js-blockquote-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="260" height="5" viewBox="0 0 260 5">
            <g id="Group_22222" data-name="Group 22222" transform="translate(-1045 -1107)">
                <rect id="Rectangle_2522" data-name="Rectangle 2522" width="80" height="5" rx="2.5" transform="translate(1225 1107)" fill="#8d99ae"/>
                <rect id="Rectangle_2521" data-name="Rectangle 2521" width="80" height="5" rx="2.5" transform="translate(1135 1107)" fill="#da1f2c"/>
                <rect id="Rectangle_2520" data-name="Rectangle 2520" width="80" height="5" rx="2.5" transform="translate(1045 1107)" fill="#2474bb"/>
            </g>
        </svg>
    </div>

    <div class="image-overlay__popup js-form-popup" id="js-form-popup-0">
        <div class="image-overlay__popup__container">
            <div class="image-overlay__popup__inner js-form-popup__inner">
                <div class="image-overlay__popup__close js-form-popup-close">
                    <span></span>
                </div>
                <h3 class="image-overlay__popup__title"><?php echo get_sub_field('form_title')?></h3>
                <?php echo apply_shortcodes('[contact-form-7 id="28943" title="Pricing Form"]'); ?>
            </div>
        </div>
    </div>


    <?php 

        $cf7_args = array(
            'post_type' => 'wpcf7_contact_form',
            'numberposts' => -1
        );

        $cf7_posts = new WP_Query($cf7_args);

        while($cf7_posts->have_posts()): $cf7_posts->the_post(); setup_postdata($cf7_posts);
    ?>

    <div class="image-overlay__popup js-form-popup" id="js-form-popup-<?php echo get_the_ID(); ?>">
        <div class="image-overlay__popup__container">
            <div class="image-overlay__popup__inner js-form-popup__inner">
                <div class="image-overlay__popup__close js-form-popup-close">
                    <span></span>
                </div>
                <h3 class="image-overlay__popup__title"><?php echo get_the_title(); ?></h3>
                <?php echo apply_shortcodes('[contact-form-7 id="' . get_the_ID() . '"]'); ?>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); endwhile;?>